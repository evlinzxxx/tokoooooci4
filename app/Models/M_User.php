<?php namespace App\Models;

use CodeIgniter\Model;

class M_User extends Model
{
 protected $table = 'tb_user';
 protected $primaryKey = 'id';
 protected $allowedFields = [
     'username','password','password2','profile','level','created_date','created_by','updated_date','updated_by'
 ];

 protected $returnType = '\App\Entities\User';
 protected $useTimeStamps = false;

}
