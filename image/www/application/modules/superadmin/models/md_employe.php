<?php
class Md_employe extends CI_Model{

	function getEmploye(){
		

        $data=$this->db->query("SELECT hris_employe.* , hris_users.username from hris_employe join hris_users on hris_employe.user_id=hris_users.user_id where hris_employe.delete='0'");
        return $data;

	}

    function getEmployeDeleted(){
        $data=$this->db->query("SELECT hris_employe.* , hris_users.username from hris_employe join hris_users on hris_employe.user_id=hris_users.user_id where hris_employe.delete='1'");
        return $data;
    }

    function getEmpId($emp_id){
        $data = $this->db->get_where('hris_employe', array('emp_id' => $emp_id));
        return $data;
    }


	function getId(){
        $q = $this->db->query("select MAX(RIGHT(emp_id,2)) as code_max from hris_employe");
        $code = "";

        if($q->num_rows() > 0){
            foreach($q->result() as $cd){
                $tmp = ((int)$cd->code_max)+1;
                $code = sprintf("%05s", $tmp);
            }
        }else{
            $code = "01";
        }
        return "KARY-".$code;
    }

    function insertEmploye($data){
    	$res =$this->db->insert("hris_employe",$data);
    	return $res;
    }


    function edit_employe($data,$where){
        $res =$this->db->update("hris_employe",$data,$where);
        return $res;
    }
    
    function delete_multiple($data,$emp_id) {
        $res=$this->db->update('hris_employe',$data,$emp_id); 
        return $res;
    }

    function aktif($data,$emp_id){
        $res=$this->db->update('hris_employe',$data,$emp_id); 
        return $res;
    }
    function active_multiple($data,$emp_id){
        $res=$this->db->update('hris_employe',$data,$emp_id); 
        return $res;
    }
}