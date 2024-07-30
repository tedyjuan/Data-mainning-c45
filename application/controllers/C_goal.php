<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class C_goal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		// ========== untuk mengecek timezone ==========
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model(array('Mglobal'));
	}

	public function index()
	{
		$data['list'] = $this->Mglobal->get_data('tb_goal');
		$this->load->view("f_goal/v_grid_goal", $data);
	}
	public function  tambah_data()
	{
		$this->load->view("f_goal/v_tambah_goal");
	}

	public function simpan_data()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('ket', 'ket', 'required');
		if ($this->form_validation->run() == false) {
			$jsonmsg = [
				'hasil' => 'false',
				'pesan' => form_error('nama') . form_error('ket'),
			];
			echo json_encode($jsonmsg);
		} else {
			$nama = $this->input->post('nama');
			$ket = $this->input->post('ket');
			$data = [
				'id_goal' => $this->Mglobal->get_max_id("id_goal", 'tb_goal'),
				'nama_goal' => $nama,
				'keterangan' => $ket,
				'dtmcreated' => date('Y-m-d H:i:s'),
				'dtmupdated' => date('Y-m-d H:i:s')
			];
			$cekdata = $this->Mglobal->single_save($data, "tb_goal");
			if ($cekdata == 'true') {
				$jsonmsg = [
					'hasil' => 'true',
					'pesan' => "Data berhasil Di simpan",
				];
				echo json_encode($jsonmsg);
			} else {
				$jsonmsg = [
					'hasil' => 'false',
					'pesan' => "Data gagal Di simpan",
				];
				echo json_encode($jsonmsg);
			}
		}
	}

	public function hapus_data()
	{
		$id = $this->input->post('id');
		$incr = $this->input->post('incr');

		$where = [
			'id_goal' => $id,
			'incr' => $incr
		];
		$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->result();
		if (empty($cekdata)) {
			$jsonmsg = [
				'hasil' => 'false',
				'pesan' => "Data Gagal Di Hapus, ID Tidak Di Temukan",
			];
			echo json_encode($jsonmsg);
		} else {

			$hapusdata = $this->Mglobal->single_delete("tb_goal", $where);
			if ($hapusdata == 'true') {
				$jsonmsg = [
					'hasil' => 'true',
					'pesan' => "Data Berhasil Di Hapus",
				];
				echo json_encode($jsonmsg);
			} else {
				$jsonmsg = [
					'hasil' => 'false',
					'pesan' => "Data Gagal Di Hapus, cek koneksi database",
				];
				echo json_encode($jsonmsg);
			}
		}
	}

	public function edit_form($id)
	{
		$decode = $this->encryption->decrypt(base64_decode($id));
		$where = [
			'id_goal' => $decode
		];
		$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->result();
		if (empty($cekdata)) {
			$this->session->set_flashdata("faileddata", "Data tidak di temukan");
			redirect("data-goal");
		} else {
			$data['detail'] = $cekdata;
			$this->load->view("f_goal/v_edit_goal", $data);
		}
	}

	public function update_data()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('ket', 'ket', 'required');
		$this->form_validation->set_rules('id', 'id', 'required');
		$this->form_validation->set_rules('incr', 'incr', 'required');
		if ($this->form_validation->run() == false) {
			$jsonmsg = [
				'hasil' => 'false',
				'pesan' => form_error('nama') . form_error('ket') . form_error('incr') . form_error('incr'),
			];
			echo json_encode($jsonmsg);
		} else {
			$id =  $this->input->post('id');
			$incr = $this->input->post('incr');
			$where = [
				'id_goal' => $id,
				'incr' => $incr
			];
			$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->result();
			if (empty($cekdata)) {
				$this->session->set_flashdata("faileddata", "Data tidak di temukan");
				redirect("data-goal");
			} else {
				$nama = htmlspecialchars($this->input->post('nama'));
				$ket = htmlspecialchars($this->input->post('ket'));
				$data = [
					'nama_goal' => $nama,
					'keterangan' => $ket,
					'dtmupdated' => date('Y-m-d H:i:s')
				];
				$cekdata = $this->Mglobal->single_update($data, "tb_goal", $where);
				if ($cekdata == 'true') {
					$jsonmsg = [
						'hasil' => 'true',
						'pesan' => "Data berhasil Di Update",
					];
					echo json_encode($jsonmsg);
				} else {
					$jsonmsg = [
						'hasil' => 'false',
						'pesan' => "Data gagal Di Update",
					];
					echo json_encode($jsonmsg);
				}
			}
		}
	}

	public function upload_form($id)
	{
		$decode = $this->encryption->decrypt(base64_decode($id));
		$where = [
			'id_goal' => $decode
		];
		$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->result();
		if (empty($cekdata)) {
			$this->session->set_flashdata("faileddata", "Data tidak di temukan");
			redirect("data-goal");
		} else {
			$data['detail'] = $cekdata;
			$this->load->view("f_goal/v_upload_goal", $data);
		}
	}
	public function preview_excel()
	{
		$id = $this->input->post('id');
		$incr = $this->input->post('incr');
		$where = [
			'id_goal' => $id,
		];
		$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->result();
		if (empty($cekdata)) {
			$jsonmsg = array(
				"hasil"     => 'false',
				"pesan"     => "Data gagal Di Preview Id Goal Tidak di temukan",
			);
			echo json_encode($jsonmsg);
		} else {
			$file_lama  =  $cekdata[0]->file_name;
			if ($file_lama != '') {
				// hapus file lama
				$filePath_lama = './uploads/' . $file_lama;
				if (file_exists($filePath_lama)) {
					unlink($filePath_lama);
					// hapus data atribute dengan type id goal
				}

				$this->Mglobal->single_delete("tb_atribut", $where);
			}
			$post_file  = $_FILES['file']['name']; // ini dari name file
			$fileNameParts = explode('.', $post_file);
			$potong_typefile = end($fileNameParts);
			$typefile = strtolower($potong_typefile);
			if ($post_file != "") {
				$nama_filenya             = "docs" . '_' . time() . '.' . $typefile;
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'xls|xlsx';
				$config['max_size']      = 5100;
				$config['file_name']     = $nama_filenya;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if (!$this->upload->do_upload('file')) {
					$jsonmsg = array(
						"hasil"  => 'false',
						"pesan"  => $this->upload->display_errors('', ''),
						"msg_db" => "upload failed",
					);
					echo json_encode($jsonmsg);
				} else {
					// Path file yang diupload
					$filePath = './uploads/' . $nama_filenya;
					// Load file Excel
					$spreadsheet = IOFactory::load($filePath);
					// Membaca data dari sheet pertama
					$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
					foreach ($sheetData as $num => $isi) {
						$lastElement[] = end($isi);
					}
					// Menghapus elemen pertama
					array_shift($lastElement);

					// Mengelompokkan dan menghitung jumlah kemunculan masing-masing elemen
					$countedValues = array_count_values($lastElement);
					$groupedData = [
						'id_goal' => $id,
						'jumlah_sample' => array_sum($countedValues),
						'sample_ya'     => $countedValues['ya'] ?? 0,
						'sample_tidak'  => $countedValues['tidak'] ?? 0,
					];
					if (!empty($groupedData)) {
						$cekdata = $this->Mglobal->single_save($groupedData, "tb_atribut_parameter");
					}
					$where = [
						'id_goal' => $id,
						'incr' => $incr
					];

					$data = [
						'file_name' => $nama_filenya
					];
					$cek_aksi = $this->Mglobal->single_update($data, "tb_goal", $where);
					if ($cek_aksi == 'true') {
						$jsonmsg = array(
							"hasil"     => 'true',
							"pesan"     => "suksess",
							"postdata"    => $sheetData,
						);
						echo json_encode($jsonmsg);
					} else {
						$jsonmsg = array(
							"hasil"     => 'false',
							"pesan"     => "nama dokumen gagal di simpan di data goal",
						);
						echo json_encode($jsonmsg);
					}
				}
			} else {
				$jsonmsg = array(
					"hasil"     => 'false',
					"pesan"     => "File Tidak Boleh Kosong",
				);
				echo json_encode($jsonmsg);
			}
		}
	}

	public function simpan_atribute()
	{
		$id = $this->input->post('id');
		$incr = $this->input->post('incr');
		$where = [
			'id_goal' => $id,
			'incr' => $incr
		];
		$cekdata = $this->Mglobal->getWhere("tb_goal", $where)->row();

		if ($cekdata == null) {
			$jsonmsg = array(
				"hasil"     => 'false',
				"pesan"     => "Data File tidak di temukan",
			);
			echo json_encode($jsonmsg);
		} else {
			$nama_filenya = $cekdata->file_name;

			$filePath = './uploads/' . $nama_filenya;
			$spreadsheet = IOFactory::load($filePath);
			// Membaca data dari sheet pertama
			$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			$max_id = $this->Mglobal->get_max_id("id_atribut", 'tb_atribut');

			// Inisialisasi array kosong untuk menyimpan hasil
			$groupedData = [];

			// Iterasi untuk mengelompokkan data
			foreach ($sheetData[1] as $key => $attribute) {

				// Buat array kosong untuk setiap atribut
				$groupedData[$attribute] = [];

				// Iterasi dari data kedua (indeks 2) ke depan untuk mengisi nilai atribut
				for ($i = 2; $i <= count($sheetData); $i++) {
					$groupedData[$attribute][$i] = [
						'id_goal' => $id,
						'id_atribut' => $max_id++,
						'nama_atribut' => strtoupper($sheetData[1][$key]),
						'value_atribut' => strtolower($sheetData[$i][$key]),
						'dtmcreated' => date('Y-m-d H:i:s'),
						'dtmupdated' => date('Y-m-d H:i:s'),
					];
				}
			}

			// Konversi ke array indexed untuk output
			$finalData = array_values($groupedData);
			if (!empty($finalData)) {
				foreach ($finalData as $valuey) {
					$cek = $this->Mglobal->simpan_multi($valuey, 'tb_atribut');
					if ($cek == 'true') {
						$param = 0;
					} else {
						$param = 1;
					}

					$con[] = $param;
				}
				$total = array_sum($con);
				if ($total == 0) {
					$cek_itemnumber = 	$this->Mglobal->get_itemnumber($id);
					foreach ($cek_itemnumber as  $vl) {
						$where_int = [
							'id_atribut' => $vl->id_atribut
						];
						$data_int = [
							'itemnumber' => $vl->int_num,
						];
						$cek_update = 	$this->Mglobal->single_update($data_int, 'tb_atribut', $where_int);
						if ($cek_update == 'true') {
							$param2 = 0;
						} else {
							$param2 = 1;
						}
						$con2[] = $param2;
					}
					$param2 = array_sum($con2);
					if ($param2 == 0) {
						$jsonmsg = array(
							"hasil"     => 'true',
							"pesan"     => "Data Berhasil Di upload ke Database",
						);
						echo json_encode($jsonmsg);
					} else {
						$jsonmsg = array(
							"hasil"     => 'false',
							"pesan"     => "Data gagal Di upload ke Database",
						);
						echo json_encode($jsonmsg);
					}
				} else {
					$jsonmsg = array(
						"hasil"     => 'false',
						"pesan"     => "Data gagal Di upload ke Database",
					);
					echo json_encode($jsonmsg);
				}
			}
		}
	}

	// ==================== 

}
