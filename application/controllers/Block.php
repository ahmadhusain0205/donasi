<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Block extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Blocking';

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Block', $data);
  }
}
