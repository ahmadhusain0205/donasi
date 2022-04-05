<?php 
class M_selesai extends CI_Model{
  public function selesai($table){
    return $this->db->query('select d.id, d.nama, (select nama from barang where id_bencana=d.id_bencana) as nama_barang, d.jumlah_barang, (select desa from daerah where id=b.id_daerah) as tujuan from ' . $table . ' d join bencana b on d.id_bencana=b.id where d.konfirmasi_kurir = 1 and d.konfirmasi = 1')->result();
  }
}
