<?php
class Manage_category extends CI_Controller{
	public function __construct()
        {
            parent::__construct();
            $this->load->model('md_category');
        }#code

	function index(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_category"=>$this->md_category->getCategory()->result());

		    $this->load->view('v_setting',$data);		    		
		    $this->load->view('category/v_manage_category',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}


	function create(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'));
	    	
	    	$this->load->view('v_setting',$data);		    		
		    $this->load->view('category/v_add_new_category');
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
	    		"ctg_code"=>$this->input->post('code'),
	    		"ctg_name"=>$this->input->post('name'),
	    		"last_update"=>$date
	    	);
	    	$this->form_validation->set_rules('code','Code','required');
	    	$this->form_validation->set_rules('name','Name','required');
	    	if($this->form_validation->run()==FALSE){
	    				$d=array('access'=>'Administrator',
	    			 	'user'=>$this->session->userdata('username'));
	    				
					    $this->load->view('v_setting',$d);		    		
					    $this->load->view('category/v_add_new_category');
					    $this->load->view('v_footer');
			}else{

			    $res=$this->md_category->insertCategory($data);
		    	if ($res){
		    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button>Succes Insert Data.</div><p>");
		    		redirect(base_url().'index.php/superadmin/manage_category');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_category');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button> Failed Insert data.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function edit($ctg){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	$d=array('user'=>$this->session->userdata('username'));

	    	$query=$this->md_category->getCtgId($ctg)->result();
	    	$data=array("ctg_id"=>$query[0]->ctg_id,
	    				"ctg_code"=>$query[0]->ctg_code,
	    				"ctg_name"=>$query[0]->ctg_name
	    				);	    	
		   $this->load->view('v_setting',$d);		    		
		   $this->load->view('category/v_edit_category',$data);
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
		    		"ctg_code"=>$this->input->post('ctg_code'),
		    		"ctg_name"=>$this->input->post("ctg_name"),
		    		"last_update"=>$date
		    	);

	    	$this->form_validation->set_rules('ctg_code','Ctg_code','required');
	    	$this->form_validation->set_rules('ctg_name','Ctg_name','required');
	    	if($this->form_validation->run()==FALSE){
	    		redirect(base_url().'index.php/superadmin/manage_category');
		    	$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Category.</div></p>");
			}else{
		    	$where=array("ctg_id"=>$this->input->post('ctg_id'));
			    $res=$this->md_category->edit_ctg($data,$where);

		    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Update Category.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_category');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_category');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update Category.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}


	function delete($ctg_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"1");
	    	$ctg_id=array('ctg_id'=>$ctg_id);
		    $res=$this->md_category->delete_multiple($data,$ctg_id);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Delete Data.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_category');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_category');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Delete Data.</div></p>");
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
			                     'field'   => 'ctg_id',  /* Nama parameter dari checkbox */
			                     'label'   => 'Cek Box', 
			                     'rules'   => 'required|xss_clean'
			                   )
			                );
			   
			    $this->form_validation->set_message('required2','Cek bok Harus Dipilih');
			    $this->form_validation->set_rules($config);
			    
			    /* Validasi untuk pengecekan jika tidak ada data yand dipilih */
			    
			    if($this->form_validation->run() == FALSE){
			    
			    
			     $this->session->set_flashdata('warning',TRUE);
			     redirect('superadmin/manage_category/'.$_POST['kode_ctg'].''); /*kode nim diambil dari parameter textboxt yang ada pada view */
			     
			    }else{
			      
			      foreach($_POST['ctg_id'] as $hapus){
			      	$data=array('delete'=>"1");
			      	$ctg_id=array('ctg_id'=>$hapus);
			      	$this->md_category->delete_multiple($data,$ctg_id);
			      //$this->db->query("DELETE FROM `supplier` WHERE `id_supp` = '$hapus'"); /*Query untuk menghapus data*/
			      }
			      
			      $this->session->set_flashdata('delete_sukses',TRUE);
			      redirect(base_url().'index.php/superadmin/manage_category/');
			      
			    }
			}else{
				redirect(base_url().'index.php/main_module/logout');
			}
	}

	function dataDeleted(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

	    	$data=array("user"=>$this->session->userdata('username'),"dt_ctg"=>$this->md_category->getCtgDeleted()->result());

		    $this->load->view('v_setting',$data);		    		
		    $this->load->view('category/v_manage_category_deleted',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}

	function active($ctg_id){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {
	    	
	    	$data=array('delete'=>"0");
	    	$ctg_id=array('ctg_id'=>$ctg_id);
		    $res=$this->md_category->aktif($data,$ctg_id);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Aktif.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_category/dataDeleted');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_category/dataDeleted');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Aktif.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
}