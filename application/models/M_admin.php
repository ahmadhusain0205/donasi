<?php
class M_admin extends CI_Model
{
  public function get($table)
  {
    // mengambil data
    return $this->db->get($table)->result();
  }
  public function count_where($table)
  {
    // menjumlahkan data berdasarkan konfirmasi dengan nilai 1
    return $this->db->get_where($table, ['konfirmasi' => 1])->num_rows();
  }
  public function count($table)
  {
    // menjumlahkan data
    return $this->db->get($table)->num_rows();
  }
  public function selesai($table)
  {
    return $this->db->query('select * from ' . $table . ' where konfirmasi_kurir = 1 and konfirmasi = 1')->num_rows();
  }
}
