<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_barang', 'id_pembeli', 'jumlah', 'total_harga', 'alamat', 'ongkir', 'status', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];

    protected $returnType = '\App\Entities\Transaksi';
    protected $useTimeStamps = false;
}
