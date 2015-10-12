<?php
class My_profile extends CI_Controller{

	public function __construct()
        {
            parent::__construct();
           	 
           	$this->load->model('md_module_employe');
            /* $this->load->helper('flexigrid'); */
        }#code

	function index(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	$data=array("user"=>$this->session->userdata('email'),"profile_user"=>$this->md_module_employe->getUsersProfile($this->session->userdata('email'))->result());

		   	$this->load->view('v_header_emp',$data);		    		
			$this->load->view('profile/profile_data',$data);
			$this->load->view('v_footer_emp');

	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function update(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	
	    		 $d=array('user'=>$this->session->userdata('email'));

		    	 $query=$this->md_module_employe->getUsersProfile($this->session->userdata('email'))->result();

		    	 $data=array("emp_id"=>$query[0]->emp_id,
		    	 			"name"=>$query[0]->name,
		    				"email"=>$query[0]->email,
		    				"password"=>$query[0]->password
		    				);	    	
			   	$this->load->view('v_header_emp',$d);		    		
				$this->load->view('profile/profile_form_update',$data);
				$this->load->view('v_footer_emp');

	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function act_edit(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	            $date = date('Y-m-d H:i:s');

		    	$data=array(
		    		"password"=>$this->input->post('password'),	    		
		    		"last_update"=>$date
		    	);
		    	//print_r($data);
	    	$this->form_validation->set_rules('password','Password','required');
	    	if($this->form_validation->run()==FALSE){
	    		redirect(base_url().'index.php/employe/my_profile');
		    	$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Data.</div></p>");
			}else{
		    	$where=array("emp_id"=>$this->input->post('emp_id'));
			    $res=$this->md_module_employe->edit_profile($data,$where);

		    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Update Data.</strong></div><p>");
	    		redirect(base_url().'index.php/employe/my_profile');
		    	}else{
		    		redirect(base_url().'index.php/employe/my_profile');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Data.</div></p>");
		    	}
	    	}

	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}
}