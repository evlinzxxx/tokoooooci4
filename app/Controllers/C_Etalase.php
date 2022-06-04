<?php

namespace App\Controllers;

class C_Etalase extends BaseController
{
    //properti untuk mengatur ongkir
    private $url = "https://api.rajaongkir.com/starter/";
    private $apiKey = "16b7667d8f47d138163ea6325e0e9de0";


    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    //function untuk mengarahkan ke halaman info
    public function info()
    {
        return view('etalase/info');
    }

    public function index()
    {
        $barang = new \App\Models\M_Barang();

        $data = [
            $model = $barang->findAll(),
            'etalase' => $barang->paginate(6),
            'pager' => $barang->pager,
        ];

        return view('etalase/index', [
            'data' => $data,
        ]);
    }

    //function untuk menuju dan mengisi serta melakukan pembelian barang
    public function beli()
    {
        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $modelKomentar = new \App\Models\M_Komentar();

        $komentar = $modelKomentar->where('id_barang', $id)->findAll();

        $model = $modelBarang->find($id);

        $provinsi = $this->rajaongkir('province');


        if ($this->request->getPost()) {
            $data = $this->request->getPost();
            $this->validation->run($data, 'transaksi');
            $errors = $this->validation->getErrors();

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
                // 
                $barang = $barangModel->find($id_barang);
                $entityBarang = new \App\Entities\Barang();
                //menyimpan id barang di variabel entityBarang
                $entityBarang->id = $id_barang;
                //mengurangkan jumlah stok barang jika sudah dibeli
                $entityBarang->stok = $barang->stok - $jumlah_pembelian;
                $barangModel->save($entityBarang);

                $transaksi->fill($data);
                $transaksi->status = 0;
                $transaksi->created_by = $this->session->get('id');
                $transaksi->created_date = date("Y-m-d H:i:s");

                $transaksiModel->save($transaksi);

                $id = $transaksiModel->insertID();

                $segment = ['C_Transaksi', 'view_cust', $id];

                return redirect()->to(site_url($segment));
            }
        }

        return view('etalase/beli', [
            'model' => $model,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
            'komentar' => $komentar
        ]);
    }

    //function untuk mendapatkan nilai ongkir
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rajaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }

    //function untuk mendapatkan data kabupaten/kota
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

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

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;

        if ($id_province != null) {
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
                "key: " . $this->apiKey
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

        $data['items'] = array_values(session('cart'));
        $data['total'] = $this->total();
        return view('keranjang/index', $data);
    }

    //function untuk menambahkan barang ke keranjang
    public function tambah_cart()
    {

        $id = $this->request->uri->getSegment(3);

        $modelBarang = new \App\Models\M_Barang();

        $model = $modelBarang->find($id);

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
        $id = $this->request->uri->getSegment(3);

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
        $cart = array_values(session('cart'));
        for ($i = 0; $i < count($cart); $i++) {
            $cart[$i]['quantity'] = $_POST['quantity'][$i];
        }
        $session = session();
        $session->set('cart', $cart);

        return $this->response->redirect(site_url('C_Etalase/index_cart'));
    }

    private function exists($id)
    {
        $items = array_values(session('cart'));
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id'] == $id) {
                return $i;
            }
        }

        return -1;
    }

    private function total()
    {
        $s = 0;
        $items = array_values(session('cart'));
        foreach ($items as $item) {
            $s += $item['price'] * $item['quantity'];
        }

        return $s;
    }
}
