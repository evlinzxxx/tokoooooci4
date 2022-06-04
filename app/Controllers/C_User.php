<?php

namespace App\Controllers;

class C_User extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    //function untuk menampilkan data user
    public function index()
    {
        $model =  new \App\Models\M_User();

        $data =[
            'users'=> $model->paginate(10),
            'pager'=> $model->pager,
        ]; 

        return view('user/index', [
            'data'=> $data,

        ]);
    }

    
}
 