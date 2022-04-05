<?php
// jika ada notif
if ($this->session->flashdata('notif')) {
  echo $this->session->flashdata('notif');
}
?>
<div class="row">
  <div class="col">
    <h3 class="text-center text-dark fw-bold">INFOGRAFIS DAERAH BENCANA</h3>
  </div>
</div>
<div class="row mb-5">
  <div class="col">
    <div id="map"></div>
  </div>
</div>
<div class="row mb-5">
  <div class="col-8">
    <div class="row mb-5">
      <div class="col">
        <h3 class="text-center text-dark fw-bold"><u>PRIORITAS</u></h3>
      </div>
    </div>
    <?php foreach ($bencana_prioritas as $bp) : ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <img src="<?= base_url('assets/img/bencana/') . $bp->gambar; ?>" class="img-thumbnail rounded" style="width: 300px;">
            </div>
            <div class="col-8 my-auto">
              <div class="row">
                <div class="col">
                  <span><?= $bp->tanggal; ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <?php $sql = $this->db->query('select desa from daerah where id=' . $bp->id_daerah)->row_array(); ?>
                  <div class="h4"><?= strtoupper($bp->bencana); ?> DI <b class="text-danger"><?= strtoupper($sql['desa']); ?></b></div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <p><?= $bp->deskripsi; ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-danger float-start" data-bs-toggle="modal" data-bs-target="#kebutuhan<?= $bp->id; ?>">
                    <i class="fas fa-hands"></i> Kebutuhan
                  </button>
                  <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#donasi<?= $bp->id; ?>">
                    <i class="fas fa-donate"></i> Donasi Sekarang
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="col-4">
    <div class="row mb-5">
      <div class="col">
        <h3 class="text-center text-dark fw-bold"><u>MINORITAS</u></h3>
      </div>
    </div>
    <?php foreach ($bencana_minoritas as $bm) : ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <img src="<?= base_url('assets/img/bencana/') . $bm->gambar; ?>" class="img-thumbnail rounded" style="width: 100px;">
            </div>
            <div class="col-8 my-auto">
              <div class="row">
                <div class="col">
                  <span style="font-size: 10px;"><?= $bm->tanggal; ?></span>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <?php $sql = $this->db->query('select desa from daerah where id=' . $bm->id_daerah)->row_array(); ?>
                  <div class="h6">
                    <?= strtoupper($bm->bencana); ?> DI <b class="text-danger"><?= strtoupper($sql['desa']); ?></b>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-sm btn-danger float-start" data-bs-toggle="modal" data-bs-target="#kebutuhan<?= $bm->id; ?>">
                    <i class="fas fa-hands"></i> Kebutuhan
                  </button>
                  <button type="button" class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#donasi<?= $bm->id; ?>">
                    <i class="fas fa-donate"></i> Donasi Sekarang
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<?php foreach ($bencana_prioritas as $bp) : ?>
  <!-- modal donasi -->
  <div class="modal fade" id="donasi<?= $bp->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-primary">
        <div class="modal-header">
          <?php $sql = $this->db->query('select desa from daerah where id=' . $bp->id_daerah)->row_array(); ?>
          <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-donate"></i> Donasi Sekarang ke <?= $sql['desa']; ?></h5>
        </div>
        <?= form_open_multipart('Welcome/donasi'); ?>
        <div class="modal-body">
          <h4 class="text-center fw-bold">Informasi Donasi</h4>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="id_daerah" class="mb-2">Daerah</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <?php $sql = $this->db->query('select desa from daerah where id = ' . $bp->id_daerah)->row_array(); ?>
                  <input type="text" class="form-control" value="<?php echo $sql['desa']; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="nama_bank" class="mb-2">Bank</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bp->nama_bank; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="atas_nama" class="mb-2">Bank (Atas Nama)</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bp->atas_nama; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="no_rekening" class="mb-2">Nomor Rekening</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-wallet"></i></span>
                  <input type="number" class="form-control" value="<?php echo $bp->no_rekening; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="kekurangan" class="mb-2">Kekurangan Uang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-wave"></i></span>
                  <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($bp->kekurangan); ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="terkumpul" class="mb-2">Uang Terkumpul</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-wave"></i></span>
                  <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($bp->terkumpul); ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="kekurangan_barang" class="mb-2">Kekurangan Barang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bp->kekurangan_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="terkumpul" class="mb-2">Barang Terkumpul</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bp->terkumpul_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <h4 class="text-center fw-bold">Informasi Anda</h4>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nama" class="mb-2">Nama *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                  <input type="hidden" value="<?= $bp->id; ?>" name="id">
                  <input type="text" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="nama" name="nama" autofocus required>
                  <?php echo form_error('nama'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="no_hp" class="mb-2">Nomor Hp *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('no_hp'); ?>" placeholder="no_hp" name="no_hp" required>
                  <?php echo form_error('no_hp'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="alamat" class="mb-2">Alamat *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <textarea name="alamat" class="form-control" value="<?php echo set_value('alamat'); ?>" required></textarea>
                  <?php echo form_error('alamat'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="donasi" class="mb-2">Donasi Uang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('donasi'); ?>" placeholder="donasi" name="donasi">
                  <?php echo form_error('donasi'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="bukti" class="mb-2">Bukti Transaksi Donasi Uang</label>
                <div class="input-group mb-3">
                  <input type="file" class="custom-file-input form-control" placeholder="bukti" name="bukti" id="bukti">
                  <?php echo form_error('bukti'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="barang" class="mb-2">Donasi Barang (Kg)</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('barang'); ?>" placeholder="barang" name="barang">
                  <?php echo form_error('barang'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="kurir" class="mb-2">Pengiriman Barang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-truck-loading"></i></span>
                  <select name="kurir" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="0">Antar</option>
                    <option value="1">Jemput</option>
                    <!-- <?php foreach ($kurir as $k) : ?>
                      <option value="<?= $k->nama; ?>"><?= $k->nama; ?></option>
                    <?php endforeach; ?> -->
                  </select>
                  <?php echo form_error('kurir'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-hand-holding-usd"></i> Donasikan</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>

  <!-- modal kebutuhan -->
  <div class="modal fade" id="kebutuhan<?= $bp->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-hands"></i> Kebutuhan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="uang" class="mb-2">Membutuhkan Uang Sebesar</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
              <input type="text" class="form-control" value="<?= number_format($bp->target); ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="barang" class="mb-2">Membutuhkan Barang Sebanyak (Kg)</label>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                  <input type="text" class="form-control" value="<?= $bp->nama_barang; ?>" readonly>
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="text" class="form-control" value="<?= $bp->target_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<?php foreach ($bencana_minoritas as $bm) : ?>
  <!-- modal donasi -->
  <div class="modal fade" id="donasi<?= $bm->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content border-primary">
        <div class="modal-header">
          <?php $sql = $this->db->query('select desa from daerah where id=' . $bm->id_daerah)->row_array(); ?>
          <h5 class="modal-title text-primary" id="exampleModalLabel"><i class="fas fa-donate"></i> Donasi Sekarang ke <?= $sql['desa']; ?></h5>
        </div>
        <?= form_open_multipart('Welcome/donasi'); ?>
        <div class="modal-body">
          <h4 class="text-center fw-bold">Informasi Donasi</h4>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="id_daerah" class="mb-2">Daerah</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <?php $sql = $this->db->query('select desa from daerah where id = ' . $bm->id_daerah)->row_array(); ?>
                  <input type="text" class="form-control" value="<?php echo $sql['desa']; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="nama_bank" class="mb-2">Bank</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bm->nama_bank; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="atas_nama" class="mb-2">Bank (Atas Nama)</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bm->atas_nama; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="no_rekening" class="mb-2">Nomor Rekening</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-wallet"></i></span>
                  <input type="number" class="form-control" value="<?php echo $bm->no_rekening; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="kekurangan" class="mb-2">Kekurangan Uang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-wave"></i></span>
                  <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($bm->kekurangan); ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="terkumpul" class="mb-2">Uang Terkumpul</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-money-bill-wave"></i></span>
                  <input type="text" class="form-control" value="<?php echo 'Rp. ' . number_format($bm->terkumpul); ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="kekurangan_barang" class="mb-2">Kekurangan Barang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bm->kekurangan_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="terkumpul" class="mb-2">Barang Terkumpul</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="text" class="form-control" value="<?php echo $bm->terkumpul_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <h4 class="text-center fw-bold">Informasi Anda</h4>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="nama" class="mb-2">Nama *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-user"></i></span>
                  <input type="hidden" value="<?= $bm->id; ?>" name="id">
                  <input type="text" class="form-control" value="<?php echo set_value('nama'); ?>" placeholder="nama" name="nama" autofocus required>
                  <?php echo form_error('nama'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="no_hp" class="mb-2">Nomor Hp *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('no_hp'); ?>" placeholder="no_hp" name="no_hp" required>
                  <?php echo form_error('no_hp'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="alamat">Alamat *</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-map-marked-alt"></i></span>
                  <textarea name="alamat" class="form-control" value="<?= set_value('alamat'); ?>"></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="donasi" class="mb-2">Donasi Uang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('donasi'); ?>" placeholder="donasi" name="donasi">
                  <?php echo form_error('donasi'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="bukti" class="mb-2">Bukti Transaksi Donasi Uang</label>
                <div class="input-group mb-3">
                  <input type="file" class="custom-file-input form-control" placeholder="bukti" name="bukti" id="bukti">
                  <?php echo form_error('bukti'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="barang" class="mb-2">Donasi Barang (Kg)</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="number" class="form-control" value="<?php echo set_value('barang'); ?>" placeholder="barang" name="barang">
                  <?php echo form_error('barang'); ?>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="kurir" class="mb-2">Pengiriman Barang</label>
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-truck-loading"></i></span>
                  <select name="kurir" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="0">Antar</option>
                    <option value="1">Jemput</option>
                    <!-- <?php foreach ($kurir as $k) : ?>
                      <option value="<?= $k->nama; ?>"><?= $k->nama; ?></option>
                    <?php endforeach; ?> -->
                  </select>
                  <?php echo form_error('kurir'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"><i class="far fa-window-close"></i> Batal</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-hand-holding-usd"></i> Donasikan</button>
        </div>
        <?= form_close(); ?>
      </div>
    </div>
  </div>

  <!-- modal kebutuhan -->
  <div class="modal fade" id="kebutuhan<?= $bm->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-danger">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="staticBackdropLabel"><i class="fas fa-hands"></i> Kebutuhan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="uang" class="mb-2">Membutuhkan Uang Sebesar</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="fas fa-money-bill-wave"></i></span>
              <input type="text" class="form-control" value="<?= number_format($bm->target); ?>" readonly>
            </div>
          </div>
          <div class="form-group">
            <label for="barang" class="mb-2">Membutuhkan Barang Sebanyak (Kg)</label>
            <div class="row">
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                  <input type="text" class="form-control" value="<?= $bm->nama_barang; ?>" readonly>
                </div>
              </div>
              <div class="col">
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></span>
                  <input type="text" class="form-control" value="<?= $bm->target_barang . ' Kg'; ?>" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>


<!-- leaflet -->

<script>
  var map = L.map('map').setView([-7.4797342, 110.2176941], 12);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; Donasi'
  }).addTo(map);
  <?php foreach ($bencana as $bp) : ?>
    var card = '<div class="text-center"><?= $bp->desa; ?>, <?= $bp->kecamatan; ?>, Magelang<br><br><img src="<?= base_url('assets/img/bencana/') . $bp->gambar; ?>" style="width: 50px;"><br><br>Bencana: <?= $bp->bencana; ?><br><br><div><?= $bp->deskripsi; ?></div><br><br><div class="form-group"><label for="uang" class="mb-2">Membutuhkan Uang Sebesar</label><div class="input-group mb-3"><span class="input-group-text" id="basic-addon1">Rp</span><input type="text" class="form-control" value="<?= number_format($bp->target); ?>" readonly></div></div><div class="form-group"><label for="barang" class="mb-2">Membutuhkan Barang Sebanyak(Kg) </label><div class="row"><div class="col"><div class="input-group mb-3"><input type="text" class="form-control" value="<?= $bp->nama_barang; ?>"readonly></div></div><div class="col"><div class="input-group mb-3"><input type="text" class="form-control" value= "<?= $bp->target_barang . ' Kg'; ?>"readonly></div></div></div></div><br><br><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#donasi<?= $bp->id; ?> "> <i class="fas fa-donate"></i> Donasi Sekarang</button></div>';
    L.marker([<?= $bp->latitude; ?>, <?= $bp->longtitude; ?>]).addTo(map)
      .bindPopup(card)
      .openPopup();
  <?php endforeach; ?>
</script>