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
        <h3>PROFIL KU
          <button type="button" class="btn float-end btn-dark btn-sm" style="margin-left: 5px;" data-bs-toggle="modal" data-bs-target="#password">
            <i class="fas fa-user-lock"></i> Ganti password
          </button>
          <button type="button" class="btn float-end btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#ubah_profile">
            <i class="fas fa-user-edit"></i> Ubah profil
          </button>
        </h3>
        <hr>
        <div class="row justify-content-center mb-4">
          <div class="col-lg-4 text-center my-auto">
            <img src="<?= base_url('assets/img/user/') . $user['gambar']; ?>" class="img-thumbnail rounded">
          </div>
          <div class="col-lg-8">
            <div class="row h4">
              <div class="col-sm-3 text-danger">
                <label>Username</label>
              </div>
              <div class="col">
                <label>: <?= $user['username']; ?></label>
              </div>
            </div>
            <hr>
            <div class="row h4">
              <div class="col-sm-3 text-danger">
                <label>Nama</label>
              </div>
              <div class="col">
                <label>: <?= $user['nama']; ?></label>
              </div>
            </div>
            <hr>
            <div class="row h4">
              <div class="col-sm-3 text-danger">
                <label>Level</label>
              </div>
              <div class="col">
                <label>
                  <?php
                  if ($user['id_role'] == 1) {
                    echo ': Administrator';
                  } else if ($user['id_role'] == 2) {
                    echo ': Relawan';
                  } else {
                    echo ': Kurir';
                  }
                  ?>
                </label>
              </div>
            </div>
            <hr>
            <div class="row h4">
              <div class="col-sm-3 text-danger">
                <label>Nomor Hp</label>
              </div>
              <div class="col">
                <label>: <?= $user['no_hp']; ?></label>
              </div>
            </div>
            <hr>
            <div class="row h4">
              <div class="col-sm-3 text-danger">
                <label>Alamat</label>
              </div>
              <div class="col">
                <label>: <?= $user['alamat']; ?></label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- modal ubah profile -->
<div class="modal fade" id="ubah_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-danger">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel"><i class="fas fa-user-edit"></i> Ubah Profile</h5>
      </div>
      <?= form_open_multipart('Profile/edit'); ?>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <label for="username" class="mb-2">Profile</label>
            <div class="input-group mb-3">
              <input type="file" class="form-control" value="<?php echo $user['gambar']; ?>" name="gambar">
              <?php echo form_error('gambar'); ?>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="username" class="mb-2">Username *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                <input type="text" class="form-control" value="<?php echo $user['username']; ?>" placeholder="Username" name="username" readonly required>
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
                <input type="number" class="form-control" value="<?php echo $user['no_hp']; ?>" placeholder="max 15 number" name="no_hp" required>
                <?php echo form_error('no_hp'); ?>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="nama" class="mb-2">Nama *</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
                <input type="text" class="form-control" value="<?php echo $user['nama']; ?>" placeholder="nama" name="nama" required>
                <?php echo form_error('nama'); ?>
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
                <textarea name="alamat" class="form-control" placeholder="alamat" required><?php echo $user['alamat']; ?></textarea>
                <?php echo form_error('alamat'); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
        <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-save"></i> Simpan</button>
      </div>
      <?= form_close(); ?>
    </div>
  </div>
</div>

<!-- modal ganti password -->
<div class="modal fade" id="password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-dark">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="exampleModalLabel"><i class="fas fa-user-lock"></i> Ganti password</h5>
      </div>
      <form action="<?= site_url('Profile/password') ?>" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label for="password" class="mb-2">Password baru *</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock-open"></i></span>
              <input type="hidden" name="id" value="<?= $user['id']; ?>">
              <input type="password" class="form-control" placeholder="Password" name="password" required>
              <?php echo form_error('password'); ?>
            </div>
          </div>
          <div class="form-group">
            <label for="konfirmasi" class="mb-2">Ulangi password baru *</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
              <input type="password" class="form-control" placeholder="konfirmasi" name="konfirmasi" required>
              <?php echo form_error('konfirmasi'); ?>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <button type="submit" class="btn btn-dark btn-sm"><i class="fas fa-fingerprint"></i> Simpan sandi</button>
        </div>
      </form>
    </div>
  </div>
</div>