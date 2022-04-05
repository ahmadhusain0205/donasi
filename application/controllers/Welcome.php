<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// load model m_welcome
		$this->load->model('M_welcome');

		// load model m_donasi
		$this->load->model('M_donasi');
	}
	public function index()
	{
		// membuat judul halaman
		$data['judul'] = 'Selamat Datang';

		// meminta data tabel user ke dalam m_welcome lalu di tampung ke variabel data['kurir']
		$data['kurir'] = $this->M_welcome->kurir('user');

		// meminta data tabel bencana ke dalam m_welcome lalu di tampung ke variabel data['bencana_prioritas']
		$data['bencana'] = $this->M_welcome->get_bencana('bencana');

		// meminta data tabel bencana ke dalam m_welcome lalu di tampung ke variabel data['bencana_prioritas']
		$data['bencana_prioritas'] = $this->M_welcome->get_prioritas('bencana');

		// meminta data tabel bencana ke dalam m_welcome lalu di tampung ke variabel data['bencana_minoritas']
		$data['bencana_minoritas'] = $this->M_welcome->get_minoritas('bencana');

		// memuat halaman Welcome
		$this->template->load('Template', 'Welcome/Home', $data);
	}
	public function ajukan()
	{
		// membuat judul halaman
		$data['judul'] = 'Halaman Pengajuan';

		// meminta data tabel daerah ke dalam m_welcome lalu di tampung ke variabel data['daerah']
		$data['daerah'] = $this->M_welcome->get('daerah');

		// memuat halaman pengajuan
		$this->template->load('Template', 'Welcome/Ajukan', $data);
	}
	public function add()
	{
		// membuat validasi
		$this->form_validation->set_rules('id_daerah', 'id daerah', 'required|trim');
		$this->form_validation->set_rules('bencana', 'bencana', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required|trim|min_length[3]');
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
      <strong>Gagal!</strong> mengajukan data.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
			);

			// arahkan ke halaman pengajuan
			redirect('Welcome/ajukan');
		}

		// jika validasi sukses/terpenuhi
		else {

			// simpan data id_daerah dengan inputan dari form id_daerah
			$id_daerah = $this->input->post('id_daerah');

			// simpan data bencana dengan inputan dari form bencana
			$bencana = $this->input->post('bencana');

			// simpan data deskripsi dengan inputan dari form deskripsi
			$deskripsi = $this->input->post('deskripsi');

			// simpan data atas_nama dengan inputan dari form atas_nama
			$atas_nama = '-';

			// simpan data no_rekening dengan inputan dari form no_rekening
			$no_rekening = 0;

			// simpan data target dengan inputan dari form target
			$target = 0;

			// simpan demua variable diatas ke dalam variabel data
			$data = [
				'id_daerah' => $id_daerah,
				'bencana' => $bencana,
				'deskripsi' => $deskripsi,
				'target' => $target,
				'kekurangan' => 0,
				'terkumpul' => 0,
				'konfirmasi' => 0,
				'id_barang' => 0,
				'gambar' => 'default.png',
			];

			// kirim data ke dalam M_welcome dan nama tabelnya untuk di tambahkan
			$this->M_welcome->add('bencana', $data);

			// membuat notifikasi
			$this->session->set_flashdata(
				'notif',
				'
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil mengajukan data!</strong> Data akan dikonfirmasi jika benar.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
			);

			// arahkan ke halaman pengajuan
			redirect('Welcome/ajukan');
		}
	}
	public function donasi()
	{
		// membuat validasi
		$this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]');
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
      <strong>Gagal!</strong> mendonasi.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
			);

			// arahkan ke halaman home
			redirect('Welcome');
		}

		// jika validasi sukses/terpenuhi
		else {

			// simpan data id dengan inputan dari form id
			$id = $this->input->post('id');

			// simpan data nama dengan inputan dari form nama
			$nama = $this->input->post('nama');

			// simpan data no_hp dengan inputan dari form no_hp
			$no_hp = $this->input->post('no_hp');

			// simpan data alamat dengan inputan dari form alamat
			$alamat = $this->input->post('alamat');

			// simpan data donasi_barang dengan inputan dari form barang
			$barangx = $this->input->post('barang');

			// cek jumlah barang

			// jika jumlahnya null
			if ($barangx == null) {

				// isikan dengan data 0
				$barang = 0;
			}

			// jika barang tidak null
			else {

				// isikan sesuai denganinputan
				$barang = $barangx;
			}

			// cek keadaan donasi uang atau barang

			// simpan data donasi dengan inputan dari form donasi
			$donasi_uang = $this->input->post('donasi');

			// jika donasi uang
			if ($donasi_uang != null) {
				// simpan ke dalam variabel donasi
				$donasi = $donasi_uang;
			} else {
				$donasi = 0;
			}

			// cek keadaan donasi uang atau barang

			// simpan data kurir dengan inputan dari form kurir
			$kurir = $this->input->post('kurir');

			// upload gambar

			// ambil nama file dari inputan form bukti, lalu simpan ke dalam variabel image_name
			$image_name = $_FILES["bukti"]['name'];

			// cek kondisi form bukti

			// jika ada filenya
			if ($image_name != null) {

				// arahkan ke direktori
				$config['upload_path'] 		= 'assets/img/bukti/';

				// menentukan format gambar
				$config['allowed_types'] 	= 'jpg|png|jpeg';

				// menentukan ukuran maksimal
				$config['max_size'] = '2048';

				// ambil file name dari variabel image_name
				$config['file_name'] 		= $image_name;

				// load library upload dari codeigniter
				$this->load->library('upload', $config);

				// upload file dari inputan form bukti
				$this->upload->do_upload('bukti');

				// simpan file nama bukti ke dalam variabel bukti
				$bukti = $this->upload->data('file_name');
			}
			// jika tidak ada filenya
			else {
				$bukti = 'default.png';
			}

			// simpan demua variable diatas ke dalam variabel data
			$data = [
				'nama' => $nama,
				'no_hp' => $no_hp,
				'alamat' => $alamat,
				'donasi_uang' => $donasi,
				'konfirmasi' => 0,
				'konfirmasi_kurir' => 0,
				'bukti' => $bukti,
				'id_bencana' => $id,
				'status_kurir' => $kurir,
				'jumlah_barang' => $barang,
			];

			// kirim data ke dalam M_welcome dan nama tabelnya untuk di tambahkan
			$this->M_welcome->add('donasi', $data);

			// membuat notifikasi
			$this->session->set_flashdata(
				'notif',
				'
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Berhasil mendonasi!</strong> Terima kasih telah peduli.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      '
			);

			// arahkan ke halaman home
			redirect('Welcome');
		}
	}
	public function pendonatur()
	{
		// membuat judul halaman
		$data['judul'] = 'Daftar Pendonatur';

		// meminta data tabel donasi ke dalam m_donasi lalu di tampung ke variabel data['donasi_uang']
		$data['donasi_uang'] = $this->M_donasi->get_uang('donasi');

		// meminta data tabel donasi ke dalam m_donasi lalu di tampung ke variabel data['donasi_barang']
		$data['donasi_barang'] = $this->M_donasi->get_barang('donasi');

		// memuat halaman pendonatur
		$this->template->load('Template', 'Welcome/Pendonatur', $data);
	}
}
