<div class="row">
  <div class="col-lg">
    <?php
    // jika notif ada
    if ($this->session->flashdata('notif')) {
      echo $this->session->flashdata('notif');
    }
    ?>
    <div class="card shadow mb-4">
      <form action="<?= site_url('Auth'); ?>" method="POST">
        <div class="card-body">
          <div class="row justify-content-center p-5">
            <div class="col-4 text-center my-auto">
              <img src="<?= base_url('assets/img/welcome.jpg'); ?>" class="img-fluid rounded" style="background-size: cover; width:400px">
              <br>
              <br>
              <b class="h3 text-danger fw-bold">Kabupaten Magelang</b>
            </div>
            <div class="col-8 my-auto">
              <h3 class="text-center fw-bold">SELAMAT DATANG</h3>
              <hr>
              <div class="form-group">
                <label for="username" class="mb-2">Username *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                  <input type="text" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" name="username" autofocus>
                  <?php echo form_error('username'); ?>
                </div>
              </div>
              <div class="form-group">
                <label for="password" class="mb-2">Password *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-key"></i></span>
                  <input type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password'); ?>" name="password">
                  <?php echo form_error('passwor'); ?>
                </div>
              </div>
              <hr>
              <a href="<?= site_url('Auth/register'); ?>" class="btn btn-dark float-start" type="button"><i class="fa-solid fa-user-plus"></i> Daftar</a>
              <button class="btn btn-danger float-end" type="submit"><i class="fa-solid fa-user-lock"></i> Masuk</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>