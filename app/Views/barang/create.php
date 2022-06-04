<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>TAMBAH BARANG</h1>
<?= form_open_multipart('C_Barang/create') ?>
<div class="form-group">
    <label class="form-label">Nama Barang</label>
    <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
</div>
<div class="form-group">
    <label class="form-label">Harga Barang</label>
    <input type="number" value=null min=0 id="harga" name="harga" class="form-control" placeholder="Harga">
</div>
<div class="form-group">
    <label class="form-label">Stok Barang</label>
    <input type="number" value=null min=0 id="stok" name="stok" class="form-control" placeholder="Stok">
</div>
<div class="form-group">
    <label class="form-label">Deskripsi</label>
    <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
</div>
<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input name="gambar" value=null id="gambar" class="form-control" type="file">
</div>
<div class="text-right">
    <button type="submit" value="Submit" id="submit" name="submit" class="btn btn-success">Tambah Barang</button>

</div>


<?= form_close() ?>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?= base_url('ckeditor5-build-classic/ckeditor.js') ?>"> </script>
<style>
    .ck-editor__editable_inline {
        min-height: 200px;
    }
</style>
<script>
    ClassicEditor
        .create(document.querySelector('#deskripsi'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?= $this->endSection() ?>