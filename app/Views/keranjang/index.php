<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Keranjang</h1>
<form method="post" action="<?= site_url('C_Etalase/update_cart') ?>">
  <table class="table">
    <thead class="table-light">
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Gambar</th>
        <th style="width:30%" scope="col">Nama</th>
        <th scope="col">Harga</th>
        <th scope="col">Qty </th>
        <th scope="col">Sub Total</th>
        <th scope="col">Act</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <?php if ($items) :  ?>
          <?php foreach ($items as $item) : ?>
      <tr>
        <td><?= $item['id'] ?></td>
        <td><img class="img-thumbnail" style="max-height: 150px" src="<?= base_url('uploads/' . $item['photo']) ?>" alt=""></td>
        <td><?= $item['name'] ?></td>
        <td><?= "RP " . number_format($item['price'], 2, ',', '.')  ?></td>
        <td>
          <input id="quantity" name="quantity[]" type="number" style="width: 50px" min="1" value="<?= $item['quantity'] ?>">
        </td>
        <td><?= "RP " . number_format(($item['price']) * ($item['quantity']), 2, ',', '.')  ?></td>
        <td><a class="btn btn-danger" href="<?= site_url('C_Etalase/hapus_cart/' . $item['id']) ?>">del</a>
          <input class="btn btn-warning" type="Submit" value="Update">
          <a class="btn btn-success" href="<?= site_url('C_Etalase/beli/' . $item['id']) ?>">Beli</a>
        </td>
      </tr>
    <?php endforeach ?>
    <tr>
      <td colspan="5" align="right">Total = </td>
      <td><?= "RP " . number_format($total, 2, ',', '.') ?></td>


    </tr>

  <?php endif ?>
    </tbody>

  </table>
  <a href="<?= site_url('C_Etalase/index') ?>" class="btn btn-success">Kembali ke Etalase</a>

</form>

<?= $this->endSection() ?>