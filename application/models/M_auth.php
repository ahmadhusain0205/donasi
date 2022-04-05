<?php
class M_auth extends CI_Model
{
  public function simpan($table, $data)
  {
    // menambahkan data
    return $this->db->insert($table, $data);
  }
}
