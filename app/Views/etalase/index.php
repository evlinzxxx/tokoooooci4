<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<h1>Produk Kami</h1>
<br>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= base_url('asset/Precious2.jpg') ?>" class="d-block w-100" alt="gambar">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('asset/Precious1.jpg') ?>" class="d-block w-100" alt="gambar">
        </div>
        <div class="carousel-item">
            <img src="<?= base_url('asset/Precious.jpg') ?>" class="d-block w-100" alt="gambar">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="row">
        <?php foreach ($data['etalase'] as $m) : ?>
            <div class="col-4">
                <div class="card text-center">
                    <div class="card-header">
                        <span class="text-success"><strong><?= $m->nama ?></strong></span>
                    </div>
                    <div class="card-body">
                        <img class="img-thumbnail" style="max-height: 200px" src="<?= base_url('uploads/' . $m->gambar) ?>" alt="">
                        <h5 class="mt-3 text-success">
                            <?= "RP " . number_format($m->harga, 2, ',', '.') ?>
                        </h5>
                        <h6 class="text-info">Stok :<?= $m->stok ?></h6>
                        <h6 class="text-info">Deskripsi : <br><?= substr($m->deskripsi, 0, 80) ?><a href="<?= site_url('C_Etalase/beli/' . $m->id) ?>"> Read more</a></h6>


                    </div>
                    <div class="card-footer">
                        <a href="<?= site_url('C_Etalase/tambah_cart/' . $m->id) ?>" class="btn btn-success">Tambahkan Ke Keranjang</a>
                        <a href="<?= site_url('C_Etalase/beli/' . $m->id) ?>" style="width:25%" class="btn btn-success">Beli</a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>
<br>
<br>
<br>
<?= $data['pager']->links('default', 'custom_pagination') ?>

<?= $this->endSection() ?>