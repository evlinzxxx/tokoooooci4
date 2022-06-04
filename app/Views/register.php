<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?= $this->extend('layout') ?>
    <?= $this->section('content') ?>

    <?php
    $session = session();
    $errors = $session->getFlashdata('errors');

    ?>
    <div class="text-center">
        <h1 style="text-align:center">REGISTER</h1>
        <img style="width:50%" src="<?= base_url('asset/Precious.jpg') ?>" class="img-fluid" alt="...">
    </div>
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
    <?= form_open('C_Auth/register') ?>
    <div class="login-box-body">
        <p class="login-box-msg">Daftarkan diri Mu!</p>
        <div class="form-group has-feedback">
            <input type="text" id="username" name="username" class="form-control" placeholder="Username">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" id="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" id="password2" name="password2" class="form-control" placeholder="Repeat Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <!-- /.col -->
            <div class="text-right">
                <button style="width:750px;margin-left:180px" type="submit" id="submit" class="btn btn-secondary">Register</button>
                <br>
                <a style="margin-right:260px" href="<?= site_url('C_Auth/login') ?>"><br>Sudah Punya Akun? Login</a>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <?= form_close() ?>
    <?= $this->endSection() ?>

</body>

</html>