<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;	

class Payments extends MY_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->model('admin/payment_model', 'payment_model');
			$this->load->model('activity_model','activity_model');
			$this->load->model('admin/customer_model','customer_model');			
			$this->load->library('pagination'); // loaded codeigniter pagination liberary
			$this->load->library('datatable'); // loaded my custom 'serverside datatable' library
			$this->load->library('functions'); // loaded my custom 'functions' library 
		}
		public function index() {
			redirect(base_url('admin/payments/list'));
		}
		//-----------------------------------------------------------------------
		public function list(){
			$count = $this->payment_model->count_all_payments();
			$per_page_record = 20;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$url= base_url("admin/payments/list/");

			$config = $this->functions->pagination_config($url,$count,$per_page_record);
			$config['uri_segment'] = 4;		
			$this->pagination->initialize($config);

			$data['all_payments']=$this->payment_model->get_all_payments_for_pagination($per_page_record,$page);
			if ($data['all_payments'] == false)
				$data['all_payments'] = array();
				
			$data['title'] = 'Online-Payment List';
			$data['start'] = $page;
			$data['view'] = 'admin/payments/payment_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------------------
		public function view($id = 0){
			$payment = $this->payment_model->get_payment_by_id($id);
			$customer_id = $payment['customer_id'];
			$customer = $this->customer_model->get_customer_by_id($customer_id);
			
			$store_record = $this->payment_model->get_payment_store($payment['store']);
			$type_record = $this->payment_model->get_payment_type($payment['type']);
			
			$payment['store'] = $store_record['store'];
			$payment['type'] = $type_record['type'];
			$data['payment'] = $payment;
			$data['customer'] = $customer;
			
			$this->payment_model->mark_as_read($id);
			$data['view'] = 'admin/payments/payment_view';
			$this->load->view('layout', $data);
		}
		//-----------------------------------------------------------------------
		public function del($id = 0){
			$this->db->delete('ci_payments', array('id' => $id));

			// Add User Activity
			$this->activity_model->add(17);

			$this->session->set_flashdata('msg', 'Online-Payment Request has been deleted successfully!');
			redirect(base_url('admin/payments'));
		}
		//-----------------------------------------------------------------------
		public function export() {		
			$str = $this->input->post('details');
			$details = json_decode($str);
			if (count($details) == 0) {
				$ret['success'] = false;	
        		echo json_encode($ret);
        		return;
			}
			
			$spreadsheet = new Spreadsheet();
	        $sheet = $spreadsheet->getActiveSheet();
	       	$sheet->setCellValue('A1', 'ID');
	        $sheet->setCellValue('B1', 'Created Date');
	        $sheet->setCellValue('C1', 'Customer Name');
	        $sheet->setCellValue('D1', 'Email');
			$sheet->setCellValue('E1', 'Phone');  
			$sheet->setCellValue('F1', 'Pledge1');  
			$sheet->setCellValue('G1', 'Pledge2');  
			$sheet->setCellValue('H1', 'Pledge3');  
			$sheet->setCellValue('I1', 'Pledge4');  
			$sheet->setCellValue('J1', 'Pledge5'); 
			$sheet->setCellValue('K1', 'Payment Type'); 
			$sheet->setCellValue('L1', 'Store'); 
			
			$fileName = 'payments_'.date('Y-m-d_H-i-s').'.xlsx';  
			
			$ids = array();
			foreach ($details as $detail) {
				array_push($ids, $detail->req_id);
			}
			
			$records = $this->payment_model->get_payments($ids);
			$i = 0;
			$rows = 2;
			foreach ($records as $row) 
			{  
				$name = $row['firstname']." ".$row['lastname'];
				
	            $sheet->setCellValue('A' . $rows, ++$i);
	            $sheet->setCellValue('B' . $rows, date('F j, Y h:i:s',strtotime($row['created_at'])));
	            $sheet->setCellValue('C' . $rows, $name);
	            $sheet->setCellValue('D' . $rows, $row['email']);
	            $sheet->setCellValue('E' . $rows, $row['mobile_no']);
	            $sheet->setCellValue('F' . $rows, $row['pledge1']);
	            $sheet->setCellValue('G' . $rows, $row['pledge2']);
	            $sheet->setCellValue('H' . $rows, $row['pledge3']);
	            $sheet->setCellValue('I' . $rows, $row['pledge4']);
	            $sheet->setCellValue('J' . $rows, $row['pledge5']);	            
	            $sheet->setCellValue('K' . $rows, $row['type']);
	            $sheet->setCellValue('L' . $rows, $row['store']);
	            
	            $rows++;  
			}
	        
	        // Add User Activity
			$this->activity_model->add(18);
					
	        $writer = new Xlsx($spreadsheet);
			$writer->save("uploads/export/".$fileName);
			//header("Content-Type: application/vnd.ms-excel");
	        //redirect(base_url()."/uploads/export/".$fileName);		
	        
	        $ret['success'] = true;	
	        $ret['path'] = base_url("uploads/export/".$fileName);
        	echo json_encode($ret);
        	return;        			
		}
	
		//-----------------------------------------------------------------------
		public function export_all() {		
			$spreadsheet = new Spreadsheet();
	        $sheet = $spreadsheet->getActiveSheet();
	       	$sheet->setCellValue('A1', 'ID');
	        $sheet->setCellValue('B1', 'Created Date');
	        $sheet->setCellValue('C1', 'Customer Name');
	        $sheet->setCellValue('D1', 'Email');
			$sheet->setCellValue('E1', 'Phone');  
			$sheet->setCellValue('F1', 'Pledge1');  
			$sheet->setCellValue('G1', 'Pledge2');  
			$sheet->setCellValue('H1', 'Pledge3');  
			$sheet->setCellValue('I1', 'Pledge4');  
			$sheet->setCellValue('J1', 'Pledge5'); 
			$sheet->setCellValue('K1', 'Payment Type'); 
			$sheet->setCellValue('L1', 'Store'); 
			
			$fileName = 'payments_'.date('Y-m-d_H-i-s').'.xlsx';  
			
			$records = $this->payment_model->get_all_payments();
			$i = 0;
			$rows = 2;
			foreach ($records as $row) 
			{  
				$name = $row['firstname']." ".$row['lastname'];
				
	            $sheet->setCellValue('A' . $rows, ++$i);
	            $sheet->setCellValue('B' . $rows, date('F j, Y',strtotime($row['created_at'])));
	            $sheet->setCellValue('C' . $rows, $name);
	            $sheet->setCellValue('D' . $rows, $row['email']);
	            $sheet->setCellValue('E' . $rows, $row['mobile_no']);
	            $sheet->setCellValue('F' . $rows, $row['pledge1']);
	            $sheet->setCellValue('G' . $rows, $row['pledge2']);
	            $sheet->setCellValue('H' . $rows, $row['pledge3']);
	            $sheet->setCellValue('I' . $rows, $row['pledge4']);
	            $sheet->setCellValue('J' . $rows, $row['pledge5']);	            
	            $sheet->setCellValue('K' . $rows, $row['type']);
	            $sheet->setCellValue('L' . $rows, $row['store']);
	            
	            $rows++;  
			}
	        
	        // Add User Activity
			$this->activity_model->add(18);
					
	        $writer = new Xlsx($spreadsheet);
			$writer->save("uploads/export/".$fileName);
			header("Content-Type: application/vnd.ms-excel");
	        redirect(base_url()."/uploads/export/".$fileName);
		}			

	}
?>