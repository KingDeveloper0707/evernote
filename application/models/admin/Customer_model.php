<?php
	class Customer_model extends CI_Model{
		public function add_customer($data){
			$this->db->insert('ci_customers', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
		//---------------------------------------------------
		// get all users for server-side datatable processing (ajax based)
		public function get_all_customers(){
			$wh =array();
			$SQL ='SELECT * FROM ci_customers';
			return $this->datatable->LoadJson($SQL);
		}
		
		public function get_customers(){
			$query_string = "SELECT * FROM ci_customers ".
					"ORDER BY ci_customers.created_at DESC ";
			$query = $this->db->query($query_string); 
			if ($query->num_rows() == 0)
				return false;
			return $query->result_array();
		}
				
		//---------------------------------------------------
		// Count total user for pagination
		public function count_all_customers(){
			return $this->db->count_all('ci_customers');
		}
		//---------------------------------------------------
		// Get all users for pagination
		public function get_all_customers_for_pagination($limit, $offset){
			$wh =array();	
			$this->db->order_by('created_at', 'desc');
			$this->db->limit($limit, $offset);

			if(count($wh)>0){
				$WHERE = implode(' and ',$wh);
				$query = $this->db->get_where('ci_customers', $WHERE);
			}
			else{
				$query = $this->db->get('ci_customers');
			}
			return $query->result_array();
			//echo $this->db->last_query();
		}
		//---------------------------------------------------
		// Get user detial by ID
		public function get_customer_by_id($id){
			$query = $this->db->get_where('ci_customers', array('id' => $id));
			return $result = $query->row_array();
		}
		
		//---------------------------------------------------
		// Get user detial by Email
		public function get_customer_by_email($email){
			$query = $this->db->get_where('ci_customers', array('email' => $email));
			return $result = $query->row_array();
		}
		

		//---------------------------------------------------
		// Edit user Record
		public function edit_customer($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_customers', $data);
			return true;
		}

	}

?>