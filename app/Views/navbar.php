<?php
$session = session();
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand">Precious Skin Care</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <?php if ($session->get('isLoggedIn')) : ?>
      <ul class="navbar-nav mr-auto">
        <?php if (session()->get('level') == 0) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
            <ul class="dropdown-menu">
              <a class="dropdown-item" href="<?= site_url('C_Barang/index') ?>">List Barang</a>
              <a class="dropdown-item" href="<?= site_url('C_Barang/create') ?>">Tambah Barang</a>
            </ul>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Transaksi/index') ?>">Transaksi </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_User/index') ?>">User </a>
          </li>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Etalase/index') ?>">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('C_Etalase/info') ?>">Info</a>
          </li>
        <?php endif ?>
      </ul>
    <?php endif ?>
    <div class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <?php if ($session->get('isLoggedIn')) : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Etalase/index_cart') ?>"><i class="fa-solid fa-cart-shopping"></i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="return confirm('Apakah anda yakin ingin keluar ?')" href="<?= site_url('C_Auth/logout') ?>"><i class="fa-solid fa-person-walking-arrow-right"></i></a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Auth/tampilan') ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Auth/tampilan') ?>">About</a>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Auth/tampilan') ?>">Catalog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= site_url('C_Auth/login') ?>">Login</a>
          </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>