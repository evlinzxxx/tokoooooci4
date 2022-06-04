<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>TAMPILAN BARANG</h1>
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" alt="image" src="<?= base_url('uploads/' . $barang->gambar) ?>" alt="">

                </div>

            </div>

        </div>
        <div class="col-6">
            <h1 class="text-success"><?= $barang->nama ?></h1>
            <h4>Harga : <?= "RP " . number_format($barang->harga, 2, ',', '.') ?></h4>
            <h4>Stok : <?= $barang->stok ?></h4>
            <h5>Deskripsi : <br>
                <h6><?= $barang->deskripsi ?></h6>
            </h5>

        </div>
    </div>

</div>

<?= $this->endSection() ?>