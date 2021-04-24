<?php
	class Admin_model extends CI_Model{

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
		public function get_all_notes_by_id($id){
			
			$array = array('user_id' => $id, 'is_active' => 1);
			$this->db->where($array);
			$this->db->order_by('created_at', 'DESC');
			$query = $this->db->get('ci_templates');
			return $result = $query->result_array();
		}

		//get my notes counts 
		public function get_my_counts_notes_by_id($id){
			
			$array = array('user_id' => $id, 'is_active' => 1);
			$this->db->where($array);
			$this->db->order_by('created_at', 'DESC');			
			$counts = $this->db->count_all_results('ci_templates');
			return $counts;
		}


		//Delete Notes
		public function del($ids){
			
			$this->db->where_in('id', explode(",", $ids));
			$this->db->delete('ci_templates');

			return true;
	 
			

			//$this->session->set_flashdata('msg', 'Notes has been deleted successfully!');
			//redirect(base_url('admin/users'));
		}


	}

?>