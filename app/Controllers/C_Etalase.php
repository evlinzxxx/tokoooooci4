<?php

namespace App\Controllers;

class C_Etalase extends BaseController
{
    //properti untuk mengatur API rajaongkir
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "16b7667d8f47d138163ea6325e0e9de0";


    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();//library validation
        $this->session = session();//library session
    }

    //function untuk mengarahkan ke halaman info
    public function info()
    {
        //mengembalikan ke tampilan info di etalase
        return view('etalase/info');
    }

    public function index()
    {
        $barang = new \App\Models\M_Barang();

        //menyimpan semua data pada model barang dan pager dalam array var data
        $data = [
            $model = $barang->findAll(),
            'etalase' => $barang->paginate(6),
            'pager' => $barang->pager,
        ];

        //mengembalikan ke tampilan index etalase dengan membawa data
        return view('etalase/index', [
            'data' => $data,
        ]);
    }

    //function untuk menuju dan mengisi serta melakukan pembelian barang
    public function beli()
    {
        //mengambil id yang ada pada segment ke 3
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $modelKomentar = new \App\Models\M_Komentar();

        $komentar = $modelKomentar->where('id_barang', $id)->findAll();

        //menyimpan data yg dicari dengan id di dalam model barang
        $model = $modelBarang->find($id);
        //mengambil data provinsi pada api rajaongkir
        $provinsi = $this->rajaongkir('province');

        //jika ada data yang dipost 
        if ($this->request->getPost()) {
            $data = $this->request->getPost();//simpan di var data
            $this->validation->run($data, 'transaksi');//validasi dengan entities
            $errors = $this->validation->getErrors();//cek jika ada error

            if (!$errors) {
                //memanggil model M_Transaksi
                $transaksiModel = new \App\Models\M_Transaksi();
                //memanggil entities Transaksi
                $transaksi = new \App\Entities\Transaksi();
                //memanggil model M_Barang
                $barangModel = new \App\Models\M_Barang();
                //mengambil id barang dengan fungsi getPost
                $id_barang = $this->request->getPost('id_barang');
                //mengambil jumlah barang yg dibeli yang sudah dihitung 
                //di view beli dengan fungsi getPost
                $jumlah_pembelian = $this->request->getPost('jumlah');
                //mencari data barang di dalam model melalui id_barang
                $barang = $barangModel->find($id_barang);
                $entityBarang = new \App\Entities\Barang();
                //menyimpan id barang di variabel entityBarang
                $entityBarang->id = $id_barang;
                //mengurangkan jumlah stok barang jika sudah dibeli
                $entityBarang->stok = $barang->stok - $jumlah_pembelian;
                //menyimpan jumlah barang yang real kedalam model barang
                $barangModel->save($entityBarang);

                $transaksi->fill($data);//ambil data transaksi
                $transaksi->status = 0;
                $transaksi->created_by = $this->session->get('id');//ambil id user yg membeli
                $transaksi->created_date = date("Y-m-d H:i:s");//ambil waktu saat membeli

                //simpan data transaksi di dalam model transaksi
                $transaksiModel->save($transaksi);

                //ambil id transaksinya
                $id = $transaksiModel->insertID();
                //digunakan untuk membuka view transaksi customer berdasarkan id
                $segment = ['C_Transaksi', 'view_cust', $id];
                //menjalankan nilai segment
                return redirect()->to(site_url($segment));
            }
        }
         //kalau tidak ada data yg di post
        //kembalikan ke form beli
        return view('etalase/beli', [
            'model' => $model,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,//untuk mendaptkan data provinsi,perlu masuk ke field results pada api rajaongkir
            'komentar' => $komentar
        ]);
    }

    //function untuk mendapatkan nilai ongkir
    public function getCost()
    {
        if ($this->request->isAJAX())//memanggil cost dengan fungsi AJAX
        {
            $origin = $this->request->getGet('origin');//mengambil data origin
            $destination = $this->request->getGet('destination');//mengambil data destination
            $weight = $this->request->getGet('weight');//mengambil data weight
            $courier = $this->request->getGet('courier');//mengambil data courier
            //menyimpan data final cost,setelah data origin,destination,weight,dan courier 
            //yang sudah dicocokan dengan function rajaongkircost di dalam var data
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            //mengembalikan data ke view halaman beli
            return $this->response->setJSON($data);
        }
    }

    //function untuk mendapatkan data kabupaten/kota
    public function getCity()
    {
        if ($this->request->isAJAX())//memanggil city dengan fungsi AJAX
        {
            //mengambil id provinsi sesuai data province yang dipilih
            $id_province = $this->request->getGet('id_province');
            //ambil data city berdasarkan id province nya
            $data = $this->rajaongkir('city', $id_province);
            //menampilkan data city nya dengan JSON
            return $this->response->setJSON($data);
        }
    }
    
    //menyimpan semua function rajaongkircost untuk menghitung total ongkir
    private function rajaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey,
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }

    //menyimpan semua function rajaongkir untuk mendapatkan nilai provinsi
    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;//menerima atau menampung string province dan city

        if ($id_province != null) //id_province akan digunakan untuk memfilter nama city berdasarkan id province
        {
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey//dari apikey di atas
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    //function untuk memperlihatkan keranjang
    public function index_cart()
    {
        //mengembalikan nilai cart dalam bentuk array di dalam var data field items
        $data['items'] = array_values(session('cart'));
        //menyimpan total harga keranjang di var data field total
        $data['total'] = $this->total();
        return view('keranjang/index', $data);
    }

    //function untuk menambahkan barang ke keranjang
    public function tambah_cart()
    {
        //mengambil segment ke 3 dari view beli yaitu id
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();
        //mencari data barang di model berdasarkan id
        $model = $modelBarang->find($id);
        //memasukkan data yang sudah ditemukan di dalam array
        $item = array(
            'id' => $model->id,
            'name' => $model->nama,
            'photo' => $model->gambar,
            'price' => $model->harga,
            'quantity' => 1
        );

        $session = session();
        if ($session->has('cart')) {
            $index = $this->exists($id);
            $cart = array_values(session('cart'));
            if ($index == -1) {
                array_push($cart, $item);
            } else {
                $cart[$index]['quantity']++;
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($item);
            $session->set('cart', $cart);
        }

        return $this->response->redirect(site_url('C_Etalase/index_cart'));
    }

     //function untuk menghapus barang di keranjang
    public function hapus_cart()
    {
        //mengambil segment ke 3 dari view beli yaitu id
        $id = $this->request->uri->getSegment(3);
        //temukan barang yg ingin dihapus dgn id di dalam model
        $modelBarang = new \App\Models\M_Barang();

        $model = $modelBarang->find($id);
        $index = $this->exists($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $session = session();
        $session->set('cart', $cart);

        return $this->response->redirect(site_url('C_Etalase/index_cart'));
    }

     //function untuk mengupdate barang di keranjang
    public function update_cart()
    {
        //mengembalikan nilai cart dalam bentuk array
        $cart = array_values(session('cart'));
        //mengupdate nilai quantity barang
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]['quantity'] = $_POST['quantity'][$i];
        }
        $session = session();
        $session->set('cart', $cart);

        return $this->response->redirect(site_url('C_Etalase/index_cart'));
    }

     //function untuk mengecek keberadaan barang melalui id
    private function exists($id)
    {
        //mengembalikan nilai cart dalam bentuk array
        $items = array_values(session('cart'));
         //mengambil dan mengembalikan id barang
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) {
                return $i;
            }
        }

        return -1;
    }

    //function untuk mencari nilai total harga di dalam keranjang
    private function total()
    {
        $s = 0;//deklarasikan nilai var s adalah 0
        $items = array_values(session('cart'));//mengembalikan nilai cart dalam bentuk array
        foreach ($items as $item) {
            $s += $item['price'] * $item['quantity'];//menghitung total harga barang dalam keranjang
        }

        return $s;
    }
}
