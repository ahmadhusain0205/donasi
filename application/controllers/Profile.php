<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Profil ku';

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman profile
    $this->template->load('Template_user', 'Profile/Data', $data);
  }
  public function edit()
  {
    // membuat validasi
    $this->form_validation->set_rules('username', 'username', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
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
      <strong>Gagal!</strong> mengubah data profile.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman profile
      redirect('Profile');
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan data username dengan inputan dari form username
      $username = $this->input->post('username');

      // simpan data nama dengan inputan dari form nama
      $nama = $this->input->post('nama');

      // simpan data alamat dengan inputan dari form alamat
      $alamat = $this->input->post('alamat');

      // simpan data no_hp dengan inputan dari form no_hp
      $no_hp = $this->input->post('no_hp');

      // upload gambar

      // ambil nama file dari inputan form gambar, lalu simpan ke dalam variabel upload_image
      $upload_image = $_FILES['gambar']['name'];

      // cek kondisi nama gambar

      // jika namanya ada
      if ($upload_image) {

        // arahkan ke direktori
        $config['upload_path'] = './assets/img/user/';

        // menentukan format gambar
        $config['allowed_types'] = 'jpg|png';

        // menentukan ukuran maksimal
        $config['max_size'] = '2048';

        // load library upload dari codeigniter
        $this->load->library('upload', $config);

        // cek kondisi terupload/tidak

        // jika terupload
        if ($this->upload->do_upload('gambar')) {

          // simpan nama file gambar kedalam variabel new
          $new = $this->upload->data('file_name');

          // cek kondisi nama upload-an gambarnya

          // jika namanya kosong
          if (!isset($new)) {

            // beri nama default lalu simpan ke dalam varibael gambar_default
            $gambar_default = 'default.png';
          }

          // jika tidak kosong
          else {

            // simpan variable new ke dalam variabel gambar_default
            $gambar_default = $new;
          }
        }

        // jika tidak terupload
        else {

          // beri nama default lalu simpan ke dalam varibael gambar_default
          $gambar_default = 'default.png';
        }
      }

      // jika namanya tidak ada
      else {

        // beri nama default lalu simpan ke dalam varibael gambar_default
        $gambar_default = 'default.png';
      }

      // update data user

      // set data nama dengan variabel nama
      $this->db->set('nama', $nama);

      // set data alamat dengan variabel alamat
      $this->db->set('alamat', $alamat);

      // set data no_hp dengan variabel no_hp
      $this->db->set('no_hp', $no_hp);

      // set data gambar dengan variabel gambar_default
      $this->db->set('gambar', $gambar_default);

      // kondisikan berdasarkan username nya
      $this->db->where('username', $username);

      // pilih tabel nya
      $this->db->update('user');

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengubah data profile.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman profile
      redirect('Profile');
    }
  }
  public function password()
  {
    // membuat validasi
    $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('konfirmasi', 'konfirmasi', 'required|trim|min_length[3]|matches[password]');
    $this->form_validation->set_message('min_length', '%s minimal 3 angka atau huruf');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');

    // cek validasi

    // jika validasi gagal/tidak terpenuhi
    if ($this->form_validation->run() == false) {

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Gagal!</strong> mengubah password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman profile
      redirect('Profile');
    }

    // jika validasi sukses/terpenuhi
    else {
      // update data user

      // set data password dengan inputan form password yang sudah di encrypsi dengan md5
      $this->db->set('password', md5($this->input->post('password')));

      // kondisikan berdasarkan id nya
      $this->db->where('id', $this->input->post('id'));

      // pilih tabel nya
      $this->db->update('user');

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengubah password.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman profile
      redirect('Profile');
    }
  }
}
