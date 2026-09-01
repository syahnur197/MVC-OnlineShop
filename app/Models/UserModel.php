<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    protected $useTimestamps  = false;
    protected $useSoftDeletes = false;
    protected $allowedFields  = [
        'first_name',
        'last_name',
        'company_name',
        'username',
        'email',
        'password',
        'user_type',
        'is_banned',
    ];

    /**
     * Rules for the registration form. The profile form has its own set, see
     * rulesForProfile(), because a user must be allowed to keep their own
     * username and e-mail address.
     */
    protected $validationRules = [
        'first_name'       => 'trim|required|min_length[2]|max_length[50]|alpha_space',
        'last_name'        => 'trim|required|min_length[2]|max_length[50]|alpha_space',
        'username'         => 'trim|required|min_length[5]|max_length[12]|alpha_numeric|is_unique[users.username]',
        'email'            => 'trim|required|valid_email|max_length[100]|is_unique[users.email]',
        'password'         => 'required|min_length[8]',
        'password_confirm' => 'required|matches[password]',
    ];

    protected $validationMessages = [
        'first_name'       => ['required' => 'You have not provided your first name.'],
        'last_name'        => ['required' => 'You have not provided your last name.'],
        'username'         => ['is_unique' => 'This username is already taken.'],
        'email'            => ['is_unique' => 'This e-mail address is already registered.'],
        'password_confirm' => ['matches' => 'The two passwords do not match.'],
    ];

    /**
     * Both callbacks run after validation, which is what makes the plain password
     * available to matches[password] and still keeps it out of the database.
     */
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        // password_confirm is validated but never stored.
        unset($data['data']['password_confirm']);

        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

        return $data;
    }

    public function rulesForProfile(int $userId): array
    {
        return [
            'first_name' => $this->validationRules['first_name'],
            'last_name'  => $this->validationRules['last_name'],
            'username'   => "trim|required|min_length[5]|max_length[12]|alpha_numeric|is_unique[users.username,id,{$userId}]",
            'email'      => "trim|required|valid_email|max_length[100]|is_unique[users.email,id,{$userId}]",
        ];
    }

    public function findByUsername(string $username): ?User
    {
        return $this->where('username', $username)->first();
    }

    /** Customers only: the dashboard does not let an admin manage other admins. */
    public function customers(): array
    {
        return $this->where('user_type', User::TYPE_USER)->orderBy('id', 'ASC')->findAll();
    }

    public function setBanned(int $userId, bool $banned): bool
    {
        return $this->update($userId, ['is_banned' => (int) $banned]);
    }

    /**
     * The password rules, so the change-password form validates the plain text
     * before it reaches changePassword() and gets hashed. Rules and messages are
     * returned together, in the combined format Controller::validate() understands,
     * so they stay defined only once above.
     */
    public function passwordRules(): array
    {
        $rules = [];

        foreach (['password', 'password_confirm'] as $field) {
            $rules[$field] = [
                'label'  => $field === 'password' ? 'Password' : 'Password confirmation',
                'rules'  => $this->validationRules[$field],
                'errors' => $this->validationMessages[$field] ?? [],
            ];
        }

        return $rules;
    }

    /**
     * Replace a password after checking the current one. Returns false only when the
     * current password is wrong - the caller is expected to have validated the new one
     * against passwordRules() already. hashPassword() does the hashing.
     */
    public function changePassword(int $userId, string $currentPassword, string $newPassword): bool
    {
        $user = $this->find($userId);

        if ($user === null || ! $user->verifyPassword($currentPassword)) {
            return false;
        }

        return $this->update($userId, ['password' => $newPassword]);
    }
}
