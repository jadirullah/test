<?php
class md_login extends CI_Model
{
    public function __construct(){
        parent::__construct();        
    }
    
    function cek_login($username, $password)
    {
        $this->db->select('*');
        $this->db->where('username',$username); 
        $this->db->where('pass',$password);
        $this->db->where('delete',0);
        $query=$this->db->get('hris_users');
        if ($query->num_rows() == 1)
        {
            return $query->row_array();
        }
    }

    function cek_email($email,$password){
        $this->db->select('email,password,delete');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $this->db->where('delete',0);
        $query=$this->db->get('hris_employe');
        if ($query->num_rows() ==1){
            return $query->row_array();
        }
    }
}
    

?>