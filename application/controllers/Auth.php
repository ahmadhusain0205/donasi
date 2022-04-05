<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model M_auth
    $this->load->model('M_auth');
  }
  public function index()
  {
    // membuat judul
    $data['judul'] = 'Halaman Masuk';

    // membuat validasi
    $this->form_validation->set_rules('username', 'username', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 huruf/nomor');

    // cek validasi

    // jika validasi gagal/tidak terpenuhi
    if ($this->form_validation->run() == false) {

      // menampilkan halaman login
      $this->template->load('Template', 'Auth/Login', $data);
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan data username dengan inputan dari form username
      $username = $this->input->post('username');

      // simpan data password dengan inputan dari form password kemudian di encrypsi dengan md5
      $password = md5($this->input->post('password'));

      // memuat data user yang sedang login
      $user = $this->db->get_where('user', ['username' => $username])->row_array();

      // pengecekan user

      // jika user berdasarkan username ada
      if ($user) {

        // lakukan pengecekan password

        // jika password sama
        if ($password ==  $user['password']) {

          // simpan juga ke dalam variabel data['user'] berdasarkan username
          $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

          // simpan data['user'] ke dalam session
          $this->session->set_userdata($user);

          // lakukan pengecekan status/role

          // jika status/rolenya 1/admin
          if ($user['id_role'] == 1) {

            // arahkan ke controller admin
            redirect('Admin');
          }

          // jika status/rolenya 2/relawan
          else if ($user['id_role'] == 2) {

            // arahkan ke controller relawan
            redirect('Relawan');
          }

          // jika tidak keduanya/kurir
          else {

            // arahkan ke controller kurir
            redirect('Kurir_x');
          }
        }

        // jika password salah
        else {

          // membuat notifikasi
          $this->session->set_flashdata(
            'notif',
            '
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Password salah!</strong> Silahkan masukan password dengan benar.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            '
          );

          // tampilkan halaman login
          $this->template->load('Template', 'Auth/Login', $data);
        }
      }

      // jika user tidak ada berdasarkan username
      else {

        // membuat notifikasi
        $this->session->set_flashdata(
          'notif',
          '
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Akun belum terdaftar!</strong> Silahkan daftar terlebih dahulu.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          '
        );

        // tampilkan halaman login
        $this->template->load('Template', 'Auth/Login', $data);
      }
    }
  }
  public function register()
  {
    // membuat judul
    $data['judul'] = 'Halaman Daftar';

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

      // menampilkan halaman register
      $this->template->load('Template', 'Auth/Register', $data);
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan inputan dari form register ke dalam variabel data
      $data = [
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'gambar' => 'default.png',
        'nama' => $this->input->post('nama'),
        'alamat' => $this->input->post('alamat'),
        'no_hp' => $this->input->post('no_hp'),
        'id_role' => $this->input->post('role')
      ];

      // arahkan data ke dalam model m_auth untuk di simpan ke dalam database
      $this->M_auth->simpan('user', $data);

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil mendaftar!</strong> Silahkan masuk.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman login
      redirect('Auth');
    }
  }
  public function logout()
  {
    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Terima kasih!</strong> Sudah berkunjung.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman login
    redirect('Auth');

    // hapus session
    $this->session->sess_destroy();
  }
}
