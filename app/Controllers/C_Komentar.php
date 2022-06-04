<?php

namespace App\Controllers;


class C_Komentar extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    //function untuk menambahkan komentar
    public function komentar()
    {

        $id_barang = $this->request->uri->getSegment(3);
        $model = new \App\Models\M_Komentar();

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'komentar');
            $errors = $this->validation->getErrors();


            if (!$errors) {

                $komentarEntity = new \App\Entities\Komentar();

                $komentarEntity->fill($data);
                $komentarEntity->fill($data);

                $komentarEntity->created_by = $this->session->get('id');
                $komentarEntity->created_date = date("Y-m-d H:i:s");

                $model->save($komentarEntity);

                $segments = ['C_Etalase', 'beli', $id_barang];

                return redirect()->to(site_url($segments));
            }
        }

        return view('komentar/create', [
            'id_barang' => $id_barang,
            'model' => $model
        ]);
    }
}
