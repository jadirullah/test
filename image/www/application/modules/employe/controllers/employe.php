<?php
class Employe extends CI_Controller{


	 public function __construct()
        {
            parent::__construct();
           
            $this->load->helper('form');
		    $this->load->helper('url');
		    $this->load->helper('html');		 
           	//$this->load->model('m_att_webase');
            /* $this->load->helper('flexigrid'); */
        }#code

	function index(){
		$title['title']="Akses Attendance";
		$this->load->view('v_header_login',$title);
		$this->load->view('dashboard_login');
		$this->load->view('v_footer_login');
	}
}