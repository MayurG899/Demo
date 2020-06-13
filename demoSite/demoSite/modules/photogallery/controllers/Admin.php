<?php
    class Admin extends BE_Controller
    {
        // [MenuItem ("Photo Gallery/Photo/Add")]
        public function add_media()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('PhotoGalleryMedia');
        }
        // [MenuItem ("Photo Gallery/Photo/Show")]
        public function show_media()
        {
            $this->show_objects('PhotoGalleryMedia');
        }
        // [MenuItem ("Photo Gallery/Albums/Add")]
        public function add_album()
        {
			$this->check_admin($this->user->get_id());
            $this->modify_object('PhotoGalleryAlbum');
        }
        // [MenuItem ("Photo Gallery/Albums/Show")]
        public function show_albums()
        {
            $this->show_objects('PhotoGalleryAlbum');
        }
		// [MenuItem ("Photo Gallery/User Profiles")]
		public function show_user_profiles()
		{
			$this->show_objects('PhotoGalleryUserSettings');
		}
        // [MenuItem ("Photo Gallery/Reports/Photo Reports")]
        public function show_photo_reports()
        {
            $this->show_objects('PhotoGalleryPhotoReport');
        }
		
        // [MenuItem ("Photo Gallery/Reports/Comment Reports")]
        public function show_comment_reports()
        {
            $this->show_objects('PhotoGalleryCommentReport');
        }
       
        public function modify_object($object_type, $object_id = -1)
        {
            $object = $this->get_object($object_type, $object_id);
            
            if($_POST)
            {
				if($object_type == 'PhotoGalleryAlbum'){
					if($_POST['image'] == ''){
						$_POST['image'] = base_url('builderengine/public/img/photo_placeholder.png');
					}
				}
				if($object_type == 'PhotoGalleryMedia'){
					if($_POST['media_file'] == ''){
						$_POST['media_file'] = base_url('builderengine/public/img/photo_placeholder.png');
					}
				}
                $object->create($_POST);
                redirect(base_url('admin/module/photogallery/show_objects/'.$object_type), 'location');
            }
            
            $data['view'] = $this->get_view($object_type,  $object_id);
            $data['title'] = ucfirst($object_type);
			$data['current_page'] = 'photogallery';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/modify_object', $data);
        }

        public function delete_object($object_type, $object_id)
        {
            $object = $this->get_object($object_type, $object_id);
			if($object_type == 'PhotoGalleryAlbum'){
				$photos = new PhotoGalleryMedia();
				$photos = $photos->where('album_id',$object_id)->get();
				foreach($photos as $photo){
					$comments = new PhotoGalleryComment();
					$comments = $comments->where('media_id',$photo->id)->get();
					foreach($comments as $comment){
						$comment_reports = new PhotoGalleryCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$photo_reports = new PhotoGalleryPhotoReport();
					$photo_reports = $photo_reports->where('media_id',$photo->id)->get();
					foreach($photo_reports as $photo_report){
						$photo_report->delete();
					}
					$photo_ratings = new PhotoGalleryRating();
					$photo_ratings = $photo_ratings->where('media_id',$photo->id)->get();
					foreach($photo_ratings as $photo_rating){
						$photo_rating->delete();
					}
					$photo_likes = new PhotoGalleryLike();
					$photo_likes = $photo_likes->where('media_id',$photo->id)->get();
					foreach($photo_likes as $photo_like){
						$photo_like->delete();
					}
					$photo->delete();
				}
			}
			if($object_type == 'PhotoGalleryMedia'){
				foreach($object as $photo){
					$comments = new PhotoGalleryComment();
					$comments = $comments->where('media_id',$photo->id)->get();
					foreach($comments as $comment){
						$comment_reports = new PhotoGalleryCommentReport();
						$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
						foreach($comment_reports as $comment_report){
							$comment_report->delete();
						}
						$comment->delete();
					}
					$photo_reports = new PhotoGalleryPhotoReport();
					$photo_reports = $photo_reports->where('media_id',$photo->id)->get();
					foreach($photo_reports as $photo_report){
						$photo_report->delete();
					}
					$photo_ratings = new PhotoGalleryRating();
					$photo_ratings = $photo_ratings->where('media_id',$photo->id)->get();
					foreach($photo_ratings as $photo_rating){
						$photo_rating->delete();
					}
					$photo_likes = new PhotoGalleryLike();
					$photo_likes = $photo_likes->where('media_id',$photo->id)->get();
					foreach($photo_likes as $photo_like){
						$photo_like->delete();
					}
				}			
			}
			if($object_type == 'PhotoGalleryUserSettings'){
				$this->user->require_group("Administrators");
				$this->load->model('users');
				$obj = $this->get_object($object_type,$object_id);
				$this->users->delete($obj->user_id);
				$this->db->delete('link_groups_users', array('user_id' => $obj->user_id));				
			}
            $object->delete();
            redirect(base_url('admin/module/photogallery/show_objects/'.$object_type), 'location');
        }

		public function bulk_delete($object_type,$view)
		{
			if($_POST){
				foreach($_POST['id'] as $id){
					$object = new $object_type($id);
					if($object_type == 'PhotoGalleryAlbum'){
						$photos = new PhotoGalleryMedia();
						$photos = $photos->where('album_id',$id)->get();
						foreach($photos as $photo){
							$comments = new PhotoGalleryComment();
							$comments = $comments->where('media_id',$photo->id)->get();
							foreach($comments as $comment){
								$comment_reports = new PhotoGalleryCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$photo_reports = new PhotoGalleryPhotoReport();
							$photo_reports = $photo_reports->where('media_id',$photo->id)->get();
							foreach($photo_reports as $photo_report){
								$photo_report->delete();
							}
							$photo_ratings = new PhotoGalleryRating();
							$photo_ratings = $photo_ratings->where('media_id',$photo->id)->get();
							foreach($photo_ratings as $photo_rating){
								$photo_rating->delete();
							}
							$photo_likes = new PhotoGalleryLike();
							$photo_likes = $photo_likes->where('media_id',$photo->id)->get();
							foreach($photo_likes as $photo_like){
								$photo_like->delete();
							}
							$photo->delete();
						}
					}
					if($object_type == 'PhotoGalleryMedia'){
						foreach($object as $photo){
							$comments = new PhotoGalleryComment();
							$comments = $comments->where('media_id',$photo->id)->get();
							foreach($comments as $comment){
								$comment_reports = new PhotoGalleryCommentReport();
								$comment_reports = $comment_reports->where('comment_id',$comment->id)->get();
								foreach($comment_reports as $comment_report){
									$comment_report->delete();
								}
								$comment->delete();
							}
							$photo_reports = new PhotoGalleryPhotoReport();
							$photo_reports = $photo_reports->where('media_id',$photo->id)->get();
							foreach($photo_reports as $photo_report){
								$photo_report->delete();
							}
							$photo_ratings = new PhotoGalleryRating();
							$photo_ratings = $photo_ratings->where('media_id',$photo->id)->get();
							foreach($photo_ratings as $photo_rating){
								$photo_rating->delete();
							}
							$photo_likes = new PhotoGalleryLike();
							$photo_likes = $photo_likes->where('media_id',$photo->id)->get();
							foreach($photo_likes as $photo_like){
								$photo_like->delete();
							}
						}
					}
					if($object_type == 'PhotoGalleryUserSettings'){
						$this->user->require_group("Administrators");
						$this->load->model('users');
						$this->users->delete($object->user_id);
						$this->db->delete('link_groups_users', array('user_id' => $object->user_id));				
					}
					$object->delete();
				}
				redirect(base_url('admin/module/photogallery/'.$view), 'location');
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
			$data['current_page'] = 'photogallery';
			$data['current_child_page'] = $object_type;
            $this->load->view('backend/show_'.$object_type.'_objects', $data);
        }
        // [MenuItem ("Photo Gallery/Settings")]
        public function settings()
        {
			if($_POST)
			{
				$protocol = strtolower(substr($_SERVER['SERVER_PROTOCOL'],0,strrpos($_SERVER['SERVER_PROTOCOL'],'/'))).'://';
				$link = $_POST['photogallery_terms'];
				if(strpos($link, $protocol) !== false)
					$this->BuilderEngine->set_option('photogallery_terms', $link);
				else
					$this->BuilderEngine->set_option('photogallery_terms', $protocol.$link);
				$this->BuilderEngine->set_option('photogallery_active', $this->input->post('photogallery_active', true));
				$this->BuilderEngine->set_option('photogallery_option', $this->input->post('photogallery_option', true));
				$this->BuilderEngine->set_option('photogallery_allow_ratings', $this->input->post('photogallery_allow_ratings', true));
				$this->BuilderEngine->set_option('photogallery_allow_comments', $this->input->post('photogallery_allow_comments', true));
				$this->BuilderEngine->set_option('photogallery_comments_private', $this->input->post('photogallery_comments_private', true));
				$this->BuilderEngine->set_option('photogallery_show_tags', $this->input->post('photogallery_show_tags', true));
                //$this->BuilderEngine->set_option('photogallery_num_tags_displayed', $this->input->post('photogallery_num_tags_displayed', true));
				//$this->BuilderEngine->set_option('photogallery_medias_per_page', $this->input->post('photogallery_medias_per_page', true));
                //$this->BuilderEngine->set_option('photogallery_num_recent_medias_displayed', $this->input->post('photogallery_num_recent_medias_displayed', true));
				//$this->BuilderEngine->set_option('photogallery_num_medias_displayed', $this->input->post('photogallery_num_medias_displayed', true));
				$this->BuilderEngine->set_option('photogallery_access_groups', $this->input->post('access_groups', true));
				$this->BuilderEngine->set_option('photogallery_register_info', $this->input->post('register_info', true));
				$this->BuilderEngine->set_option('photogallery_login_info', $this->input->post('login_info', true));

			}
			$data['current_page'] = 'photogallery';
			$data['current_child_page'] = 'settings';
			$this->load->view('backend/photogallery_settings',$data);	
        }

        public function delete_comment($id)
        {
            $comment = new PhotoGalleryComment($id);
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
            $comment_report = new PhotoGalleryCommentReport($id);
            $comment_report->delete();
            $this->show_comment_reports();
        }
        public function delete_photo($id)
        {
            $photo = new PhotoGalleryMedia($id);
            $photo_reports = $photo->report->get();
            foreach ($photo_reports as $photo_report)
            {
                $photo_report->delete();
            }
            $photo->delete();
			$this->show_photo_reports();
        }
        public function delete_photo_report($id)
        {
            $comment_report = new PhotoGalleryPhotoReport($id);
            $comment_report->delete();
            $this->show_photo_reports();
        }
		public function register_admin($id)
		{
			$user_settings = new PhotoGalleryUserSettings();
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
			$user_settings = new PhotoGalleryUserSettings();
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
            $this->modify_object('PhotoGalleryUserSettings');
        }

		public function clean_up_user_list()
		{
			$photo_users = new PhotoGalleryUserSettings();
			foreach($photo_users->get() as $photo_user){
				$user = new User($photo_user->user_id);
				if($user->id != $photo_user->user_id){
				$photo_user->delete();
				}
			}
			
			$this->show_user_profiles();
		}
    }
?>