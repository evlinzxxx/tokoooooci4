<?php

namespace App\Controllers;


class C_Barang extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    //function untuk menampilkan semua data barang
    public function index()
    {
        $modelBarang = new \App\Models\M_Barang();


        $data = [
            $barangs = $modelBarang->findAll(),
            'barang' => $modelBarang->paginate(5),
            'pager' => $modelBarang->pager,
        ];

        return view('barang/index', [
            'data' => $data
        ]);
    }

    //function untuk menampilkan view detail barang
    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $barang = $modelBarang->find($id);

        return view('barang/view', [
            'barang' => $barang
        ]);
    }

    //function untuk tambah barang
    public function create()
    {
        if ($this->request->getPost()) {
            //jika ada data yang di post
            $data = $this->request->getPost();
            $this->validation->run($data, 'barang');
            $errors = $this->validation->getErrors();

            if (!$errors) {
                $modelBarang = new \App\Models\M_Barang();

                $barang = new \App\Entities\Barang();

                $barang->fill($data);
                $barang->gambar = $this->request->getFile('gambar');
                $barang->created_by = $this->session->get('id');
                $barang->created_date = date("Y-m-d H:i:s");

                $modelBarang->save($barang);

                $id = $modelBarang->insertID();

                $segments = ['C_Barang', 'view', $id];
                // /barang/view/$id
                return redirect()->to(site_url($segments));
            }
        }
        return view('barang/create');
    }

    //function untuk update barang
    public function update()
    {
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $barang = $modelBarang->find($id);

        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'barangupdate');
            $errors = $this->validation->getErrors();

            if (!$errors) {

                $b = new \App\Entities\Barang();

                $b->id = $id;
                $b->fill($data);

                if ($this->request->getFile('gambar')->isValid()) {
                    $b->gambar = $this->request->getFile('gambar');
                }

                $b->updated_by = $this->session->get('id');
                $b->updated_date = date("Y-m-d H:i:s");

                $modelBarang->save($b);

                $segments = ['C_Barang', 'view', $id];

                return redirect()->to(base_url($segments));
            }
        }

        return view('barang/update', [
            'barang' => $barang
        ]);
    }

    //function untuk hapus barang
    public function delete()
    {
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $delete = $modelBarang->delete($id);

        return redirect()->to(site_url('C_Barang/index'));
    }
}
