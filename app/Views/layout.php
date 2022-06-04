<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

  <title>Precious Skin Care</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">
  <script src="https://kit.fontawesome.com/6759f9a17c.js" crossorigin="anonymous"></script>
  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <style>
    body {
      padding-top: 5rem;
    }

    .starter-template {
      padding: 3rem 1.5rem;
      text-align: center;
    }
  </style>
</head>

<body>

  <?= $this->include('navbar') ?>

  <main role="main" class="container">

    <?= $this->renderSection('content') ?>


  </main><!-- /.container -->

  <script src="<?= base_url('jquery.min.js') ?>"></script>
  <script src="<?= base_url('bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <?= $this->renderSection('script') ?>

</body>


<?= $this->include('footer') ?>
</html>