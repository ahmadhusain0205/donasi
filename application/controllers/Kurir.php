<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_kurir
    $this->load->model('M_kurir');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Halaman Kurir';

    // meminta data donasi dari M_kurir lalu simpan ke dalam variabel data['donasi']
    $data['donasi'] = $this->M_kurir->get_join('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Kurir/Data', $data);
  }
  public function konfirmasi($id)
  {
    // simpan inputan id ke dalam variabel where
    $where = $id;

    // mengirim nama tabel dan kondisi where ke model m_kurir untuk diupdate
    $this->M_kurir->update('donasi', $where);

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menyelesaikan tugas.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman kurir
    redirect('Kurir');
  }
}
