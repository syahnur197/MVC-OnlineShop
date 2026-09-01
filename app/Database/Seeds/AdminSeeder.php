<?php

namespace App\Database\Seeds;

use App\Entities\User;
use App\Models\UserModel;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Database\Seeder;

/**
 * Creates the single administrator account a fresh install needs.
 * Idempotent: it does nothing on a database that already has an admin.
 *
 * Set ADMIN_PASSWORD in .env to choose the password.
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $users = new UserModel();

        if ($users->where('user_type', User::TYPE_ADMIN)->first() !== null) {
            CLI::write('An admin already exists, nothing to do.', 'yellow');

            return;
        }

        $password = env('ADMIN_PASSWORD') ?: 'admin1234';

        // UserModel::hashPassword() hashes it on the way in.
        $admin = new User([
            'first_name' => 'Site',
            'last_name'  => 'Administrator',
            'username'   => 'admin',
            'email'      => 'admin@example.com',
            'password'   => $password,
            'user_type'  => User::TYPE_ADMIN,
        ]);

        // Validation is skipped on purpose: the rules describe the registration form,
        // which asks for a plain password plus a confirmation field.
        $users->skipValidation(true)->insert($admin);

        CLI::write('Created the admin account "admin" with password: ' . $password, 'green');
    }
}
