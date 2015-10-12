<?php
class Onsite extends CI_Controller{
	 public function __construct()
        {
            parent::__construct();
           
      	 
           	$this->load->model('m_att_webase');
            /* $this->load->helper('flexigrid'); */
        }#code

	function index(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" ){

	    	$d=array('user'=>$this->session->userdata('email'));
	    	date_default_timezone_set('Asia/Jakarta');
        	$date=date('Y-m-d');
	    	$att=$this->db->query("SELECT emp_id,att_name,att_email,att_date,att_status FROM hris_attendance WHERE att_email='".$this->session->userdata('email')."' AND att_date='".$date."' AND att_status='Clock in' AND osw_id=2");
	    	$row = $att->row();
	    	if ($row != null){
	    			$att_out=$this->db->query("SELECT emp_id,att_name,att_email,att_date,att_status FROM hris_attendance WHERE att_email='".$this->session->userdata('email')."' AND att_date='".$date."' AND att_status='Clock out'");

	    			$row_out=$att_out->row();

	    			if($row_out != null){
	    					echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Thanks ! Your Succesfully Attendance today !!!')
					        window.location.href='".base_url()."index.php/employe/home/'
					        </SCRIPT>");
	    			}else{
			    		$data=array('email'=>$this->session->userdata('email'),
			    				'att_ctg'=>$this->m_att_webase->att_ctg());
						$this->load->view('v_header_emp',$d);		    		
					    $this->load->view('onsite/form_att_onsite_out',$data);
					    $this->load->view('v_footer_emp');
					}
	    	}else{
	    		$data=array('email'=>$this->session->userdata('email'),
	    				'att_ctg'=>$this->m_att_webase->att_ctg());
				$this->load->view('v_header_emp',$d);
			    $this->load->view('onsite/form_att_onsite_in',$data);
			    $this->load->view('v_footer_emp');
			}
	    }else {
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function act_clockin(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	date_default_timezone_set('Asia/Jakarta');
        	$currentdate = date('Y-m-d H:i:s');
        	$time=date('H:i:s');
        	$date=date('Y-m-d');
			$email=$this->input->post('email');
			$reason_onsite=$this->input->post('reason_onsite');
	    	$latitude=$this->input->post('lat');
	    	$longitude=$this->input->post('long');
	    	$emp = $this->db->query("select emp_id,name from hris_employe where email='" .$email. "'");
	        $row = $emp->row();

	        if (empty($email)){
		            $notice ="Access Not Found !!!";
		            echo json_encode($notice);
	        }else{
	            $data = array(
	                'emp_id' => $row->emp_id,
	                'osw_id' =>2,
	                'att_name' =>$row->name,
	                'att_email' => $email,
	                'att_time' =>$time,
	                'att_date' =>$date,
	                'att_date_server' => $currentdate,
	                'att_date_current' => $currentdate,
	                'att_status' => "Clock in",
	                'att_latitude' => $latitude,
	                'att_longtitude' => $longitude,
	                'att_image' =>"|",
	                'reason_onsite'=>$reason_onsite
	            );

	            $query = $this->db->insert('hris_attendance', $data);

	            if ($query) {
	            	echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Succesfully Clock In')
					        window.location.href='".base_url()."index.php/employe/home/'
					        </SCRIPT>");
	                 
	            } else {
	               	echo "<script>alert('Failed To Clock In')</script>";
	               	redirect(base_url().'index.php/employe/home/');
	            }
	        }
	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function act_clockout(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" )
	    {
	    	date_default_timezone_set('Asia/Jakarta');
        	$currentdate = date('Y-m-d H:i:s');
        	$time=date('H:i:s');
        	$date=date('Y-m-d');
			$email=$this->input->post('email');
			$reason_onsite=$this->input->post('reason_onsite');
	    	$latitude=$this->input->post('lat');
	    	$longitude=$this->input->post('long');
	    	$emp = $this->db->query("select emp_id,name from hris_employe where email='" .$email. "'");
	        $row = $emp->row();

	        if (empty($email)){
		            $notice ="Access Not Found !!!";
		            echo json_encode($notice);
	        }else{
	            $data = array(
	                'emp_id' => $row->emp_id,
	                'osw_id' =>2,
	                'att_name' =>$row->name,
	                'att_email' => $email,
	                'att_time' =>$time,
	                'att_date' =>$date,
	                'att_date_server' => $currentdate,
	                'att_date_current' => $currentdate,
	                'att_status' => "Clock out",
	                'att_latitude' => $latitude,
	                'att_longtitude' => $longitude,
	                'att_image' =>"|",
	                'reason_onsite'=>$reason_onsite
	            );

	            $query = $this->db->insert('hris_attendance', $data);

	            if ($query) {
	            	echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Succesfully Clock Out')
					        window.location.href='".base_url()."index.php/employe/home/'
					        </SCRIPT>");
	                 
	            } else {
	               	echo "<script>alert('Failed To Clock Out')</script>";
	               	redirect(base_url().'index.php/employe/home/');
	            }
	        }
	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}
}