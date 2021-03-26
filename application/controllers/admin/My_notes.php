<?php defined('BASEPATH') OR exit('No direct script access allowed');
class My_notes extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/notes_model','notes_model');
	}

	public function index(){

		// var_dump($this->general_settings); exit();
		$data['all_customers'] = $this->notes_model->get_all_customers();
		$data['active_users'] = $this->notes_model->get_active_users();
		$data['all_requests'] = $this->notes_model->get_all_requests();
		$data['today_requests'] = $this->notes_model->get_today_requests();
		$data['title'] = 'My_Notes';
		$data['view'] = 'admin/my_notes/my_notes';
		$this->load->view('layout', $data);
	}
}
?>