<?php
	class Payment_model extends CI_Model{
		public function add_request($data){
			$this->db->insert('ci_payments', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}

		// Get request item detial by ID
		public function get_payment_store($id){
			$query = $this->db->get_where('ci_stores', array('id' => $id));
			return $result = $query->row_array();
		}
		
		// Get request item detial by ID
		public function get_payment_type($id){
			$query = $this->db->get_where('ci_payment_type', array('id' => $id));
			return $result = $query->row_array();
		}
		
		
		// Get user detial by ID
		public function get_payment_by_id($id){
			$query = $this->db->get_where('ci_payments', array('id' => $id));
			return $result = $query->row_array();
		}
				
		//---------------------------------------------------
		// Count total user for pagination
		public function count_all_payments(){
			return $this->db->count_all('ci_payments');
		}		
		
		//---------------------------------------------------
		// Get all users for pagination
		public function get_all_payments_for_pagination($limit, $offset){
				
			$query_string = "SELECT ci_payments.id, ci_payments.created_at, pledge1, pledge2, pledge3, pledge4, pledge5, ci_stores.store, ci_payment_type.type, mark_read, firstname, lastname, email, mobile_no ".
					"FROM ci_payments, ci_customers, ci_stores, ci_payment_type ".
					"WHERE ci_payments.type=ci_payment_type.id ".
					"AND ci_payments.store=ci_stores.id ".
					"AND ci_payments.customer_id=ci_customers.id ".
					"ORDER BY ci_payments.created_at DESC ".
					"LIMIT $limit OFFSET $offset";					
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}	
		
		// Get all users for pagination
		public function get_all_payments(){
				
			$query_string = "SELECT ci_payments.id, ci_payments.created_at, pledge1, pledge2, pledge3, pledge4, pledge5, ci_stores.store, ci_payment_type.type, firstname, lastname, email, mobile_no ".
					"FROM ci_payments, ci_customers, ci_stores, ci_payment_type ".
					"WHERE ci_payments.type=ci_payment_type.id ".
					"AND ci_payments.store=ci_stores.id ".
					"AND ci_payments.customer_id=ci_customers.id ".
					"ORDER BY ci_payments.created_at DESC ";		
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
		
		public function get_payments($ids){
			$id_group = implode(",",$ids);
			$query_string = "SELECT ci_payments.id, ci_payments.created_at, pledge1, pledge2, pledge3, pledge4, pledge5, ci_stores.store, ci_payment_type.type, firstname, lastname, email, mobile_no ".
					"FROM ci_payments, ci_customers, ci_stores, ci_payment_type ".
					"WHERE ci_payments.type=ci_payment_type.id ".
					"AND ci_payments.store=ci_stores.id ".
					"AND ci_payments.customer_id=ci_customers.id ".
					"AND ci_payments.id IN ($id_group)".
					"ORDER BY ci_payments.created_at DESC ";		
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
		
		public function mark_as_read($id) {
			$role = $this->session->userdata('role');
			if ($role == "1") {
				$data = array('mark_read' => 1);
				$this->db->where('id', $id);
				$this->db->update('ci_payments', $data);
			}
			return true;
		}
		
		public function add_ticket($id, $filepath) {
			$data = array('ticket' => $filepath);
			$this->db->where('id', $id);
			$this->db->update('ci_payments', $data);
			return true;
		}
	}

?>