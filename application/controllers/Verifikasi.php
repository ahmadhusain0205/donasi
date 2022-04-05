<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_verifikasi
    $this->load->model('M_verifikasi');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Halaman Verifiksi';

    // meminta data tabel bencana ke dalam m_verifikasi lalu di tampung ke variabel data['bencana']
    $data['bencana'] = $this->M_verifikasi->bencana('bencana');

    // meminta data tabel donasi ke dalam m_verifikasi lalu di tampung ke variabel data['donasi_belum_terkonfirmasi_uang']
    $data['donasi_uang'] = $this->M_verifikasi->get_belum_terkonfirmasi_uang('donasi');

    // meminta data tabel donasi ke dalam m_verifikasi lalu di tampung ke variabel data['donasi_belum_terkonfirmasi']
    $data['donasi_barang'] = $this->M_verifikasi->get_belum_terkonfirmasi_barang('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman verifikasi
    $this->template->load('Template_user', 'Verifikasi/Data', $data);
  }
  public function konfirmasi($id)
  {
    // menampung id dari form verifikasi ke dalam variabel where
    $where = $id;

    // mengirim nama tabel dan kondisi where ke model m_verifikasi untuk diupdate
    $this->M_verifikasi->update('donasi', $where);

    // mengambil 1 baris data dari table donasi berdasarkan id nya
    $get_donasi = $this->db->get_where('donasi', ['id' => $where])->row_array();

    // menampung data id_bencana ke dalam variabel id_bencana dari variabel get_donasi
    $id_bencana = $get_donasi['id_bencana'];

    // menampung data donasi_uang ke dalam variabel donasi dari variabel get_donasi
    $donasi = $get_donasi['donasi_uang'];

    // mengambil 1 baris data dari table bencana berdasarkan id nya
    $get_bencana = $this->db->get_where('bencana', ['id' => $id_bencana])->row_array();

    // menampung data terkumpul ke dalam variabel terkumpul dari variabel get_bencana
    $terkumpul = $get_bencana['terkumpul'];

    // menampung data target ke dalam variabel target dari variabel get_bencana
    $target = $get_bencana['target'];

    // aritmatika penjumlahan variabel terkumpul dan variabel donasi
    $rumus = $terkumpul + $donasi;

    // aritmatika pengurangan variabel target dan variabel rumus
    $kekurangan = $target - $rumus;

    // update data bencana

    // set data terkumpul dengan variabel rumus
    $this->db->set('terkumpul', $rumus);

    // set data kekurangan dengan variabel kekurangan
    $this->db->set('kekurangan', $kekurangan);

    // kondisikan berdasarkan id nya
    $this->db->where('id', $id_bencana);

    // pilih tabel nya
    $this->db->update('bencana');

    // ambil jumlah barang dari variabel get_donasi lalu simpan ke dalam variabel jumlah_barang
    $jumlah_barang = $get_donasi['jumlah_barang'];

    // ambil 1 baris data barang berdasarkan id_bencana lalu simpan ke dalam variabel get_barang
    $get_barang = $this->db->get_where('barang', ['id_bencana' => $id_bencana])->row_array();

    // ambil data id dari variabel get_barang lalu simpan ke dalam variabel barang_id
    $barang_id = $get_barang['id'];

    // ambil data target dari variabel get_barang lalu simpan ke dalam variabel barang_target
    $barang_target = $get_barang['target'];

    // ambil data terkumpul dari variabel get_barang lalu simpan ke dalam variabel barang_terkumpul
    $barang_terkumpul = $get_barang['terkumpul'];

    // aritmatika barang terkumpul
    $rumus_terkumpul = $barang_terkumpul + $jumlah_barang;

    // aritmatika barang kekurangan
    $rumus_kekurangan = $barang_target - $rumus_terkumpul;

    // update data barang

    // set terkumpul dari variabel rumus_terkumpul
    $this->db->set('terkumpul', $rumus_terkumpul);

    // set kekurangan  dari variabel rumus_kekurangan
    $this->db->set('kekurangan', $rumus_kekurangan);

    // kondisi berdasarkan id barang
    $this->db->where('id', $barang_id);

    // pilih tabel nya
    $this->db->update('barang');

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengkonfirmasi data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // alihkan ke halaman verifikasi
    redirect('Verifikasi');
  }
  public function tolak($id)
  {
    // menampung id dari form verifikasi ke dalam variabel where
    $where = $id;

    // kondisikan berdasarkan id nya
    $this->db->where('id', $where);

    // pilih tabel nya
    $this->db->delete('donasi');

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menolak data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman verifikasi
    redirect('Verifikasi');
  }
  public function jemput()
  {
    $id = $this->input->post('id');
    $id_user = $this->input->post('id_user');
    $this->db->set('id_user', $id_user);
    $this->db->set('status_kurir', 2);
    $this->db->where('id', $id);
    $this->db->update('donasi');
    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> meminta penjemputan.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman verifikasi
    redirect('Verifikasi');
  }
}
