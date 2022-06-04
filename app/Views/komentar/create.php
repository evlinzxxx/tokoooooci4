<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Komentar</h1>
<?= form_open('C_Komentar/komentar/' . $id_barang) ?>
<input type="hidden" name="id_user" id="id_user" value="<?= session()->get('id') ?>">
<input type="hidden" name="id_barang" id="id_barang" value="<?= $id_barang ?>">
<div class="form-group">
    <label for="">Komentar</label>
    <textarea class="form-control" name="komentar" id="komentar" value='null'></textarea>
</div>
<div class="text-right">
    <button name="submit" id="submit" type="submit" value="Submit" class="btn btn-success">Tambahkan Komentar</button>

</div>

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
        .create(document.querySelector('#komentar'))
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<?= $this->endSection() ?>