<?php
class Report extends CI_Controller{


	 public function __construct()
        {
            parent::__construct();
           	 
           	$this->load->model('md_module_employe');
        }

	function index(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	$data=array('user'=>$this->session->userdata('email'),
	    				'attendance_detil'=>$this->md_module_employe->getDetailAttEmploye($this->session->userdata('email')));
    		

		   	$this->load->view('v_header_emp',$data);		    		
		    $this->load->view('report/report_data',$data);
		    $this->load->view('v_footer_emp');

		}else{
			redirect(base_url().'index.php/main_module/att_logout');
	    }
	}
}