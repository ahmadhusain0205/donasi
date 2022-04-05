<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Selesai extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_selesai
    $this->load->model('M_selesai');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Tugas Terselesaikan';

    // meminta data donasi yang sudah terselesaikan
    $data['selesai'] = $this->M_selesai->selesai('donasi');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Selesai/Data', $data);
  }
}
