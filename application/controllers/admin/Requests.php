<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;	

class Requests extends MY_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->model('admin/request_model', 'request_model');
			$this->load->model('activity_model','activity_model');
			$this->load->model('admin/customer_model','customer_model');
			$this->load->model('admin/media_model','media_model');
			$this->load->library('pagination'); // loaded codeigniter pagination liberary
			$this->load->library('datatable'); // loaded my custom 'serverside datatable' library
			$this->load->library('functions'); // loaded my custom 'functions' library 
		}
		public function index() {
			redirect(base_url('admin/requests/list'));
		}
		//-----------------------------------------------------------------------
		public function list(){
			$count = $this->request_model->count_all_requests();
			$per_page_record = 20;
			$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
			$url= base_url("admin/requests/list/");

			$config = $this->functions->pagination_config($url,$count,$per_page_record);
			$config['uri_segment'] = 4;		
			$this->pagination->initialize($config);

			$data['all_requests']=$this->request_model->get_all_requests_for_pagination($per_page_record,$page);
			if ($data['all_requests'] == false)
				$data['all_requests'] = array();
				
			$data['title'] = 'Request List';
			$data['start'] = $page;
			$data['view'] = 'admin/requests/request_list';
			$this->load->view('layout', $data);
		}

		//-----------------------------------------------------------------------
		public function view($id = 0){
			$req = $this->request_model->get_request_by_id($id);
			
			$request = $this->request_model->get_request_req($req['request_id']);
			$item = $this->request_model->get_request_item($req['item_id']);
			$photos = $this->media_model->get_media_photos($id);
			$receipt = $this->media_model->get_media_receipt($id);
			$req['request'] = $request['request'];
			$req['item'] = $item['item'];
			if ($req['attrs'] != '') {
				$data['attrs'] = json_decode($req['attrs']);
			} else {
				$data['attrs'] = array();
			}
			$data['photos'] = $photos;
			$data['receipt'] = $receipt;
			
			$customer_id = $req['customer_id'];
			$customer = $this->customer_model->get_customer_by_id($customer_id);
			$this->request_model->mark_as_read($id);
			
			$data['request'] = $req;
			$data['customer'] = $customer;
			$data['view'] = 'admin/requests/request_view';
			$this->load->view('layout', $data);
		}
		//-----------------------------------------------------------------------
		public function del($id = 0){
			$this->db->delete('ci_requests', array('id' => $id));

			// Add User Activity
			$this->activity_model->add(15);

			$this->session->set_flashdata('msg', 'Request has been deleted successfully!');
			redirect(base_url('admin/requests'));
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
			$sheet->setCellValue('F1', 'Zip');  
			$sheet->setCellValue('G1', 'Request');  
			$sheet->setCellValue('H1', 'Item');  
			$sheet->setCellValue('I1', 'Type');  
			$sheet->setCellValue('J1', 'Attributes'); 
			$sheet->setCellValue('K1', 'Original Price'); 
			$sheet->setCellValue('L1', 'Price'); 
			
			$fileName = 'requests_'.date('Y-m-d_H-i-s').'.xlsx';  
			
			$records = $this->request_model->get_all_requests();
			$i = 0;
			$rows = 2;
			foreach ($records as $row) 
			{  
				$name = $row['firstname']." ".$row['lastname'];
				$attrs = json_decode($row['attrs']);
				$new_attrs = array();
				foreach($attrs as $key => $value) {
					array_push($new_attrs, $key.":".$value);
				}
				
				$str = implode($new_attrs, ",");
	            $sheet->setCellValue('A' . $rows, ++$i);
	            $sheet->setCellValue('B' . $rows, date('F j, Y',strtotime($row['created_at'])));
	            $sheet->setCellValue('C' . $rows, $name);
	            $sheet->setCellValue('D' . $rows, $row['email']);
	            $sheet->setCellValue('E' . $rows, $row['mobile_no']);
	            $sheet->setCellValue('F' . $rows, $row['zip']);
	            $sheet->setCellValue('G' . $rows, $row['request']);
	            $sheet->setCellValue('H' . $rows, $row['item']);
	            $sheet->setCellValue('I' . $rows, $row['type']);
	            $sheet->setCellValue('J' . $rows, $str);	            
	            $sheet->setCellValue('K' . $rows, $row['original_price']);
	            $sheet->setCellValue('L' . $rows, $row['price']);
	            
	            $rows++;  
			}
	        
	        // Add User Activity
			$this->activity_model->add(19);

	        $writer = new Xlsx($spreadsheet);
			$writer->save("uploads/export/".$fileName);
			header("Content-Type: application/vnd.ms-excel");
	        redirect(base_url()."/uploads/export/".$fileName);
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
			$sheet->setCellValue('F1', 'Zip');  
			$sheet->setCellValue('G1', 'Request');  
			$sheet->setCellValue('H1', 'Item');  
			$sheet->setCellValue('I1', 'Type');  
			$sheet->setCellValue('J1', 'Attributes'); 
			$sheet->setCellValue('K1', 'Original Price'); 
			$sheet->setCellValue('L1', 'Price'); 
			
			$fileName = 'requests_'.date('Y-m-d_H-i-s').'.xlsx';  
			
			$ids = array();
			foreach ($details as $detail) {
				array_push($ids, $detail->req_id);
			}
						
			$records = $this->request_model->get_requests($ids);
			$i = 0;
			$rows = 2;
			foreach ($records as $row) 
			{  
				$name = $row['firstname']." ".$row['lastname'];
				$attrs = json_decode($row['attrs']);
				$new_attrs = array();
				foreach($attrs as $key => $value) {
					array_push($new_attrs, $key.":".$value);
				}
				
				$str = implode($new_attrs, ",");
	            $sheet->setCellValue('A' . $rows, ++$i);
	            $sheet->setCellValue('B' . $rows, date('F j, Y',strtotime($row['created_at'])));
	            $sheet->setCellValue('C' . $rows, $name);
	            $sheet->setCellValue('D' . $rows, $row['email']);
	            $sheet->setCellValue('E' . $rows, $row['mobile_no']);
	            $sheet->setCellValue('F' . $rows, $row['zip']);
	            $sheet->setCellValue('G' . $rows, $row['request']);
	            $sheet->setCellValue('H' . $rows, $row['item']);
	            $sheet->setCellValue('I' . $rows, $row['type']);
	            $sheet->setCellValue('J' . $rows, $str);	            
	            $sheet->setCellValue('K' . $rows, $row['original_price']);
	            $sheet->setCellValue('L' . $rows, $row['price']);
	            
	            $rows++;  
			}
	        
	        // Add User Activity
			$this->activity_model->add(19);

	        $writer = new Xlsx($spreadsheet);
			$writer->save("uploads/export/".$fileName);	
	        
	        $ret['success'] = true;	
	        $ret['path'] = base_url("uploads/export/".$fileName);
        	echo json_encode($ret);
        	return;        			
		}	
	}
?>