<?php
class M_kurir extends CI_Model
{
  public function get_join($table)
  {
    if ($this->session->userdata('id_role') == 1) {
      return $this->db->query('select d.id, d.nama, (select nama from user where id = d.id_user) pengantar, d.no_hp, d.alamat, (select nama from barang where id_bencana=d.id_bencana) as nama_barang, d.jumlah_barang, (select desa from daerah where id=b.id_daerah) as tujuan from ' . $table . ' d join bencana b on d.id_bencana=b.id where d.konfirmasi_kurir = 0 and d.jumlah_barang != 0 and d.konfirmasi=1')->result();
    } else {
      return $this->db->query('select d.id, d.nama, (select nama from user where id = d.id_user) pengantar, d.no_hp, d.alamat, (select nama from barang where id_bencana=d.id_bencana) as nama_barang, d.jumlah_barang, (select desa from daerah where id=b.id_daerah) as tujuan from ' . $table . ' d join bencana b on d.id_bencana=b.id where d.konfirmasi_kurir = 0 and d.jumlah_barang != 0 and d.konfirmasi=1 and d.id_user = ' . $this->session->userdata('id'))->result();
    }
  }
  public function update($table, $where)
  {
    // set konfirmasi menjadi 1
    $this->db->set('konfirmasi_kurir', 1);

    // kondisi berdasarkan id
    $this->db->where('id', $where);

    // pilih tabel nya
    $this->db->update('donasi');
  }
}
