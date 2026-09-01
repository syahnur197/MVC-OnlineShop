<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Loads the catalogue carried over from the CodeIgniter 3 application, so the
 * migrated shop has something to render. Optional, run it explicitly:
 *
 *     php spark db:seed DemoDataSeeder
 *
 * Re-runnable: every table it touches is emptied first. Every demo account has
 * the password "password123".
 */
class DemoDataSeeder extends Seeder
{
    /** Children first, so the truncates do not trip over the foreign keys. */
    private const TABLES = [
        'reviews',
        'cart_items',
        'carts',
        'addresses',
        'contact_messages',
        'product_images',
        'products',
        'categories',
        'users',
    ];

    public function run(): void
    {
        $statements = file_get_contents(__DIR__ . '/sql/demo_data.sql');

        $this->db->disableForeignKeyChecks();

        try {
            foreach (self::TABLES as $table) {
                $this->db->table($table)->truncate();
            }

            // Match whole INSERT statements. The terminator has to be a semicolon at the
            // end of a line: the product descriptions contain HTML entities such as
            // "&amp;" whose semicolons sit mid line.
            preg_match_all('/^INSERT INTO .*?;$/ms', $statements, $matches);

            foreach ($matches[0] as $statement) {
                $this->db->query($statement);
            }
        } finally {
            $this->db->enableForeignKeyChecks();
        }
    }
}
