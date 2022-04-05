<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggota extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_anggota
    $this->load->model('M_anggota');

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

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // meminta data tabel user ke dalam m_anggota lalu di tampung ke variabel data['anggota']
    $data['anggota'] = $this->M_anggota->getanggota('user');

    // memuat halaman anggota
    $this->template->load('Template_user', 'Anggota/Data', $data);
  }
  public function add()
  {
    // membuat validasi
    $this->form_validation->set_rules('username', 'username', 'required|trim|is_unique[user.username]|min_length[3]', [
      'is_unique' => 'username sudah digunakan'
    ]);
    $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('role', 'role', 'required|trim');
    $this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('alamat', 'alamat', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('no_hp', 'no hp', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_message('required', '%s tidak boleh kosong');

    // cek validasi

    // jika validasi gagal/tidak terpenuhi
    if ($this->form_validation->run() == false) {

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Gagal!</strong> menambahkan data anggota.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman anggota
      redirect('Anggota');
    }

    // jika validasi sukses/terpenuhi
    else {

      // tampung inputan form anggota ke dalam variabel data
      $data = [
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'nama' => $this->input->post('nama'),
        'alamat' => $this->input->post('alamat'),
        'no_hp' => $this->input->post('no_hp'),
        'id_role' => $this->input->post('role'),
        'gambar' => 'default.png'
      ];

      // kirim data ke dalam M_anggota dan nama tabelnya untuk di tambahkan
      $this->M_anggota->add('user', $data);

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menambahkan data anggota.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman anggota
      redirect('Anggota');
    }
  }
  public function edit()
  {
    // membuat validasi
    $this->form_validation->set_rules('username', 'username', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('role', 'role', 'required|trim');
    $this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('alamat', 'alamat', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('no_hp', 'no hp', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_message('required', '%s tidak boleh kosong');

    // cek validasi
    // jika validasi gagal/tidak terpenuhi
    if ($this->form_validation->run() == false) {

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Gagal!</strong> mengubah data anggota.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman anggota
      redirect('Anggota');
    }

    // jika validasi sukses/terpenuhi
    else {

      // set data username dengan inputan dari form username
      $this->db->set('username', $this->input->post('username'));

      // set data nama dengan inputan dari form nama
      $this->db->set('nama', $this->input->post('nama'));

      // set data no_hp dengan inputan dari form no_hp
      $this->db->set('no_hp', $this->input->post('no_hp'));

      // set data alamat dengan inputan dari form alamat
      $this->db->set('alamat', $this->input->post('alamat'));

      // set data id_role dengan inputan dari form id_role
      $this->db->set('id_role', $this->input->post('role'));

      // kondisikan berdasarkan id nya
      $this->db->where('id', $this->input->post('id'));

      // pilih tabel nya
      $this->db->update('user');

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengubah data anggota.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman anggota
      redirect('Anggota');
    }
  }
  public function delete($id)
  {
    // membuat kondisi berdasarkan id
    $where = ['id' => $id];

    // kirim nama table dan kondisi ke m_anggota untuk dihapus dari database
    $this->M_anggota->delete('user', $where);

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menghapus data anggota.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman anggota
    redirect('Anggota');
  }
}
