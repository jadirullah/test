<?php
class Manage_employed extends CI_Controller{
	public function __construct()
        {
            parent::__construct();
            $this->load->model('md_employe');
  
            
        }#code
    function index(){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_employe"=>$this->md_employe->getEmploye()->result());

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('employe/v_manage_employe',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }
	
	function create(){

		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),
	    		'kode'=>$this->md_employe->getId());
	    	
	    	$this->load->view('v_header',$data);		    		
		    $this->load->view('employe/v_add_new_employe',$data);
		    $this->load->view('v_footer');	
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function act_create(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	$user_id=$this->session->userdata("id_user");
	    	date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d H:i:s');

	    	$data=array(
	    		"emp_id"=>$this->input->post('emp_id'),
	    		"name"=>$this->input->post('name'),
	    		"email"=>$this->input->post('email'),
	    		"password"=>"123456",
	    		"user_id"=>$user_id,
	    		"create_date"=>$date,
	    		"last_update"=>$date
	    	);
	    	$this->form_validation->set_rules('name','Name','required');
	    	$this->form_validation->set_rules('email','Email','required');
	    	if($this->form_validation->run()==FALSE){
	    				$d=array('access'=>'Administrator',
	    			 	'user'=>$this->session->userdata('username'));
	    				$data=array('kode'=>$this->md_employe->getId());
					    $this->load->view('v_header',$d);		    		
					    $this->load->view('employe/v_add_new_employe',$data);
					    $this->load->view('v_footer');
			}else{

			    $res=$this->md_employe->insertEmploye($data);
		    	if ($res){
		    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button>Succes Insert Data.</div><p>");
		    		redirect(base_url().'index.php/superadmin/manage_employed');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_employed');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button> Failed Insert data.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
	function edit($emp_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	$d=array('user'=>$this->session->userdata('username'));

	    	$query=$this->md_employe->getEmpId($emp_id)->result();
	    	$data=array("emp_id"=>$query[0]->emp_id,
	    				"name"=>$query[0]->name,
	    				"email"=>$query[0]->email,
	    				"password"=>$query[0]->password	    				
	    				);	    	
		   $this->load->view('v_header',$d);		    		
		   $this->load->view('employe/v_edit_new_employe',$data);
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
		    		"name"=>$this->input->post('name'),
		    		"email"=>$this->input->post('email'),
		    		"password"=>$this->input->post('password'),
		    		"user_id"=>$this->session->userdata("id_user"),	    		
		    		"last_update"=>$date
		    	);
		    	$where=array("emp_id"=>$this->input->post('emp_id'));

	    	$this->form_validation->set_rules('name','Name','required');
	    	$this->form_validation->set_rules('email','Email','required');
	    	if($this->form_validation->run()==FALSE){
	    		redirect(base_url().'index.php/superadmin/manage_employed');
		    	$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Users.</div></p>");
			}else{
		    	
			    $res=$this->md_employe->edit_employe($data,$where);

		    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Update Users.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_employed');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_employed');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Users.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function delete($emp_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"1");
	    	$emp_id=array('emp_id'=>$emp_id);
		    $res=$this->md_employe->delete_multiple($data,$emp_id);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Delete Users.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_employed');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_employed');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Delete Users.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function dataDeleted(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_employe"=>$this->md_employe->getEmployeDeleted()->result());

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('employe/v_manage_employe_deleted',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function active($emp_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"0");
	    	$emp_id=array('emp_id'=>$emp_id);
		    $res=$this->md_employe->aktif($data,$emp_id);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Aktife Data.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_employed/dataDeleted');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_employed/dataDeleted');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Aktie Data.</div></p>");
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
			                     'field'   => 'emp_id',  /* Nama parameter dari checkbox */
			                     'label'   => 'Cek Box', 
			                     'rules'   => 'required|xss_clean'
			                   )
			                );
			   
			    $this->form_validation->set_message('required2','Cek bok Harus Dipilih');
			    $this->form_validation->set_rules($config);
			    
			    /* Validasi untuk pengecekan jika tidak ada data yand dipilih */
			    
			    if($this->form_validation->run() == FALSE){
			    
			    
			     $this->session->set_flashdata('warning',TRUE);
			     redirect('superadmin/manage_employed/'.$_POST['kode_emp'].''); /*kode nim diambil dari parameter textboxt yang ada pada view */
			     
			    }else{
			      
			      foreach($_POST['emp_id'] as $hapus){
			      	$data=array('delete'=>"1");
			      	$emp_id=array('emp_id'=>$hapus);
			      	$this->md_employe->delete_multiple($data,$emp_id);
			      //$this->db->query("DELETE FROM `supplier` WHERE `id_supp` = '$hapus'"); /*Query untuk menghapus data*/
			      }
			      
			      $this->session->set_flashdata('delete_sukses',TRUE);
			      redirect(base_url().'index.php/superadmin/manage_employed/');
			      
			    }
			}else{
				redirect(base_url().'index.php/main_module/logout');
			}
	}
	function active_multiple(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
		    {
			    $config = array(
			                 
			                 array(
			                     'field'   => 'emp_id',  /* Nama parameter dari checkbox */
			                     'label'   => 'Cek Box', 
			                     'rules'   => 'required|xss_clean'
			                   )
			                );
			   
			    $this->form_validation->set_message('required2','Cek bok Harus Dipilih');
			    $this->form_validation->set_rules($config);
			    
			    /* Validasi untuk pengecekan jika tidak ada data yand dipilih */
			    
			    if($this->form_validation->run() == FALSE){
			    
			    
			     $this->session->set_flashdata('warning',TRUE);
			     redirect('superadmin/manage_employed/'.$_POST['kode_emp'].''); /*kode nim diambil dari parameter textboxt yang ada pada view */
			     
			    }else{
			      
			      foreach($_POST['emp_id'] as $hapus){
			      	$data=array('delete'=>"0");
			      	$emp_id=array('emp_id'=>$hapus);
			      	$this->md_employe->active_multiple($data,$emp_id);
			      //$this->db->query("DELETE FROM `supplier` WHERE `id_supp` = '$hapus'"); /*Query untuk menghapus data*/
			      }
			      
			      $this->session->set_flashdata('delete_sukses',TRUE);
			      redirect(base_url().'index.php/superadmin/manage_employed/dataDeleted');
			      
			    }
			}else{
				redirect(base_url().'index.php/main_module/logout');
			}	
	}

}