<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_admin
    $this->load->model('M_admin');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2 or $this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Selamat Datang';

    // meminta data (jumlah data) tabel bencana ke dalam m_admin lalu di tampung ke variabel data['count_bencana']
    $data['count_bencana'] = $this->M_admin->count_where('bencana');

    // meminta data (jumlah data) tabel user ke dalam m_admin lalu di tampung ke variabel data['count_anggota']
    $data['count_anggota'] = $this->M_admin->count('user');

    // meminta data (jumlah data) tabel donasi ke dalam m_admin lalu di tampung ke variabel data['count_donatur']
    $data['count_donatur'] = $this->M_admin->count_where('donasi');

    // meminta data (jumlah data) tabel donasi ke dalam m_admin lalu di tampung ke variabel data['count_selesai']
    $data['count_selesai'] = $this->M_admin->selesai('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Admin/Dashboard', $data);
  }
}
