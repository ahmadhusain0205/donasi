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

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow mb-4 fixed-top" style="background:rgba(255, 255, 255, 0.5); backdrop-filter: blur(10px);">
    <div class="container">
      <?php
      if ($this->session->userdata('id_role') == 1) {
        $x = site_url('Admin');
      } else if ($this->session->userdata('id_role') == 2) {
        $x = site_url('Relawan');
      } else {
        $x = site_url('Kurir_x');
      }
      ?>
      <a class="navbar-brand fw-bold" href="<?= $x; ?>">
        <img src="<?= base_url('assets/img/logo.png'); ?>" style="width: 30px;">
        Donasi <b class="text-dark">Bencana</b>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">



          <?php if ($this->session->userdata('id_role') == 1) { ?>


            <li class="nav-item">
              <?php $sql = $this->db->query('select * from bencana where konfirmasi = 0')->num_rows(); ?>
              <?php if ($this->uri->segment(1) == 'Bencana') { ?>
                <a class="nav-link active" href="<?= site_url('Bencana'); ?>">
                  <i class="fas fa-people-carry"></i> Bencana
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } else { ?>
                <?php $sql = $this->db->query('select * from bencana where konfirmasi = 0')->num_rows(); ?>
                <a class="nav-link" href="<?= site_url('Bencana'); ?>">
                  <i class="fas fa-people-carry"></i> Bencana
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } ?>
            </li>
            <li class="nav-item">
              <?php if ($this->uri->segment(1) == 'Anggota') { ?>
                <a class="nav-link active" href="<?= site_url('Anggota'); ?>"><i class="fa-solid fa-users"></i> Anggota</a>
              <?php } else { ?>
                <a class="nav-link" href="<?= site_url('Anggota'); ?>"><i class="fa-solid fa-users"></i> Anggota</a>
              <?php } ?>
            </li>
            <li class="nav-item">
              <?php if ($this->uri->segment(1) == 'Barang') { ?>
                <a class="nav-link active" href="<?= site_url('Barang'); ?>"><i class="fas fa-box"></i> Barang</a>
              <?php } else { ?>
                <a class="nav-link" href="<?= site_url('Barang'); ?>"><i class="fas fa-box"></i> Barang</a>
              <?php } ?>
            </li>


          <?php } ?>
          <?php if ($this->session->userdata('id_role') == 1 or $this->session->userdata('id_role') == 2) { ?>


            <li class="nav-item">
              <?php $sql = $this->db->query('select * from donasi where konfirmasi = 0')->num_rows(); ?>
              <?php if ($this->uri->segment(1) == 'Verifikasi') { ?>
                <a class="nav-link active" href="<?= site_url('Verifikasi'); ?>">
                  <i class="fa-solid fa-clipboard-check"></i> Verifikasi
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } else { ?>
                <?php $sql = $this->db->query('select * from donasi where konfirmasi = 0')->num_rows(); ?>
                <a class="nav-link" href="<?= site_url('Verifikasi'); ?>">
                  <i class="fa-solid fa-clipboard-check"></i> Verifikasi
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } ?>
            </li>
            <li class="nav-item">
              <?php if ($this->uri->segment(1) == 'Donatur') { ?>
                <a class="nav-link active" href="<?= site_url('Donatur'); ?>"><i class="fa-solid fa-hand-holding-dollar"></i> Donatur</a>
              <?php } else { ?>
                <a class="nav-link" href="<?= site_url('Donatur'); ?>"><i class="fa-solid fa-hand-holding-dollar"></i> Donatur</a>
              <?php } ?>
            </li>


          <?php } ?>
          <?php if ($this->session->userdata('id_role') == 1 or $this->session->userdata('id_role') == 3) { ?>



            <li class="nav-item">
              <?php $sql = $this->db->query('select * from donasi where konfirmasi_kurir = 0 and jumlah_barang != 0 and konfirmasi = 1')->num_rows(); ?>
              <?php if ($this->uri->segment(1) == 'Kurir') { ?>
                <a class="nav-link active" href="<?= site_url('Kurir'); ?>">
                  <i class="fas fa-truck-loading"></i> Kurir
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } else { ?>
                <?php $sql = $this->db->query('select * from donasi where konfirmasi_kurir = 0 and jumlah_barang != 0 and konfirmasi = 1')->num_rows(); ?>
                <a class="nav-link" href="<?= site_url('Kurir'); ?>">
                  <i class="fas fa-truck-loading"></i> Kurir
                  <?php if ($sql != null) { ?>
                    <sup class="text-white">
                      + <?= $sql; ?>
                    </sup>
                  <?php } ?>
                </a>
              <?php } ?>
            </li>
            <li class="nav-item">
              <?php if ($this->uri->segment(1) == 'Selesai') { ?>
                <a class="nav-link active" href="<?= site_url('Selesai'); ?>"><i class="fas fa-dove"></i> Terselesaikan</a>
              <?php } else { ?>
                <a class="nav-link" href="<?= site_url('Selesai'); ?>"><i class="fas fa-dove"></i> Terselesaikan</a>
              <?php } ?>
            </li>


          <?php } ?>




          <li class="nav-item">
            <?php if ($this->uri->segment(1) == 'Profile') { ?>
              <a class="nav-link active" href="<?= site_url('Profile'); ?>"><i class="far fa-smile"></i> Profile</a>
            <?php } else { ?>
              <a class="nav-link" href="<?= site_url('Profile'); ?>"><i class="far fa-smile"></i> Profile</a>
            <?php } ?>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logout" type="button">
              <i class="fas fa-power-off"></i> Keluar
            </a>
            <!-- <a class="nav-link" href="<?= site_url('Auth/logout'); ?>"><i class="fas fa-power-off"></i> Keluar</a> -->
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container" style="margin-bottom: 100px; margin-top: 100px;">
    <?= $content; ?>
  </div>


  <!-- modal logout -->
  <div class="modal fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-power-off"></i> Keluar</h5>
        </div>
        <div class="modal-body">
          Yakin ingin keluar ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Auth/logout'); ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-power-off"></i> Keluar</a>
        </div>
      </div>
    </div>
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