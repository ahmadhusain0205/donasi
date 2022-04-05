<div class="row judtify-content-center">
  <div class="col-lg my-auto">
    <a href="<?= site_url('Verifikasi'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-warning h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-clipboard-check fa-4x text-warning"></i>
            </div>
            <div class="col-8">
              <h4 class="text-warning fw-bold">Menunggu Verifikasi</h4>
              <h2 class="text-warning fw-bold"><?= $verifikasi; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <div class="col-lg my-auto">
    <a href="<?= site_url('Donatur'); ?>" class="text-decoration-none">
      <div class="card shadow mb-4 border-success h-100">
        <div class="card-body">
          <div class="row justify-content-center">
            <div class="col-4 my-auto">
              <i class="fas fa-hand-holding-heart fa-4x text-success"></i>
            </div>
            <div class="col-8">
              <h4 class="text-success fw-bold">Jumlah Donatur</h4>
              <h2 class="text-success fw-bold"><?= $donasi; ?></h2>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</div>