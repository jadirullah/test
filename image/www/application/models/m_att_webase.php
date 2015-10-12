<?php
class M_att_webase extends CI_Model{

	public function __construct(){
        parent::__construct();        
    }
    
    function att_ctg()
    {
        
        $query = $this->db->get_where('hris_categories', array('delete' =>0));
        return $query;
    }
}