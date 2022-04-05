<div class="row">
  <div class="col">
    <?php
    // jika ada notif
    if ($this->session->flashdata('notif')) {
      echo $this->session->flashdata('notif');
    }
    ?>
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>DATA KIRIM KURIR</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Donatur</th>
                <th>Nomor Hp</th>
                <th>Alamat</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Pengantar</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi as $d) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $d->nama; ?></td>
                  <td><?= $d->no_hp; ?></td>
                  <td><?= $d->alamat; ?></td>
                  <td><?= $d->nama_barang; ?></td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $d->jumlah_barang . ' Kg'; ?></a>
                  </td>
                  <td><?= $d->pengantar; ?></td>
                  <td><?= $d->tujuan; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" disabled>
                      <i class="fas fa-spinner"></i> Menunggu
                    </button>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $d->id; ?>">
                      <i class="far fa-check-square"></i> Konfirmasi
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php foreach ($donasi as $d) : ?>
  <!-- modal konfirmasi -->
  <div class="modal fade" id="konfirmasi<?= $d->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="far fa-check-square"></i> Konfirmasi data</h5>
        </div>
        <div class="modal-body">
          Barang sudah sampai di desa <b class="text-success"><?= $d->tujuan; ?></b> ?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Kurir/konfirmasi/') . $d->id; ?>" type="button" class="btn btn-success btn-sm"><i class="far fa-check-square"></i> Selesaikan</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>