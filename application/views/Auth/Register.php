<div class="row">
  <div class="col-lg">
    <div class="card shadow mb-4">
      <form action="<?= site_url('Auth/register'); ?>" method="POST">
        <div class="card-body">
          <div class="row justify-content-center p-5">
            <div class="col-4 text-center my-auto">
              <img src="<?= base_url('assets/img/welcome.jpg'); ?>" class="img-fluid rounded" style="background-size: cover; width:400px">
              <br>
              <br>
              <b class="h3 text-danger">Kabupaten Magelang</b>
            </div>
            <div class="col-8 my-auto">
              <h3 class="text-center fw-bold">DAFTAR SEKARANG</h3>
              <hr>
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="username" class="mb-2">Username *</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                      <input type="text" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Username" name="username" autofocus>
                      <?php echo form_error('username'); ?>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="password" class="mb-2">Password *</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                      <input type="password" class="form-control" value="<?php echo set_value('password'); ?>" placeholder="Password" name="password">
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
                      <input type="number" class="form-control" value="<?php echo set_value('no_hp'); ?>" placeholder="max 15 number" name="no_hp">
                      <?php echo form_error('no_hp'); ?>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="nama" class="mb-2">Nama *</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-file-signature"></i></span>
                      <input type="text" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="nama" name="nama">
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
                      <select name="role" class="form-control">
                        <option value="">-- Pilih --</option>
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
                      <textarea name="alamat" class="form-control" value="<?php echo set_value('alamat'); ?>" placeholder="alamat"></textarea>
                      <?php echo form_error('alamat'); ?>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <a href="<?= site_url('Auth'); ?>" class="btn btn-dark float-start" type="button"><i class="fa-solid fa-user-lock"></i> Masuk</a>
              <button class="btn btn-danger float-end" type="submit"><i class="fa-solid fa-user-plus"></i> Daftar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>