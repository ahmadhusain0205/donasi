<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <h3>DAFTAR PENDONATUR UANG</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama Donatur</th>
                <th>Donasi</th>
                <th>Tujuan Donasi</th>
                <th>Bencana</th>
                <th width="40%">Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi_uang as $dt) :  ?>
                <?php
                $sql = $this->db->query('select desa from daerah where id=' . $dt->id_daerah)->row_array();
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $dt->nama; ?></td>
                  <td>Rp.
                    <a class="text-decoration-none text-danger fw-bold float-end" id="blinkingtext"><?= number_format($dt->donasi_uang); ?></a>
                  </td>
                  <td><?= $sql['desa']; ?></td>
                  <td><?= $dt->bencana; ?></td>
                  <td><?= $dt->deskripsi; ?></td>
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
        <h3>DAFTAR PENDONATUR BARANG</h3>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama Donatur</th>
                <th>Nama Barang</th>
                <th>Jumlah Donasi</th>
                <th>Tujuan Donasi</th>
                <th>Bencana</th>
                <th width="40%">Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($donasi_barang as $bd) :  ?>
                <?php
                $sql = $this->db->query('select desa from daerah where id=' . $bd->id_daerah)->row_array();
                ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $bd->nama; ?></td>
                  <td><?= $bd->nama_barang; ?></td>
                  <td>
                    <a class="text-decoration-none text-danger fw-bold float-end" id="blinkingtext"><?= $bd->jumlah_barang . ' Kg'; ?></a>
                  </td>
                  <td><?= $sql['desa']; ?></td>
                  <td><?= $bd->bencana; ?></td>
                  <td><?= $bd->deskripsi; ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  var x = 1;

  function blink(id) {
    document.getElementById(id).style.width = "300px";
    if (x == 1) {
      document.getElementById(id).style.backgroundColor = "red";
      x = 2;
    } else {
      document.getElementById(id).style.backgroundColor = "";
      x = 1;
    }
  }
  window.onload = function() {
    setInterval("blink('alert')", 500);
  }

  var blink_speed = 500; // every 1000 == 1 second, adjust to suit
  var t = setInterval(function() {
    var ele = document.getElementById('blinkingtext');
    ele.style.visibility = (ele.style.visibility == 'hidden' ? '' : 'hidden');
  }, blink_speed);
</script>