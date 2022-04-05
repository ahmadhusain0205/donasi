<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- fontawesome -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/fontawesome/css/all.min.css" type="text/css">
  <!-- Bootstrap CSS -->
  <link href="<?= base_url('assets'); ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title><?= $judul; ?></title>

  <!-- datatables -->
  <link rel="stylesheet" href="<?= base_url('assets'); ?>/css/jquery.dataTables.min.css" type="text/css">
  <!-- chart js -->
  <script type="text/javascript" src="<?= base_url('assets'); ?>/js/Chart.js"></script>
  <link rel="shortcut icon" href="<?= base_url('assets/img/logo.png'); ?>" style="width: 10px; height: 10px;">
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>leaflet/leaflet.css">
  <style>
    #map {
      height: 720px;
    }
  </style>
  <!-- leaflet -->
  <script src="<?= base_url('assets/'); ?>leaflet/leaflet.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow mb-4 fixed-top" style="background:rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px);">
    <div class="container">
      <a class="navbar-brand fw-bold" href="<?= site_url('Welcome'); ?>">
        <img src="<?= base_url('assets/img/logo.png'); ?>" style="width: 30px;">
        Donasi <b class="text-dark">Bencana</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <?php if ($this->uri->segment(1) == 'Welcome' && $this->uri->segment(2) == 'pendonatur') { ?>
              <a class="nav-link active" href="<?= site_url('Welcome/pendonatur'); ?>"><i class="fa fa-users"></i> Pendonatur</a>
            <?php } else { ?>
              <a class="nav-link" href="<?= site_url('Welcome/pendonatur'); ?>"><i class="fa fa-users"></i> Pendonatur</a>
            <?php } ?>
          </li>
          <li class="nav-item">
            <?php if ($this->uri->segment(1) == 'Welcome' && $this->uri->segment(2) == 'ajukan') { ?>
              <a class="nav-link active" href="<?= site_url('Welcome/ajukan'); ?>"><i class="fa-solid fa-bullhorn"></i> Ajukan</a>
            <?php } else { ?>
              <a class="nav-link" href="<?= site_url('Welcome/ajukan'); ?>"><i class="fa-solid fa-bullhorn"></i> Ajukan</a>
            <?php } ?>
          </li>
          <li class="nav-item">
            <?php if ($this->uri->segment(1) == 'Auth') { ?>
              <a class="nav-link active" href="<?= site_url('Auth'); ?>"><i class="fa-solid fa-door-closed"></i> Masuk</a>
            <?php } else { ?>
              <a class="nav-link" href="<?= site_url('Auth'); ?>"><i class="fa-solid fa-door-closed"></i> Masuk</a>
            <?php } ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container-fluid" style="margin-bottom: 100px; margin-top: 100px;">
    <?= $content; ?>
  </div>

  <!-- footer -->
  <footer class="bg-danger text-center text-lg-start fixed-bottom">
    <!-- Copyright -->
    <div class="text-center p-3 text-white">
      © 2022 Copyright:
      <a class="text-white text-decoration-none fw-bold">SKRIPSI UNIMMA</a>
    </div>
    <!-- Copyright -->
  </footer>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="<?= base_url('assets'); ?>/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="<?= base_url('assets'); ?>/js/jquery-3.5.1.js"></script>
  <script src="<?= base_url('assets'); ?>/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#table').DataTable();
    });
  </script>
  <!-- sweetalert -->
  <script src="<?= base_url('assets'); ?>/sweetalert/dist/sweetalert2.all.min.js"></script>

  <script src="<?= base_url('assets'); ?>/js/myscript.js"></script>



</body>

</html>