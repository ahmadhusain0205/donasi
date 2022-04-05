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
        <h3>DATA BENCANA BELUM TERKONFIRMASI
          <button type="button" class="btn float-end btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah">
            <i class="fas fa-medkit"></i> Tambah data
          </button>
        </h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Tanggal</th>
                <th>Daerah</th>
                <th>Bencana</th>
                <th width="40%">Deskripsi</th>
                <th width="18%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($bencana_belum_terkonfirmasi as $bbk) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td><?= $bbk->tanggal; ?></td>
                  <td><?= $bbk->desa; ?></td>
                  <td><?= $bbk->bencana; ?></td>
                  <td><?= $bbk->deskripsi; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolak<?= $bbk->id; ?>">
                      <i class="far fa-window-close"></i> Tolak
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#konfirmasi<?= $bbk->id; ?>">
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
        <h3>DATA BENCANA TERKONFIRMASI</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="table">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th width="10%">Tanggal</th>
                <th>Daerah</th>
                <th>Bencana</th>
                <th>Deskripsi</th>
                <th width="25%">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($bencana_terkonfirmasi as $bt) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td><?= $bt->tanggal; ?></td>
                  <td><?= $bt->desa; ?></td>
                  <td><?= $bt->bencana; ?></td>
                  <td><?= $bt->deskripsi; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail<?= $bt->id; ?>">
                      <i class="fas fa-info"></i> Detail
                    </button>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah<?= $bt->id; ?>">
                      <i class="far fa-edit"></i> Ubah
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus<?= $bt->id; ?>">
                      <i class="far fa-window-close"></i> Hapus
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
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="far fa-plus-square"></i> Tambah data</h5>
      </div>
      <?= form_open_multipart('Bencana/add'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label for="daerah" class="mb-2">Daerah *</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
              <select name="id_daerah" class="form-control">
                <option value="">-- Pilih Daerah --</option>
                <?php foreach ($daerah as $d) : ?>
                  <option value="<?= $d->id; ?>"><?= $d->desa; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="bencana" class="mb-2">Bencana *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-medkit"></i></span>
                <input type="text" class="form-control" value="<?php echo set_value('bencana'); ?>" placeholder="bencana" name="bencana" required>
                <?php echo form_error('bencana'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="deskripsi" class="mb-2">deskripsi *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-clipboard"></i></span>
                <textarea name="deskripsi" class="form-control" placeholder="deskripsi"></textarea>
                <?php echo form_error('deskripsi'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="id_user" class="mb-2">Penerima *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                <select name="id_user" class="form-control" required>
                  <option value="">-- Pilih --</option>
                  <?php $penerima = $this->db->query('select * from user where id_bank != null or id_bank != 0')->result(); ?>
                  <?php foreach ($penerima as $p) : ?>
                    <option value="<?= $p->id; ?>"><?= $p->nama; ?></option>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_user'); ?>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="target" class="mb-2">Target *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
                <input type="number" class="form-control" value="<?php echo set_value('target'); ?>" placeholder="target" name="target" required>
                <?php echo form_error('target'); ?>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="gambar" class="mb-2">Gambar</label>
              <div class="input-group mb-3">
                <input type="file" class="form-control" placeholder="gambar" name="gambar">
                <?php echo form_error('gambar'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
        <button type="submit" class="btn btn-primary btn-sm"><i class="far fa-plus-square"></i> Tambahkan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<?php foreach ($bencana_terkonfirmasi as $bt) : ?>
  <!-- modal hapus -->
  <div class="modal fade" id="hapus<?= $bt->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus data dengan desa : <b class="text-danger"><?= $bt->desa; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Bencana/delete/') . $bt->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Hapus</a>
        </div>
      </div>
    </div>
  </div>
  <!-- modal detail -->
  <div class="modal fade" id="detail<?= $bt->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content border-primary">
        <div class="modal-header">
          <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-info"></i> Informasi tambahan data</h5>
        </div>
        <div class="modal-body">
          <div class="responsive">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr>
                  <th>Daerah</th>
                  <th>Atas Nama</th>
                  <th>No Rekening</th>
                  <th>Target Uang</th>
                  <th>Kekurangan Uang</th>
                  <th>Uang Terkumpul</th>
                  <th>Nama Barang</th>
                  <th>Target Barang</th>
                  <th>Kekurangan Barang</th>
                  <th>Barang Terkumpul</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <?php $sql = $this->db->query('select desa from daerah where id=' . $bt->id_daerah)->row_array(); ?>
                  <td><?= $sql['desa']; ?></td>
                  <td><?= $bt->atas_nama; ?></td>
                  <td>
                    <a class="text-dark text-decoration-none float-end"><?= $bt->no_rekening; ?></a>
                  </td>
                  <td>Rp.
                    <a class="text-dark text-decoration-none float-end"><?= number_format($bt->target); ?></a>
                  </td>
                  <td>Rp.
                    <a class="text-dark text-decoration-none float-end"><?= number_format($bt->kekurangan); ?></a>
                  </td>
                  <td>Rp.
                    <a class="text-dark text-decoration-none float-end"><?= number_format($bt->terkumpul); ?></a>
                  </td>
                  <td><?= $bt->nama_barang; ?></td>
                  <td>
                    <a class="float-end text-decoration-none text-dark"><?= $bt->target_barang, ' Kg'; ?></a>
                  </td>
                  <td>
                    <a class="float-end text-decoration-none text-dark"><?= $bt->kekurangan_barang, ' Kg'; ?></a>
                  </td>
                  <td>
                    <a class="float-end text-decoration-none text-dark"><?= $bt->terkumpul_barang, ' Kg'; ?></a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn float-end btn-primary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal edit -->
  <div class="modal fade" id="ubah<?= $bt->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-warning">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="far fa-edit"></i> Ubah data</h5>
        </div>
        <?= form_open_multipart('Bencana/edit'); ?>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <label for="daerah" class="mb-2">Daerah *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                <select name="id_daerah" class="form-control">
                  <?php $sql = $this->db->query('select desa from daerah where id=' . $bt->id_daerah)->row_array(); ?>
                  <option value="<?= $bt->id_daerah; ?>">Daerah saat ini : <?= $sql['desa']; ?></option>
                  <?php foreach ($daerah as $d) : ?>
                    <option value="<?= $d->id; ?>">Ubah ke : <?= $d->desa; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="bencana" class="mb-2">Bencana *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-medkit"></i></span>
                  <input type="hidden" value="<?php echo $bt->id; ?>" name="id" required>
                  <input type="text" class="form-control" value="<?php echo $bt->bencana; ?>" placeholder="bencana" name="bencana" required>
                  <?php echo form_error('bencana'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="deskripsi" class="mb-2">deskripsi *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-clipboard"></i></span>
                  <textarea name="deskripsi" class="form-control" placeholder="deskripsi"><?= $bt->deskripsi; ?></textarea>
                  <?php echo form_error('deskripsi'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="id_user" class="mb-2">Penerima *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                  <select name="id_user" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <?php $penerima = $this->db->query('select * from user where id_bank != null or id_bank != 0')->result(); ?>
                    <?php foreach ($penerima as $p) : ?>
                      <option value="<?= $p->id; ?>"><?= $p->nama; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('id_user'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="target" class="mb-2">Target *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
                  <input type="number" class="form-control" value="<?php echo $bt->target; ?>" placeholder="target" name="target" required>
                  <?php echo form_error('target'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="gambar" class="mb-2">Gambar</label>
                <div class="input-group mb-3">
                  <input type="file" class="form-control" placeholder="gambar" name="gambar">
                  <?php echo form_error('kekurangan'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="kekurangan" class="mb-2">Kekurangan *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
                  <input type="number" class="form-control" value="<?php echo $bt->kekurangan; ?>" placeholder="kekurangan" name="kekurangan" required>
                  <?php echo form_error('kekurangan'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="terkumpul" class="mb-2">Terkumpul *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill"></i></span>
                  <input type="number" class="form-control" value="<?php echo $bt->terkumpul; ?>" placeholder="terkumpul" name="terkumpul" required>
                  <?php echo form_error('terkumpul'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <button type="submit" class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Ubah</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
<?php endforeach; ?>

<?php foreach ($bencana_belum_terkonfirmasi as $bbk) : ?>
  <!-- modal konfirmasi -->
  <div class="modal fade" id="konfirmasi<?= $bbk->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-success">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLabel"><i class="far fa-check-square"></i> Konfirmasi data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin mengkonfirmasi data dengan desa : <b class="text-success"><?= $bbk->desa; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Bencana/konfirmasi/') . $bbk->id; ?>" type="button" class="btn btn-success btn-sm"><i class="far fa-check-square"></i> Konfirmasi</a>
        </div>
      </div>
    </div>
  </div>
  <!-- modal tolak -->
  <div class="modal fade" id="tolak<?= $bbk->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="far fa-window-close"></i> Tolak data</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menolak data dengan desa : <b class="text-danger"><?= $bbk->desa; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Bencana/tolak/') . $bbk->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="far fa-window-close"></i> Tolak</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>