<?php

namespace App\Controllers;

use TCPDF;

class C_Transaksi extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->validation = \Config\Services::validation();
        $this->session = session();
    }

    //function untuk menampilkan detail invoice transaksi ke admin
    public function view()
    {
        $id = $this->request->uri->getSegment(3);

        $transaksiModel = new \App\Models\M_Transaksi();
        $transaksi = $transaksiModel->select('*, tb_transaksi.id AS id_trans')->join('tb_barang', 'tb_barang.id=tb_transaksi.id_barang')
            ->join('tb_user', 'tb_user.id=tb_transaksi.id_pembeli')
            ->where('tb_transaksi.id', $id)
            ->first();

        return view('transaksi/view', [
            'transaksi' => $transaksi,
        ]);
    }

    //function untuk menampilkan detail invoice transaksi ke customer
    public function view_cust()
    {
        $id = $this->request->uri->getSegment(3);

        $transaksiModel = new \App\Models\M_Transaksi();
        $transaksi = $transaksiModel->select('*, tb_transaksi.id AS id_trans')->join('tb_barang', 'tb_barang.id=tb_transaksi.id_barang')
            ->join('tb_user', 'tb_user.id=tb_transaksi.id_pembeli')
            ->where('tb_transaksi.id', $id)
            ->first();

        return view('etalase/transaksi', [
            'transaksi' => $transaksi,
        ]);
    }

    //function untuk menampilkan semua invoice transaksi ke admin
    public function index()
    {
        $transaksiModel = new \App\Models\M_Transaksi();
        $data = [
            $model = $transaksiModel->findAll(),
            'transaksi' => $transaksiModel->paginate(5),
            'pager' => $transaksiModel->pager,
        ];
        return view('transaksi/index', [
            'data' => $data
        ]);
    }

    //function untuk mencetak detail invoice 
    public function invoice()
    {
        $id = $this->request->uri->getSegment(3);

        $modelTransaksi = new \App\Models\M_Transaksi();
        $transaksi = $modelTransaksi->find($id);

        $modelUser = new \App\Models\M_User();
        $pembeli = $modelUser->find($transaksi->id_pembeli);

        $modelBarang = new \App\Models\M_Barang();
        $barang = $modelBarang->find($transaksi->id_barang);

        $html = view('transaksi/invoice', [
            'transaksi' => $transaksi,
            'pembeli' => $pembeli,
            'barang' => $barang
        ]);

        $pdf = new TCPDF('L', PDF_UNIT, 'A4', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Precious Skin Care');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        $this->response->setContentType('application/pdf');

        //Close and output PDF document
        $pdf->Output('invoice.pdf', 'I');
    }
}
