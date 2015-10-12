<?php
    
    class main_module extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            $this->load->model('md_login');
            $this->load->helper('form');
		    $this->load->helper('url');
		    $this->load->helper('html');		 
            $this->load->library('session');
            /* $this->load->helper('flexigrid'); */
        }#code
        
        function index()
        {
            $this->load->view('v_header');
	    	$this->load->view('v_body_login');
	    	$this->load->view('v_footer');
        }
        
        function in()
        {
            $username = $this->input->post('username');
	    	$password = $this->input->post('password');
		    if($username != null && $password !=null)
		    {
				$passencrypt = md5($this->config->item("key_login").$password);            
				$login_data = $this->md_login->cek_login($username, $passencrypt);
				if($login_data)
				{
				    $session_data = array(
					'logged_in' => 'Assalamualaikum',
					'id_user' => $login_data['user_id'],
					'username' => $login_data['username'],
					'userlevel' => $login_data['level'],
					'userDelete' => $login_data['delete'],
					'is_login' => true
				    );
				    $this->session->set_userdata($session_data);	
				    if($login_data['level'] == 1)
				    {
				    	$this->session->set_userdata($session_data);
						redirect(base_url().'index.php/superadmin/dashboard');
				    }

				    elseif($login_data['level'] == 2)
				    {
						redirect(base_url().'index.php/users/dashboard');
				    }

				    elseif($login_data['level'] == 3)
				    {
				    	redirect(base_url().'index.php/supervisor/dashboard');
				    }
				    elseif($login_data['level'] == 4)
				    {
					// redirect(base_url().'index.php/projectmanager/dashboard');
				    	redirect(base_url().'index.php/supervisor/dashboard');
				    }
				    elseif ($login_data['level']==5) { // admin marketing
				    	redirect(site_url().'/supervisor/dashboard');
				    }
				    //echo $login_data['level'];
				}else
				{
				    $this->session->set_flashdata("msg","Incorrect Username and Password");
				    redirect(base_url().'index.php/private/auth_login/masuk');
				}
		    }else
		    {
				$this->session->set_flashdata("msg","Username and Password can't be empty");
				redirect(base_url().'index.php/private/auth_login/masuk');
		    }
    }

    function attendance(){
    	$email = $this->input->post('email');
    	$password=$this->input->post('password');

    	if($email != null && $password !=null){
    		$login_data = $this->md_login->cek_email($email,$password);
    		if ($login_data){
    			$session_data =array(
    				'logged_in' => 'Assalamualaikum',
					'userDelete' => $login_data['delete'],
					'is_login' => true,
    				'email' => $login_data['email'],
    				'password'=>$login_data['password']
    			);
				// echo $session;
					if(($login_data['delete'] == 0)){
						$session=$this->session->set_userdata($session_data);
						redirect(base_url().'index.php/employe/home');
					}else{
						$this->session->set_flashdata("msg","Wrong Session");
						redirect(base_url().'index.php/employe');
					}
    		}else{
    			$this->session->set_flashdata("msg","Email Or Password Not Valid");
				redirect(base_url().'index.php/employe');
    		}

    	}else{
    		$this->session->set_flashdata("msg","Email can't be empty");
			redirect(base_url().'index.php/employe');
    	}

    }

	function logout()
	{
	    $this->session->sess_destroy();
	    redirect(base_url());
	}

	function att_logout(){
		$this->session->sess_destroy();
		redirect(base_url().'index.php/employe');
	}
}
    
?>