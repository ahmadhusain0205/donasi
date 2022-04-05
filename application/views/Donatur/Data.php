<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>DATA DONASI UANG</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama</th>
                <th>Jumlah Donasi Uang</th>
                <th>Bukti Transaksi</th>
                <th>Tujuan Donasi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi_uang as $du) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td><?= $du->nama; ?></td>
                  <td>Rp.
                    <a class="text-decoration-none text-dark float-end"><?= number_format($du->donasi_uang); ?></a>
                  </td>
                  <td class="text-center">
                    <button type="button" style="border: none;" data-bs-toggle="modal" data-bs-target="#zoom<?= $du->id; ?>">
                      <img src="<?= base_url('assets/img/bukti/') . $du->bukti; ?>" class="img-thumbnail rounded" style="width: 100px; height: 100px; background-size:cover">
                    </button>
                  </td>
                  <td>
                    <?php
                    $sql = $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from bencana b join daerah d on d.id=b.id_daerah where b.id=' . $du->id_bencana)->row_array();
                    ?>
                    <?= $sql['desa']; ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" disabled><i class="far fa-check-circle"></i> Diterima</button>
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

<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>DATA DONASI BARANG</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama</th>
                <th>Nama Barang</th>
                <th>Jumlah Donasi Barang</th>
                <th>Tujuan Donasi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi_barang as $db) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td><?= $db->nama; ?></td>
                  <td><?= $db->nama_barang; ?></td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $db->jumlah_barang . ' Kg'; ?></a>
                  </td>
                  <td>
                    <?php
                    $sql = $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from bencana b join daerah d on d.id=b.id_daerah where b.id=' . $db->id_bencana)->row_array();
                    ?>
                    <?= $sql['desa']; ?>
                  </td>
                  <td class="text-center">
                    <?php
                    // cek konfirmasi_kurir

                    // jika sudah terkonfirmasi
                    if ($db->don_konfirmasi_kurir == 1) {
                    ?>
                      <button class="btn btn-sm btn-primary" style="width: 200px;" disabled><i class="far fa-check-circle"></i> Selesai</button>
                    <?php }

                    // jika belum terkonfirmasi
                    else {
                    ?>
                      <button class="btn btn-sm btn-warning" style="width: 200px;" disabled><i class="fas fa-spinner"></i> Menunggu</button>
                    <?php } ?>
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

<?php foreach ($donasi_uang as $du) : ?>
  <!-- modal zoom -->
  <div class="modal fade" id="zoom<?= $du->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xl-down">
      <div class="modal-content">
        <div class="modal-body">
          <h4><?= strtoupper($du->nama); ?>
            <button type="button" class="btn-close float-end mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
          </h4>
          <img src="<?= base_url('assets/img/bukti/') . $du->bukti; ?>" style="width: 100%;">
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>