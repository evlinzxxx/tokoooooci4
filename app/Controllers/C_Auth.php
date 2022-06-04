<?php

namespace App\Controllers;

class C_Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    //function untuk mengarahkan ke view awal web
    public function tampilan()
    {
        return view('view');
    }

    //function untuk registrasi
    public function register()
    {

        if ($this->request->getPost()) {
            //validasi untuk data yang di post/di inputkan
            $data = $this->request->getPost();
            $validate = $this->validation->run($data, 'register');
            $errors = $this->validation->getErrors();

            //jika tidak terdapat error
            if (!$errors) {
                $modelUser = new \App\Models\M_User();

                $user = new \App\Entities\User();

                $user->username = $this->request->getPost('username');
                $user->password = $this->request->getPost('password');

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
