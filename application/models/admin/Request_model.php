<?php
	class Request_model extends CI_Model{
		public function add_request($data){
			$this->db->insert('ci_requests', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}

		//---------------------------------------------------
		// Count total user for pagination
		public function count_all_requests(){
			return $this->db->count_all('ci_requests');
		}
		//---------------------------------------------------
		// Get all users for pagination
		public function get_all_requests_for_pagination($limit, $offset){
			$query_string = "SELECT request, ci_requests.id, ci_requests.created_at, item, type, mark_read, attrs, price, original_price, description, email ".
					"FROM ci_requests, ci_request, ci_item, ci_customers ".
					"WHERE ci_requests.request_id=ci_request.id ".
					"AND ci_requests.item_id=ci_item.id ".
					"AND ci_requests.customer_id=ci_customers.id ".
					"ORDER BY ci_requests.created_at DESC ".
					"LIMIT $limit OFFSET $offset";
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
		
		// Get all users for pagination
		public function get_all_requests(){
			$query_string = "SELECT request, ci_requests.id, ci_requests.created_at, item, type, attrs, price, original_price, description, email,firstname,lastname,mobile_no,zip ".
					"FROM ci_requests, ci_request, ci_item, ci_customers ".
					"WHERE ci_requests.request_id=ci_request.id ".
					"AND ci_requests.item_id=ci_item.id ".
					"AND ci_requests.customer_id=ci_customers.id ".
					"ORDER BY ci_requests.created_at DESC ";
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
		
		// Get all users for pagination
		public function get_requests($ids){
			$id_group = implode(",",$ids);
			$query_string = "SELECT request, ci_requests.id, ci_requests.created_at, item, type, attrs, price, original_price, description, email,firstname,lastname,mobile_no,zip ".
					"FROM ci_requests, ci_request, ci_item, ci_customers ".
					"WHERE ci_requests.request_id=ci_request.id ".
					"AND ci_requests.item_id=ci_item.id ".
					"AND ci_requests.customer_id=ci_customers.id ".
					"AND ci_requests.id IN ($id_group)".
					"ORDER BY ci_requests.created_at DESC ";
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
				
				
		//---------------------------------------------------
		// Get user detial by ID
		public function get_request_by_id($id){
			$query = $this->db->get_where('ci_requests', array('id' => $id));
			return $result = $query->row_array();
		}
		
		//---------------------------------------------------
		// Get request  detial by ID
		public function get_request_req($id){
			$query = $this->db->get_where('ci_request', array('id' => $id));
			return $result = $query->row_array();
		}
		
		//---------------------------------------------------
		// Get request item detial by ID
		public function get_request_item($id){
			$query = $this->db->get_where('ci_item', array('id' => $id));
			return $result = $query->row_array();
		}

		//---------------------------------------------------
		// Edit user Record
		public function edit_request($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_requests', $data);
			return true;
		}

		public function mark_as_read($id) {
			$role = $this->session->userdata('role');
			if ($role == "1") {			
				$data = array('mark_read' => 1);
				$this->db->where('id', $id);
				$this->db->update('ci_requests', $data);
			}
			return true;
		}
	}

?>