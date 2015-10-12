<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coba extends CI_Controller {

	public function index()
	{
		echo "hello world";
	}

	public function page_test()
	{
		$name = $this->input->post('Name');
		$email = $this->input->post('Email');
		$time = $this->input->post('Time');
		$date = $this->input->post('Date');
		$status = $this->input->post('Status');
		$lat = $this->input->post('Lat');
		$lng = $this->input->post('Lng');
		
		$data = array(
			'name'  => $name ,
			'email' => $email ,
			'time'  => $time ,
			'date'  => $date ,
			'status'  => $status ,
			'latitude'  => $lat ,
			'longtitude'  => $lng
		);
		
		$query = $this->db->insert('test', $data);
		
		if ($query){
			echo "Succes";
		} else {
			echo "Failed";
		}
	}
	
	public function attendance()
    {

        date_default_timezone_set('Asia/Jakarta');
        $currentime = date('Y-m-d H:i:s');
        $name = $this->input->post('Name');
        $email = $this->input->post('Email');
        $time = $this->input->post('Time');
        $date = $this->input->post('Date');
        $status = $this->input->post('Status');
        $lat = $this->input->post('Lat');
        $lng = $this->input->post('Lng');
        
        $emp = $this->db->query("select emp_id from hris_employe where email='".$email."'");
        $row=$emp->row();
        
        $data = array(
            'emp_id'  => $row->emp_id ,
            'name'  => $name ,
            'email' => $email ,
            'time'  => $time ,
            'date'  => $date ,
            'curren_time'=>$currentime,
            'status'  => $status ,
            'latitude'  => $lat ,
            'longtitude'  => $lng
        );
        
        $query = $this->db->insert('attendance', $data);
        
        if ($query){
            echo "Succes";
        } else {
            echo "Failed";
        }
    }
	
	public function registration_gcm()
	{
		$reg_id = $this->input->post('reg_id');
		
		$data = array(
			'reg_id'  => $reg_id
		);
		
		$query = $this->db->insert('gcm_regisid', $data);
		
		if ($query){
			echo "Succes";
		} else {
			echo "Failed";
		}
	}
	
	public function getCategory()
	{
		$query = $this->db->get('category');
		$test = array();
		
		foreach ($query->result_array() as $row)
		{
			$test[] = array("code"=>$row['code'], "name"=>$row['name']);
		}
		
		$response = array("data" => $test);
		
		if ($query){
			echo json_encode($response);
		} else {
			echo "Failed";
		}
	}
	
	public function late()
	{
		date_default_timezone_set('Asia/Jakarta');
		$datecurrent = date("Y-m-d");
		$nama = $this->input->post('Nama');
		$jenis = $this->input->post('Jenis');
		$alasan = $this->input->post('Alasan');
		$image_satu = $this->input->post('Image_satu');
		$image_dua = $this->input->post('Image_dua');

		$file_img_satu = $this->input->post('File_img_satu');
		$file_img_dua = $this->input->post('File_img_dua');
		
		$data = array(
			'nama'  => $nama ,
			'jenis' => $jenis ,
			'alasan'  => $alasan ,
			'date_current'=>$datecurrent,
			'image_satu'  => $image_satu ,
			'image_dua'  => $image_dua
		);
		
		$query = $this->db->insert('late', $data);
		
		if ($query) {
			echo "Succes";
		} else {
			echo "Failed";
		}
		
		$this->load->helper('file');
		
		$decoded = base64_decode($file_img_satu);
		$decoded1 = base64_decode($file_img_dua);
		
		$path = FCPATH."media/".$image_satu;
		$path1 = FCPATH."media/".$image_dua;
		
		write_file($path, $decoded);
		write_file($path1, $decoded1);
	}
	
	public function late_test()
	{
		$nama = $this->input->post('Nama');
		$jenis = $this->input->post('Jenis');
		$alasan = $this->input->post('Alasan');
		$image_satu = $this->input->post('Image_satu');
		$image_dua = $this->input->post('Image_dua');

		$file_img_satu = $this->input->post('File_img_satu');
		$file_img_dua = $this->input->post('File_img_dua');
		
		$data = array(
			'nama'  => $nama ,
			'jenis' => $jenis ,
			'alasan'  => $alasan ,
			'image_satu'  => $image_satu ,
			'image_dua'  => $image_dua
		);
		
		$query = $this->db->insert('late_test', $data);
		
		if ($query) {
			echo "Succes";
		} else {
			echo "Failed";
		}
		
		$this->load->helper('file');
		
		$decoded = base64_decode($file_img_satu);
		$decoded1 = base64_decode($file_img_dua);
		
		$path = FCPATH."media/".$image_satu;
		$path1 = FCPATH."media/".$image_dua;
		
		write_file($path, $decoded);
		write_file($path1, $decoded1);
	}
	
	function sendMessageThroughGCM() {
		//required message to call this GCM & //passed message to array 'message' with index 'm'
		$data = $_GET['message'];
		$message = array("msg" => $data);
		
		// query all registered id from database and encode it to json
		$query = $this->db->get('gcm_regisid');
		$reg_id = array();
		foreach ($query->result_array() as $row)
		{
			$reg_id[] = $row['reg_id'];
		}
		
		
		$gcmRegIds = array("APA91bH4_d5HCYdefigPDPUrabc4wHd5zfx_RwNI7dnJeLP05lSXrVjPQVFDl1LtYj9qn4zKXSy3l_psC73iaf1ipXHA97WHzJMe6AC9DjDs3fGUpazPfJm-kJrGmFwCybZHpG2LFZbH");
		// $gecmRegIds = $reg_id;
			
		//Google cloud messaging GCM-API url
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $gcmRegIds,
            'data' => $message,
        );
		
		// Update your Google Cloud Messaging API Key
		define("GOOGLE_API_KEY", "AIzaSyCn_LhLMRCAP35IX8E6xkIAPGgb7NjrLqI"); 		
        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);	
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);				
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
		echo $result;
        return $result;
    }
	
	function base64_to_jpeg($base64_string, $output_file) {
		$ifp = fopen($output_file, "wb"); 

		fwrite($ifp, base64_decode($base64_string)); 
		//fclose($ifp); 

		return $output_file;
	}
	
	public function registerMac()
	{
		$MacRouter = $this->input->post('mac_router');
		$VendorName = $this->input->post('vendor_name');
		
		$data = array(
			'router_mac'  => $MacRouter,
			'vendor_name' => $VendorName
		);
		
		$data1 = array(
			'vendor_name' => $VendorName
		);
		
		$query1 = $this->db->insert('higo_vendor', $data1);
		$query = $this->db->insert('higo_router', $data);
		
		if ($query && $query){
			echo json_encode(array("message" => "Succes"));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
	
	public function registerUser()
	{
		$Username = $this->input->post('username');
		$Password = $this->input->post('password');
		$Email = $this->input->post('email');
		$VendorId = $this->input->post('vendor_id');
		$MacDevice = $this->input->post('mac_device');
		
		$data = array(
			'username'  => $Username ,
			'password' => $Password ,
			'email'  => $Email ,
			'vendor_id'  => $VendorId ,
			'mac_device'  => $MacDevice
		);
		
		$query = $this->db->insert('higo_user', $data);
		
		if ($query){
			echo json_encode(array("message" => "Succes"));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
	
	public function registerFbUser()
	{
		$FacebookId = $this->input->post('facebook_id');
		$Username = $this->input->post('username');
		$Email = $this->input->post('email');
		$VendorId = $this->input->post('vendor_id');
		$MacAddress = $this->input->post('mac_device');
	
		$emp = $this->db->query("select email from higo_user where facebook_id='".$FacebookId."'");
        $row=$emp->row();
		
		$data = array(
			'facebook_id'  => $FacebookId ,
			'username'  => $Username ,
			'email'  => $Email ,
			'vendor_id'  => $VendorId ,
			'mac_device'  => $MacAddress
		);
		
		if (isset($row->email)){
			$query = $this->db->query("select email from higo_user where facebook_id='".$FacebookId."'");
		} else {
			$query = $this->db->insert('higo_user', $data);
		}
		
		if ($query){
			echo json_encode(array("message" => "Succes"));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
	
	public function loginCheck()
	{
		$Password = $this->input->post('password');
		$Email = $this->input->post('email');
		
		$this->db->select('email');
		$this->db->from('higo_user');
		$this->db->where('email', $Email);
		
		$query = $this->db->get();
		$test = array();
		
		foreach ($query->result_array() as $row)
		{
			$test = $row['email'];
		}
		
		if ($test != null){
			// echo var_dump($test);
			echo json_encode(array("message" => "Succes"));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
	
	public function isEverLogin()
	{
		$MacAddress = $this->input->post('mac_router');
		
		$this->db->select('*');
		$this->db->from('higo_router');
		$this->db->where('router_mac', $MacAddress);
		
		$query = $this->db->get();
		$mac = array();
		$vendor = array();
	
		foreach ($query->result_array() as $row)
		{
			$mac = $row['router_mac'];
			$vendor = $row['vendor_name'];
		}
		
		$query1 = $this->db->query("select id from higo_vendor where vendor_name='".$vendor."'");
		$vendor_id = array();
		
		foreach ($query1->result_array() as $row)
		{
			$vendor_id = $row['id'];
		}
		
		if ($mac != null){
			// echo var_dump($test);
			echo json_encode(array("message" => "Succes", "mac"=>$mac, "vendor_id"=>$vendor_id));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
	
	public function deleteRouterMac()
	{
		$MacAddress = $this->input->post('mac_router');
		
		$query_name = $this->db->query("select vendor_name from higo_router where router_mac='".$MacAddress."'");
		$row = $query_name->row();
		
		$name = $row;
		$vendor_name = $name->vendor_name;
		$query1 = $this->db->query("delete from higo_vendor where vendor_name='".$vendor_name."'");

		$query = $this->db->query("delete from higo_router where router_mac='".$MacAddress."'");
		
		if ($query){
			echo json_encode(array("message" => "Succes"));
		} else {
			echo json_encode(array("message" => "Failed"));
		}
	}
}
