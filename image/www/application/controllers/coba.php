<?php

class Coba extends CI_Controller {

    function index() {
        echo "hallo coba";
    }

    public function attendance() {

        date_default_timezone_set('Asia/Jakarta');
        $currentdate = date('Y-m-d H:i:s');
        $ctg_id = $this->input->post('ctg_id');
        $osw_id = $this->input->post('osw_id');
        $name = $this->input->post('Name');
        $email =( empty( $_POST[ 'Email' ] ) ) ? '' : $_POST[ 'Email' ];
        //$email = $this->input->post('Email');
        $osw=
        $time = $this->input->post('Time');
        $date = $this->input->post('Date');
        $status = $this->input->post('Status');
        $lat = $this->input->post('Lat');
        $lng = $this->input->post('Lng');
        $image_satu = $this->input->post('Image_satu');
        $image_dua = $this->input->post('Image_dua');
        $reason_late=$this->input->post('reason_late');
		$reason_meeting=$this->input->post('reason_meeting');
		$reason_onsite=$this->input->post('reason_onsite');
        $file_img_satu = $this->input->post('File_img_satu');
        $file_img_dua = $this->input->post('File_img_dua');

        $emp = $this->db->query("select emp_id from hris_employe where email='" .$email. "'");
        $row = $emp->row();

        if (empty($email)){
            $notice ="Access Not Found !!!";
            echo json_encode($notice);
        }else{
            $data = array(
                'emp_id' => $row->emp_id,
                'ctg_id' => $ctg_id,
                'osw_id'=>$osw_id,
                'att_name' => $name,
                'att_email' => $email,
                'att_time' => $time,
                'att_date' => $date,
                'att_date_server' => $currentdate,
                'att_date_current' => $currentdate,
                'att_status' => $status,
                'att_latitude' => $lat,
                'att_longtitude' => $lng,
                'att_image' => $image_satu . "|" . $image_dua,
                'reason_late'=>$reason_late,
				'reason_meeting'=>$reason_meeting,
				'reason_onsite'=>$reason_onsite
            );

            $query = $this->db->insert('hris_attendance', $data);

            if ($query) {
                echo "Succes";
            } else {
                echo "Failed";
            }
        }

        $this->load->helper('file');

        $decoded = base64_decode($file_img_satu);
        $decoded1 = base64_decode($file_img_dua);

        $path = FCPATH . "media/" . $image_satu;
        $path1 = FCPATH . "media/" . $image_dua;

        write_file($path, $decoded);
        write_file($path1, $decoded1);
    }

    public function registration_gcm() {
        $reg_id = $this->input->post('reg_id');

        $data = array(
            'reg_id' => $reg_id
        );

		if (!empty($reg_id)){
			$query = $this->db->insert('hris_gcm_regisid', $data);
		} else {
			$query = "";
		}
		
        if ($query) {
            echo "Succes";
        } else {
            echo "Failed";
        }
    }

    public function getCategory() {
        $query = $this->db->get('hris_categories');
        $test = array();

        foreach ($query->result_array() as $row) {
            $test[] = array("ctg_id" => $row['ctg_id'], "code" => $row['ctg_code'], "name" => $row['ctg_name'], "last_update" => $row['last_update']);
        }

        $response = array("data" => $test);

        if ($query) {
            // echo "<pre>";
            echo json_encode($response);
            // echo "</pre>";
        } else {
            echo "Failed";
        }
    }
	
	public function getOutsidework() {
        $query = $this->db->get('hris_outsidework');
        $test = array();

        foreach ($query->result_array() as $row) {
            $test[] = array("osw_id" => $row['osw_id'], "osw_code" => $row['osw_code'], "osw_name" => $row['osw_name'], "last_update" => $row['last_update']);
        }

        $response = array("data" => $test);

        if ($query) {
            echo json_encode($response);
        } else {
            echo "Failed";
        }
    }

    function sendMessageThroughGCM() {
        //required message to call this GCM & //passed message to array 'message' with index 'm'
        $data = $_GET['message'];
        $message = array("msg" => $data);

        //query all registered id from database and encode it to json
        $query = $this->db->get('hris_gcm_regisid');
        $reg_id = array();
        foreach ($query->result_array() as $row) {
            $reg_id[] = $row['reg_id'];
        }
        $gcmRegIds = $reg_id;
        echo json_encode($gcmRegIds);

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
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
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

    // public function page_test()
    // {
    // 	$name = $this->input->post('Name');
    // 	$email = $this->input->post('Email');
    // 	$time = $this->input->post('Time');
    // 	$date = $this->input->post('Date');
    // 	$status = $this->input->post('Status');
    // 	$lat = $this->input->post('Lat');
    // 	$lng = $this->input->post('Lng');
    // 	$data = array(
    // 		'name'  => $name ,
    // 		'email' => $email ,
    // 		'time'  => $time ,
    // 		'date'  => $date ,
    // 		'status'  => $status ,
    // 		'latitude'  => $lat ,
    // 		'longtitude'  => $lng
    // 	);
    // 	$query = $this->db->insert('test', $data);
    // 	if ($query){
    // 		echo "Succes";
    // 	} else {
    // 		echo "Failed";
    // 	}
    // }
    // public function late()
    // {
    // 	$nama = $this->input->post('Nama');
    // 	$jenis = $this->input->post('Jenis');
    // 	$alasan = $this->input->post('Alasan');
    // 	$image_satu = $this->input->post('Image_satu');
    // 	$image_dua = $this->input->post('Image_dua');
    // 	$file_img_satu = $this->input->post('File_img_satu');
    // 	$file_img_dua = $this->input->post('File_img_dua');
    // 	$data = array(
    // 		'nama'  => $nama ,
    // 		'jenis' => $jenis ,
    // 		'alasan'  => $alasan ,
    // 		'image_satu'  => $image_satu ,
    // 		'image_dua'  => $image_dua
    // 	);
    // 	$query = $this->db->insert('late', $data);
    // 	if ($query) {
    // 		echo "Succes";
    // 	} else {
    // 		echo "Failed";
    // 	}
    // 	$this->load->helper('file');
    // 	$decoded = base64_decode($file_img_satu);
    // 	$decoded1 = base64_decode($file_img_dua);
    // 	$path = FCPATH."media/".$image_satu;
    // 	$path1 = FCPATH."media/".$image_dua;
    // 	write_file($path, $decoded);
    // 	write_file($path1, $decoded1);
    // }
    // public function late_test()
    // {
    // 	$nama = $this->input->post('Nama');
    // 	$jenis = $this->input->post('Jenis');
    // 	$alasan = $this->input->post('Alasan');
    // 	$image_satu = $this->input->post('Image_satu');
    // 	$image_dua = $this->input->post('Image_dua');
    // 	$file_img_satu = $this->input->post('File_img_satu');
    // 	$file_img_dua = $this->input->post('File_img_dua');
    // 	$data = array(
    // 		'nama'  => $nama ,
    // 		'jenis' => $jenis ,
    // 		'alasan'  => $alasan ,
    // 		'image_satu'  => $image_satu ,
    // 		'image_dua'  => $image_dua
    // 	);
    // 	$query = $this->db->insert('late_test', $data);
    // 	if ($query) {
    // 		echo "Succes";
    // 	} else {
    // 		echo "Failed";
    // 	}
    // 	$this->load->helper('file');
    // 	$decoded = base64_decode($file_img_satu);
    // 	$decoded1 = base64_decode($file_img_dua);
    // 	$path = FCPATH."media/".$image_satu;
    // 	$path1 = FCPATH."media/".$image_dua;
    // 	write_file($path, $decoded);
    // 	write_file($path1, $decoded1);
    // }
    //function call() {
    //$gcmRegID1  = "APA91bEm7Q8OdUBL94-UfIiUc2C-1v4CdCsORYaLo-zg9fh0fLCAFHFeyWOnzNuN-95mjqPU19Nd6-BlZFRU1n6z4f6z23Gp1HlDugy2oJdXP9-pGdrGEwW4254VlkZHjeh-W_s4wBWl";
    //$gcmRegID2 = "APA91bGHQN5rUBqWea3-iojvCH7aDCr23rfK5HwV6Iy_CHxfwMhdzuAEGwGFHc3zDyMrnejCUPQF3KOjV5GubCsz4w-gesqISNT4JARJM1LvNRfIZm0Qfny3vWrZfy2tE4luejcduJOY";
    //	$pushMessage = "You must clock'in before late";	
    //if (isset($gcmRegID1) && isset($pushMessage)) {		
    //$gcmRegIds = array($gcmRegID1, $gcmRegID2);
    //$message = array("m" => $pushMessage);	
    //$pushStatus = sendMessageThroughGCM($gcmRegIds, $message);
    //}
    //}
}