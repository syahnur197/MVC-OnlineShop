<?php

namespace App\Controllers;

use App\Entities\User;
use App\Models\UserModel;

class Account extends BaseController
{
    public function login(): string
    {
        return $this->page('account/login', 'Login');
    }

    public function attemptLogin()
    {
        $username = (string) $this->request->getPost('username');
        $password = (string) $this->request->getPost('password');

        $failure = $this->auth->attempt($username, $password);

        if ($failure === 'banned') {
            return redirect()->to(site_url('shop'))
                ->with('error', 'This account is banned from the site.');
        }

        if ($failure !== null) {
            // Deliberately vague: do not reveal whether the username exists.
            return redirect()->to(site_url('account'))->withInput()
                ->with('error', 'Those credentials do not match our records.');
        }

        return $this->auth->isAdmin()
            ? redirect()->to(site_url('admin'))
                ->with('success', 'Welcome back, ' . $this->auth->username() . '. You are signed in as the administrator.')
            : redirect()->to(site_url('shop'))
                ->with('success', 'Welcome back, ' . $this->auth->username() . '. Happy browsing.');
    }

    public function register(): string
    {
        return $this->page('account/register', 'Register Account');
    }

    public function createAccount()
    {
        $users = model(UserModel::class);

        // The model validates the plain password against password_confirm, then hashes it.
        $user = new User($this->request->getPost([
            'first_name',
            'last_name',
            'username',
            'email',
            'password',
            'password_confirm',
        ]));
        $user->user_type = User::TYPE_USER;

        if (! $users->insert($user)) {
            return redirect()->to(site_url('account/register'))->withInput()
                ->with('error', $this->errorList($users->errors()));
        }

        return redirect()->to(site_url('account'))
            ->with('success', 'Your account has been created. You can log in now.');
    }

    public function logout()
    {
        $this->auth->logout();

        return redirect()->to(site_url('shop'))->with('success', 'You have been logged out.');
    }

    private function page(string $view, string $title): string
    {
        return view('layout/account/header', ['title' => $title])
            . view($view)
            . view('layout/account/footer');
    }
}
