<div class="row judtify-content-center">
  <div class="col-lg my-auto">
    <a href="<?= site_url('Kurir'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-warning h-100">
        <div class="card-body">
          <div class="row justify-content-center p-3">
            <div class="col-4 my-auto">
              <i class="fas fa-spinner fa-4x text-warning"></i>
            </div>
            <div class="col-8">
              <h4 class="text-warning fw-bold"> Menunggu Pengiriman</h4>
              <h2 class="text-warning fw-bold"><?= $kirim; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg my-auto">
    <a href="<?= site_url('Selesai'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-success h-100">
        <div class="card-body">
          <div class="row justify-content-center p-3">
            <div class="col-4 my-auto">
              <i class="fas fa-tasks fa-4x text-success"></i>
            </div>
            <div class="col-8">
              <h4 class="text-success fw-bold">Donasi Sampai Di Tujuan</h4>
              <h2 class="text-success fw-bold"><?= $selesai; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>