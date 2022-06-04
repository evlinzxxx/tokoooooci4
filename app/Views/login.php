<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<?php
$session = session();
$errors = $session->getFlashdata('errors');

?>
<h1 style="text-align:center">LOGIN</h1>

<?php if ($errors != null) : ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Terjadi Kesalahan</h4>
        <hr>
        <p class="mb-0">
            <?php
            foreach ($errors as $err) {
                echo $err . '<br>';
            }
            ?>
        </p>
    </div>
<?php endif ?>

<?= form_open('C_Auth/login') ?>
<div class="text-center">
    <img style="width:50%" src="<?= base_url('asset/Precious2.jpg') ?>" class="img-fluid" alt="...">
</div>
<div class="login-box-body">
    <p class="login-box-msg">Login disini!</p>
    <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <!-- /.col -->
        <button style="width:750px;margin-left:180px" type="submit" id="submit" class="btn btn-secondary">Login</button>
        <br>
        <a style="margin-left:460px" href="<?= site_url('C_Auth/register') ?>"><br>Belum Punya Akun? Register</a>
    </div>
    <!-- /.col -->
</div>
</div>
<?= form_close() ?>
<br>
<br>
<br>
<br>




<?= $this->endSection() ?>