<?php
	class Admin_settings_model extends CI_Model{

		//--------------------------------------------------------------------
		public function get_user_detail(){
			$id = $this->session->userdata('admin_id');
			$query = $this->db->get_where('ci_users', array('id' => $id));
			return $result = $query->row_array();
		}
		//--------------------------------------------------------------------
		public function update_user($data){
			$id = $this->session->userdata('admin_id');
			$this->db->where('id', $id);
			$this->db->update('ci_users', $data);
			return true;
		}
		//--------------------------------------------------------------------
		public function change_pwd($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_users', $data);
			return true;
		}

		// get all notes with id for server-side datatable processing (ajax based)
		public function get_all_notes(){
			
			$query = $this->db->get('ci_templates');
			return $result = $query->result_array();
		}

		//get my notes counts 
		public function get_my_counts_notes(){
			
			$counts = $this->db->count_all_results('ci_templates');
			return $counts;
		}

        //Get Tags info 
		public function get_tags_info_by_id(){
			
						
			$query = $this->db->get('ci_tags');
			
			return $result = $query->result_array();
		}

		//Delete Notes
		public function del($ids){
			
			$this->db->where_in('id', explode(",", $ids));
			$this->db->delete('ci_templates');

			return true;
	 
			

			//$this->session->set_flashdata('msg', 'Notes has been deleted successfully!');
			//redirect(base_url('admin/users'));
		}

		//active/inactive notes
		public function active_inactive_notes($id, $data) {
			

			$this->db->where('id', $id);
			$this->db->update('ci_templates', $data);
			return true;

		}

		//add tagss table
		public function insert_tags($data){
			$this->db->insert('ci_tags', $data);
			$new_id = $this->db->insert_id();
			return $new_id;
		}

		//Get current tagnames
		public function get_current_tagname($id){
			
			$this->db->select('tags');
			$this->db->where('id', $id);
			$query = $this->db->get('ci_templates');
			return $result = $query->row();
		}

		//Get current user name
		public function get_current_username($id){
			
			$this->db->select('username');
			$this->db->where('id', $id);
			$query = $this->db->get('ci_users');
		
			return $result = $query->row();
		}

		//Insert notes   return $this->db->insert('news', $data);
		public function insert_template($data){
			$this->db->insert('ci_templates', $data);
			$insert_id = $this->db->insert_id();
			return $insert_id;
		}

		//Update Notes table
		public function edit_template($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_templates', $data);
			return true;
		}


	}

?>