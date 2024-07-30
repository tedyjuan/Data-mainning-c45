<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class C_atribut extends CI_Controller
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

		$cek = $this->Mglobal->get_select();
		if (empty($cek)) {
			$data['list'] = [];
		} else {
			$data['list'] = $cek;
		}
		$this->load->view("f_atribut/v_grid_atribut", $data);
	}
	public function preview_excel()
	{

		$id = $this->input->post('pilih_goal');
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
				$this->Mglobal->single_delete("tb_atribut_parameter", $where);
				$this->Mglobal->single_delete("tb_atribut_mart", $where);
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
		$id = $this->input->post('pilih_goal');
		$where = [
			'id_goal' => $id,
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
						$array_x = $this->show_data_atribut($id);
						if (!empty($array_x)) {
							$pesan = $array_x['data'];
							$hasil = $array_x['hasil'];
							if ($hasil == 'true') {
								$jsonmsg = array(
									"hasil"     => 'true',
									"pesan"     => "Data Berhasil Di upload ke Database",
									"senddata" => $pesan
								);
								echo json_encode($jsonmsg);
							} else {
								$jsonmsg = array(
									"hasil"     => 'false',
									"pesan"     => "Gagal  Di upload ke Database",
									"senddata" => $pesan
								);
								echo json_encode($jsonmsg);
							}
						} else {
							$jsonmsg = array(
								"hasil"     => 'false',
								"pesan"     => "Data gagal Di upload Atribute",
							);
							echo json_encode($jsonmsg);
						}
					} else {
						$jsonmsg = array(
							"hasil"     => 'false',
							"pesan"     => "Data gagal Di upload ke Database",
							"total"     => $total,
						);
						echo json_encode($jsonmsg);
					}
				} else {
					$jsonmsg = array(
						"hasil"     => 'false',
						"pesan"     => "Data gagal Di upload ke Database",
						"total"     => $total,
					);
					echo json_encode($jsonmsg);
				}
			}
		}
	}
	public function  show_data_atribut($id_goal)
	{
		$cekdata = $this->Mglobal->get_value_SI($id_goal);
		if (empty($cekdata)) {
			$jsonmsg = array(
				"hasil"     => 'false',
				"pesan"     => "Data atribut Tidak Di Temukan",
			);
			return $jsonmsg;
		} else {
			foreach ($cekdata as $row) {
				$where = [
					'id_goal' => $id_goal,
					'id_atribut' => $row->id_atribut,
				];
				$data = [
					'value_si' => $row->val_akhir
				];
				$cek_update = 	$this->Mglobal->single_update($data, "tb_atribut", $where);
				if ($cek_update == 'true') {
					$param = 0;
				} else {
					$param = 1;
				}
				$con[] = $param;
			}
			$param = array_sum($con);
			if ($param == 0) {
				$set_datamart = $this->Mglobal->set_datamart_value_SI($id_goal, "ya", "tidak");
				if (empty($set_datamart)) {
					$jsonmsg = array(
						"hasil"     => 'false',
						"pesan"     => "Data gagal Di upload ke Database",
					);
					return $jsonmsg;
				} else {
					$data_mart = [];
					foreach ($set_datamart as $rw) {
						$data_mart[] = [
							'id_goal'              => $rw->id_goal,
							'nama_atribut'         => $rw->nama_atribut,
							'value_atribut'        => $rw->value_atribut,
							'nilai_sample_yes'     => $rw->SI_NILAI_YA,
							'nilai_sample_no'      => $rw->SI_NILAI_TIDAK,
							'total_sample_atribut' => $rw->total_sample_atribut,
						];
					}
					$set_datamart = $this->Mglobal->simpan_multi($data_mart, 'tb_atribut_mart');
					if ($set_datamart == 'true') {
						$jsonmsg = array(
							"hasil"     => 'true',
							"pesan"     => "Data Berhasil Di upload ke Database",
							"data" => $data_mart,
						);
						return $jsonmsg;
					} else {
						$jsonmsg = array(
							"hasil"     => 'false',
							"pesan"     => "Rumus Data Gagal Menghitung, Pastikan Data Sudah Benar",
						);
						return $jsonmsg;
					}
				}
			} else {
				$jsonmsg = array(
					"hasil"     => 'false',
					"pesan"     => "Data gagal Di upload ke Database",
				);
				return $jsonmsg;
			}
		}
	}
}
