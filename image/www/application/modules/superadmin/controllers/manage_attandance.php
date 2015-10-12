<?php 
class Manage_attandance extends CI_Controller{

	public function __construct()
        {
            parent::__construct();
            $this->load->model('md_attandance');
  
            
        }#code

	function index(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {

    	 $name =( empty( $_POST[ 'name' ] ) ) ? '' : $_POST[ 'name' ];
	     $tgl_awal =( empty( $_POST[ 'tanggal_awal' ] ) ) ? '' : $_POST[ 'tanggal_awal' ];
	     $tgl_akhir =( empty( $_POST[ 'tanggal_akhir' ] ) ) ? '' : $_POST[ 'tanggal_akhir' ];

	     	//searching
		     if(empty($name) && empty($tgl_awal) && empty($tgl_akhir)){
		     	$data=array(
		     		"user"=>$this->session->userdata('username'),
		     		"dt_list_attendance"=>$this->md_attandance->getAttandance()->result()
		     		);
		     }elseif(!empty($name) && !empty($tgl_awal) && !empty($tgl_akhir)){
				$data=array("user"=>$this->session->userdata('username'),
					"dt_list_attendance"=>$this->md_attandance->getAttandanceCariSemua($_POST['name'],$_POST['tanggal_awal'],$_POST['tanggal_akhir'])->result()
					);
		     }elseif(!empty($name) && empty($tgl_awal) && empty($tgl_akhir)){
				$data=array("user"=>$this->session->userdata('username'),
					"dt_list_attendance"=>$this->md_attandance->getAttandanceCariNama($_POST['name'])->result()
					);		     	
		     }elseif(empty($name) && !empty($tgl_awal) && !empty($tgl_akhir)){
		     	$data=array("user"=>$this->session->userdata('username'),
		     		"dt_list_attendance"=>$this->md_attandance->getAttandanceCariTanggalTo($_POST['tanggal_awal'],$_POST['tanggal_akhir'])->result()
		     		);
		     }elseif(empty($name) && !empty($tgl_awal) && empty($tgl_akhir)){
		     	$data=array("user"=>$this->session->userdata('username'),
		     		"dt_list_attendance"=>$this->md_attandance->getAttandanceCariTanggal($_POST['tanggal_awal'])->result()
		     		);
		     }elseif(empty($name) && empty($tgl_awal) && !empty($tgl_akhir)){
		     	$data=array("user"=>$this->session->userdata('username'),
		     		"dt_list_attendance"=>$this->md_attandance->getAttandanceCariTanggal($_POST['tanggal_akhir'])->result()
		     		);
		     }else{
		     	$data=array("user"=>$this->session->userdata('username'),
		     		"dt_list_attendance"=>$this->md_attandance->getAttandance()->result()
		     		);
		     }

		    $this->load->view('v_header',$data);		    		
		    $this->load->view('attendance/v_list_attendance',$data);
		    $this->load->view('v_footer');

		}else{
		redirect(base_url().'index.php/main_module/logout');
	    }
	}
	function detailEmp($employe){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('userlevel'),array('1')) && in_array($this->session->userdata('userDelete'),array('0')))
	    {	
	    	$tgl_awal =( empty( $_POST[ 'tanggal_awal' ] ) ) ? '' : $_POST[ 'tanggal_awal'];
	     	$tgl_akhir =( empty( $_POST[ 'tanggal_akhir' ] ) ) ? '' : $_POST[ 'tanggal_akhir'];

			if(empty($tgl_awal) && empty($tgl_akhir)){
		     	$data=array("user"=>$this->session->userdata('username'),
	    				"emp"=>$employe,
	    				"dt_att_emp"=>$this->md_attandance->getDetailAttEmploye($employe)
	    		);
		     }elseif(!empty($tgl_awal) && !empty($tgl_akhir)){
		     	$data=array("user"=>$this->session->userdata('username'),
		     		"emp"=>$employe,
		     		"dt_att_emp"=>$this->md_attandance->getDetailAttEmpSearchTo($_POST['tanggal_awal'],$_POST['tanggal_akhir'],$employe)
		     		);

		     	//print_r($this->md_attandance->getDetailAttEmpSearchTo($_POST['tanggal_awal'],$_POST['tanggal_akhir'],$employe));
		     }	     	

	    	
			$this->load->view('v_header',$data);		    		
			$this->load->view('attendance/v_list_detail_att_empl',$data);
			$this->load->view('v_footer');
		}else{
			redirect(base_url().'index.php/main_module/logout');
		}
	}
}
?>