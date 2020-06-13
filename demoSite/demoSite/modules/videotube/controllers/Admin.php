<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("VideoTube/Video/Add")]
        public function add_media()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('VideoTubeMedia');
        }
        // [MenuItem ("VideoTube/Video/Show")]
        public function show_media()
        {
            $this->show_objects('VideoTubeMedia');
        }
        // [MenuItem ("VideoTube/Albums/Add")]
        public function add_album()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('VideoTubeAlbum');
        }
        // [MenuItem ("VideoTube/Albums/Show")]
        public function show_albums()
        {
            $this->show_objects('VideoTubeAlbum');
        }
		// [MenuItem ("VideoTube/User Profiles")]
		public function show_user_profiles()
		{
			$this->show_objects('VideoTubeUserSettings');
		}		
        // [MenuItem ("VideoTube/Reports/Video Reports")]
        public function show_video_reports()
        {
            $this->show_objects('VideoTubeVideoReport');
        }
		
        // [MenuItem ("VideoTube/Reports/Comment Reports")]
        public function show_comment_reports()
        {
            $this->show_objects('VideoTubeCommentReport');
        }
       
        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            if($_POST){
				if($object_type == 'VideoTubeAlbum'){
					if($_POST['image'] == ''){
						$_POST['image'] = base_url('builderengine/public/img/video_placeholder.png');
					}
				}
				if($object_type == 'VideoTubeMedia'){
				
					if($_POST['media_file'] == '')
						$_POST['media_file'] = $object->file;
					if(isset($_FILES['media_file']) && $_FILES['media_file']['error'] == 0){
						$allowed = array('mp4', 'avi', 'mpeg' , 'mpg');
						$extension = pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION);
						if(!in_array(strtolower($extension), $allowed)){
							redirect(base_url('admin/module/videotube/error/'.$object_type), 'location');
						}
						else{
							$user_id = $this->user->get_id();
							if(!is_dir("files/users"))
								mkdir("files/users");
							if(!is_dir("files/users/user_".$user_id))
								mkdir("files/users/user_".$user_id);
							 if(!is_dir("files/users/user_".$user_id."/videotube"))
								mkdir("files/users/user_".$user_id."/videotube");
							 if(!is_dir("files/users/user_".$user_id."/videotube/videos"))
								mkdir("files/users/user_".$user_id."/videotube/videos");
							$newUniqueFileName = md5(uniqid());
							$ext = pathinfo($_FILES['media_file']['name'], PATHINFO_EXTENSION);
							$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/videotube/videos/'.$newUniqueFileName.'.'.$ext;
							if(move_uploaded_file($_FILES['media_file']['tmp_name'], $newFileName)){
								$_POST['media_file'] = base_url().'files/users/user_'.$user_id.'/videotube/videos/'.$newUniqueFileName.'.'.$ext;
							}
						}
					}
					if(!isset($_POST['media_file']) || (isset($_POST['media_file']) && $_POST['file'] != ''))
						$_POST['media_file'] = $_POST['file'];
					$object->create($_POST);
					redirect(base_url('admin/module/videotube/show_objects/'.$object_type), 'location');
				}
				if($object_type == 'VideoTubeUserSettings'){
					$videotube_users = new VideoTubeUserSettings();
					foreach($videotube_users->get() as $videotube_user){
						if($videotube_user->user_id == $_POST['user_id']){
							redirect(base_url('admin/module/videotube/show_objects/'.$object_type), 'location');
						}
					}
					$object->create($_POST);
					redirect(base_url('admin/module/videotube/show_objects/'.$object_type), 'location');
				}
				else{
					$object->create($_POST);
					redirect(base_url('admin/module/videotube/show_objects/'.$object_type), 'location');
				}
            }
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = ucfirst($object_type);
			$data['current_page'] = 'videotube';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'VideoTubeAlbum'){
				$videos = new VideoTubeMedia();
				$videos = $videos->where('album_id',$object_id)->get();
				foreach($videos as $video){
					$comments = new VideoTubeComment();
					$comments = $comments->where('media_id',$video->id)->get();
					foreach($comments as $comment){
						$comment_reports = new VideoTubeCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$video_reports = new VideoTubeVideoReport();
					$video_reports = $video_reports->where('media_id',$video->id)->get();
					foreach($video_reports as $video_report){
						$video_report->delete();
					}
					$video_ratings = new VideoTubeRating();
					$video_ratings = $video_ratings->where('media_id',$video->id)->get();
					foreach($video_ratings as $video_rating){
						$video_rating->delete();
					}
					$video_likes = new VideoTubeLike();
					$video_likes = $video_likes->where('media_id',$video->id)->get();
					foreach($video_likes as $video_like){
						$video_like->delete();
					}
					$video->delete();
				}
			}
			if($object_type == 'VideoTubeMedia'){
				foreach($object as $video){
					$comments = new VideoTubeComment();
					$comments = $comments->where('media_id',$video->id)->get();
					foreach($comments as $comment){
						$comment_reports = new VideoTubeCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$video_reports = new VideoTubeVideoReport();
					$video_reports = $video_reports->where('media_id',$video->id)->get();
					foreach($video_reports as $video_report){
						$video_report->delete();
					}
					$video_ratings = new VideoTubeRating();
					$video_ratings = $video_ratings->where('media_id',$video->id)->get();
					foreach($video_ratings as $video_rating){
						$video_rating->delete();
					}
					$video_likes = new VideoTubeLike();
					$video_likes = $video_likes->where('media_id',$video->id)->get();
					foreach($video_likes as $video_like){
						$video_like->delete();
					}
				}			
			}
			if($object_type == 'VideoTubeUserSettings'){
				$this->user->require_group("Administrators");
				$this->load->model('users');
				if($object_id != 'revoke'.$object_id){
					$obj = $this->get_object($object_type,$object_id);
					$this->users->delete($obj->user_id);
					$this->db->delete('link_groups_users', array('user_id' => $obj->user_id));
				}
				if(strpos($object_id,'revoke') !== false){
					$object->id = str_replace('revoke','',$object_id);
				}
			}
            $object->delete();
            redirect(base_url('admin/module/videotube/show_objects/'.$object_type), 'location');
        }

		public function bulk_delete($object_type,$view)
		{
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'VideoTubeAlbum'){
						$videos = new VideoTubeMedia();
						$videos = $videos->where('album_id',$id)->get();
						foreach($videos as $video){
							$comments = new VideoTubeComment();
							$comments = $comments->where('media_id',$video->id)->get();
							foreach($comments as $comment){
								$comment_reports = new VideoTubeCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$video_reports = new VideoTubeVideoReport();
							$video_reports = $video_reports->where('media_id',$video->id)->get();
							foreach($video_reports as $video_report){
								$video_report->delete();
							}
							$video_ratings = new VideoTubeRating();
							$video_ratings = $video_ratings->where('media_id',$video->id)->get();
							foreach($video_ratings as $video_rating){
								$video_rating->delete();
							}
							$video_likes = new VideoTubeLike();
							$video_likes = $video_likes->where('media_id',$video->id)->get();
							foreach($video_likes as $video_like){
								$video_like->delete();
							}
							$video->delete();
						}
					}
					if($object_type == 'VideoTubeMedia'){
						foreach($object as $video){
							$comments = new VideoTubeComment();
							$comments = $comments->where('media_id',$video->id)->get();
							foreach($comments as $comment){
								$comment_reports = new VideoTubeCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$video_reports = new VideoTubeVideoReport();
							$video_reports = $video_reports->where('media_id',$video->id)->get();
							foreach($video_reports as $video_report){
								$video_report->delete();
							}
							$video_ratings = new VideoTubeRating();
							$video_ratings = $video_ratings->where('media_id',$video->id)->get();
							foreach($video_ratings as $video_rating){
								$video_rating->delete();
							}
							$video_likes = new VideoTubeLike();
							$video_likes = $video_likes->where('media_id',$video->id)->get();
							foreach($video_likes as $video_like){
								$video_like->delete();
							}
						}			
					}
					if($object_type == 'VideoTubeUserSettings'){
						$this->user->require_group("Administrators");
						$this->load->model('users');
						if($object_id != 'revoke'.$object_id){
							$obj = $this->get_object($object_type,$id);
							$this->users->delete($obj->user_id);
							$this->db->delete('link_groups_users', array('user_id' => $obj->user_id));
						}
						if(strpos($object_id,'revoke') !== false){
							$object->id = str_replace('revoke','',$id);
						}
					}
					$object->delete();
				}
				redirect(base_url('admin/module/videotube/'.$view),'location');
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
			$data['current_page'] = 'videotube';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }
        // [MenuItem ("VideoTube/Settings")]
        public function settings()
        {
			if($_POST)
			{
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['videotube_terms'];
				if(strpos($link, $protocol) !== false)
					$this->BuilderEngine->set_option('videotube_terms', $link);
				else
					$this->BuilderEngine->set_option('videotube_terms', $protocol.$link);
				$this->BuilderEngine->set_option('videotube_active', $this->input->post('videotube_active', true));
				$this->BuilderEngine->set_option('videotube_option', $this->input->post('videotube_option', true));
				$this->BuilderEngine->set_option('videotube_allow_ratings', $this->input->post('videotube_allow_ratings', true));
				$this->BuilderEngine->set_option('videotube_allow_comments', $this->input->post('videotube_allow_comments', true));
				$this->BuilderEngine->set_option('videotube_comments_private', $this->input->post('videotube_comments_private', true));
				$this->BuilderEngine->set_option('videotube_show_tags', $this->input->post('videotube_show_tags', true));
                //$this->BuilderEngine->set_option('videotube_num_tags_displayed', $this->input->post('videotube_num_tags_displayed', true));
				//$this->BuilderEngine->set_option('videotube_medias_per_page', $this->input->post('videotube_medias_per_page', true));
                //$this->BuilderEngine->set_option('videotube_num_recent_medias_displayed', $this->input->post('videotube_num_recent_medias_displayed', true));
				//$this->BuilderEngine->set_option('videotube_num_medias_displayed', $this->input->post('videotube_num_medias_displayed', true));
				$this->BuilderEngine->set_option('videotube_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('videotube_register_info', $this->input->post('register_info', true));
				$this->BuilderEngine->set_option('videotube_login_info', $this->input->post('login_info', true));

			}
			$data['current_page'] = 'videotube';
			$data['current_child_page'] = 'settings';
			$this->load->view('backend/videotube_settings',$data);	
        }

        public function delete_comment($id)
        {
            $comment = new VideoTubeComment($id);
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
            $comment_report = new VideoTubeCommentReport($id);
            $comment_report->delete();
            $this->show_comment_reports();
        }
        public function delete_video($id)
        {
            $video = new VideoTubeMedia($id);
            $video_reports = $video->report->get();
            foreach ($video_reports as $video_report)
            {
                $video_report->delete();
            }
            $video->delete();
			$this->show_video_reports();
        }
        public function delete_video_report($id)
        {
            $comment_report = new VideoTubeVideoReport($id);
            $comment_report->delete();
            $this->show_video_reports();
        }
		public function register_admin($id)
		{
			$user_settings = new VideoTubeUserSettings();
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
			$user_settings = new VideoTubeUserSettings();
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
            $this->modify_object('VideoTubeUserSettings');
        }
		public function clean_up_user_list()
		{
			$video_users = new VideoTubeUserSettings();
			foreach($video_users->get() as $video_user){
				$user = new User($video_user->user_id);
				if($user->id != $video_user->user_id){
				$video_user->delete();
				}
			}
			
			$this->show_user_profiles();
		}
    }
?>