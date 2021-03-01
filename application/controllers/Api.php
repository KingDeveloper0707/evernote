<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('mailer');
		$this->load->helper('email_helper');
		$this->load->model('admin/customer_model', 'customer_model');
		$this->load->model('admin/template_model', 'template_model');
		$this->load->model('admin/request_model', 'request_model');
		$this->load->model('admin/media_model', 'media_model');
		$this->load->model('admin/payment_model', 'payment_model');
		 
	}
	//-------------------------------------------------------------------------
	public function index(){
		echo "API for Gem Shopify Store";
	}
	
	//-------------------------------------------------------------------------
	public function add_request() {		
		header('Access-Control-Allow-Origin: *');  
		$ip_addr = $this->input->ip_address();
		
		if (!$this->validateRecaptcha()) {
			$ret['success'] = false;	
			$ret['message'] = 'Google Recaptcha validation fail. Try again';	
        	echo json_encode($ret);
			return;
		}
				
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['request_id'] = $this->input->post('request_id');
		$data['item_id'] = $this->input->post('item_id');
		$data['type'] = $this->input->post('type');
		
		if ($data['request_id'] == "" || $data['item_id'] == "" || $data['type'] == "") {
			$ret['success'] = false;	
			$ret['error'] = "Incorrect Parameters";	
			echo json_encode($ret);
			return;
		}
		if (isset($_REQUEST['attrs'])) {
			$attrs = array();
			foreach($_REQUEST['attrs'] as $key => $value) {
				$attrs[$key] = $value;
			}
			$data['attrs'] = json_encode($attrs);
		}
		
		$data['price'] = $this->input->post('price');
		$data['original_price'] = $this->input->post('original_price');
		$data['description'] = $this->input->post('description');

		/* Customer */
		$customer['firstname'] = $this->input->post('firstname');
		$customer['lastname'] = $this->input->post('lastname');
		$customer['zip'] = $this->input->post('zip');
		$customer['mobile_no'] = $this->input->post('mobile_no');
		$customer['email'] = trim($this->input->post('email'));
		$customer['created_at'] = date('Y-m-d H:i:s');
		
		$cr = $this->customer_model->get_customer_by_email($customer['email']);
		if ($cr == NULL) {
			$customer_id = $this->customer_model->add_customer($customer);
		} else {
			$customer_id = $cr['id'];			
		}
		
		/* Add Request */
		$data['customer_id'] = $customer_id;
		$req_id = $this->request_model->add_request($data);
		
		/* File Upload */
		$file_path = "./uploads/files/".date('Y-m');
		if(!is_dir($file_path)){
		    //Directory does not exist, so lets create it.
		    mkdir($file_path, 0755);
		}

		$file_photos = 'photos';
		$count = count($_FILES[$file_photos]['name']);
		for($i=0;$i<$count;$i++){
		    if(!empty($_FILES[$file_photos]['name'][$i])){
		    	$path_parts = pathinfo($_FILES[$file_photos]['name'][$i]);
		    	$file_name = "Request_".$req_id."_Photo_".$i.".".$path_parts['extension'];
		    	move_uploaded_file($_FILES[$file_photos]['tmp_name'][$i], $file_path.'/'.$file_name);	
		    	
		    	$media['type'] = 1;
				$media['path'] = $file_path;
				$media['filename'] = $file_name;
				$media['original_filename'] = $_FILES[$file_photos]['name'][$i];
				$media['extension'] = $path_parts['extension'];
				$media['size'] = $_FILES[$file_photos]['size'][$i];
				$media['request_id'] = $req_id;
				
				$this->media_model->add_media($media);	
		    }
		}

		$file_receipt = 'receipt';
		$file_name = "Request_".$req_id."_Receipt";
		if ($_FILES[$file_receipt]['size'] > 0) {
	    	$path_parts = pathinfo($_FILES[$file_receipt]['name']);
	    	$file_name = "Request_".$req_id."_Receipt.".$path_parts['extension'];
	    	move_uploaded_file($_FILES[$file_receipt]['tmp_name'], $file_path.'/'.$file_name);	
	    	
	    	$media['type'] = 2;
			$media['path'] = $file_path;
			$media['filename'] = $file_name;
			$media['original_filename'] = $_FILES[$file_receipt]['name'];
			$media['extension'] = $path_parts['extension'];
			$media['size'] = $_FILES[$file_receipt]['size'];
			$media['request_id'] = $req_id;
			
			$this->media_model->add_media($media);			
		}
		        
        if ($ip_addr != "127.0.0.1") {
        	$this->sendRequestEmail($req_id, $data['request_id'], $data['item_id'], $data['type'], $customer);
			$this->sendEmailRespond(1, $cr['email']);			
		}
		
        $ret['success'] = true;	
        //$ret['params'] = $data;
		echo json_encode($ret);
	}
	
	public function validateRecaptcha() {
		$keySecret = $this->config->item('shopify_recaptcha_secretkey');
		$recaptcha = $this->input->post('recaptcha');
		$check = array(
			'secret' => $keySecret,
			'response' => $recaptcha
		);

		$startProcess = curl_init();
		curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
		curl_setopt($startProcess, CURLOPT_POST, true);
		curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
		curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
		$receiveData = curl_exec($startProcess);

		$finalResponse = json_decode($receiveData, true);
		return $finalResponse['success'];						
	}
	
	//-------------------------------------------------------------------------
	public function add_payment() {		
		header('Access-Control-Allow-Origin: *');  
		
		$ip_addr = $this->input->ip_address();
		
		if (!$this->validateRecaptcha()) {
			$ret['success'] = false;	
			$ret['message'] = 'Google Recaptcha validation fail. Try again';	
        	echo json_encode($ret);
			return;
		}
				
		$data['created_at'] = date('Y-m-d H:i:s');
		$pledge1 = $this->input->post('pledge1');
		$pledge2 = $this->input->post('pledge2');
		$pledge3 = $this->input->post('pledge3');
		$pledge4 = $this->input->post('pledge4');
		$pledge5 = $this->input->post('pledge5');
		
		if ($pledge1 != "")
			$data['pledge1'] = strtoupper("LT-".$pledge1);
		else 
			$data['pledge1'] = "";		
				
		if ($pledge2 != "")
			$data['pledge2'] = strtoupper("LT-".$pledge2);
		else 
			$data['pledge2'] = "";	
					
		if ($pledge3 != "")
			$data['pledge3'] = strtoupper("LT-".$pledge3);
		else 
			$data['pledge3'] = "";
			
		if ($pledge4 != "")
			$data['pledge4'] = strtoupper("LT-".$pledge4);
		else 
			$data['pledge4'] = "";
			
		if ($pledge5 != "")
			$data['pledge5'] = strtoupper("LT-".$pledge5);
		else 
			$data['pledge5'] = "";

		
		$data['type'] = $this->input->post('type');
		$data['store'] = $this->input->post('store');

		$data['type1'] = $this->input->post('type1');
		$data['type2'] = $this->input->post('type2');
		$data['amount'] = $this->input->post('amount');
		
		if ($data['type'] == "1") {
			$data['type2'] = "";
			$data['amount'] = 0;
		} else if ($data['type'] == "2"){
			$data['type1'] = "";		
		}
		
		/* Customer */
		$customer['firstname'] = $this->input->post('firstname');
		$customer['lastname'] = $this->input->post('lastname');
		$customer['mobile_no'] = $this->input->post('mobile_no');
		$customer['email'] = trim($this->input->post('email'));
		$customer['created_at'] = date('Y-m-d H:i:s');
		
		$cr = $this->customer_model->get_customer_by_email($customer['email']);
		if ($cr == NULL) {
			$customer_id = $this->customer_model->add_customer($customer);
		} else {
			$customer_id = $cr['id'];			
		}
		
		/* Add Request */
		$data['customer_id'] = $customer_id;
		$req_id = $this->payment_model->add_request($data);     

		/* File Upload */
		$file_path = "./uploads/files/".date('Y-m');
		if(!is_dir($file_path)){
		    //Directory does not exist, so lets create it.
		    mkdir($file_path, 0755);
		}
		
		$file_ticket = 'ticket';
		$file_name = "Ticket_".$req_id;
		if ($_FILES[$file_ticket]['size'] > 0) {
	    	$path_parts = pathinfo($_FILES[$file_ticket]['name']);
	    	$file_name = "Ticket_".$req_id.".".$path_parts['extension'];
	    	move_uploaded_file($_FILES[$file_ticket]['tmp_name'], $file_path.'/'.$file_name);	
	    	
			$this->payment_model->add_ticket($req_id, $file_path.'/'.$file_name);			
		}
		        
        if ($ip_addr != "127.0.0.1") {
        	$this->sendPaymentEmail($req_id, $data, $customer);
			$this->sendEmailRespond(2, $customer['email']);
		}

        $ret['success'] = true;	
        //$ret['params'] = $data;
		echo json_encode($ret);
	}
		
	//-----------------------------------------------------------------------
	public function test_api() {
		$data = array();
		$this->load->view('admin/api/loan', $data);
		
	}
	
	//-----------------------------------------------------------------------
	public function sendPaymentEmail($req_id, $data, $customer) {
		$store = $this->payment_model->get_payment_store($data['store']);
		
		$subject = 'You have received new Online Payment request!';
		//$payment_type = $data['type']=="1"?"Payment toward Existing Loan":"Payment toward Layaway Item";
		if ($data['type'] == "1") {
			$payment_type = "Payment toward Existing Loan - ".$data['type1'];
		} else {
			if ($data['amount'] == 0)
				$payment_type = "Payment toward Layaway Item - ".$data['type2'];
			else 
				$payment_type = "Payment toward Layaway Item - ".$data['type2'].", $".$data['amount'];
		}

		$message = "
		<html>
		<head>
		  <title>$subject</title>
		</head>
		<body>
		  <p><strong>Here is information</strong></p>
		  <table>
		    <tr>
		      <td>Customer Name: </td>
		      <td>".$customer['firstname']." ".$customer['lastname']."</td>		      
		    </tr>
		    <tr>
		      <td>Customer Email: </td>
		      <td>".$customer['email']."</td>
		    </tr>
		    <tr>
		      <td>Phone: </td>
		      <td>".$customer['mobile_no']."</td>
		    </tr>
		    <tr>
		      <td>Pledge1: </td>
		      <td>".$data['pledge1']."</td>
		    </tr>
		    <tr>
		      <td>Pledge2: </td>
		      <td>".$data['pledge2']."</td>
		    </tr>
		    		    		    <tr>
		      <td>Pledge3: </td>
		      <td>".$data['pledge3']."</td>
		    </tr>
		    <tr>
		      <td>Pledge4: </td>
		      <td>".$data['pledge4']."</td>
		    </tr>
		    <tr>
		      <td>Pledge5: </td>
		      <td>".$data['pledge5']."</td>
		    </tr>
		    <tr>
		      <td>Payment Type: </td>
		      <td>".$payment_type."</td>
		    </tr>
		    <tr>
		      <td>Store: </td>
		      <td>".$store['store']."</td>
		    </tr>
		  </table>	
		  <br>
		</body>
		</html>
		";

		$to = $this->config->item('primary_email');
		$cc = $this->config->item('secondary_email');
		
		sendEmail($to, $subject, $message, $cc);
		return;		
	}
	
	//-----------------------------------------------------------------------
	public function sendRequestEmail($req_id, $req_type, $item_id, $type, $customer) {
		$item = $this->request_model->get_request_item($item_id);
		$req = $req_type==1?"LOAN":"SELL";
		// Subject
		
		$subject = 'You have received new '.$req.' request!';
		
		$message = "
		<html>
		<head>
		  <title>$subject</title>
		</head>
		<body>
		  <p><strong>Here is information</strong></p>
		  <table>
		    <tr>
		      <td>Customer Name: </td>
		      <td>".$customer['firstname']." ".$customer['lastname']."</td>		      
		    </tr>
		    <tr>
		      <td>Customer Email: </td>
		      <td>".$customer['email']."</td>
		    </tr>
		    <tr>
		      <td>Phone: </td>
		      <td>".$customer['mobile_no']."</td>
		    </tr>
		    <tr>
		      <td>Item: </td>
		      <td>".$item['item']."</td>
		    </tr>
		    <tr>
		      <td>Type: </td>
		      <td>".$type."</td>
		    </tr>
		  </table>	
		  <br>
		  <p>Please check details from <a href='https://app.gempawnbrokers.com//admin/requests/view/".$req_id."' target='_blank'>Here</a></p>	  
		</body>
		</html>
		";

		$to = $this->config->item('primary_email');
		$cc = $this->config->item('secondary_email');
		
		sendEmail($to, $subject, $message, $cc);
		return;		
	}
    
    //-----------------------------------------------------------------------
    public function sendEmailRespond($template_id, $to) {
		$template = $this->template_model->get_template($template_id);

		$message = "
		<html>
		<head>
		  <title>".$template['subject']."</title>
		</head>
		<body>
		  ".$template['content']."  
		</body>
		</html>
		";
		
		sendEmail($to, $template['subject'], $message, '');
	}
	
	//-----------------------------------------------------------------------
	public function test_email() {
		$this->sendEmailRespond(1, 'grantlarocca4@gmail.com');
		echo "Email Sent";
		return;
		$template = $this->template_model->get_template(1);

		$to = $this->config->item('primary_email');
		$cc = $this->config->item('secondary_email');
		sendEmail('grantlarocca4@gmail.com', $template['subject'], $template['content'], '');
		
		
		return;		
	}
}  // end class


?>