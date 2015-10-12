<?php
class Md_attandance extends CI_Model{

	function getAttandance(){
		//$data=$this->db->get('attendance');
		date_default_timezone_set('Asia/Jakarta');
        $currendate = date('Y-m-d');
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
								CAST(att_date_current AS DATE) AS tanggal, 
								MIN(CAST(att_date_current AS TIME)) AS clock_in,
								MAX(CAST(att_date_current AS TIME)) AS clock_out
								FROM hris_attendance
								WHERE att_date_current != '0000-00-00 00:00:00' AND att_date_current LIKE'".$currendate."%'
								GROUP BY hris_attendance.`emp_id`,tanggal
								ORDER BY clock_in ASC");
		return $data;
	}

	function getAttandanceCariSemua($name,$tgl_awal,$tgl_akhir){
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
										CAST(att_date_current AS DATE) AS tanggal, 
										MIN(CAST(att_date_current AS TIME)) AS clock_in,
										MAX(CAST(att_date_current AS TIME)) AS clock_out
										FROM hris_attendance
										WHERE hris_attendance.att_name LIKE '%$name%' AND att_date_current BETWEEN '$tgl_awal' AND '$tgl_akhir' AND att_date_current != '0000-00-00 00:00:00'
										GROUP BY hris_attendance.`emp_id`,tanggal
										ORDER BY hris_attendance.`emp_id` ASC");
		return $data;
	}
	function getAttandanceCariNama($name){
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
										CAST(att_date_current AS DATE) AS tanggal, 
										MIN(CAST(att_date_current AS TIME)) AS clock_in,
										MAX(CAST(att_date_current AS TIME)) AS clock_out
										FROM hris_attendance
										WHERE hris_attendance.att_name LIKE '%$name%' AND att_date_current != '0000-00-00 00:00:00'
										GROUP BY hris_attendance.`emp_id`,tanggal
										ORDER BY hris_attendance.`emp_id` ASC");
		return $data;	
	}
	function getAttandanceCariTanggalTo($tgl_awal,$tgl_akhir){
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
										CAST(att_date_current AS DATE) AS tanggal, 
										MIN(CAST(att_date_current AS TIME)) AS clock_in,
										MAX(CAST(att_date_current AS TIME)) AS clock_out
										FROM hris_attendance
										WHERE att_date_current BETWEEN '$tgl_awal' AND '".$tgl_akhir." 23:59:59.999'
										GROUP BY hris_attendance.`emp_id`,tanggal
										ORDER BY hris_attendance.`emp_id` ASC");
		return $data;
	}
	function getAttandanceCariTanggal($tgl_awal){
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
										CAST(att_date_current AS DATE) AS tanggal, 
										MIN(CAST(att_date_current AS TIME)) AS clock_in,
										MAX(CAST(att_date_current AS TIME)) AS clock_out
										FROM hris_attendance
										WHERE att_date_current LIKE '%$tgl_awal%'
										GROUP BY hris_attendance.`emp_id`,tanggal
										ORDER BY hris_attendance.`emp_id` ASC");
		return $data;
	}


	function getDetailAttEmploye($emp){
		$data =$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
								CAST(att_date_current AS DATE) AS tanggal, 
								MIN(CAST(att_date_current AS TIME)) AS clock_in,
								MAX(CAST(att_date_current AS TIME)) AS clock_out
								FROM hris_attendance
								WHERE hris_attendance.emp_id ='".$emp."' 
								GROUP BY hris_attendance.`emp_id`,tanggal
								ORDER BY tanggal DESC");
		return $data;
	}
	function getDetailAttEmpSearchTo($tgl_awal,$tgl_akhir,$emp){
		$data=$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
								CAST(att_date_current AS DATE) AS tanggal, 
								MIN(CAST(att_date_current AS TIME)) AS clock_in,
								MAX(CAST(att_date_current AS TIME)) AS clock_out
								FROM hris_attendance
								WHERE att_date_current BETWEEN '".$tgl_awal."' AND '".$tgl_akhir." 23:59:59.999' AND hris_attendance.emp_id ='".$emp."' 
								GROUP BY hris_attendance.`emp_id`,tanggal
								ORDER BY hris_attendance.`emp_id` ASC");
		return $data;
	}
}