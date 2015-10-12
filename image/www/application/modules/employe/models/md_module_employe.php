<?php
class Md_module_employe extends CI_Model{


	function getUsersProfile($email){
        $data=$this->db->query("select * from hris_employe where hris_employe.delete=0 and email='".$email."'");
        return $data;
    }

    function getProfileData($emp_id){
    	$data=$this->db->query("select * from hris_employe where hris_employe.delete=0 and emp_id='".$emp_id."'");
        return $data;
    }

    function edit_profile($data,$where){
    	$res =$this->db->update("hris_employe",$data,$where);
        return $res;
    }

    function getDetailAttEmploye($email){
        $data =$this->db->query("SELECT hris_attendance.att_id,osw_id,ctg_id,hris_attendance.`emp_id`, hris_attendance.`att_name`,hris_attendance.`att_email`,
                                CAST(att_date_current AS DATE) AS tanggal, 
                                MIN(CAST(att_date_current AS TIME)) AS clock_in,
                                MAX(CAST(att_date_current AS TIME)) AS clock_out
                                FROM hris_attendance
                                WHERE hris_attendance.att_email ='".$email."' 
                                GROUP BY hris_attendance.`emp_id`,tanggal
                                ORDER BY tanggal DESC");
        return $data;
    }
}