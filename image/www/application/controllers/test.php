<?php
class Test extends CI_Controller{
	 public function __construct()
        {
            parent::__construct();
           
            $this->load->helper('form');
		    $this->load->helper('url');
		    $this->load->helper('html');		 
           	$this->load->model('m_att_webase');
            /* $this->load->helper('flexigrid'); */
        }#code

	function index(){
		$title['title']="Akses Attendance";
		$this->load->view('v_header',$title);
		$this->load->view('form_email');
		$this->load->view('v_footer');
	}

	function clockin(){
		if($this->session->userdata('email') !=null && $this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('delete'), array('0')))
	    {	

            date_default_timezone_set('Asia/Jakarta');
        	$date=date('Y-m-d');
	    	$att=$this->db->query("SELECT emp_id,att_name,att_email,att_date,att_status FROM hris_attendance WHERE att_email='".$this->session->userdata('email')."' AND att_date='".$date."' AND att_status='Clock in'");
	    	$row = $att->row();
	    	if ($row != null){
	    			$att_out=$this->db->query("SELECT emp_id,att_name,att_email,att_date,att_status FROM hris_attendance WHERE att_email='".$this->session->userdata('email')."' AND att_date='".$date."' AND att_status='Clock out'");

	    			$row_out=$att_out->row();

	    			if($row_out != null){
	    					echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Thanks ! Your Succesfully Attendance today !!!')
					        window.location.href='".base_url()."index.php/test/out/'
					        </SCRIPT>");
	    			}else{
			    		$data=array('email'=>$this->session->userdata('email'),
			    				'att_ctg'=>$this->m_att_webase->att_ctg());
						$this->load->view('clockout_attendance',$data);
					}
	    	}else{

	    		$data=array('email'=>$this->session->userdata('email'),
	    				'att_ctg'=>$this->m_att_webase->att_ctg());
				$this->load->view('clockin_attendance',$data);
	    	}
		}else{
			redirect(base_url().'index.php/main_module/att_logout');
		}
	}

	function act_clockin(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('delete'), array('0')))
	    {
	    	date_default_timezone_set('Asia/Jakarta');
        	$currentdate = date('Y-m-d H:i:s');
        	$time=date('H:i:s');
        	$date=date('Y-m-d');
			$email=$this->input->post('email');
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
	                'ctg_id' =>0,
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
	                'reason_late'=>0
	            );

	            $query = $this->db->insert('hris_attendance', $data);

	            if ($query) {
	            	echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Succesfully Clock Out')
					        window.location.href='".base_url()."index.php/test/out/'
					        </SCRIPT>");
	                 
	            } else {
	               	echo "<script>alert('Failed To Clock In')</script>";
	               	redirect(base_url().'index.php/test/clockin/');
	            }
	        }
	    	
		}else{
			redirect(base_url().'index.php/main_module/att_logout');
		}
	}

	function act_clockin_late(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('delete'), array('0')))
	    {
	    	
	    	$config['upload_path'] = './media/';
			$config['allowed_types'] = 'gif|jpg|png';
			$this->load->library('upload', $config);
            $result_array = array();

			for ($i = 1; $i <=3; $i++){
               if (!empty($_FILES['userfile'.$i]['name'])) {
                    if (!$this->upload->do_upload('userfile'.$i))
                        $sub_data['error'] = $this->upload->display_errors();
                    else
                        $hasil=array_push($result_array,$this->upload->data());
                }
            }

            date_default_timezone_set('Asia/Jakarta');
        	$currentdate = date('Y-m-d H:i:s');
        	$time=date('H:i:s');
        	$date=date('Y-m-d');
			$email=$this->input->post('email');
			$ctg_id=$this->input->post('ctg_id');
	    	$reason_late=$this->input->post('reason_late');
	    	$latitude=$this->input->post('lat');
	    	$longitude=$this->input->post('long');
		    $att_image1= $result_array[0]['file_name'];
		    $att_image2= $result_array[1]['file_name'];
			
		    $emp = $this->db->query("select emp_id,name from hris_employe where email='" .$email. "'");
        	$row = $emp->row();

        	if (empty($email)){
	            $notice ="Access Not Found !!!";
	            echo json_encode($notice);
	        }else{
	            $data = array(
	                'emp_id' => $row->emp_id,
	                'ctg_id' => $ctg_id,
	                'att_name' =>$row->name,
	                'att_email' => $email,
	                'att_time' =>$time,
	                'att_date' =>$date,
	                'att_date_server' => $currentdate,
	                'att_date_current' => $currentdate,
	                'att_status' => "Clock in",
	                'att_latitude' => $latitude,
	                'att_longtitude' => $longitude,
	                'att_image' => $att_image1 . "|" . $att_image2,
	                'reason_late'=>$reason_late
	            );

	            $query = $this->db->insert('hris_attendance', $data);

	            if ($query) {
	            	echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Succesfully Clockin')
					        window.location.href='".base_url()."index.php/test/out/'
					        </SCRIPT>");
	                 
	            } else {
	               	echo "<script>alert('Failed To Clock In')</script>";
	               	redirect(base_url().'index.php/test/clockin/');
	            }
	        }

		}else{
			redirect(base_url().'index.php/main_module/att_logout');
		}	
	}

	function act_clockout(){
		if($this->session->userdata("logged_in") == "Assalamualaikum" && in_array($this->session->userdata('delete'), array('0')))
	    {
	    	date_default_timezone_set('Asia/Jakarta');
        	$currentdate = date('Y-m-d H:i:s');
        	$time=date('H:i:s');
        	$date=date('Y-m-d');
			$email=$this->input->post('email');
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
	                'ctg_id' =>0,
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
	                'reason_late'=>0
	            );

	            $query = $this->db->insert('hris_attendance', $data);

	            if ($query) {
	            	echo ("<SCRIPT LANGUAGE='JavaScript'>
					        window.alert('Succesfully Clock Out')
					        window.location.href='".base_url()."index.php/test/out/'
					        </SCRIPT>");
	                 
	            } else {
	               	echo "<script>alert('Failed To Clock In')</script>";
	               	redirect(base_url().'index.php/test/clockin/');
	            }
	        }
	    }else{
	    	redirect(base_url().'index.php/main_module/att_logout');
	    }
	}

	function out(){
		redirect(base_url().'index.php/main_module/att_logout');
	}
}