<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
        {
            parent::__construct();
            //$this->load->model("Users_Model");
            
        }

	function index(){

	    $this->load->view('v_header');		    		
	    $this->load->view('v_content');
	    $this->load->view('v_footer');
	}

	function attandance(){
		$karyawan= $this->db->get_where('attendance', array('status' => 'Clock in'));

		
		$data=array("data_attandance"=>$karyawan->result());
		$this->load->view('v_header');		    		
	 	$this->load->view('attandance/v_data',$data);
	 	$this->load->view('v_footer');

	}

	function DetailAttandance(){
		echo "Detail Masuk";
	}
}
