<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_login extends CI_Controller{
    
    public function __construct()
        {
            parent::__construct();
            //$this->load->model('md_login');
            $this->load->helper('form');
            $this->load->helper('url');
            $this->load->helper('html');         
            $this->load->library('session');
        
            /* $this->load->helper('flexigrid'); */
        }
    
    public function masuk() {
        $data=array('title'=>"Login Hris Attendance");

        $this->load->view('v_header',$data);
        $this->load->view('v_login');
        $this->load->view('v_footer');
    }

}