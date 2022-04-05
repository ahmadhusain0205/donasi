<?php
class M_bencana extends CI_Model
{
  public function get($table)
  {
    // mengambil data
    return $this->db->get($table)->result();
  }
  public function get_terkonfirmasi($table)
  {
    // mengambil data join tabel bencana dan daerah berdasarkan konfirmasi dengan nilai 1
    return $this->db->query('select d.kode_pos, d.kecamatan, b.tanggal, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar, (select nama from barang where id_bencana=b.id) as nama_barang, (select target from barang where id_bencana=b.id) as target_barang, (select kekurangan from barang where id_bencana=b.id) as kekurangan_barang, (select terkumpul from barang where id_bencana=b.id) as terkumpul_barang from ' . $table . ' b join daerah d on d.id=b.id_daerah where konfirmasi = 1 order by b.id desc')->result();
  }
  public function get_belum_terkonfirmasi($table)
  {
    // mengambil data join tabel bencana dan daerah berdasarkan konfirmasi dengan nilai 0
    return $this->db->query('select d.kode_pos, d.kecamatan, b.tanggal, d.desa, b.id, b.id_daerah, b.bencana, b.deskripsi, (select no_rekening from bank where id in (select id_bank from user where id = b.id_user)) as no_rekening,  (select nama_bank from bank where id in (select id_bank from user where id = b.id_user)) as nama_bank, (select nama from user where id = b.id_user) as atas_nama, b.target, b.kekurangan, b.terkumpul, b.gambar from ' . $table . ' b join daerah d on d.id=b.id_daerah where konfirmasi = 0 order by b.id desc')->result();
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
    $this->db->where($where);
    $this->db->update($table);
  }
}
