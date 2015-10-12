<?php 
class Manage_product extends CI_Controller{

	public function __construct()
        {
            parent::__construct();
            $this->load->model('md_product');
  
            
        }#code

    function kategory(){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$d=array('access'=>'Administrator',
	    			 'user'=>$this->session->userdata('username'));

	    	$data=array("dt_kategory"=>$this->md_product->getKategory()->result());

		    $this->load->view('v_header',$d);		    		
		    $this->load->view('v_product_kategory',$data);
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }

    function create_kategory(){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$d=array('access'=>'Administrator',
	    			 'user'=>$this->session->userdata('username'));

		    $this->load->view('v_header',$d);		    		
		    $this->load->view('v_product_kategori_new');
		    $this->load->view('v_footer');
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }
    function act_create_kategory(){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$data=array(
	    		"nama"=>$this->input->post('nama'),
	    		"keterangan"=>$this->input->post('keterangan')
	    		
	    	);
	    	$this->form_validation->set_rules('nama','nama','required');
	    	
	    	if($this->form_validation->run()==FALSE){
	    				$d=array('access'=>'Administrator',
	    			 	'user'=>$this->session->userdata('username'));
					    $this->load->view('v_header',$d);		    		
					    $this->load->view('v_product_kategori_new',$data);
					    $this->load->view('v_footer');
			}else{

			    $res=$this->md_product->insertKategory($data);
		    	if ($res){
		    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button>Succes Insert kategory.</div><p>");
		    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
		    	}else{
		    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
		    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button> Failed Insert kategory.</div></p>");
		    	}
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }

    function kategory_edit($id){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$d=array('access'=>'Administrator',
	    			 'user'=>$this->session->userdata('username'));

	    	$query=$this->md_product->getKategoryId($id)->result();
	    	$data=array("id_kategori"=>$query[0]->id_kategori,
	    				"nama"=>$query[0]->nama,
	    				"keterangan"=>$query[0]->keterangan);

		   $this->load->view('v_header',$d);		    		
		   $this->load->view('v_product_kategori_edit',$data);
		   $this->load->view('v_footer');

		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }

    function act_edit_kategory(){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	$data=array(
	    		"nama"=>$this->input->post('nama'),
	    		"keterangan"=>$this->input->post('keterangan'));

	    	$where=array("id_kategori"=>$this->input->post('id_kategori'));

		    $res=$this->md_product->kategoryEdit($data,$where);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button> Succes Update kategory.</div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Update kategory.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }

    function kategory_delete($id){
    	if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
	    {
	    	
		    $res=$this->md_product->delete_kategory_multiple($id);

	    	if ($res){
	    		$this->session->set_flashdata("result","<p><div class='alert alert-info'><button type='button' class='close' data-dismiss='alert'>×</button><strong>Succes Delete kategory.</strong></div><p>");
	    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
	    	}else{
	    		redirect(base_url().'index.php/superadmin/manage_product/kategory');
	    		$this->session->set_flashdata("result","<p><div class='alert'><button type='button' class='close' data-dismiss='alert'>×</button>Failed Delete kategory.</div></p>");
	    	}
		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
    }

    function kategory_delete_multiple() {
	  if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'), array('1')))
		    {
			    $config = array(
			                 
			                 array(
			                     'field'   => 'id_kategori',  /* Nama parameter dari checkbox */
			                     'label'   => 'Cek Box', 
			                     'rules'   => 'required|xss_clean'
			                   )
			                );
			   
			    $this->form_validation->set_message('required2','Cek bok Harus Dipilih');
			    $this->form_validation->set_rules($config);
			    
			    /* Validasi untuk pengecekan jika tidak ada data yand dipilih */
			    
			    if($this->form_validation->run() == FALSE){
			    
			    
			     $this->session->set_flashdata('warning',TRUE);
			     redirect('superadmin/manage_product/kategory'.$_POST['id_kategori'].''); /*kode nim diambil dari parameter textboxt yang ada pada view */
			     
			    }else{
			      
			      foreach($_POST['id_kategori'] as $hapus){
			      	$this->md_product->delete_kategory_multiple($hapus);
			      //$this->db->query("DELETE FROM `supplier` WHERE `id_supp` = '$hapus'"); /*Query untuk menghapus data*/
			      }
			      
			      $this->session->set_flashdata('delete_sukses',TRUE);
			      redirect(base_url().'index.php/superadmin/manage_product/kategory');
			      
			    }
			}else{
				redirect(base_url().'index.php/main_module/logout');
			}
 	}
}