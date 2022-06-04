<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');

?>

<section class="home" id="#home">
    <br>
    <br>
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
</section>
<section class="about" id="#about">
    <br>
    <br>
    <br>
    <br>
    <h2 style="text-align:center">About</h2>
    <p>Precious Skin Care hadir untuk membantu merawat kulit wanita Indonesia.Indonesia dengan jenis suku yang berbeda,menciptkan pula keberbedaan pada tekstur dan sifat kulit wajah wanita Indonesia.
        Kami hadir untuk ikut ambil bagian dalam merawat dan menyehatkan sel-sel kulit Anda.Produk dari Precious Skin Care akan membantu melembapkan, mencerahkan, menggantikan sel-sel kulit mati, menyehatkan
        kulit yang kering dan berminyak, dan hal lain yang bermanfaat untuk kulit wajah wanita Indonesia.
        <br>
        <br>
        Produk-produk Precious Skin Care, salah satunya yaitu ,Produk Your Skin Bae Series yang mengandung perpaduan bahan aktif dan bahan alami ini sudah teruji klinis dan aman, sehingga dapat digunakan untuk
        semua jenis kulit dan aman dipakai untuk usia mulai dari 15 tahun.Salah satu produk yang sangat hype yaitu, Anti Acne & Exfoliating Serum,yang merupakan Serum dengan formula khusus untuk mengatasi masalah jerawat dan blackhead pada kulit. Mengandung Salicylic Acid 2% dan Zinc yang bekerja sebagai eksfoliator untuk membersihkan sel kulit mati hingga dalam
        pori-pori serta menjaga produksi minyak di kulit. Perpaduan kedua ingredients tersebut juga berfungsi membatasi perkembangbiakkan bakteri yang menyebabkan jerawat.
        <br>
        <br>
        Kemudian produk berikutnya,yaitu Avoskin Perfect Hydrating Treatment Essence hadir dengan kemasan 30 ml yang travel friendly! Memiliki kandungan utama chamomile oil dan ET-VC, produk ini efektif untuk melembapkan kulit, mencerahkan, mengatasi jerawat, anti-inflamasi, dan antioksidan.
        Produk ini merupakan salah satu produk Avoskin yang minimal ingredients, paraben free, fungal acne safe, dan mengandung fatty alcohol. Kandungan alcohol jenis fatty ini berfungsi sebagai carrying agent yang membantu penyerapan kandungan lain dan efektif untuk melembutkan kulit.
        <br>
        <br>
        Selain itu bahan-bahan yang digunakan pun sangat berkualitas,seperti Water, Glycerin, Glycolic Acid, Butylene Glycol, Propylene Glycol, Gluconolactone, Melaleuca Alternifolia (Tea Tree) Leaf Extract, Hamamelis Virginiana (Witch Hazel) Leaf Extract, Niacinamide, Chamomilla Recutita (Matricaria) Flower Extract,
        Rubus Idaeus (Raspberry) Fruit Extract, Citrus Limon (Lemon) Fruit Extract, Salicylic Acid, Acer Saccharum (Sugar Maple) Extract, Portulaca Oleracea Extract, Aloe Barbadensis Leaf Juice, Amylopectin, Dextrin, Xanthan Gum, Tetrasodium EDTA, Sodium Hydroxymethylglycinate, Polyglutamic Acid
    </p>
</section>

<section class="catalog" id="#catalog">
    <br>
    <br>
    <br>
    <h2 style="text-align:center">Catalog</h2>
    <br>
    <br>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd1.png') ?>" class="card-img-top" alt="Air-Terjun_Suban">
                <div class="card-body">
                    <h5 class="card-title text-success">Your Skin Bae Lactic Acid 10% + Kiwi Fruit 5% + Niacinamide 2,5% High Dose Serum</h5>
                    <p>Serum dengan kandungan Lactic Acid, Niacinamide, dan Kiwi Extract yang bermanfaat sebagai anti aging agent melalui eksfoliasi lapisan kulit terluar. Memiliki kandungan antioksidan yang tinggi, kulit akan terlindungi dari bahaya sinar UV dan radikal bebas. Dengan penggunaan rutin, elastisitas kulit akan meningkat dan garis halus tersamarkan.</p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 129.000</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd3.png') ?>" class="card-img-top" alt="Bukit-Jipang">
                <div class="card-body">
                    <h5 class="card-title text-success">Perfect Hydrating Treatment Essence 100ml Special Edition</h5>
                    <p>Chamomile oil dan ET-VC menjadi formula andalan dalam produk Avoskin PHTE Special Edition. Kedua kandungan tersebut bermanfaat untuk melembapkan kulit, mencerahkan, mengatasi jerawat, anti-inflamasi, dan antioksidan.
                        Produk ini merupakan salah satu produk Avoskin yang minimal ingredients, paraben free, fungal acne safe, dan mengandung fatty alcohol. Kandungan alcohol jenis fatty ini berfungsi sebagai carrying agent yang membantu penyerapan kandungan lain dan efektif untuk melembutkan kulit.
                    </p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 233.000</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd2.png') ?>" class="card-img-top" alt="Danau-Mas">
                <div class="card-body">
                    <h5 class="card-title text-success">Avoskin AHA BHA Sheet Mask 3pcs</h5>
                    <p>Sheet mask lokal pertama dengan kandungan exfoliating acid AHA-BHA-PHA yang dipadukan dengan niacinamide, tea tree, witch hazel, dan aloe vera. Sheet mask ini memberikan sensasi dan pengalaman baru pada proses eksfoliasi kulit tanpa membuat efek kulit terasa kering. Kandungan niacinamide dan ekstrak natural lainnya bekerja optimal untuk melembapkan kulit sehingga tak hanya sel kulit mati yang terangkat, tetapi kelembapan kulit pun tetap terjaga. AHA-BHA-PHA Sheet mask bekerja untuk mencerahkan dan melembapkan kulit.</p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 87.750</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd5.png') ?>" class="card-img-top" alt="Air-Terjun_Suban">
                <div class="card-body">
                    <h5 class="card-title text-success">Your Skin Bae Marine Collagen 10% + Ginseng Root</h5>
                    <p>Serum dengan kandungan aktif yang dipadukan dengan natural ekstrak terbaik untuk mengatasi masalah bekas jerawat. Mengandung marine collagen 10% dan ginseng root yang berfungsi optimal untuk membantu memperbaiki tekstur kulit dengan cara menjaga kelembapan kulit secara optimal. </p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 129.000</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd6.png') ?>" class="card-img-top" alt="Bukit-Jipang">
                <div class="card-body">
                    <h5 class="card-title text-success">Acne Solution Overnight Liquid Ampoule Sheet Mask 3pcs</h5>
                    <p>Sheet mask ini memiliki kandungan utama Salicylic Acid, Niacinamide, Carica Papaya Extract, dan Witch Hazel akan bekerja optimal untuk merawat kulit berjerawat, menyamarkan pori-pori dan membantu melembabkan kulit. Masker ini dapat menjadi penanganan pertama ketika ada tanda-tanda jerawat akan muncul dan meradang.</p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 93.600</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="<?= base_url('asset/prd4.png') ?>" class="card-img-top" alt="Danau-Mas">
                <div class="card-body">
                    <h5 class="card-title text-success">Intensive Nourishing Eye Cream</h5>
                    <p>Krim mata dengan kualitas formula terbaik yang dapat membantu mengurangi lingkaran hitam pada mata dan menjaga kulit area mata tetap terlihat sehat dan lembap. Diperkaya dengan ekstrak kopi, bengkuang, dan mentimun yang mampu mengurangi kantung mata dan membuat mata tampak lebih segar.</p>
                    <h6><i class="fa-solid fa-rupiah-sign"></i> 131.000</h6>
                    <br>
                    <a id="rel" href="<?= site_url('C_Auth/login/') ?>" style="width:25%" class="btn btn-secondary"><i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>

</section>

<?= $this->endSection() ?>