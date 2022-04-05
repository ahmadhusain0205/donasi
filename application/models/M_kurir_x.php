<?php
class M_kurir_x extends CI_Model
{
  public function count_where($table)
  {
    return $this->db->query('select * from ' . $table . ' where konfirmasi = 1 and konfirmasi_kurir = 0 and status_kurir = 1 and jumlah_barang != 0')->num_rows();
  }
  public function count_selesai($table)
  {
    return $this->db->query('select * from ' . $table . ' where konfirmasi = 1 and konfirmasi_kurir = 1')->num_rows();
  }
}
