<?php
	class Find_notes_model extends CI_Model{

		public function get_all_customers(){
			return $this->db->count_all('ci_customers');
		}
		public function get_active_users(){
			$this->db->where('is_active', 1);
			return $this->db->count_all_results('ci_users');
		}
		public function get_all_requests(){
			return $this->db->count_all('ci_requests');
		}
		
		public function get_today_requests(){
			$first_date = date('Y-m-d').' 00:00:00';
			$second_date = date('Y-m-d').' 23:59:59';
			$this->db->where('created_at >=', $first_date);
			$this->db->where('created_at <=', $second_date);

			return $this->db->count_all_results('ci_requests');
		}
	}

?>
