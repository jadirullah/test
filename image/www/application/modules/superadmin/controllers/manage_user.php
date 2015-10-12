<?php
class Manage_user extends CI_Controller{

	public function __construct()
        {
            parent::__construct();
            $this->load->model('md_users');
        }
	function index(){
	    if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_user"=>$this->md_users->getUsers()->result());

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('user/v_manage_user',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
	function dataDeleted(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_user"=>$this->md_users->getUsersDeleted()->result());

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('user/v_manage_user_deleted',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
	function create(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),
	    		'kode'=>$this->md_users->getId());
	    	
	    	$this->load->view('v_header',$data);		    		
		    $this->load->view('user/v_add_new_user',$data);
		    $this->load->view('v_footer');	
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function act_create(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d H:i:s');

	    	$data=array(
	    		"user_id"=>$this->input->post('user_id'),
	    		"username"=>$this->input->post('username'),
	    		"pass"=>md5($this->input->post('password')),
	    		"level"=>$this->input->post("level"),
	    		"create_date"=>$date,
	    		"last_update"=>$date
	    	);
	    	$this->form_validation->set_rules('username','Username','required');
	    	$this->form_validation->set_rules('password','Password','required');
	    	if($this->form_validation->run()==FALSE){
	    				$d=array('access'=>'Administrator',
	    			 	'user'=>$this->session->userdata('username'));
	    				$data=array('kode'=>$this->md_users->getId());
					    $this->load->view('v_header',$d);		    		
					    $this->load->view('user/v_add_new_user',$data);
					    $this->load->view('v_footer');
			}else{

			    $res=$this->md_users->insertUser($data);
		    	if ($res){
		    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button>Succes Insert Data.</div><p>");
		    		redirect(base_url().'index.php/superadmin/manage_user');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_user');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button> Failed Insert data.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function edit($user_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	$d=array('user'=>$this->session->userdata('username'));

	    	$query=$this->md_users->getUserId($user_id)->result();
	    	$data=array("user_id"=>$query[0]->user_id,
	    				"username"=>$query[0]->username,
	    				"password"=>$query[0]->pass,
	    				"level"=>$query[0]->level
	    				);	    	
		   $this->load->view('v_header',$d);		    		
		   $this->load->view('user/v_edit_new_user',$data);
		   $this->load->view('v_footer');

		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function act_edit(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	date_default_timezone_set('Asia/Jakarta');
	            $date = date('Y-m-d H:i:s');

		    	$data=array(	    		
		    		"username"=>$this->input->post('username'),
		    		"pass"=>md5($this->input->post('password')),
		    		"level"=>$this->input->post("level"),	    		
		    		"last_update"=>$date
		    	);

	    	$this->form_validation->set_rules('username','Username','required');
	    	$this->form_validation->set_rules('password','Password','required');
	    	if($this->form_validation->run()==FALSE){
	    		redirect(base_url().'index.php/superadmin/manage_user');
		    	$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Users.</div></p>");
			}else{
		    	$where=array("user_id"=>$this->input->post('user_id'));
			    $res=$this->md_users->edit_user($data,$where);

		    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Update Users.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_user');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_user');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Users.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function delete($user_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"1");
	    	$id_user=array('user_id'=>$user_id);
		    $res=$this->md_users->delete_multiple($data,$id_user);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Delete Users.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_user');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_user');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Delete Users.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function active($user_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"0");
	    	$id_user=array('user_id'=>$user_id);
		    $res=$this->md_users->aktif($data,$id_user);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Aktife Users.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_user/dataDeleted');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_user/dataDeleted');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Aktie Users.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function delete_multiple(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
		    {
			    $config = array(
			                 
			                 array(
			                     'field'   => 'id_user',  /* Nama parameter dari checkbox */
			                     'label'   => 'Cek Box', 
			                     'rules'   => 'required|xss_clean'
			                   )
			                );
			   
			    $this->form_validation->set_message('required2','Cek bok Harus Dipilih');
			    $this->form_validation->set_rules($config);
			    
			    /* Validasi untuk pengecekan jika tidak ada data yand dipilih */
			    
			    if($this->form_validation->run() == FALSE){
			    
			    
			     $this->session->set_flashdata('warning',TRUE);
			     redirect('superadmin/manage_user/'.$_POST['kode_user'].''); /*kode nim diambil dari parameter textboxt yang ada pada view */
			     
			    }else{
			      
			      foreach($_POST['id_user'] as $hapus){
			      	$data=array('delete'=>"1");
			      	$user_id=array('user_id'=>$hapus);
			      	$this->md_users->delete_multiple($data,$user_id);
			      //$this->db->query("DELETE FROM `supplier` WHERE `id_supp` = '$hapus'"); /*Query untuk menghapus data*/
			      }
			      
			      $this->session->set_flashdata('delete_sukses',TRUE);
			      redirect(base_url().'index.php/superadmin/manage_user/');
			      
			    }
			}else{
				redirect(base_url().'index.php/main_module/logout');
			}
	}
}