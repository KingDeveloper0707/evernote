<?php
	class Template_model extends CI_Model{
		//---------------------------------------------------
		// Get user detial by ID
		public function get_template($id){
			$query = $this->db->get_where('ci_templates', array('id' => $id));
			return $result = $query->row_array();
		}
		//---------------------------------------------------
		// Edit user Record
		public function edit_template($data, $id){
			$this->db->where('id', $id);
			$this->db->update('ci_templates', $data);
			return true;
		}

	}

?>