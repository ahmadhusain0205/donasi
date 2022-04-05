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
        <h3>DATA ANGGOTA
          <button type="button" class="btn float-end btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah_anggota">
            <i class="fas fa-user-plus"></i> Tambah anggota
          </button>
        </h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="table">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Profile</th>
                <th>Username</th>
                <th>Level</th>
                <th>Nama</th>
                <th>Nomor Hp</th>
                <th>Alamat</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($anggota as $a) : ?>
                <tr>
                  <td width="1%"><?= $no++; ?></td>
                  <td class="text-center">
                    <img src="<?= base_url('assets/img/user/') . $a->gambar; ?>" style="width: 50px; height: 50px; border-radius:50%">
                  </td>
                  <td><?= $a->username; ?></td>
                  <td class="text-danger fw-bold text-center">
                    <?php
                    if ($a->id_role == 1) {
                      echo 'Administrator';
                    } else if ($a->id_role == 2) {
                      echo 'Relawan';
                    } else {
                      echo 'Kurir';
                    }
                    ?>
                  </td>
                  <td><?= $a->nama; ?></td>
                  <td><a class="text-decoration-none text-dark float-end"><?= $a->no_hp; ?></a></td>
                  <td><?= $a->alamat; ?></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_anggota<?= $a->id; ?>">
                      <i class="fas fa-edit"></i> Ubah
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus_anggota<?= $a->id; ?>">
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

<!-- modal tambah anggota -->
<div class="modal fade" id="tambah_anggota" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-primary">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-user-plus"></i> Tambah Anggota</h5>
      </div>
      <form action="<?= site_url('Anggota/add'); ?>" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="username" class="mb-2">Username *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                  <input type="text" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Username" name="username" autofocus required>
                  <?php echo form_error('username'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="password" class="mb-2">Password *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                  <input type="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password" name="password" required>
                  <?php echo form_error('password'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="no_hp" class="mb-2">Nomor Hp *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone-flip"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('no_hp'); ?>" placeholder="max 15 number" name="no_hp" required>
                  <?php echo form_error('no_hp'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="nama" class="mb-2">Nama *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
                  <input type="text" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="nama" name="nama" required>
                  <?php echo form_error('nama'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="role" class="mb-2">Status *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user-tie"></i></span>
                  <select name="role" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="1">Administrator</option>
                    <option value="2">Relawan</option>
                    <option value="3">Kurir</option>
                  </select>
                  <?php echo form_error('role'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="alamat" class="mb-2">Alamat *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-map-location-dot"></i></span>
                  <textarea name="alamat" class="form-control" required value="<?php echo set_value('alamat'); ?>" placeholder="alamat"></textarea>
                  <?php echo form_error('alamat'); ?>
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

<?php foreach ($anggota as $a) : ?>
  <!-- modal ubah anggota -->
  <div class="modal fade" id="ubah_anggota<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-warning">
        <div class="modal-header">
          <h5 class="modal-title text-warning" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Ubah Anggota</h5>
        </div>
        <form action="<?= site_url('Anggota/edit'); ?>" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="username" class="mb-2">Username *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                    <input type="hidden" value="<?php echo $a->id; ?>" name="id">
                    <input type="text" class="form-control" value="<?php echo $a->username; ?>" placeholder="Username" name="username" autofocus required>
                    <?php echo form_error('username'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="no_hp" class="mb-2">Nomor Hp *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-phone-flip"></i></span>
                    <input type="number" class="form-control" value="<?php echo $a->no_hp; ?>" placeholder="max 15 number" name="no_hp" required>
                    <?php echo form_error('no_hp'); ?>
                  </div>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="nama" class="mb-2">Nama *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
                    <input type="text" class="form-control" value="<?php echo $a->nama; ?>" placeholder="nama" name="nama" required>
                    <?php echo form_error('nama'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="role" class="mb-2">Status *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user-tie"></i></span>
                    <select name="role" class="form-control" required>
                      <option value="<?= $a->id_role; ?>">
                        Status saat ini:
                        <?php
                        if ($a->id_role == 1) {
                          echo 'Administrator';
                        } else if ($a->id_role == 2) {
                          echo 'Relawan';
                        } else {
                          echo 'Kurir';
                        }
                        ?>
                      </option>
                      <option value="1">Ubah ke : Administrator</option>
                      <option value="2">Ubah ke : Relawan</option>
                      <option value="3">Ubah ke : Kurir</option>
                    </select>
                    <?php echo form_error('role'); ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="alamat" class="mb-2">Alamat *</label>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-map-location-dot"></i></span>
                    <textarea name="alamat" class="form-control" placeholder="alamat" required><?php echo $a->alamat; ?></textarea>
                    <?php echo form_error('alamat'); ?>
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

  <!-- modal hapus anggota -->
  <div class="modal fade" id="hapus_anggota<?= $a->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-user-times"></i> Hapus Anggota</h5>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus anggota dengan username : <b class="text-danger"><?= $a->username; ?></b>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <a href="<?= site_url('Anggota/delete/') . $a->id; ?>" type="button" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i> Hapus</a>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>