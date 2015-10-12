<?php
class Home extends CI_Controller{

	public function __construct()
        {
            parent::__construct();
            
        }#code
        
	function index(){
	    if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	 $d=array('user'=>$this->session->userdata('email'));

		    $this->load->view('v_header_emp',$d);		    		
		    $this->load->view('v_content_emp');
		    $this->load->view('v_footer_emp');

		}else{
			redirect(base_url().'index.php/main_module/att_logout');
	    }
	}


	function office(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	$d=array('user'=>$this->session->userdata('email'));

		    $this->load->view('v_header_emp',$d);		    		
		    $this->load->view('v_content_emp');
		    $this->load->view('v_footer_emp');
		}else{
			redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function meetting(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	$d=array('user'=>$this->session->userdata('email'));

		    $this->load->view('v_header_emp',$d);		    		
		    $this->load->view('v_content_emp');
		    $this->load->view('v_footer_emp');
		}else{
			redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function onsite(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	$d=array('user'=>$this->session->userdata('email'));

		    $this->load->view('v_header_emp',$d);		    		
		    $this->load->view('v_content_emp');
		    $this->load->view('v_footer_emp');
		}else{
			redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function out(){
		redirect(base_url().'index.php/main_module/att_logout');
	}
}