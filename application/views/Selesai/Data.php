<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="table">
            <thead>
              <tr class="text-center">
                <th width="1%">#</th>
                <th>Nama Donatur</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Tujuan Donasi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($selesai as $s) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $s->nama; ?></td>
                  <td><?= $s->nama_barang; ?></td>
                  <td>
                    <a class="text-decoration-none text-dark float-end"><?= $s->jumlah_barang . ' Kg'; ?></a>
                  </td>
                  <td><?= $s->tujuan; ?></td>
                  <td class="text-center">
                    <button class="btn btn-primary btn-sm" disabled><i class="far fa-check-circle"></i> Selesai</button>
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