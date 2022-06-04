<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Daftar Barang</h1>

<table class="table">
  <thead class="table-light">
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Gambar</th>
      <th scope="col">Harga</th>
      <th scope="col">Stok</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($data['barang'] as $index => $barang) : ?>
    <tr>
      <td><?= ($index + 1) ?></td>
      <td><?= $barang->nama ?></td>
      <td><img class="img-fluid" width="200px" src="<?= base_url('uploads/' . $barang->gambar) ?>" alt="gambar"></td>
      <td><?= $barang->harga ?></td>
      <td><?= $barang->stok ?></td>
      <td>
        <a href="<?= site_url('C_Barang/view/' . $barang->id) ?>" class="btn btn-primary">View</a>
        <a href="<?= site_url('C_Barang/update/' . $barang->id) ?>" class="btn btn-success">Update</a>
        <a href="<?= site_url('C_Barang/delete/' . $barang->id) ?>" onclick="return confirm('Anda yakin mau menghapus item ini ?')" class="btn btn-danger">Delete</a>
      </td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

<?= $data['pager']->links('default', 'custom_pagination') ?>
<?= $this->endSection() ?>