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

                $user->created_by = 0;//yang membuat akun
                $user->created_date = date("Y-m-d H:i:s");//tanggal akun dibuat

                $modelUser->save($user);//simpan data user ke dalam model

                return view('login');//arahkan ke view login
            }
            //jika salah tampilkan pesan error
            $this->session->setFlashdata('errors', $errors);
        }
        //kembalikan ke form register
        return view('register');
    }

    //function untuk login
    public function login()
    {
        //mengambil data login yang diinputkan user
        //jalankan validasi data yanng dipost
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'login');
            $errors = $this->validation->getErrors();

            //jika ada error return view login kembali
            if ($errors) {
                return view('login');
            }

            $modelUser = new \App\Models\M_User();

            $username = $this->request->getPost('username');//menyimpan data username di var username
            $password = $this->request->getPost('password');//menyimpan data password di var password
            //cek username yang dipost apakah sama dengan username di db,simpan dalam var user
            $user = $modelUser->where('username', $username)->first();

            //jika user ditemukan
            if ($user) {
                $password2 = $user->password2;//mengambil password2 dari user yg ditemukan
                //jika password yg dipost tidak sama dengan password dan password2 di db
                if ($user->password !== md5($password2 . $password))
                {
                    $this->session->setFlashdata('errors', ['Password Salah!']);//tampil pesan error
                //jika password yg dipost sama dengan password dan password2 di db
                } else {
                    //session data dalam array
                    $sessData = [
                        'username' => $user->username,
                        'id' => $user->id,
                        'level' => $user->level,
                        'isLoggedIn' => TRUE
                    ];

                    $this->session->set($sessData);//menyimpan session

                    //arahkan ke controller C_Etalase di funtion index
                    return redirect()->to(site_url('C_Etalase/index'));
                }
            } else {
                //pesan error jika user tidak ditemukan
                $this->session->setFlashdata('errors', ['User Tidak Ditemukan :( ']);
            }
        }
        return view('login');
    }

    //function untuk logout
    public function logout()
    {
        //session untuk logout
        $this->session->destroy();
        return redirect()->to(site_url('C_Auth/login'));//diminta untuk kembali login
    }
}
