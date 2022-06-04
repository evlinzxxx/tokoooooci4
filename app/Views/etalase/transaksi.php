<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h4>Transaksi No <?= $transaksi->id_trans ?></h4>
<table class="table">
    <tr>
        <td>Barang</td>
        <td><?= $transaksi->nama ?></td>
    </tr>
    <tr>
        <td>Pembeli</td>
        <td><?= $transaksi->username ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td><?= $transaksi->alamat ?></td>
    </tr>
    <tr>
        <td>Jumlah</td>
        <td><?= $transaksi->jumlah ?></td>
    </tr>
    <tr>
        <td>Total Harga</td>
        <td><?= "Rp " . number_format($transaksi->total_harga, 2, ',', '.') ?></td>
    </tr>

</table>
<a href="<?= site_url('C_Transaksi/invoice/' . $transaksi->id_trans) ?>" class="btn btn-info">Invoice</a><br>
<div class="text-center">
    <br><br>
    <h4>Kami tunggu pembayaran sampai 2x24 jam </h4><img style="width:50%" src="<?= base_url('asset/Transaksi.jpg') ?>" alt=""><br>
    <h2>TERIMA KASIH</h2>

</div>
<?= $this->endSection() ?>