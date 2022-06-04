<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Barang extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama', 'harga', 'stok', 'deskripsi', 'gambar', 'created_date', 'created_by', 'updated_date', 'updated_by'
    ];

    protected $returnType = '\App\Entities\Barang';
    protected $useTimeStamps = false;
}
