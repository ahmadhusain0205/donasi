<?php
class M_anggota extends CI_Model
{
  public function getanggota($table)
  {
    // mengambil data
    return $this->db->get($table)->result();
  }
  public function add($table, $data)
  {
    // menambahkan data
    return $this->db->insert($table, $data);
  }
  public function delete($table, $where)
  {
    // menghapus data
    $this->db->where($where);
    $this->db->delete($table);
  }
}
