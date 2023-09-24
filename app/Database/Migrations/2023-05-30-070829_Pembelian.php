<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pembelian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idbeli' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'notransaksi' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'tanggalbeli' => [
                'type'       => 'date',
            ],
            'totalbeli' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'alamatpengiriman' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'kota' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'ongkir' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'statusbeli' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'resipengiriman' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'waktu' => [
                'type'       => 'datetime',
            ],
            
            'created_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
        ]);
        $this->forge->addKey('idbeli', true);
        $this->forge->createTable('pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('pembelian');
    }
}
