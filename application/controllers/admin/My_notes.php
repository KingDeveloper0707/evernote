
<?php defined('BASEPATH') OR exit('No direct script access allowed');
	class My_notes extends MY_Controller {
		public function __construct(){
				parent::__construct();
				$this->load->model('admin/notes_model','notes_model');
				$this->load->model('activity_model','activity_model');
				$this->load->library('datatable'); // loaded my custom serverside datatable library
			}
			//-----------------------------------------------------------------------
			public function index(){
				$id = $this->session->userdata('admin_id');

				//get notes information
				
				$records = $this->notes_model->get_last_notes_by_id($id);
				
					
				//get user information
				$user_info = $this->notes_model->get_user_info_by_id($id);

				//get tags information
				$tags_info = $this->notes_model->get_tags_info_by_id();
				$tags_array = array();
				$i= 0;
				foreach($tags_info as $row){
					$tags_array[$i] = array($row['id'], $row['tagname']);
					$i++;
				}

				$data['title'] = 'My_Notes';
				$data['view'] = 'admin/my_notes/my_notes';
				$data['note_data'] = $records;
				$data['user_data'] = $user_info;
				$data['tags_data'] = $tags_array;
				$this->load->view('layout', $data);
			}
			//-----------------------------------------------------------------------
			public function datatable_json(){		
				$id = $this->session->userdata('admin_id');

				$records = $this->notes_model->get_all_notes_by_id($id);

				$data = array();
				

				//get tags information
				$tags_info = $this->notes_model->get_tags_info_by_id();
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

						$data[] = array(
							'<div class="show_create_date">'.$row['created_at'].'</div><div class="show_note_title">'.$current_title.'</div>',
							
							$row['created_at'],
							$row['updated_at'],
							$tag_full_name,
							$row['id'],
							$row['content'],
							$row['user_id'],
							$tag_full_name,
						);
					
						
				}

				$recods["data"] = $data;
			
				echo json_encode($recods);						   
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
						$tags_info = $this->notes_model->get_tags_info_by_id();
						$tags_array = array();
						$i= 0;
						foreach($tags_info as $row){
							if ($row['tagname'] == $this->input->post('create_tag') )
								$i = $row['id'];					
							
						}

						if ($i == 0){
							$tag_data = array(
								'tagname' => $this->input->post('create_tag'),
								'created_at' => date('Y-m-d H:i:s'),
								'user_id' => $id,
							);	
							$new_tag_id = $this->notes_model->insert_tags($tag_data);
						}else{
							$new_tag_id = $i;
						}
						
						$i=0;
						$current_tag_name = $this->notes_model->get_current_tagname($this->input->post('curid'));
						$all_tags = "";
						$all_tags .= $current_tag_name->tags;
						if (strlen($all_tags) > 0){

							$tag_list = explode(",", $current_tag_name->tags);
							$same_tag = "";
                            if(count($tag_list) > 1){
                              foreach ($tag_list as $v) { 
								if($v == $new_tag_id){
									$same_tag = $v;
								}
							  }
							}

							if(strlen($same_tag) > 0){

							}else{
								$all_tags .= ",".$new_tag_id;
							}
							
						}else{
							$all_tags .= $new_tag_id;
						}



						$data = array(
							'subject' => $this->input->post('subject'),
							'content' => $this->input->post('content'),
							'updated_at' => date('Y-m-d H:i:s'),
							'tags' =>$all_tags,
						);

						$this->notes_model->edit_template($data, $this->input->post('curid'));
	

						echo json_encode($tag_data);	
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
		

			//---Create notes
			public function create_notes () {
				//if($this->input->post('submit')){
					
					$id = $this->session->userdata('admin_id');
					$username = $this->session->userdata('username');
					
						$data = array(
							'subject' => "",
							'content' => "",
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'user_id' => $id,
							'tags' => "",
							'is_active' => 1,

						);
						// Add User Activity
						$this->activity_model->add(1);
						$inputed_id = $this->notes_model->insert_template($data);
	
						$send_data = array(
							'subject' => "",
							'content' => "",
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
							'user_id' => $id,
							'tags' => "",
							'is_active' => 1,
							'current_id' => $inputed_id,
							'user_name' => $username,
							
						);

						echo json_encode($send_data);	
						//$this->session->set_flashdata('msg', 'Template has been updated successfully!');
						//redirect(base_url('admin/my_notes/update_notes'));
					
				//}
			}
	
		
	}
?>