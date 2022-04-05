<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relawan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_relawan
    $this->load->model('M_relawan');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Selamat Datang';

    // meminta data (jumlah data) dari tabel donasi yang berlum terverifikasi ke M_relawan lalu simpan ke dalam variabel data['verifikasi']
    $data['verifikasi'] = $this->M_relawan->count_where('donasi');

    // meminta data (jumlah data) dari tabel donasi yang sudah terverifikasi ke M_relawan lalu simpan ke dalam variabel data['donasi']
    $data['donasi'] = $this->M_relawan->count_donasi('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Relawan/Dashboard', $data);
  }
}
