<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h1>Daftar Barang</h1>

<table class="table">
  <thead class="table-light">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">Created By</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <?php foreach ($data['users'] as $index => $user) : ?>
    <tr>
      <td><?= $user->id ?></td>
      <td><?= $user->username ?></td>
      <td><?= $user->created_by ?></td>
      <td><?= $user->created_date ?></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>

<?= $data['pager']->links('default', 'custom_pagination') ?>
<?= $this->endSection() ?>