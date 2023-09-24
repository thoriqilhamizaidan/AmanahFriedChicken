<?php

namespace App\Models;

use CodeIgniter\Model;

class PembelianModel extends Model
{
    protected $table      = 'pembelian';
    protected $primaryKey = 'idbeli';

    protected $allowedFields = [
        'notransaksi',
        'id',
        'tanggalbeli',
        'totalbeli',
        'alamatpengiriman',
        'jenispengiriman ',
        'kota',
        'ongkir',
        'statusbeli',
        'resipengiriman',
        'bukti_makanan',
        'waktu'
    ];

    protected $useTimestamps = true;

    public function leftJoin($idpengguna)
    {
        $builder = $this->db->table('pembelian');
        $builder->select('*')->select('pembelian.idbeli as idbelireal')
            ->join('pembayaran', 'pembelian.idbeli = pembayaran.idbeli', 'left')
            ->where('pembelian.id', $idpengguna)
            ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idbeli', 'desc');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function idbeli($idpengguna)
    {
        $builder = $this->db->table('pembelian');
        $builder->select('pembelian.idbeli')->where('pembelian.id', $idpengguna)
            ->orderBy('pembelian.tanggalbeli', 'desc')
            ->orderBy('pembelian.idbeli', 'desc');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function joinPengguna($idbeli)
    {
        $builder = $this->db->table('pembelian');
        $builder->select('*')->select('pembelian.idbeli')
            ->join('pengguna', 'pengguna.idpengguna = pembelian.id')
            ->where('pembelian.idbeli', $idbeli);
        $query = $builder->get();

        return $query->getRowArray();
    }
}
