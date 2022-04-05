<?php
class M_barang extends CI_Model
{
  public function get_join($table)
  {
    return $this->db->query('select b.id, b.nama, b.target, b.kekurangan, b.terkumpul, b.id_bencana, ben.id_daerah, d.desa from ' . $table . ' b join bencana ben on b.id_bencana=ben.id join daerah d on ben.id_daerah=d.id')->result();
  }
  public function tujuan($table)
  {
    return $this->db->query('select b.id, (select desa from daerah where id = b.id_daerah) as desa from ' . $table . ' b where konfirmasi = 1')->result();
  }
  public function add($table, $data)
  {
    // menambahkan data
    return $this->db->insert($table, $data);
  }
}
