<?php
	class Notes_model extends CI_Model{
	
		//---------------------------------------------------
		// get all notes with id for server-side datatable processing (ajax based)
		public function get_all_notes_by_id($id){
			
			$array = array('user_id' => $id, 'is_active' => 1);
			$this->db->where($array);
			$this->db->order_by('created_at', 'DESC');
			$query = $this->db->get('ci_templates');
			return $result = $query->result_array();
		}


		// get last notes with id for server-side datatable processing (ajax based)
		public function get_last_notes_by_id($id){
			
			$array = array('user_id' => $id, 'is_active' => 1);
			$this->db->where($array);
			$this->db->order_by('created_at', 'DESC');
			$query = $this->db->get('ci_templates');
			$ret = $query->row();
			return $ret;
		}


		// get user info by id
		public function get_user_info_by_id($id){
			
			$this->db->where('id', $id);			
			$query = $this->db->get('ci_users');
			
			return $result = $query->row_array();
		}


		// Get user detial by ID
		public function get_template($id){
			$query = $this->db->get_where('ci_templates', array('id' => $id));
			return $result = $query->row_array();
		}


		//Update Notes table
		public function edit_template($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_templates', $data);
			return true;
		}

		//Insert notes   return $this->db->insert('news', $data);
		public function insert_template($data){
			$this->db->insert('ci_templates', $data);
			
			return true;
		}
	}

?>
