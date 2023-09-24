<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table      = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $allowedFields = [
        'idbeli',
        'nama',
        'tanggaltransfer',
        'tanggal',
        'bukti',
    ];

    protected $useTimestamps = true;
}
