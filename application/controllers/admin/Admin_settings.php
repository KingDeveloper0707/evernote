<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_settings extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('admin/admin_settings_model', 'admin_settings_model');
		$this->load->model('activity_model','activity_model');
	}
	//-------------------------------------------------------------------------
	public function index(){
		if($this->input->post('submit')){
			$data = array(
				'username' => $this->input->post('username'),
				'firstname' => $this->input->post('firstname'),
				'position_title' => $this->input->post('position_title'),
				'email' => $this->input->post('email'),
				'company' => $this->input->post('company'),
				'expertise' => $this->input->post('expertise'),
				'bio' => $this->input->post('bio'),
				'updated_at' => date('Y-m-d H:i:s'),
			);
			$data = $this->security->xss_clean($data);
			$result = $this->admin_settings_model->update_user($data);
			if($result){

				// Add User Activity
				$this->activity_model->add(6);

				$this->session->set_flashdata('msg', 'Profile has been Updated Successfully!');
				redirect(base_url('admin/profile'), 'refresh');
			}
		}
		else{
			$id = $this->session->userdata('admin_id');

			$data['user'] = $this->admin_settings_model->get_user_detail();
			$data['counts'] = $this->admin_settings_model->get_my_counts_notes ();
			$data['title'] = 'User Profile';
			$data['view'] = 'admin/Admin_settings/Admin_settings';
			
			$this->load->view('layout', $data);
		}
	}

	//-------------------------------------------------------------------------
	public function change_pwd(){
		$id = $this->session->userdata('admin_id');
		if($this->input->post('submit')){
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('confirm_pwd', 'Confirm Password', 'trim|required|matches[password]');
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->admin_settings_model->get_user_detail();
				$data['view'] = 'admin/profile';
				$this->load->view('layout', $data);
			}
			else{
				$data = array(
					'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
				);
				$data = $this->security->xss_clean($data);
				$result = $this->admin_settings_model->change_pwd($data, $id);
				if($result){

					// Add User Activity
					$this->activity_model->add(7);

					$this->session->set_flashdata('msg', 'Password has been changed successfully!');
					redirect(base_url('admin/profile'));
				}
			}
		}
		else{
			$id = $this->session->userdata('admin_id');

			$data['user'] = $this->admin_settings_model->get_user_detail();
			$data['counts'] = $this->admin_settings_model->get_my_counts_notes_by_id ($id);
			$data['title'] = 'User Profile';
			$data['view'] = 'admin/profile';
			$this->load->view('layout', $data);
		}
	}


	public function datatable_json(){		
			
        
        $id = $this->session->userdata('admin_id');

        $records = $this->admin_settings_model->get_all_notes();

				$data = array();
				

				//get tags information
				$tags_info = $this->admin_settings_model->get_tags_info_by_id();
				$tags_array = array();
				$i= 0;
				foreach($tags_info as $row){
					$tags_array[$i] = array($row['id'], $row['tagname']);
					$i++;
				}


				foreach ($records as $row)
				{
					if ($row['subject'] == ""){
						$current_title = "Untitled";
					}else{
						$current_title = $row['subject'];
					}
					$tag_list = explode(",", $row['tags']);
					$tag_full_name = "";

					foreach ($tag_list as $v) { 
						foreach ($tags_array as $tag_data){
							if ($tag_data[0] == $v){
							  $tag_full_name .= '<div class="tag_list">'.$tag_data[1]. '</div>' ;

							}
						}
					}

					$user_name = $this->admin_settings_model->get_current_username($row['user_id']);
						if($user_name != null){
							$cur_user_name = $user_name->username;
						}else {
							$cur_user_name = "";
						}
					
						$title_class = "show_note_title";

						if ($row['is_active'] == 0)  
							$title_class = $title_class." inactive_title";

						$data[] = array(
                            '<input type="checkbox" class="chkclass"  value="'. $row['id'] .'">',
							'<div class="'.$title_class.'">'.$current_title.'</div>',							
							$row['created_at'],							
							$tag_full_name,
							$row['id'],
							$row['content'],
							$row['user_id'],
							$cur_user_name,
							$row['is_active'],
						);
					
						
				}

				$recods["data"] = $data;
			
				echo json_encode($recods);		
	}

	//-------------------------------------------------------------------------
	public function delete_notes(){
		$ids = $this->input->post('ids');
 
		$records = $this->admin_settings_model->del($ids);

		if ($records)
			echo json_encode(['success'=>"Item Deleted successfully."]);
	}

	//----Active/Inacitve Notes
	public function active_inactive_notes() {
		$id = $this->input->post('note_id');
		$active_val = $this->input->post('active_val');

		if ($active_val == 0 ){
			$data = array(
				'is_active' => 1,
			);
		}else {
			$data = array(
				'is_active' => 0,
			);
		}
		

		$edit = $this->admin_settings_model->active_inactive_notes($id, $data);
	}

	//---update notes
	public function update_notes () {
		//if($this->input->post('submit')){
			//$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
			//$this->form_validation->set_rules('content', 'Content', 'required');
			$this->form_validation->set_rules('curid', 'Curid', 'required');

			if ($this->form_validation->run() == FALSE) {
							
				$id = $this->session->userdata('admin_id');

				//get notes information
				$records = $this->notes_model->get_last_notes_by_id($id);
				//get user information
				$user_info = $this->notes_model->get_user_info_by_id($id);


				$data['title'] = 'My_Notes';
				$data['view'] = 'admin/my_notes/my_notes';
				$data['note_data'] = $records;
				$data['user_data'] = $user_info;
				$this->load->view('layout', $data);
			}
			else{
				
				$id = $this->session->userdata('admin_id');
				// Add User Activity
				$this->activity_model->add(1);

				//get tags information
				$tags_info = $this->admin_settings_model->get_tags_info_by_id();
				
				$i= 0;
				
				foreach($tags_info as $row){
					if ($row['tagname'] == $this->input->post('create_tag') ){
						$i = $row['id'];	
					}
				}

				$new_tag_id="";
				$send_tag_id = "";

				if ($i == 0){//new tag
					if ($this->input->post('create_tag') != "" ){
						$tag_data = array(
							'tagname' => $this->input->post('create_tag'),
							'created_at' => date('Y-m-d H:i:s'),
							'user_id' => $id,
						);	
						$new_tag_id = $this->admin_settings_model->insert_tags($tag_data);
						$send_tag_id = $new_tag_id;
					}
					
				}else{
					$new_tag_id = $i; //exsiting tag
				}
				
				$i=0;
				$current_tag_name = $this->admin_settings_model->get_current_tagname($this->input->post('curid'));
				$all_tags = "";
				$all_tags .= $current_tag_name->tags;
				if (strlen($all_tags) > 0){ //exsiting tag

					$tag_list = explode(",", $current_tag_name->tags);
					$same_tag = "";
					if(count($tag_list) > 0){
						foreach ($tag_list as $v) { 
						if($v == $new_tag_id){
							$same_tag = $v;
						}
						}
					}

					if(strlen($same_tag) > 0){
						//exsiting tag and inserted tag
					}else{
						if ($new_tag_id != "")
							$all_tags .= ",".$new_tag_id;
							$send_tag_id = $new_tag_id;
					}
					
				}else{
					//new first tag
					$all_tags .= $new_tag_id;
					$send_tag_id = $new_tag_id;
				}



				$data = array(
					'subject' => $this->input->post('subject'),
					'content' => $this->input->post('e_content'),
					'updated_at' => date('Y-m-d H:i:s'),
					'tags' =>$all_tags,
				);

				$this->admin_settings_model->edit_template($data, $this->input->post('curid'));
				


				//get tags information
				$all_tags_info = $this->admin_settings_model->get_tags_info_by_id();

				//get sending tag name
				$send_tag_name = "";
				foreach($all_tags_info as $row){
					if ($row['id'] == $send_tag_id ){
						$send_tag_name = $row['tagname'];	
					}
				}


				
				$send_data = array(
					'subject' => $this->input->post('subject'),
					'content' => $this->input->post('e_content'),
					'updated_at' => date('Y-m-d H:i:s'),
					'tags' =>$all_tags,
					'all_tag_list' => $all_tags_info,
					'new_tag_name' =>$send_tag_name,
				);
				
				
				echo json_encode($send_data);	
				//$this->session->set_flashdata('msg', 'Template has been updated successfully!');
				//redirect(base_url('admin/my_notes/update_notes'));
			}
		//}
		/*
		else{
				
			$id = $this->session->userdata('admin_id');

			//get notes information
			$records = $this->notes_model->get_last_notes_by_id($id);
			//get user information
			$user_info = $this->notes_model->get_user_info_by_id($id);


			$data['title'] = 'My_Notes';
			$data['view'] = 'admin/my_notes/my_notes';
			$data['note_data'] = $records;
			$data['user_data'] = $user_info;
			$this->load->view('layout', $data);
		}*/
	}
			

}

?>	