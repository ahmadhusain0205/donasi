<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Donatur extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_donasi
    $this->load->model('M_donasi');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Halaman Donatur';

    // meminta data tabel bencana ke dalam m_bencana lalu di tampung ke variabel data['bencana']
    $data['bencana'] = $this->M_donasi->bencana('bencana');

    // meminta data tabel donasi ke dalam m_bencana lalu di tampung ke variabel data['donasi_terkonfirmasi']
    $data['donasi_uang'] = $this->M_donasi->get_uang('donasi');

    // meminta data tabel donasi ke dalam m_bencana lalu di tampung ke variabel data['donasi_terkonfirmasi']
    $data['donasi_barang'] = $this->M_donasi->get_barang('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman donatur
    $this->template->load('Template_user', 'Donatur/Data', $data);
  }
}
