<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'first_name'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'last_name'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'company_name' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => ''],
            'username'     => ['type' => 'VARCHAR', 'constraint' => 50],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 100],
            'password'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'user_type'    => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'user'],
            'is_banned'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');
    }

    public function down(): void
    {
        $this->forge->dropTable('users');
    }
}
