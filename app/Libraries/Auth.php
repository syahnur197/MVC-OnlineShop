<?php

namespace App\Libraries;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\Session\Session;

/**
 * Everything that reads or writes the logged in user's session lives here, so the
 * session keys are spelled out in exactly one place.
 */
class Auth
{
    public const SESSION_KEY = 'user';

    private Session $session;

    public function __construct(private UserModel $users)
    {
        $this->session = session();
    }

    /**
     * Check the credentials and start a session. Returns the reason it failed, or
     * null when the login succeeded.
     *
     * @return string|null 'invalid' | 'banned' | null
     */
    public function attempt(string $username, string $password): ?string
    {
        $user = $this->users->findByUsername($username);

        // Verify against a dummy hash when the account does not exist, so that a wrong
        // username takes the same time as a wrong password.
        if ($user === null) {
            password_verify($password, '$2y$12$usesomesillystringfore7hnbRJHxXVLeakoG8K30M1MYF5U6u');

            return 'invalid';
        }

        if (! $user->verifyPassword($password)) {
            return 'invalid';
        }

        if ($user->is_banned) {
            return 'banned';
        }

        // New session id on privilege change: an id captured before login is useless.
        $this->session->regenerate(true);
        $this->session->set(self::SESSION_KEY, [
            'id'       => $user->id,
            'username' => $user->username,
            'type'     => $user->user_type,
        ]);

        return null;
    }

    public function logout(): void
    {
        $this->session->remove(self::SESSION_KEY);
        $this->session->destroy();
    }

    public function check(): bool
    {
        return $this->session->has(self::SESSION_KEY);
    }

    public function id(): ?int
    {
        return $this->session->get(self::SESSION_KEY)['id'] ?? null;
    }

    public function username(): ?string
    {
        return $this->session->get(self::SESSION_KEY)['username'] ?? null;
    }

    public function type(): ?string
    {
        return $this->session->get(self::SESSION_KEY)['type'] ?? null;
    }

    public function isAdmin(): bool
    {
        return $this->type() === User::TYPE_ADMIN;
    }

    public function isCustomer(): bool
    {
        return $this->type() === User::TYPE_USER;
    }

    /** The full record, re-read from the database. Null when nobody is logged in. */
    public function user(): ?User
    {
        $id = $this->id();

        return $id === null ? null : $this->users->find($id);
    }

    /**
     * Refresh the cached session copy after the user edits their own profile, so the
     * navigation bar does not keep showing the old username.
     */
    public function refresh(): void
    {
        $user = $this->user();

        if ($user !== null) {
            $this->session->set(self::SESSION_KEY, [
                'id'       => $user->id,
                'username' => $user->username,
                'type'     => $user->user_type,
            ]);
        }
    }
}
