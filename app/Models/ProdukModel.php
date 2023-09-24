<?php

namespace App\Models;

use CodeIgniter\Database\MySQLi\Builder;
use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id_produk';
    protected $allowedFields    = ['id_kategori','nama_produk','harga_produk','stok_produk','deskripsi_produk','foto_produk'];

    // Dates
    protected $useTimestamps = true; 

    function getAll() {
        $builder = $this->db->table('produk');
        $builder->join('kategori','kategori.id_kategori = produk.id_kategori','LEFT');
        $query = $builder->get();

        return $query->getResultArray();
    }

    function getProduk($id_kategori) {
        $builder = $this->db->table('produk');
        $builder->where('id_kategori', $id_kategori);
        $query = $builder->get();

        return $query->getResultArray();
    }
}