<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    // load model m_barang
    $this->load->model('M_barang');

    // cek id rolenya
    if ($this->session->userdata('id_role') == 2 or $this->session->userdata('id_role') == 3) {

      // arahkan ke block
      redirect('Block');
    }
  }
  public function index()
  {
    // membuat judul halaman
    $data['judul'] = 'Halaman Data Barang Donasi';

    // meminta data tabel barang ke dalam M_barang lalu di tampung ke variabel data['barang']
    $data['barang'] = $this->M_barang->get_join('barang');

    // meminta data tujuan dari join bencana dan daerah lalu di tampung ke variabel data['tujuan']
    $data['tujuan'] = $this->M_barang->tujuan('bencana');

    // memuat data user yang sedang login
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    // memuat halaman dashboard
    $this->template->load('Template_user', 'Barang/Data', $data);
  }
  public function add()
  {
    // membuat validasi
    $this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('target', 'target', 'required|trim|min_length[3]');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 huruf/nomor');

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

      // arahkan ke halaman barang
      redirect('Barang');
    }

    // jika validasi sukses/terpenuhi
    else {
      // simpan data nama dengan inputan dari form nama
      $nama = $this->input->post('nama');

      // simpan data target dengan inputan dari form target
      $target = $this->input->post('target');

      // simpan data tujuan dengan inputan dari form tujuan
      $tujuan = $this->input->post('tujuan');

      // simpan variabel diatas ke dalam variabel data
      $data = [
        'nama' => $nama,
        'target' => $target,
        'kekurangan' => 0,
        'terkumpul' => 0,
        'id_bencana' => $tujuan,
      ];


      // kirim data ke dalam M_barang dan nama tabelnya untuk di tambahkan
      $this->M_barang->add('barang', $data);

      // ambil id barang dengan data terakhir
      $sql = $this->db->query('select * from barang order by id desc limit 1')->row_array();

      // ambil id nya lalu tampung ke variabel id_barang
      $id_barang = $sql['id'];

      // update bencana

      // set id_barang dari variabel id_barang
      $this->db->set('id_barang', $id_barang);

      // berdasarkan id_bencana dari variabel sql
      $this->db->where('id', $sql['id_bencana']);

      // pilih tabelmya
      $this->db->update('bencana');

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

      // arahkan ke halaman barang
      redirect('Barang');
    }
  }
  public function delete($id)
  {
    // tampung id dari inputan form ke variabel where
    $where = $id;

    // ambil 1 baris data barang berdasarkan id nya
    $sql = $this->db->query('select * from barang where id=' . $where)->row_array();

    // ambil id_bencana dari variabel sql lalu tampung ke variabel id_bencana
    $id_bencana = $sql['id_bencana'];

    // update data bencana

    // set id_barang menjadi 0
    $this->db->set('id_barang', 0);

    // kondisi berdasarkan variabel id_bencana
    $this->db->where('id', $id_bencana);

    // pilih tabel nya
    $this->db->update('bencana');

    // hapus data dari tabel barang

    // kondisi berdasarkan variabel where
    $this->db->where('id', $where);

    // pilih tabel nya
    $this->db->delete('barang');

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

    // arahkan ke halaman barang
    redirect('Barang');
  }
  public function ubah()
  {
    // membuat validasi
    $this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('target', 'target', 'required|trim|min_length[3]');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 huruf/nomor');

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

      // arahkan ke halaman barang
      redirect('Barang');
    }

    // jika validasi sukses/terpenuhi
    else {

      // simpan data id dari form input id lalu simpan ke dalam variabel id
      $id = $this->input->post('id');

      // simpan data nama dari form input nama lalu simpan ke dalam variabel nama
      $nama = $this->input->post('nama');

      // simpan data target dari form input target lalu simpan ke dalam variabel target
      $target = $this->input->post('target');

      // simpan data kekurangan dari form input kekurangan lalu simpan ke dalam variabel kekurangan
      $kekurangan = $this->input->post('kekurangan');

      // simpan data terkumpul dari form input terkumpul lalu simpan ke dalam variabel terkumpul
      $terkumpul = $this->input->post('terkumpul');

      // simpan data tujuan dari form input tujuan lalu simpan ke dalam variabel tujuan
      $tujuan = $this->input->post('tujuan');

      // update data

      // set nama berdasarkan variabel nama
      $this->db->set('nama', $nama);

      // set target berdasarkan variabel target
      $this->db->set('target', $target);

      // set kekurangan berdasarkan variabel kekurangan
      $this->db->set('kekurangan', $kekurangan);

      // set terkumpul berdasarkan variabel terkumpul
      $this->db->set('terkumpul', $terkumpul);

      // set tujuan berdasarkan variabel tujuan
      $this->db->set('id_bencana', $tujuan);

      // kondisi berdasarkan id
      $this->db->where('id', $id);

      // pilih tabel nya
      $this->db->update('barang');

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

      // arahkan ke halaman barang
      redirect('Barang');
    }
  }
}
