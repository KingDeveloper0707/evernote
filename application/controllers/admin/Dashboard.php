<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/dashboard_model','dashboard_model');
	}

	public function index(){

		// var_dump($this->general_settings); exit();
		$data['all_customers'] = $this->dashboard_model->get_all_customers();
		$data['active_users'] = $this->dashboard_model->get_active_users();
		$data['all_requests'] = $this->dashboard_model->get_all_requests();
		$data['today_requests'] = $this->dashboard_model->get_today_requests();
		$data['title'] = 'Dashboard';
		$data['view'] = 'admin/dashboard/index';
		$this->load->view('layout', $data);
	}
}
?>