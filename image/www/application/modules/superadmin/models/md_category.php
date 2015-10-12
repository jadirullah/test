<?php
class Md_category extends CI_Model{

	function getCategory(){
		
        //$data=$this->db->get("hris_categories");
        $data=$this->db->query("select * from hris_categories where hris_categories.delete=0");
        return $data;

	}

    function getCtgDeleted(){
        $data=$this->db->query("select * from hris_categories where hris_categories.delete=1");
        return $data;
    }

    function getCtgId($ctg){
        $data = $this->db->get_where('hris_categories', array('ctg_id' => $ctg));
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

    function insertCategory($data){
    	$res =$this->db->insert("hris_categories",$data);
    	return $res;
    }


    function edit_ctg($data,$where){
        $res =$this->db->update("hris_categories",$data,$where);
        return $res;
    }
    
    function delete_multiple($data,$ctg_id) {
        $res=$this->db->update('hris_categories',$data,$ctg_id); 
        return $res;
    }

    function aktif($data,$ctg_id){
        $res=$this->db->update('hris_categories',$data,$ctg_id); 
        return $res;
    }
}