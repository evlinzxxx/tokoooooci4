<?php

namespace App\Controllers;


class C_Barang extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();//library validation
        $this->session = session();//library session
    }

    //function untuk menampilkan semua data barang
    public function index()
    {
        $modelBarang = new \App\Models\M_Barang();
        //memasukkan data barang dan pagination ke array data
        $data = [
            $barangs = $modelBarang->findAll(),
            'barang' => $modelBarang->paginate(5),
            'pager' => $modelBarang->pager,
        ];
        //mengarhkan ke tampilan index barang dengan membawa data
        return view('barang/index', [
            'data' => $data
        ]);
    }

    //function untuk menampilkan view detail barang
    public function view()
    {
        //mengambil id dari segment create atau update
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();
        //mencari data barang di model sesuai id yang dipilih
        $barang = $modelBarang->find($id);

        //mengarahkan ke tampilan view barang dengan data barang
        return view('barang/view', [
            'barang' => $barang
        ]);
    }

    //function untuk tambah barang
    public function create()
    {
        //jika ada data yang di post
        if ($this->request->getPost()) {
            //jika ada data yang di post
            $data = $this->request->getPost();//simpan di var data
            $this->validation->run($data, 'barang');//validai dngan entities
            $errors = $this->validation->getErrors();//cek bila ada error
            
            //jika tidak ada error jalankan
            if (!$errors) {
                $modelBarang = new \App\Models\M_Barang();

                $barang = new \App\Entities\Barang();

                $barang->fill($data);//simpan data
                $barang->gambar = $this->request->getFile('gambar');//ambil gambar
                $barang->created_by = $this->session->get('id');//ambil id admin
                $barang->created_date = date("Y-m-d H:i:s");//tanggal barang dibuat

                $modelBarang->save($barang);//simpan data barang di dalam model

                $id = $modelBarang->insertID();//mengambil id barang terakhir yang berhasil disimpan

                $segments = ['C_Barang', 'view', $id];//mengatur agar bisa langsung tampil detail barang dengan id yg sudah disimpan
                // /barang/view/$id
                return redirect()->to(site_url($segments));
            }
        }
        return view('barang/create');
    }

    //function untuk update barang
    public function update()
    {
        //mengambil id dari segment create
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();
        //mencari data barang di model sesuai id yang dipilih
        $barang = $modelBarang->find($id);

         //jika ada data yang dipost
        if ($this->request->getPost()) {
            $data = $this->request->getPost();//simpan di var data
            $this->validation->run($data, 'barangupdate');//validai dngan entities
            $errors = $this->validation->getErrors();//cek bila ada error

            //jika tidak error
            if (!$errors) {

                $b = new \App\Entities\Barang();
                //passing id untuk mencari data yg akan diubah
                $b->id = $id;
                //simpan datanya
                $b->fill($data);

                //jika ada gambar yang di upload
                if ($this->request->getFile('gambar')->isValid()) {
                    //tampilkan gambar
                    $b->gambar = $this->request->getFile('gambar');
                }

                $b->updated_by = $this->session->get('id');//id yang mengupdate
                $b->updated_date = date("Y-m-d H:i:s");//tanggal update

                $modelBarang->save($b);//simpan data yang diubah ke dalam model

                $segments = ['C_Barang', 'view', $id];//mengatur agar bisa langsung tampil detail barang dengan id yg sudah diupdate

                return redirect()->to(base_url($segments));
            }
        }
        //jika gagal mengupdate, kembalikan ke form update barang
        return view('barang/update', [
            'barang' => $barang
        ]);
    }

    //function untuk hapus barang
    public function delete()
    {
        //mengambil id dari segment create atau update
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        //menghapus data barang di model berdasrkan id
        $delete = $modelBarang->delete($id);

         //diarahkan kembali ke halaman index barang
        return redirect()->to(site_url('C_Barang/index'));
    }
}
