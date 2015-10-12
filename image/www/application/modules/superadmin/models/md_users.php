<?php
class Md_users extends CI_Model{

	function getUsers(){
        $data=$this->db->get_where('hris_users', array('delete' =>0));
		return $data;
	}

    function getUsersDeleted(){
        $data=$this->db->get_where('hris_users', array('delete' =>1));
        return $data;
    }

    function getUserId($user_id){
        $data = $this->db->get_where('hris_users', array('user_id' => $user_id));
        return $data;
    }

	function getId(){
        $q = $this->db->query("select MAX(RIGHT(user_id,2)) as code_max from hris_users");
        $code = "";

        if($q->num_rows() > 0){
            foreach($q->result() as $cd){
                $tmp = ((int)$cd->code_max)+1;
                $code = sprintf("%05s", $tmp);
            }
        }else{
            $code = "01";
        }
        return "USER-".$code;
    }

    function insertUser($data){
    	$res =$this->db->insert("hris_users",$data);
    	return $res;
    }


    function edit_user($data,$where){
        $res =$this->db->update("hris_users",$data,$where);
        return $res;
    }

    function delete_multiple($data,$user_id) {
        $res=$this->db->update('hris_users',$data,$user_id); 
        return $res;
    }

    function aktif($data,$user_id){
        $res=$this->db->update('hris_users',$data,$user_id); 
        return $res;
    }

    function getUsersProfile($users_profile){
        $data=$this->db->query("select * from hris_users where hris_users.delete=0 and username='".$users_profile."'");
        return $data;
    }

}