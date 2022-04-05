<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir_x extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_kurir_x
    $this->load->model('M_kurir_x');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2 or $this->session->userdata('id_role') == 1) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Selamat Datang';

    // meminta data (jumlah data) dari tabel donasi yang berlum terverifikasi ke M_kurir_x lalu simpan ke dalam variabel data['kirim']
    $data['kirim'] = $this->M_kurir_x->count_where('donasi');

    // meminta data (jumlah data) dari tabel donasi yang sudah terverifikasi ke M_kurir_x lalu simpan ke dalam variabel data['selesi']
    $data['selesai'] = $this->M_kurir_x->count_selesai('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Kurir_x/Dashboard', $data);
  }
}
