<?php
class M_relawan extends CI_Model
{
  public function count_where($table)
  {
    return $this->db->query('select * from ' . $table . ' where konfirmasi = 0 and konfirmasi_kurir = 0')->num_rows();
  }
  public function count_donasi($table)
  {
    return $this->db->query('select * from ' . $table . ' where konfirmasi = 1 or konfirmasi_kurir = 1')->num_rows();
  }
}
