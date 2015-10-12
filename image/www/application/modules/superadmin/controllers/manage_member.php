<?php
class Manage_member extends CI_Controller{

	function index(){
	    if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$d=array('access'=>'Administrator',
	    			 'user'=>$this->session->userdata('username'));


		    $this->load->view('v_header',$d);		    		
		    $this->load->view('v_manage_member');
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
}