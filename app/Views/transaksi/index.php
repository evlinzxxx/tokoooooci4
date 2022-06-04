<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Daftar Transaksi</h1>

<table class="table">
    <thead class="table-light">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Barang</th>
            <th scope="col">Pembeli</th>
            <th scope="col">Alamat</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Harga</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>

        <?php foreach ($data['transaksi'] as $index => $transaksi) : ?>
            <tr>
                <td><?= $transaksi->id ?></td>
                <td><?= $transaksi->id_barang ?></td>
                <td><?= $transaksi->id_pembeli ?></td>
                <td><?= $transaksi->alamat ?></td>
                <td><?= $transaksi->jumlah ?></td>
                <td><?= "Rp " . number_format($transaksi->total_harga, 2, ',', '.') ?></td>
                <td>
                    <a href="<?= site_url('C_Transaksi/view/' . $transaksi->id) ?>" class="btn btn-primary">View</a>
                    <a href="<?= site_url('C_Transaksi/invoice/' . $transaksi->id) ?>" class="btn btn-info">Invoice</a>
                </td>
            </tr>
        <?php endforeach ?>

</table>
<?= $data['pager']->links('default', 'custom_pagination') ?>
<?= $this->endSection() ?>