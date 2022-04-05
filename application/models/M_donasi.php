<?php
class M_donasi extends CI_Model
{
  public function get($table)
  {
    // mengambil data
    return $this->db->get($table)->result();
  }
  public function get_uang($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 1, lalu diorder berdasarkan donasi terbesar
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, don.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.deskripsi, b.gambar, don.nama, don.donasi_uang, don.bukti, don.konfirmasi as don_konfirmasi, don.id_bencana, don.jumlah_barang, b.tanggal, (select nama from barang where id_bencana=b.id) as nama_barang, (select target from barang where id_bencana=b.id) as target_barang, (select kekurangan from barang where id_bencana=b.id) as kekurangan_barang, (select terkumpul from barang where id_bencana=b.id) as terkumpul_barang from ' . $table . ' don join bencana b on don.id_bencana=b.id join daerah d on d.id=b.id_daerah where don.konfirmasi = 1 and b.terkumpul != 0 order by don.id desc')->result();
  }
  public function get_barang($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 1, lalu diorder berdasarkan donasi terbesar
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, don.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.deskripsi, b.gambar, don.nama, don.donasi_uang, don.bukti, don.konfirmasi as don_konfirmasi, don.konfirmasi_kurir as don_konfirmasi_kurir, don.id_bencana, don.jumlah_barang, b.tanggal, (select nama from barang where id_bencana=b.id) as nama_barang, (select target from barang where id_bencana=b.id) as target_barang, (select kekurangan from barang where id_bencana=b.id) as kekurangan_barang, (select terkumpul from barang where id_bencana=b.id) as terkumpul_barang from ' . $table . ' don join bencana b on don.id_bencana=b.id join daerah d on d.id=b.id_daerah where don.konfirmasi = 1 and don.jumlah_barang != 0 order by don.id desc')->result();
  }
  public function bencana($table)
  {
    // mengambil data join tabel bencana dan daerah
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from ' . $table . ' b join daerah d on d.id=b.id_daerah')->result();
  }
  public function add($table, $data)
  {
    // menambahkan data
    return $this->db->insert($table, $data);
  }
  public function update($table, $where)
  {
    // mengubah nilai konfirmasi dari 0 menjadi 1
    $this->db->set('konfirmasi', 1);
    $this->db->where('id', $where);
    $this->db->update($table);
  }
}
