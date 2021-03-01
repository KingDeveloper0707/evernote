<?php
	class Media_model extends CI_Model{
		public function add_media($data){
			$this->db->insert('ci_media', $data);
			$insert_id = $this->db->insert_id();
			return  $insert_id;
		}
		
		public function get_media_photos($request_id){
			$query = $this->db->get_where('ci_media', array('request_id' => $request_id, 'type' => 1));
			return $result = $query->result_array();
		}

		public function get_media_receipt($request_id){
			$query = $this->db->get_where('ci_media', array('request_id' => $request_id, 'type' => 2));
			return $result = $query->row_array();
		}
		
	}

?>