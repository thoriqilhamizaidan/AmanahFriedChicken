<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianprodukModel extends Model
{
    protected $table      = 'pembelianproduk';
    protected $primaryKey = 'idbeli_produk';

    protected $allowedFields = [
        'idbeli',
        'id_produk',
        'nama',
        'harga',
        'subharga',
        'jumlah',
    ];

    protected $useTimestamps = true;

    public function join($idbeli)
    {
        $builder = $this->db->table('pembelianproduk');
        $builder->select('*')->join('produk', 'pembelianproduk.id_produk = produk.id_produk')
            ->where('idbeli', $idbeli);
        $query = $builder->get();

        return $query->getResultArray();
    }
}
