<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Find_notes extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/find_notes_model','find_notes_model');
	}

	public function index(){

		// var_dump($this->general_settings); exit();
		$data['all_customers'] = $this->find_notes_model->get_all_customers();
		$data['active_users'] = $this->find_notes_model->get_active_users();
		$data['all_requests'] = $this->find_notes_model->get_all_requests();
		$data['today_requests'] = $this->find_notes_model->get_today_requests();
		$data['title'] = 'Find_Notes';
		$data['view'] = 'admin/find_notes/find_notes';
		$this->load->view('layout', $data);
	}
}
?>