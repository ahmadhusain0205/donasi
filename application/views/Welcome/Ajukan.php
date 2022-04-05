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
        <h3 class="text-center">PENGAJUAN INFORMASI BENCANA</h3>
        <hr>
        <?= form_open_multipart('Welcome/add'); ?>
        <div class="row justify-content-center">
          <div class="col-lg-4 my-auto">
            <img src="<?= base_url('assets/img/info.png'); ?>" style="background-size: cover; width:400px; border-radius: 50%;">
          </div>
          <div class="col-lg-8 my-auto">
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
          </div>
        </div>
        <div class="row">
          <div class="col">
            <button class="btn btn-danger float-end" type="submit"><i class="far fa-paper-plane"></i> Ajukan</button>
          </div>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>
</div>