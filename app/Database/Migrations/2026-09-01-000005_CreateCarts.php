<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarts extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            // NULL while the cart is still open; set when the user checks out, which
            // turns the cart into an order. Replaces the old date_buy + flag pair.
            'ordered_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addKey(['user_id', 'ordered_at']);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('carts');
    }

    public function down(): void
    {
        $this->forge->dropTable('carts');
    }
}
