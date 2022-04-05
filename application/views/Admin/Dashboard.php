<div class="row judtify-content-center">
  <div class="col-lg-3 my-auto">
    <a href="<?= site_url('Bencana'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-danger h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-people-carry fa-4x text-danger"></i>
            </div>
            <div class="col-8">
              <h4 class="text-danger fw-bold">Bencana Terverifikasi</h4>
              <h2 class="text-danger fw-bold"><?= $count_bencana; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 my-auto">
    <a href="<?= site_url('Selesai'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-success h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-dove fa-4x text-success"></i>
            </div>
            <div class="col-8">
              <h4 class="text-success fw-bold">Sampai Di Lokasi</h4>
              <h2 class="text-success fw-bold"><?= $count_selesai; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 my-auto">
    <a href="<?= site_url('Anggota'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-primary h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-users fa-4x text-primary"></i>
            </div>
            <div class="col-8">
              <h4 class="text-primary fw-bold">Jumlah Data Anggota</h4>
              <h2 class="text-primary fw-bold"><?= $count_anggota; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg-3 my-auto">
    <a href="<?= site_url('Donatur'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-warning h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-hands-helping fa-4x text-warning"></i>
            </div>
            <div class="col-8">
              <h4 class="text-warning fw-bold">Jumlah Data Donatur</h4>
              <h2 class="text-warning fw-bold"><?= $count_donatur; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>