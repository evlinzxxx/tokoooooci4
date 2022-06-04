<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Komentar extends Model
{
    protected $table = 'tb_komentar';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_barang', 'id_user', 'komentar', 'created_by', 'updated_date', 'updated_by'
    ];

    protected $returnType = '\App\Entities\Komentar';
    protected $useTimeStamps = false;
}
