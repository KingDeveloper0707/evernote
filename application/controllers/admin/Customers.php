<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;	

class Customers extends MY_Controller {
		public function __construct(){
			parent::__construct();
			$this->load->model('admin/customer_model', 'customer_model');
			$this->load->model('activity_model','activity_model');
			$this->load->library('datatable'); // loaded my custom serverside datatable library
		}
		//-----------------------------------------------------------------------
		public function index(){
			$data['view'] = 'admin/customers/customer_list';
			$this->load->view('layout', $data);
		}
		//-----------------------------------------------------------------------
		public function datatable_json(){				   					   
			$records = $this->customer_model->get_all_customers();
			$data = array();
			$i = 0;
			foreach ($records['data']  as $row) 
			{  
				$customer_name = $row['firstname'].' '.$row['lastname'];
				$data[]= array(
					++$i,
					$row['firstname'],
					$row['lastname'],
					$row['email'],
					$row['created_at'],
					$row['mobile_no'],					
					'<a title="View" class="view btn btn-sm btn-info" href="'.base_url('admin/customers/edit/'.$row['id']).'"> <i class="material-icons">visibility</i></a>',
					
				);
			}
			$records['data']=$data;
			echo json_encode($records);						   
		}
		//-----------------------------------------------------------------------
		public function edit($id = 0){
			if($this->input->post('submit')){
				$this->form_validation->set_rules('firstname', 'First Name', 'trim|required');
				$this->form_validation->set_rules('lastname', 'Last Name', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
				$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
				$this->form_validation->set_rules('zip', 'Zip Code', 'trim|required');
				
				if ($this->form_validation->run() == FALSE) {
					$data['user'] = $this->customer_model->get_customer_by_id($id);
					$data['view'] = 'admin/customers/customer_edit';
					$this->load->view('layout', $data);
				}
				else{
					$data = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'zip' => $this->input->post('zip'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					$data = $this->security->xss_clean($data);
					$result = $this->customer_model->edit_customer($data, $id);
					if($result){
						// Add User Activity
						$this->activity_model->add(12);

						$this->session->set_flashdata('msg', 'User has been updated successfully!');
						redirect(base_url('admin/customers'));
					}
				}
			}
			else{
				$data['user'] = $this->customer_model->get_customer_by_id($id);
				$data['view'] = 'admin/customers/customer_edit';
				$this->load->view('layout', $data);
			}
		}
		//-----------------------------------------------------------------------
		public function del($id = 0){
			$this->db->delete('ci_users', array('id' => $id));

			// Add User Activity
			$this->activity_model->add(3);

			$this->session->set_flashdata('msg', 'Use has been deleted successfully!');
			redirect(base_url('admin/users'));
		}
		
		//-----------------------------------------------------------------------
		public function export() {		
			$spreadsheet = new Spreadsheet();
	        $sheet = $spreadsheet->getActiveSheet();
	       	$sheet->setCellValue('A1', 'ID');
	        $sheet->setCellValue('B1', 'Created Date');
	        $sheet->setCellValue('C1', 'Customer Name');
	        $sheet->setCellValue('D1', 'Email');
			$sheet->setCellValue('E1', 'Phone');  
			$sheet->setCellValue('F1', 'Zip'); 
			
			$fileName = 'customers_'.date('Y-m-d_H-i-s').'.xlsx';  
			
			$records = $this->customer_model->get_customers();
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
	            $sheet->setCellValue('F' . $rows, $row['zip']);
	            
	            $rows++;  
			}
	        
	        // Add User Activity
			$this->activity_model->add(20);

	        $writer = new Xlsx($spreadsheet);
			$writer->save("uploads/export/".$fileName);
			header("Content-Type: application/vnd.ms-excel");
	        redirect(base_url()."/uploads/export/".$fileName);
		}
			
	}
?>