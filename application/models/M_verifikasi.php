<?php
class M_verifikasi extends CI_Model
{
  public function get_belum_terkonfirmasi_uang($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 0 dan konfirmasu_kurir dengan nilai 0
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.deskripsi, don.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, don.nama, don.donasi_uang, don.bukti, don.konfirmasi as don_konfirmasi, don.id_bencana, don.status_kurir, don.jumlah_barang from ' . $table . ' don join bencana b on don.id_bencana=b.id join daerah d on d.id=b.id_daerah where don.jumlah_barang = 0 and don.konfirmasi = 0 and don.konfirmasi_kurir = 0')->result();
  }
  public function get_belum_terkonfirmasi_barang($table)
  {
    // mengambil data join tabel bencana, donasi dan daerah berdasarkan konfirmasi dengan nilai 0 dan konfirmasu_kurir dengan nilai 0
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.deskripsi, don.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, don.nama, don.donasi_uang, don.bukti, don.konfirmasi as don_konfirmasi, don.id_bencana, don.status_kurir, don.jumlah_barang from ' . $table . ' don join bencana b on don.id_bencana=b.id join daerah d on d.id=b.id_daerah where don.jumlah_barang != 0 and don.konfirmasi = 0 and don.konfirmasi_kurir = 0')->result();
  }
  public function bencana($table)
  {
    // mengambil data join tabel bencana dan daerah
    return $this->db->query('select d.kode_pos, d.kecamatan, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from ' . $table . ' b join daerah d on d.id=b.id_daerah')->result();
  }
  public function update($table, $where)
  {
    // mengubah nilai konfirmasi dari 0 menjadi 1
    $this->db->set('konfirmasi', 1);
    $this->db->where('id', $where);
    $this->db->update($table);
  }
}
