<?php

namespace App\Controllers;


class C_Komentar extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();//library validation
        $this->session = session();//library session
    }

    //function untuk menambahkan komentar
    public function komentar()
    {
        //mengambil id barang dari segment ke 3 yaitu id di view beli
        $id_barang = $this->request->uri->getSegment(3);
        $model = new \App\Models\M_Komentar();
        
         //jika ada data yang di post
        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'komentar');
            $errors = $this->validation->getErrors();

            //jika tidak ada error
            if (!$errors) {

                $komentarEntity = new \App\Entities\Komentar();

                $komentarEntity->fill($data);//memindahkan data yang di post ke dalam model
                //ambil id user yang membuat komentar

                $komentarEntity->created_by = $this->session->get('id');//id user yg memberi komentar
                $komentarEntity->created_date = date("Y-m-d H:i:s");//tanggal pembuatan komentar

                $model->save($komentarEntity);//simpan komentar di dalam model

                //mengatur agar bisa langsung tampil komentar di tampilan beli barang
                $segments = ['C_Etalase', 'beli', $id_barang];

                return redirect()->to(site_url($segments));
            }
        }
        //jika ada error kembalikan ke halaman tambah komentar
        return view('komentar/create', [
            'id_barang' => $id_barang,
            'model' => $model
        ]);
    }
}
