<?php
class Manage_profile extends CI_Controller{

	public function __construct(){
            parent::__construct();
            $this->load->model('md_users');

        }
	function index(){
	    if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"profile_user"=>$this->md_users->getUsersProfile($this->session->userdata('username'))->result());

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('user/v_manage_profle',$data);

		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
}