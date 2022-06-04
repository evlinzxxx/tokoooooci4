<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    //function set password hashing dan pencocokan pass1 dan pass2
    public function setPassword(string $pass)
    {
        $password2 = uniqid('', true);
        $this->attributes['password2'] = $password2;
        $this->attributes['password'] = md5($password2 . $pass);

        return $this;
    }
}
