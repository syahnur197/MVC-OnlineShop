<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAddresses extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'street'     => ['type' => 'VARCHAR', 'constraint' => 100],
            'town'       => ['type' => 'VARCHAR', 'constraint' => 50],
            'postcode'   => ['type' => 'VARCHAR', 'constraint' => 10],
            'country'    => ['type' => 'VARCHAR', 'constraint' => 50],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        // One shipping address per user: checkout updates it in place.
        $this->forge->addUniqueKey('user_id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('addresses');
    }

    public function down(): void
    {
        $this->forge->dropTable('addresses');
    }
}
