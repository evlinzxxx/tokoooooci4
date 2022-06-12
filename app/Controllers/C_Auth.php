<?php

namespace App\Controllers;

class C_Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();//library validation
        $this->session = session();//library session
    }

    //function untuk mengarahkan ke view awal web
    public function tampilan()
    {
        return view('view');
    }

    //function untuk registrasi
    public function register()
    {
        //mengambil data register yang diinputkan user
        //jalankan validasi data yanng dipost
        if ($this->request->getPost()) {
            //validasi untuk data yang di post/di inputkan
            $data = $this->request->getPost();//menempatkan data yang diambil di inputan di variabel data
            $validate = $this->validation->run($data, 'register');//validasi untuk data yang di post/di inputkan
            $errors = $this->validation->getErrors();//cek status error

            //jika tidak terdapat error jalankan
            if (!$errors) {
                $modelUser = new \App\Models\M_User();

                $user = new \App\Entities\User();

                $user->username = $this->request->getPost('username');//meng-assign field ussername, dengan value post sebelumnnya
                $user->password = $this->request->getPost('password');//meng-assign field password, dengan value post sebelumnnya
                //password langsung terhubung ke entities User

                $user->created_by = 0;
                $user->created_date = date("Y-m-d H:i:s");

                $modelUser->save($user);

                return view('login');
            }

            $this->session->setFlashdata('errors', $errors);
        }

        return view('register');
    }

    //function untuk login
    public function login()
    {
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');
            $errors = $this->validation->getErrors();

            if ($errors) {
                return view('login');
            }

            $modelUser = new \App\Models\M_User();

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $user = $modelUser->where('username', $username)->first();

            if ($user) {
                $password2 = $user->password2;
                if ($user->password !== md5($password2 . $password)) {
                    $this->session->setFlashdata('errors', ['Password Salah!']);
                } else {
                    $sessData = [
                        'username' => $user->username,
                        'id' => $user->id,
                        'level' => $user->level,
                        'isLoggedIn' => TRUE
                    ];

                    $this->session->set($sessData);

                    return redirect()->to(site_url('C_Etalase/index'));
                }
            } else {
                $this->session->setFlashdata('errors', ['User Tidak Ditemukan :( ']);
            }
        }
        return view('login');
    }

    //function untuk logout
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(site_url('C_Auth/login'));
    }
}
