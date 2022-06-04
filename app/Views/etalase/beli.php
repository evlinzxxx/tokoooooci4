<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" src="<?= base_url('uploads/' . $model->gambar) ?>" alt="gambar">
                    <h1 class="text-success"><?= $model->nama ?></h1>
                    <h1>Harga : <?= "RP " . number_format($model->harga, 2, ',', '.') ?></h1>
                    <h4>Stok : <?= $model->stok ?></h4>
                    <p>Deskripsi : <br> <?= $model->deskripsi ?></p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <h4>Pengiriman</h4>
            <div class="form-group">
                <label for="provinsi">Pilih Provinsi</label>
                <select class="form-control" id="provinsi">
                    <option>Select Provinsi</option>
                    <?php foreach ($provinsi as $p) : ?>
                        <option value="<?= $p->province_id ?>"><?= $p->province ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="kabupaten">Pilih Kabupaten/Kota</label>
                <select class="form-control" id="kabupaten">
                    <option>Select Kabupaten/kota</option>
                </select>
            </div>
            <div class="form-group">
                <label for="service">Pilih Service</label>
                <select class="form-control" id="service">
                    <option>Select Service</option>
                </select>
            </div>

            <strong>Estimasi : <span id="estimasi"></span></strong>
            <hr>

            <?= form_open('C_Etalase/beli') ?>
            <input name="id_barang" id="id_barang" value="<?= $model->id ?>" type="hidden">
            <input name="id_pembeli" id="id_pembeli" value="<?= session()->get('id') ?>" type="hidden">
            <div class="form-group">
                <label for="">Jumlah pembelian</label>
                <input type="number" name="jumlah" id="jumlah" value=1 min=1 max=<?= $model->stok ?> class="form-control">
            </div>
            <div class="form-group">
                <label for="">Ongkir <br> Rp.</label>
                <input name="ongkir" id="ongkir" class="form-control" readonly=true>
            </div>
            <div class="form-group">
                <label for="">Total Harga <br> Rp.</label>
                <input name="total_harga" id="total_harga" class="form-control" readonly=true>
            </div>
            <div class="form-group">
                <label for="">Alamat Lengkap</label>
                <input type="text-area" name="alamat" id="alamat" class="form-control">
            </div>
            <div class="text-right">
                <button name="submit" id="submit" type="submit" value="Beli" class="btn btn-success">Beli</button>
                <a href="<?= site_url('C_Etalase/tambah_cart/' . $model->id) ?>" class="btn btn-success">Tambahkan Ke Keranjang</a>
            </div>
        </div>
        <?= form_close() ?>
    </div>
</div>

<div class="row mb-3 mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Komentar</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="<?= site_url('C_Komentar/komentar/' . $model->id) ?>" class="btn btn-success">Tambahkan Komentar</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class=" col-md-12">
                        <?php foreach ($komentar as $k) : ?>
                            <?php
                            $userModel = new \App\Models\M_User();
                            $namaUser = $userModel->find($k->id_user)->username;
                            ?>

                            <strong><?= $namaUser ?></strong>
                            <br>

                            <?= $k->komentar ?>
                            <hr>

                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('document').ready(function() {
        var jumlah_pembelian = 1;
        var harga = <?= $model->harga ?>;
        var ongkir = 0;
        $("#provinsi").on('change', function() {
            $("#kabupaten").empty();
            $("#service").empty();
            var id_province = $(this).val();
            $.ajax({
                url: "<?= site_url('C_Etalase/getCity') ?>",
                type: 'GET',
                data: {
                    'id_province': id_province,
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"];
                    for (var i = 0; i < results.length; i++) {
                        $("#kabupaten").append($('<option>', {
                            value: results[i]["city_id"],
                            text: results[i]['city_name']
                        }));
                    }
                },

            });
        });

        $("#kabupaten").on('change', function() {
            $("#service").empty();
            var id_city = $(this).val();
            $.ajax({
                url: "<?= site_url('C_Etalase/getCost') ?>",
                type: 'GET',
                data: {
                    'origin': 154,
                    'destination': id_city,
                    'weight': 1000,
                    'courier': 'jne'
                },
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var results = data["rajaongkir"]["results"][0]["costs"];
                    for (var i = 0; i < results.length; i++) {
                        var text = results[i]["description"] + "(" + results[i]["service"] + ")";
                        $("#service").append($('<option>', {
                            value: results[i]["cost"][0]["value"],
                            text: text,
                            etd: results[i]["cost"][0]["etd"]
                        }));
                    }
                },

            });
        });

        $("#service").on('change', function() {
            var estimasi = $('option:selected', this).attr('etd');
            ongkir = parseInt($(this).val());
            $("#ongkir").val(ongkir);
            $("#estimasi").html(estimasi + " Hari");
            var total_harga = (jumlah_pembelian * harga) + (jumlah_pembelian * ongkir);
            $("#total_harga").val(total_harga);
        });

        $("#jumlah").on("change", function() {
            jumlah_pembelian = $("#jumlah").val();
            var total_harga = (jumlah_pembelian * harga) + (jumlah_pembelian * ongkir);
            $("#total_harga").val(total_harga);
        });
    });
</script>
<?= $this->endSection() ?>