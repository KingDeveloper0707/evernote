
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


				$data['title'] = 'My_Notes';
				$data['view'] = 'admin/my_notes/my_notes';
				$data['note_data'] = $records;
				$data['user_data'] = $user_info;
				$this->load->view('layout', $data);
			}
			//-----------------------------------------------------------------------
			public function datatable_json(){		
				$id = $this->session->userdata('admin_id');

				$records = $this->notes_model->get_all_notes_by_id($id);

				$data = array();
				$i = 0;

				foreach ($records as $row)
				{
					if ($row['subject'] == ""){
						$current_title = "Untitled";
					}else{
						$current_title = $row['subject'];
					}
					

						$data[] = array(
							'<div class="show_create_date">'.$row['created_at'].'</div><div class="show_note_title">'.$current_title.'</div>',
							
							$row['created_at'],
							$row['updated_at'],
							$row['tags'],
							$row['id'],
							$row['content'],
							$row['user_id'],
							$row['tags'],
						);
					
						
				}

				$recods["data"] = $data;
			
				echo json_encode($recods);						   
			}


			//---update notes
			public function update_notes () {
				if($this->input->post('submit')){
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
						$data = array(
							'subject' => $this->input->post('subject'),
							'content' => $this->input->post('content'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						// Add User Activity
						$this->activity_model->add(1);
						$this->notes_model->edit_template($data, $this->input->post('curid'));
	
						$this->session->set_flashdata('msg', 'Template has been updated successfully!');
						redirect(base_url('admin/my_notes/update_notes'));
					}
				}
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
				}
			}
		

			//---Create notes
			public function create_notes () {
				if($this->input->post('submit')){
					
					$id = $this->session->userdata('admin_id');

					
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
						$this->notes_model->insert_template($data);
	
						$this->session->set_flashdata('msg', 'Template has been updated successfully!');
						redirect(base_url('admin/my_notes/update_notes'));
					
					}
			}
	
		
	}
?>