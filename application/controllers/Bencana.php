<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bencana extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_bencana
    $this->load->model('M_bencana');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2 or $this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Halaman Data Bencana';

    // meminta data tabel daerah ke dalam m_bencana lalu di tampung ke variabel data['daerah']
    $data['daerah'] = $this->M_bencana->get('daerah');

    // meminta data tabel bencana ke dalam m_bencana lalu di tampung ke variabel data['bencana_terkonfirmasi']
    $data['bencana_terkonfirmasi'] = $this->M_bencana->get_terkonfirmasi('bencana');

    // meminta data tabel bencana ke dalam m_bencana lalu di tampung ke variabel data['bencana_belum_terkonfirmasi']
    $data['bencana_belum_terkonfirmasi'] = $this->M_bencana->get_belum_terkonfirmasi('bencana');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman bencana
    $this->template->load('Template_user', 'Bencana/Data', $data);
  }
  public function konfirmasi($id)
  {
    // tampung id dari inputan form kedalam variabel where
    $where = ['id' => $id];

    // mengirim nama tabel dan kondisi where ke model m_bencana untuk diupdate
    $this->M_bencana->update('bencana', $where);

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengkonfirmasi data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman anggota
    redirect('Bencana');
  }
  public function tolak($id)
  {
    // menampung id dari form verifikasi ke dalam variabel where
    $this->db->where('id', $id);

    // pilih tabel nya
    $this->db->delete('bencana');

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menolak data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman anggota
    redirect('Bencana');
  }
  public function add()
  {
    // membuat validasi
    $this->form_validation->set_rules('id_daerah', 'id daerah', 'required|trim');
    $this->form_validation->set_rules('bencana', 'bencana', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('id_user', 'id_user', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('target', 'target', 'required|trim|min_length[3]');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 angka atau huruf');

    // cek validasi

    // jika validasi gagal/tidak terpenuhi
    if ($this->form_validation->run() == false) {

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Gagal!</strong> menambahkan data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman anggota
      redirect('Bencana');
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan data id_daerah dengan inputan dari form id_daerah
      $id_daerah = $this->input->post('id_daerah');

      // simpan data bencana dengan inputan dari form bencana
      $bencana = $this->input->post('bencana');

      // simpan data deskripsi dengan inputan dari form deskripsi
      $deskripsi = $this->input->post('deskripsi');

      // simpan data id_user dengan inputan dari form id_user
      $id_user = $this->input->post('id_user');

      // simpan data target dengan inputan dari form target
      $target = $this->input->post('target');

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

      // simpan demua variable diatas ke dalam variabel data
      $data = [
        'id_daerah' => $id_daerah,
        'bencana' => $bencana,
        'deskripsi' => $deskripsi,
        'id_user' => $id_user,
        'target' => $target,
        'kekurangan' => 0,
        'terkumpul' => 0,
        'konfirmasi' => 0,
        'id_barang' => 0,
        'gambar' => $gambar_default,
      ];

      // kirim data ke dalam M_bencan dan nama tabelnya untuk di tambahkan
      $this->M_bencana->add('bencana', $data);

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menambahkan data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman bencana
      redirect('Bencana');
    }
  }
  public function delete($id)
  {
    // menampung id dari form verifikasi ke dalam variabel where
    $where = $id;

    // kondisikan berdasarkan id nya
    $this->db->where('id', $where);

    // pilih tabel nya
    $this->db->delete('bencana');

    // membuat notifikasi
    $this->session->set_flashdata(
      'notif',
      '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> menghapus data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
    );

    // arahkan ke halaman bencana
    redirect('Bencana');
  }
  public function edit()
  {
    // membuat validasi
    $this->form_validation->set_rules('id_daerah', 'id daerah', 'required|trim');
    $this->form_validation->set_rules('bencana', 'bencana', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim|min_length[3]', [
      'min_length' => 'minimal 3 huruf atau angka'
    ]);
    $this->form_validation->set_rules('target', 'target', 'required|trim|min_length[3]', [
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
      <strong>Gagal!</strong> mengubah data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman bencana
      redirect('Bencana');
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan data id dengan inputan dari form id
      $id = $this->input->post('id');

      // simpan data id_daerah dengan inputan dari form id_daerah
      $id_daerah = $this->input->post('id_daerah');

      // simpan data bencana dengan inputan dari form bencana
      $bencana = $this->input->post('bencana');

      // simpan data deskripsi dengan inputan dari form deskripsi
      $deskripsi = $this->input->post('deskripsi');

      // simpan data id_user dengan inputan dari form id_user
      $id_user = $this->input->post('id_user');

      // simpan data target dengan inputan dari form target
      $target = $this->input->post('target');

      // simpan data kekurangan dengan inputan dari form kekurangan
      $kekurangan = $this->input->post('kekurangan');

      // simpan data terkumpul dengan inputan dari form terkumpul
      $terkumpul = $this->input->post('terkumpul');

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

        // menentukan ukuran gambar
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

      // update data bencana

      // set data id_daerah dengan variabel id_daerah
      $this->db->set('id_daerah', $id_daerah);

      // set data bencana dengan variabel bencana
      $this->db->set('bencana', $bencana);

      // set data deskripsi dengan variabel deskripsi
      $this->db->set('deskripsi', $deskripsi);

      // set data id_user dengan variabel id_user
      $this->db->set('id_user', $id_user);

      // set data target dengan variabel target
      $this->db->set('target', $target);

      // set data kekurangan dengan variabel kekurangan
      $this->db->set('kekurangan', $kekurangan);

      // set data terkumpul dengan variabel terkumpul
      $this->db->set('terkumpul', $terkumpul);

      // set data gambar dengan variabel gambar_default
      $this->db->set('gambar', $gambar_default);

      // kondisikan berdasarkan id nya
      $this->db->where('id', $id);

      // pilih tabel nya
      $this->db->update('bencana');

      // membuat notifikasi
      $this->session->set_flashdata(
        'notif',
        '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil!</strong> mengubah data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
      );

      // arahkan ke halaman bencana
      redirect('Bencana');
    }
  }
}
