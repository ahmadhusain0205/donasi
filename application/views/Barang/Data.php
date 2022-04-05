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
        <h3>DATA BARANG DONASI
          <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#tambah">
            <i class="far fa-plus-square"></i> Tambah data
          </button>
        </h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="table">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama Barang</th>
                <th>Target Barang</th>
                <th>Kekurangan Barang</th>
                <th>Terkumpul Barang</th>
                <th>Tujuan Donasi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($barang as $b) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $b->nama; ?></td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $b->target . ' Kg'; ?></a>
                  </td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $b->kekurangan . ' Kg'; ?></a>
                  </td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $b->terkumpul . ' Kg'; ?></a>
                  </td>
                  <td><?= $b->desa; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $b->id; ?>">
                      <i class="far fa-edit"></i> Ubah
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $b->id; ?>">
                      <i class="far fa-minus-square"></i> Hapus
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

<!-- modal tambah -->
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="far fa-plus-square"></i> Tambah data</h5>
      </div>
      <form action="<?= site_url('Barang/add'); ?>" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nama" class="mb-2">Nama barang *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                  <input type="text" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="nama barang" name="nama" autofocus required>
                  <?php echo form_error('nama'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="target" class="mb-2">Target barang (Kg) *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-bullseye"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('target'); ?>" placeholder="target barang (kg)" name="target" required min="1">
                  <?php echo form_error('target'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="tujuan" class="mb-2">Tujuan donasi *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <select name="tujuan" class="form-control" required>
                    <option value="">-- Pilih tujuan --</option>
                    <?php foreach ($tujuan as $t) : ?>
                      <option value="<?= $t->id; ?>"><?= $t->desa; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('tujuan'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i> Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php foreach ($barang as $b) : ?>
  <!-- modal ubah -->
  <div class="modal fade" id="ubah<?= $b->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-warning">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="far fa-edit"></i> Ubah data</h5>
        </div>
        <form action="<?= site_url('Barang/ubah'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nama" class="mb-2">Nama barang *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                    <input type="hidden" value="<?php echo $b->id; ?>" name="id">
                    <input type="text" class="form-control" value="<?php echo $b->nama; ?>" placeholder="nama barang" name="nama" required>
                    <?php echo form_error('nama'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="target" class="mb-2">Target barang (Kg) *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-bullseye"></i></span>
                    <input type="number" class="form-control" value="<?php echo $b->target; ?>" placeholder="target barang (kg)" name="target" required min="1">
                    <?php echo form_error('target'); ?>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="kekurangan" class="mb-2">Kekurangan barang (Kg) *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
                    <input type="number" class="form-control" value="<?php echo $b->kekurangan; ?>" placeholder="kekurangan barang (kg)" name="kekurangan" required min="0">
                    <?php echo form_error('kekurangan'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="terkumpul" class="mb-2">Terkumpul barang (Kg) *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-wallet"></i></span>
                    <input type="number" class="form-control" value="<?php echo $b->terkumpul; ?>" placeholder="terkumpul barang (kg)" name="terkumpul" required min="0">
                    <?php echo form_error('terkumpul'); ?>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="tujuan" class="mb-2">Tujuan donasi *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                    <select name="tujuan" class="form-control" required>
                      <?php
                      $sql = $this->db->query('select id_daerah from bencana where id=' . $b->id_bencana)->row_array();
                      $id_daerah = $sql['id_daerah'];
                      $daerah = $this->db->get_where('daerah', ['id' => $id_daerah])->row_array();
                      ?>
                      <option value="<?= $b->id_bencana; ?>">Saat ini : <?= $daerah['desa']; ?></option>
                      <?php foreach ($tujuan as $t) : ?>
                        <option value="<?= $t->id; ?>">Ubah ke : <?= $t->desa; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('tujuan'); ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
            <button type="submit" class="btn btn-warning btn-sm"><i class="far fa-save"></i> Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- modal hapus -->
  <div class="modal fade" id="hapus<?= $b->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus Barang</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus data barang : <b class="text-danger"><?= $b->nama; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Barang/delete/') . $b->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>