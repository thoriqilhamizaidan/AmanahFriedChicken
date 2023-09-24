<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembelianProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idbeli_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'idbeli' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'harga' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'subharga' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'jumlah' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
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
        $this->forge->addKey('idbeli_produk', true);
        $this->forge->createTable('pembelianproduk');    
    }

    public function down()
    {
        $this->forge->dropTable('pembelianproduk');
    }
}
