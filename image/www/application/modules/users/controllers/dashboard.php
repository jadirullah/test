<?php
class dashboard extends CI_Controller{

public function __construct()
        {
            parent::__construct();
            
        }#code
        
	function index(){
	    if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('2')))
	    {
	    	$d=array('access'=>'Users',
	    			 'user'=>$this->session->userdata('username'));

		    $this->load->view('v_header',$d);		    		
		    $this->load->view('v_content');
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
}