<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;	

class Templates extends MY_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->model('admin/template_model', 'template_model');
			$this->load->model('activity_model','activity_model');			
		}
		public function index() {
			redirect(base_url('admin/templates/request'));
		}
		//-----------------------------------------------------------------------
		public function payment() {
			if($this->input->post('submit')){
				$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
				$this->form_validation->set_rules('content', 'Content', 'required');
				
				if ($this->form_validation->run() == FALSE) {
					$data['template'] = $this->template_model->get_template(2);					
					$data['view'] = 'admin/templates/payment';
					$this->load->view('layout', $data);
				}
				else{
					$data = array(
						'subject' => $this->input->post('subject'),
						'content' => $this->input->post('content'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					// Add User Activity
					$this->activity_model->add(1);
					$this->template_model->edit_template($data, 2);

					$this->session->set_flashdata('msg', 'Template has been updated successfully!');
					redirect(base_url('admin/templates/payment'));
				}
			}
			else{
				$data['template'] = $this->template_model->get_template(2);	
				$data['view'] = 'admin/templates/payment';
				$this->load->view('layout', $data);
			}
		}
		
		//-----------------------------------------------------------------------
		public function request() {			
			if($this->input->post('submit')){
				$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
				$this->form_validation->set_rules('content', 'Content', 'required');
				
				if ($this->form_validation->run() == FALSE) {
					$data['template'] = $this->template_model->get_template(1);					
					$data['view'] = 'admin/templates/request';
					$this->load->view('layout', $data);
				}
				else{
					$data = array(
						'subject' => $this->input->post('subject'),
						'content' => $this->input->post('content'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					// Add User Activity
					$this->activity_model->add(1);
					$this->template_model->edit_template($data, 1);

					$this->session->set_flashdata('msg', 'Template has been updated successfully!');
					redirect(base_url('admin/templates/request'));
				}
			}
			else{
				$data['template'] = $this->template_model->get_template(1);	
				$data['view'] = 'admin/templates/request';
				$this->load->view('layout', $data);
			}
						
		}
	}
?>