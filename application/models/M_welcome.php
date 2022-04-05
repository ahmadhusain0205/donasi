<?php
class M_welcome extends CI_Model
{
  public function get($table)
  {
    // mengambil data
    return $this->db->get($table)->result();
  }
  public function get_bencana($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 1 dan kekurangan dengan nilai 0
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, d.longtitude, d.latitude, b.id, b.tanggal, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening, (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, (select nama from barang where id=b.id_barang) as nama_barang, (select target from barang where id=b.id_barang) as target_barang, (select kekurangan from barang where id=b.id_barang) as kekurangan_barang, (select terkumpul from barang where id=b.id_barang) as terkumpul_barang from ' . $table . ' b join daerah d on d.id=b.id_daerah where b.konfirmasi = 1')->result();
  }
  public function get_prioritas($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 1 dan kekurangan dengan nilai 0
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, d.longtitude, d.latitude, b.id, b.tanggal, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening, (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, (select nama from barang where id=b.id_barang) as nama_barang, (select target from barang where id=b.id_barang) as target_barang, (select kekurangan from barang where id=b.id_barang) as kekurangan_barang, (select terkumpul from barang where id=b.id_barang) as terkumpul_barang from ' . $table . ' b join daerah d on d.id=b.id_daerah where b.konfirmasi = 1 and b.kekurangan = 0 order by b.tanggal desc')->result();
  }
  public function get_minoritas($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 1 dan konfirmasu_kurir dengan nilai tidak sama dengan 0
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, d.longtitude, d.latitude, b.id, b.tanggal, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening, (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, (select nama from barang where id=b.id_barang) as nama_barang, (select target from barang where id=b.id_barang) as target_barang, (select kekurangan from barang where id=b.id_barang) as kekurangan_barang, (select terkumpul from barang where id=b.id_barang) as terkumpul_barang from ' . $table . ' b join daerah d on d.id=b.id_daerah where b.konfirmasi = 1 and b.kekurangan != 0 order by b.tanggal desc')->result();
  }
  public function add($table, $data)
  {
    // menambahkan data
    return $this->db->insert($table, $data);
  }
  public function kurir($table)
  {
    // mengambil data user dengan role id 3 (kurir)
    return $this->db->get_where($table, ['id_role' => 3])->result();
  }
}
