<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("Audio Player/Audio/Add")]
        public function add_media()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('AudioPlayerMedia');
        }
        // [MenuItem ("Audio Player/Audio/Show")]
        public function show_media()
        {
            $this->show_objects('AudioPlayerMedia');
        }
        // [MenuItem ("Audio Player/Albums/Add")]
        public function add_album()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('AudioPlayerAlbum');
        }
        // [MenuItem ("Audio Player/Albums/Show")]
        public function show_albums()
        {
            $this->show_objects('AudioPlayerAlbum');
        }
		// [MenuItem ("Audio Player/User Profiles")]
		public function show_user_profiles()
		{
			$this->show_objects('AudioPlayerUserSettings');
		}
        // [MenuItem ("Audio Player/Reports/Audio Reports")]
        public function show_sound_reports()
        {
            $this->show_objects('AudioPlayerSoundReport');
        }
		
        // [MenuItem ("Audio Player/Reports/Comment Reports")]
        public function show_comment_reports()
        {
            $this->show_objects('AudioPlayerCommentReport');
        }
       
        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            if($_POST){
				if($object_type == 'AudioPlayerAlbum'){
					if($_POST['image'] == ''){
						$_POST['image'] = base_url('modules/audioplayer/assets/images/audio_placeholder.png');
					}
				}
				if($object_type == 'AudioPlayerMedia'){
					if($_POST['media_file'] == '')
						$_POST['media_file'] = $object->file;
					if(isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0){
						$allowed = array('mp3', 'mpeg', 'ogg');
						$extension = pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION);
						if(!in_array(strtolower($extension), $allowed)){
							redirect(base_url('admin/module/audioplayer/error/'.$object_type), 'location');
						}
						else{
							if(move_uploaded_file($_FILES['media_file']['tmp_name'], $this->session->userdata('user_dir').'/'.$_FILES['media_file']['name'])){
								$_POST['media_file'] = $this->session->userdata('user_url').'/'.$_FILES['media_file']['name'];
							}
						}
					}
					if($_POST['cover'] == '')
						$_POST['cover'] = $object->cover;
					if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0){
						$allowed = array('jpg', 'jpeg', 'png');
						$extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
						if(!in_array(strtolower($extension), $allowed)){
							redirect(base_url('admin/module/audioplayer/error/'.$object_type), 'location');
						}
						else{
							if(move_uploaded_file($_FILES['cover']['tmp_name'], $this->session->userdata('user_dir').'/'.$_FILES['cover']['name'])){
								$_POST['cover'] = $this->session->userdata('user_url').'/'.$_FILES['cover']['name'];
							}
						}
					}
					else
						$_POST['cover'] = base_url('modules/audioplayer/assets/images/audio_placeholder.png');
				}
                $object->create($_POST);
                redirect(base_url('/index.php/admin/module/audioplayer/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = ucfirst($object_type);
			$data['current_page'] = 'audioplayer';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'AudioPlayerAlbum'){
				$sounds = new AudioPlayerMedia();
				$sounds = $sounds->where('album_id',$object_id)->get();
				foreach($sounds as $sound){
					$comments = new AudioPlayerComment();
					$comments = $comments->where('media_id',$sound->id)->get();
					foreach($comments as $comment){
						$comment_reports = new AudioPlayerCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$sound_reports = new AudioPlayerSoundReport();
					$sound_reports = $sound_reports->where('media_id',$sound->id)->get();
					foreach($sound_reports as $sound_report){
						$sound_report->delete();
					}
					$sound_ratings = new AudioPlayerRating();
					$sound_ratings = $sound_ratings->where('media_id',$sound->id)->get();
					foreach($sound_ratings as $sound_rating){
						$sound_rating->delete();
					}
					$sound_likes = new AudioPlayerLike();
					$sound_likes = $sound_likes->where('media_id',$sound->id)->get();
					foreach($sound_likes as $sound_like){
						$sound_like->delete();
					}
					$sound->delete();
				}
			}
			if($object_type == 'AudioPlayerMedia'){
				foreach($object as $sound){
					$comments = new AudioPlayerComment();
					$comments = $comments->where('media_id',$sound->id)->get();
					foreach($comments as $comment){
						$comment_reports = new AudioPlayerCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$sound_reports = new AudioPlayerSoundReport();
					$sound_reports = $sound_reports->where('media_id',$sound->id)->get();
					foreach($sound_reports as $sound_report){
						$sound_report->delete();
					}
					$sound_ratings = new AudioPlayerRating();
					$sound_ratings = $sound_ratings->where('media_id',$sound->id)->get();
					foreach($sound_ratings as $sound_rating){
						$sound_rating->delete();
					}
					$sound_likes = new AudioPlayerLike();
					$sound_likes = $sound_likes->where('media_id',$sound->id)->get();
					foreach($sound_likes as $sound_like){
						$sound_like->delete();
					}
				}			
			}
			if($object_type == 'AudioPlayerUserSettings'){
				$this->user->require_group("Administrators");
				$this->load->model('users');
				$obj = $this->get_object($object_type,$object_id);
				$this->users->delete($obj->user_id);
				$this->db->delete('link_groups_users', array('user_id' => $obj->user_id));				
			}
            $object->delete();
            redirect(base_url('/index.php/admin/module/audioplayer/show_objects/'.$object_type), 'location');
        }

        public function bulk_delete($object_type,$view)
        {
			if(!$object_type || !$view)
				show_404();
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'AudioPlayerAlbum'){
						$sounds = new AudioPlayerMedia();
						$sounds = $sounds->where('album_id',$id)->get();
						foreach($sounds as $sound){
							$comments = new AudioPlayerComment();
							$comments = $comments->where('media_id',$sound->id)->get();
							foreach($comments as $comment){
								$comment_reports = new AudioPlayerCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$sound_reports = new AudioPlayerSoundReport();
							$sound_reports = $sound_reports->where('media_id',$sound->id)->get();
							foreach($sound_reports as $sound_report){
								$sound_report->delete();
							}
							$sound_ratings = new AudioPlayerRating();
							$sound_ratings = $sound_ratings->where('media_id',$sound->id)->get();
							foreach($sound_ratings as $sound_rating){
								$sound_rating->delete();
							}
							$sound_likes = new AudioPlayerLike();
							$sound_likes = $sound_likes->where('media_id',$sound->id)->get();
							foreach($sound_likes as $sound_like){
								$sound_like->delete();
							}
							$sound->delete();
						}
					}
					if($object_type == 'AudioPlayerMedia'){
						foreach($object as $sound){
							$comments = new AudioPlayerComment();
							$comments = $comments->where('media_id',$sound->id)->get();
							foreach($comments as $comment){
								$comment_reports = new AudioPlayerCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$sound_reports = new AudioPlayerSoundReport();
							$sound_reports = $sound_reports->where('media_id',$sound->id)->get();
							foreach($sound_reports as $sound_report){
								$sound_report->delete();
							}
							$sound_ratings = new AudioPlayerRating();
							$sound_ratings = $sound_ratings->where('media_id',$sound->id)->get();
							foreach($sound_ratings as $sound_rating){
								$sound_rating->delete();
							}
							$sound_likes = new AudioPlayerLike();
							$sound_likes = $sound_likes->where('media_id',$sound->id)->get();
							foreach($sound_likes as $sound_like){
								$sound_like->delete();
							}
						}			
					}
					if($object_type == 'AudioPlayerUserSettings'){
						$this->user->require_group("Administrators");
						$this->load->model('users');
						$obj = $this->get_object($object_type,$id);
						$this->users->delete($obj->user_id);
						$this->db->delete('link_groups_users', array('user_id' => $obj->user_id));				
					}
					$object->delete();
				}
				redirect(base_url('admin/module/audioplayer/'.$view), 'location');
			}
        }

        public function get_object($object_type, $object_id = -1, $get = false)
        {
            $this->load->model($object_type);
            $object = new $object_type($object_id);

            if($get == true)
                return $object->get();
            else
                return $object;
        }

        public function get_view($object_type, $object_id = -1)
        {
            $view_name = 'add_'.$object_type;

            if($object_id == -1)
                $data['page'] = 'Add';
            else
                $data['page'] = 'Edit';

            $data['object'] = $this->get_object($object_type, $object_id);
            $view = $this->load->view('backend/'.$view_name, $data, true);
            return $view;
        }

        public function show_objects($object_type)
        {

            $user = new users();
            $group_id = $user->get_user_group_ids(get_active_user_id());

            $data['objects'] = $this->get_object($object_type, '', true);
			$data['current_page'] = 'audioplayer';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }
        // [MenuItem ("Audio Player/Settings")]
        public function settings()
        {
			if($_POST)
			{
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['audioplayer_terms'];
				if(strpos($link, $protocol) !== false)
					$this->BuilderEngine->set_option('audioplayer_terms', $link);
				else
					$this->BuilderEngine->set_option('audioplayer_terms', $protocol.$link);
				$this->BuilderEngine->set_option('audioplayer_active', $this->input->post('audioplayer_active', true));
				$this->BuilderEngine->set_option('audioplayer_option', $this->input->post('audioplayer_option', true));
				$this->BuilderEngine->set_option('audioplayer_allow_ratings', $this->input->post('audioplayer_allow_ratings', true));
				$this->BuilderEngine->set_option('audioplayer_allow_comments', $this->input->post('audioplayer_allow_comments', true));
				$this->BuilderEngine->set_option('audioplayer_comments_private', $this->input->post('audioplayer_comments_private', true));
				$this->BuilderEngine->set_option('audioplayer_show_tags', $this->input->post('audioplayer_show_tags', true));
                //$this->BuilderEngine->set_option('audioplayer_num_tags_displayed', $this->input->post('audioplayer_num_tags_displayed', true));
			    //$this->BuilderEngine->set_option('audioplayer_medias_per_page', $this->input->post('audioplayer_medias_per_page', true));
                //$this->BuilderEngine->set_option('audioplayer_num_recent_medias_displayed', $this->input->post('audioplayer_num_recent_medias_displayed', true));
			    //$this->BuilderEngine->set_option('audioplayer_num_medias_displayed', $this->input->post('audioplayer_num_medias_displayed', true));
				$this->BuilderEngine->set_option('audioplayer_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('audioplayer_register_info', $this->input->post('register_info', true));
				$this->BuilderEngine->set_option('audioplayer_login_info', $this->input->post('login_info', true));

			}
			$data['current_page'] = 'audioplayer';
			$data['current_child_page'] = 'settings';
			$this->load->view('backend/audioplayer_settings',$data);	
        }

        public function delete_comment($id)
        {
            $comment = new AudioPlayerComment($id);
            $comment_reports = $comment->report->get();
            foreach ($comment_reports as $comment_report)
            {
                $comment_report->delete();
            }
            $comment->delete();
			$this->show_comment_reports();
        }
        public function delete_report($id)
        {
            $comment_report = new AudioPlayerCommentReport($id);
            $comment_report->delete();
            $this->show_comment_reports();
        }
        public function delete_sound($id)
        {
            $sound = new AudioPlayerMedia($id);
            $sound_reports = $sound->report->get();
            foreach ($sound_reports as $sound_report)
            {
                $sound_report->delete();
            }
            $sound->delete();
			$this->show_sound_reports();
        }
        public function delete_sound_report($id)
        {
            $comment_report = new AudioPlayerSoundReport($id);
            $comment_report->delete();
            $this->show_sound_reports();
        }
		public function register_admin($id)
		{
			$user_settings = new AudioPlayerUserSettings();
			$new_user_settings = $user_settings->where('user_id',$id)->get();
			if(!$new_user_settings->exists()){
				$settings = array(
					'user_id' => $id,
					'about' => '',
					'background_img' => '',
				);
				$user_settings->create($settings);
			}
			$this->add_album();
		}
		
		public function check_admin($id)
		{
			$user_settings = new AudioPlayerUserSettings();
			$new_user_settings = $user_settings->where('user_id',$id)->get();
			
			if(!$new_user_settings->exists()){
				$settings = array(
					'user_id' => $id,
					'about' => '',
					'background_img' => '',
				);
				$user_settings->create($settings);
			}
		}

		public function error($object_type)
		{
			$data['title'] = ucfirst($object_type);
			$this->load->view('backend/error',$data);
		}
        public function approve_user()
        {
            $this->modify_object('AudioPlayerUserSettings');
        }

		public function clean_up_user_list()
		{
			$sound_users = new AudioPlayerUserSettings();
			foreach($sound_users->get() as $sound_user){
				$user = new User($sound_user->user_id);
				if($user->id != $sound_user->user_id){
				$sound_user->delete();
				}
			}
			
			$this->show_user_profiles();
		}

		public function revoke_access($user_id)
		{
			$this->load->model('users');
			$this->users->revoke_module_access($user_id,'AudioPlayerUserSettings');
			redirect(base_url('admin/module/audioplayer/show_user_profiles'),'location');
		}
    }
?>