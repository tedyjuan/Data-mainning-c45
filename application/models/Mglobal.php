<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mglobal extends CI_Model
{

	function single_save($data, $tabel)
	{
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		$this->db->insert($tabel, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function simpan_multi($data, $tabel)
	{
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		$this->db->insert_batch($tabel, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}


	public function getWhere($table, $param)
	{
		$this->db->where($param);
		return $this->db->get($table);
	}

	public function single_update($data, $tabel, $where)
	{
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		$this->db->where($where);
		$this->db->update($tabel, $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function single_delete($tabel, $where)
	{
		$this->db->trans_start();
		$this->db->trans_strict(FALSE);
		$this->db->where($where);
		$this->db->delete($tabel);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	function get_max_id($field, $table)
	{
		$query = $this->db->query("SELECT 
							IFNULL(MAX(a.`$field`), 0) + 1 AS `max`
							FROM `$table` a")->row();
		return $query->max;
	}
	public function get_data($table)
	{
		return $this->db->get($table)->result();
	}

	function get_select()
	{
		$query = $this->db->query("SELECT * FROM `tb_goal` a
						WHERE a.`file_name` IS NULL
						")->result();
		return $query;
	}
	function get_main()
	{
		$query = $this->db->query("SELECT 
									nama_atribut, 
									value_atribut, 
									COUNT(*) AS jumlah 
								FROM  tb_atribut 
								WHERE id_goal = '1'
								GROUP BY 
									nama_atribut, 
									value_atribut
								ORDER BY 
									nama_atribut, 
									value_atribut;

						")->result();
		return $query;
	}
	function get_itemnumber($id)
	{
		$query = $this->db->query("SELECT 
									ROW_NUMBER() OVER (PARTITION BY a.nama_atribut ORDER BY a.id_atribut) AS int_num,
									a.id_atribut,
									a.nama_atribut,
									a.value_atribut
								FROM 
									datamaining.tb_atribut a
								WHERE 
									a.id_goal = '$id'
								ORDER BY 
									a.nama_atribut, 
									a.id_atribut;
						")->result();
		return $query;
	}
	function get_atribut($id)
	{
		$query = $this->db->query("SELECT 
									a.nama_atribut, 
									a.value_atribut, 
									COUNT(*) AS jumlah,
									(
										SELECT COUNT(*)
										FROM tb_atribut b
										WHERE b.id_goal = '1' AND b.nama_atribut = a.nama_atribut
										GROUP BY b.nama_atribut
									) AS total_data_per_atribut
								FROM 
									tb_atribut a
								WHERE a.id_goal = '1'
								AND a.`nama_atribut` <> (
										SELECT b.`nama_atribut` FROM `datamaining`.`tb_atribut` b
										WHERE b.`id_goal` = '$id'
										ORDER BY b.`incr` DESC 
										LIMIT 1
										)
										GROUP BY 
									a.nama_atribut, 
									a.value_atribut
								ORDER BY 
									a.nama_atribut, 
									a.value_atribut;
						")->result();
		return $query;
	}
	function get_param_atribut($id)
	{
		$query = $this->db->query("SELECT 
							a.`itemnumber`,
							a.id_atribut,
							a.nama_atribut,
							a.value_atribut
						FROM 
							datamaining.tb_atribut a
						WHERE  a.id_goal = '1'
						AND a.`nama_atribut` = (
									SELECT b.`nama_atribut` 
									FROM `datamaining`.`tb_atribut` b
									WHERE b.`id_goal` = '$id'
									ORDER BY b.`incr` DESC 
									LIMIT 1
									)
						")->result();
		return $query;
	}
	function get_value_SI($id)
	{
		$query = $this->db->query("SELECT 
									a.`id_atribut`,
									bb.`value_atribut` AS 'val_akhir'
									FROM `tb_atribut` a
									LEFT JOIN (
											SELECT 
											j.`value_atribut`,
											j.`itemnumber`
											FROM `tb_atribut` j
											WHERE j.`id_goal` = '$id'
											AND j.`nama_atribut` = (
														SELECT 
														zz.`nama_atribut`
														FROM `tb_atribut` zz
														WHERE zz.`id_goal` = '$id' 
														ORDER BY zz.`incr` DESC
														LIMIT 1
											)
									) bb ON bb.itemnumber = a.`itemnumber`
									WHERE a.`id_goal` = '$id'
									AND a.`nama_atribut` <> (
												SELECT 
												z.`nama_atribut`
												FROM `tb_atribut` z
												WHERE z.`id_goal` = '$id' 
												ORDER BY z.`incr` DESC
												LIMIT 1
												)
						")->result();
		return $query;
	}
	function set_datamart_value_SI($id, $param_yes, $param_no)
	{
		$query = $this->db->query("SELECT 
									a.`id_goal`,
									a.`nama_atribut`,
									a.`value_atribut`,
									(
										SELECT MAX(b.`itemnumber`)
										FROM tb_atribut b
										WHERE b.id_goal = '$id'
										) AS 'total_atribut',
									COUNT(*) AS 'total_sample_atribut',
									SUM(CASE WHEN a.`value_si` = '$param_yes' THEN 1 ELSE 0 END) AS SI_NILAI_YA,
									SUM(CASE WHEN a.`value_si` = '$param_no' THEN 1 ELSE 0 END) AS SI_NILAI_TIDAK
								FROM 
									tb_atribut a
								WHERE 
								a.`id_goal` = '$id' 
									AND a.`nama_atribut` <> (SELECT 
												z.`nama_atribut`
												FROM `tb_atribut` z
												WHERE z.`id_goal` = '$id' 
												ORDER BY z.`incr` DESC
												LIMIT 1    
									)
								GROUP BY 
									a.`nama_atribut`, 
									a.`value_atribut`;
								")->result();
		return $query;
	}
	function parameter_set_atribute($id_goal)
	{
		$query = $this->db->query("SELECT 
									a.`value_atribut`
									FROM `tb_atribut` a
									WHERE a.`id_goal` = '$id_goal' 
									AND a.`nama_atribut` = (
												SELECT 
												z.`nama_atribut` AS 'nm'
												FROM `tb_atribut` z
												WHERE z.`id_goal` = '$id_goal' 
												ORDER BY z.`incr` DESC
												LIMIT 1)
									GROUP BY a.`nama_atribut`, a.`value_atribut`;
								")->result();
		return $query;
	}
}
