<div class="row">
  <div class="col text-center">
    <div class="fw-bold text-danger" style="margin-top: 50px; font-size:30px;" id="blinkingtext">MOHON MAAF HALAMAN TIDAK TERSEDIA</div>
    <br>
    <p class="fw-bold">Silahkan kembali ke
      <?php
      // cek role

      // jika sebagai relawan
      if ($this->session->userdata('id_role') == 2) {

        // arahkan ke halaman dashboard relawan
        $x = site_url('Relawan');
      }

      // jika sebagai kurir
      else {

        // arahkan ke halaman dashboard kurir
        $x = site_url('Kurir_x');
      }
      ?>
      <a class="btn btn-danger text-white btn-sm" type="button" href="<?= $x; ?>"><i class="fas fa-tachometer-alt"></i> Beranda</a>
    </p>
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