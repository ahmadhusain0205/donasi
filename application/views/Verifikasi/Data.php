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
                <th width="20%">Aksi</th>
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
                    $sql = $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening, (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from bencana b join daerah d on d.id=b.id_daerah where b.id=' . $du->id_bencana)->row_array();
                    ?>
                    <?= $sql['desa']; ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-sm" disabled><i class="fas fa-spinner"></i> Menunggu</button>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolak<?= $du->id; ?>">
                      <i class="far fa-window-close"></i> Tolak
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $du->id; ?>">
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
                <th>Jumlah Donasi Barang</th>
                <!-- <th>Nama Kurir</th> -->
                <th>Tujuan Donasi</th>
                <th>Pengiriman</th>
                <th>Status</th>
                <th width="20%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi_barang as $db) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td><?= $db->nama; ?></td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $db->jumlah_barang . ' Kg'; ?></a>
                  </td>
                  <!-- <td class="text-center">
                    <?= $db->nama_kurir; ?>
                  </td> -->
                  <td>
                    <?php
                    $sql = $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening, (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from bencana b join daerah d on d.id=b.id_daerah where b.id=' . $db->id_bencana)->row_array();
                    ?>
                    <?= $sql['desa']; ?>
                  </td>
                  <td class="text-center">
                    <button class="btn btn-warning btn-sm" disabled><i class="fas fa-spinner"></i> Menunggu</button>
                  </td>
                  <td class="text-center">
                    <?php if ($db->status_kurir == 0) { ?>
                      <button class="btn btn-info btn-sm" disabled><i class="fa-solid fa-car"></i> Antar</button>
                    <?php } else if ($db->status_kurir == 2) { ?>
                      <button class="btn btn-primary btn-sm" disabled><i class="fa-solid fa-car"></i> Proses Jemput</button>
                    <?php } else { ?>
                      <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#jemput<?= $db->id; ?>"><i class="fa-solid fa-car-side"></i> Jemput</button>
                    <?php } ?>
                  </td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolak<?= $db->id; ?>">
                      <i class="far fa-window-close"></i> Tolak
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $db->id; ?>">
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

  <!-- modal konfirmasi -->
  <div class="modal fade" id="konfirmasi<?= $du->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Konfirmasi data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin mengkonfirmasi data donasi atas nama : <b class="text-success"><?= $du->nama; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Verifikasi/konfirmasi/') . $du->id; ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> Konfirmasi</a>
        </div>
      </div>
    </div>
  </div>
  <!-- modal tolak -->
  <div class="modal fade" id="tolak<?= $du->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="far fa-window-close"></i> Tolak data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menolak data donasi atas nama : <b class="text-danger"><?= $du->nama; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Verifikasi/tolak/') . $du->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="far fa-window-close"></i> Tolak</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>



<?php foreach ($donasi_barang as $db) : ?>
  <!-- modal zoom -->
  <div class="modal fade" id="zoom<?= $db->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen-xl-down">
      <div class="modal-content">
        <div class="modal-body">
          <h4><?= strtoupper($db->nama); ?>
            <button type="button" class="btn-close float-end mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
          </h4>
          <img src="<?= base_url('assets/img/bukti/') . $db->bukti; ?>" style="width: 100%;">
        </div>
      </div>
    </div>
  </div>

  <!-- modal konfirmasi -->
  <div class="modal fade" id="konfirmasi<?= $db->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fas fa-plus-square"></i> Konfirmasi data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin mengkonfirmasi data donasi atas nama : <b class="text-success"><?= $db->nama; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Verifikasi/konfirmasi/') . $db->id; ?>" type="button" class="btn btn-success btn-sm"><i class="fas fa-plus-square"></i> Konfirmasi</a>
        </div>
      </div>
    </div>
  </div>
  <!-- modal jemput -->
  <div class="modal fade" id="jemput<?= $db->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="fa-solid fa-car-side"></i> Kurir</h5>
        </div>
        <form action="<?= site_url('Verifikasi/jemput'); ?>" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="id_user">Pilih Kurir *</label>
              <input type="hidden" value="<?= $db->id; ?>" name="id">
              <?php $jemput = $this->db->get_where('user', ['id_role' => 3])->result(); ?>
              <select name="id_user" class="form-control" required>
                <option value="">-- Pilih --</option>
                <?php foreach ($jemput as $j) : ?>
                  <option value="<?= $j->id; ?>"><?= $j->nama; ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
            <button type="submit" class="btn btn-success btn-sm"><i class="fa-solid fa-car-side"></i> Jemput</butt>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- modal tolak -->
  <div class="modal fade" id="tolak<?= $db->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="far fa-window-close"></i> Tolak data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menolak data donasi atas nama : <b class="text-danger"><?= $db->nama; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Verifikasi/tolak/') . $db->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="far fa-window-close"></i> Tolak</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>