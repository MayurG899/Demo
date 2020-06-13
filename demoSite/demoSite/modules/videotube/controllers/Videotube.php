<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function initialize_videoupload_js()
	{
		echo "
			<!-- jQuery File Upload Dependencies -->
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.ui.widget.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.iframe-transport.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.fileupload.js')."\" type=\"text/javascript\"></script>
			<!-- Main VideoTube Upload JS file -->
			<script src=\"".base_url('builderengine/public/mediamodules/videotube/uploadscript.js')."\" type=\"text/javascript\"></script>					
		";
	}
	function initialize_tagit_js()
	{
		echo "
			<script src=\"".base_url('themes/dashboard/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('themes/dashboard/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('themes/dashboard/assets/plugins/jquery-tag-it/js/tag-it.min.js')."\" type=\"text/javascript\"></script>
			<script type=\"text/javascript\">
				$(document).ready(function (){
					$('.white').tagit({
						fieldName: \"tags\",
						singleField: true,
						showAutocompleteOnFocus: true
					});
				});
			</script>
		";
	}

class Videotube extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('users');
		$this->load->model('videotubemedia');
		$this->load->model('videotubelike');
		$this->load->model('videotubealbum');
		$this->load->model('videotubefollow');
		$this->load->model('videotubecomment');
		$this->load->model('videotuberating');
		$this->load->model('videotubecommentreport');
		$this->load->model('videotubevideoreport');
		$this->load->model('videotubeusersettings');
		$this->load->model('visits');
    }
	
	public function login($info = null)
	{	/*
		if($this->user->is_logged_in()){
			if($this->BuilderEngine->get_option('videotube_option')=='open')
				redirect(base_url('/videotube/mysettings'),'location');
			else
				redirect(base_url('/videotube/all_videos'),'location');
		}*/
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if($info == 'info')
			$data['info'] = 'You must be signed in or registered user to be able to post !';
		if($info == 'approval')
			$data['info'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
		if($info == 'password')
			$data['info'] = 'Reset token has been sent to your email address!';			
		if($_POST){
			if(isset($_POST['email'])){
				$this->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('videotube/login/password'),'location');
			}
            $userid = $this->users->verify_login($_POST['username'], $_POST['password']);
			$video_user = new VideoTubeUserSettings();
			$video_user = $video_user->where('user_id',$userid)->get();
			if($userid != -1 && $userid != 0 && $video_user->user_id == $userid){	
				$this->user->initialize($userid);

				if($this->builderengine->get_option('videotube_option')=='open')
					redirect(base_url('videotube/myfeed'), 'location');
				else
					redirect(base_url('videotube/all_videos'), 'location');
			}
			else{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$data['error_msg'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				elseif($registered_user->id > 0 && $registered_user->verified == 'yes'){
					$data['error_msg'] = 'In order to get permission for video gallery ,please contact your <a href="mailto:'.$this->BuilderEngine->get_option('adminemail').'?Subject=Video%20Gallery%20access%20request">admin</a> !';
				}
				else
					$data['error_msg'] = 'Invalid username or password';
			}
		}
		$data['errors'] = '';
		$data['login_info'] = $this->BuilderEngine->get_option('videotube_login_info');
		$this->load->view('frontend/login.tpl',$data);	
	}
	public function logout()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		$this->user->logout(base_url('videotube/login'));
	}
		
	public function register($error = null)
	{
		/*
		if($this->user->is_logged_in())
			redirect(base_url('/videotube/all_videos'),'location');
		*/
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        $data['error'] = '';
		if($_POST){
            if($_POST['password'] != $_POST['password_re'])
                redirect(base_url('videotube/register/password'), 'location');
            else{
				if($this->BuilderEngine->get_option('videotube_access_groups'))
					$_POST['groups'] = $this->BuilderEngine->get_option('videotube_access_groups');
                $created = $this->users->register_user($_POST);
                if($created != false){
					$user_settings = new VideoTubeUserSettings();
					$settings = array(
						'user_id' => $created,
						'about' => '',
						'background_img' => '',
					);
					$user_settings->create($settings);
                   // if(isset($_GET['token']) && $_GET['token'] != '')
					if($this->BuilderEngine->get_option('sign_up_verification') == 'admin')
						redirect(base_url('videotube/login/approval'), 'location');
					else
						redirect(base_url('videotube/login'), 'location');
                }
                else
                    redirect(base_url('videotube/register/exists'), 'location');
            }
		}
		$videotube_terms = $this->BuilderEngine->get_option('videotube_terms');
		$data['register_info'] = $this->BuilderEngine->get_option('videotube_register_info');
		$data['videotube_terms'] = (!empty($videotube_terms))?$videotube_terms:'';
		$this->load->view('frontend/register.tpl', $data);	
	}

	public function channel($username = null,$page = null)
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if($username == null)
			show_404();

        $this->load->helper(array('form', 'url','captcha'));
        $this->load->library('form_validation');

	    if($_POST){
			if(!$this->user->is_guest()){
				$user = new User($this->user->get_id());
				$user_id = $user->id;
				$user_name = $user->username;
			}
			else{
				$user_id = 0;
				$user_name = $this->input->post('name');
			}

			$data = array(
				'user_id' => $user_id,
				'name' => $user_name,
				'channel_owner_id' =>  $this->input->post('channel_owner_id', true),
				'text'       =>  $this->input->post('message', true)
			);
			$this->videotubecomment->create($data);
			redirect($_SERVER['HTTP_REFERER']);
		}
		$owner = new User();
		$owner = $owner->where('username',$username)->get();
		
		$settings = new VideoTubeUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();		
		$data = array(
			'author' => $owner,
			'channel_owner' => $owner,
			'owner_settings' => $owner_settings,
			'gallery_option' => $this->BuilderEngine->get_option('videotube_option'),
			'albums' => $this->videotubealbum->where('user_id',$owner->id)->get(),
			'videos' => $this->videotubemedia->where('user_id',$owner->id)->get(),
			'followers' => $this->videotubefollow->where('following_id',$owner->id)->count(),
			'num_owners_videos' => $this->videotubemedia->where('user_id',$owner->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
		if($page == 'album'){
			$this->load->view('frontend/album.tpl',$data);
		}
		elseif($page == 'about'){
			$this->load->view('frontend/about.tpl',$data);
		}
		elseif($page == 'videos'){
			$this->load->view('frontend/videos.tpl',$data);
		}
		elseif($page == 'albums'){
			$this->load->view('frontend/albums.tpl',$data);
		}
		elseif($page == 'discussion'){
			$this->load->view('frontend/discussion.tpl',$data);
		}
		else{
			$this->load->view('frontend/channel.tpl', $data);	
		}
    }

	public function myfeed()
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'num_tags' => $this->BuilderEngine->get_option('videotube_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('videotube_show_tags'),
			'videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/myfeed.tpl', $data);
    }

	public function mysettings()
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		$user_id = $this->user->get_id();
		if($_POST){
			$this->load->model('users');
			
			if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']) ){
				$file_name = $_FILES['avatar']['name'];
				$file_size =$_FILES['avatar']['size'];
				$file_tmp = $_FILES['avatar']['tmp_name'];
				$file_type = $_FILES['avatar']['type'];
				$file = explode('.',$_FILES['avatar']['name']);
				$file_ext = strtolower(end($file));
				$extensions = array("jpeg","jpg","png"); 
				
				if(!is_dir("files/users"))
					mkdir("files/users");
				if(!is_dir("files/users/user_".$user_id))
					mkdir("files/users/user_".$user_id);
				 if(!is_dir("files/users/user_".$user_id."/videotube"))
					mkdir("files/users/user_".$user_id."/videotube");
				 if(!is_dir("files/users/user_".$user_id."/videotube/avatars"))
					mkdir("files/users/user_".$user_id."/videotube/avatars");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/videotube/avatars/".$newFileName);
			
				$_POST['avatar'] = base_url().'files/users/user_'.$user_id.'/videotube/avatars/'.$newFileName;
			}

			if(isset($_FILES['background_img']) && !empty($_FILES['background_img']['name']) ){
				$file_name = $_FILES['background_img']['name'];
				$file_size =$_FILES['background_img']['size'];
				$file_tmp = $_FILES['background_img']['tmp_name'];
				$file_type = $_FILES['background_img']['type'];
				$file = explode('.',$_FILES['background_img']['name']);
				$file_ext = strtolower(end($file));
				$extensions = array("jpeg","jpg","png"); 
				
				if(!is_dir("files/users"))
					mkdir("files/users");
				if(!is_dir("files/users/user_".$user_id))
					mkdir("files/users/user_".$user_id);
				 if(!is_dir("files/users/user_".$user_id."/videotube"))
					mkdir("files/users/user_".$user_id."/videotube");
				 if(!is_dir("files/users/user_".$user_id."/videotube/backgrounds"))
					mkdir("files/users/user_".$user_id."/videotube/backgrounds");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/videotube/backgrounds/".$newFileName);
			
				$_POST['background_img'] = base_url().'files/users/user_'.$user_id.'/videotube/backgrounds/'.$newFileName;
			}

			$current_settings = new VideoTubeUserSettings();
			$current_settings = $current_settings->where('user_id',$user_id)->get();
			$setting = array(
				'background_img' => (isset($_POST['background_img']))?$_POST['background_img']:$current_settings->background_img,
				'about' => $_POST['about'],
				'channel_comments' => $_POST['channel_comments']
			);

			$this->videotubeusersettings->where('user_id',$user_id)->update($setting);

			unset($_POST['background_img']);
			unset($_POST['about']);
			unset($_POST['channel_comments']);
			
            $update = array(
                'first_name' => $_POST['first_name'],
                'last_name'  => $_POST['last_name'],
                'username'   => $_POST['username'],
                'email'      => $_POST['email'],
                'avatar'     => (isset($_POST['avatar']))?$_POST['avatar']:'',
            );
 
            $user = $this->user->get_by_id($user_id);
            $username = $user->username;
			if(empty($_POST['avatar']))
				$update['avatar'] = $user->avatar;
 
            $this->db->where('id', $user_id);
            $this->db->update('users', $update);
		}
		
		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->videotubeusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/mysettings', $data);		
    }

	public function myvideos()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		add_action("be_foot", "initialize_tagit_js");
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		
		$settings = new VideoTubeUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->videotubeusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'my_videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/myvideos', $data);
	}

	public function myalbums()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		
		$settings = new VideoTubeUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->videotubeusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'my_videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'my_albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/myalbums', $data);
	}

    public function all_videos()
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        $videos = new VideoTubeMedia();
	
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('videotube_num_medias_displayed')){
            $videos_per_page = 6;
        }
        else
            $videos_per_page = $this->BuilderEngine->get_option('videotube_num_medias_displayed');

        $data['videos'] = $videos->get_paged($page_number, $videos_per_page);
        $data['albums'] = $this->get_albums();
		$data['gallery_option'] = $this->BuilderEngine->get_option('videotube_option');
		$this->load->view('frontend/all_videos.tpl', $data);
    }

    public function search($keyword = null)
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        $keyword = urldecode($keyword);
        $videos = new VideoTubeMedia();
        if(isset($_GET['keyword'])){
            redirect(base_url('videotube/search/'.$_GET['keyword']), 'location');
        }

        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('videotube_num_medias_displayed')){
            $videos_per_page = 6;
        }
        else
            $videos_per_page = $this->BuilderEngine->get_option('videotube_num_medias_displayed');
        $data['albums'] = $this->get_albums();
        $data['videos'] = $videos->like('title', $keyword)->or_like('tags', $keyword)->or_like('description', $keyword)->order_by('time_created', 'desc')->get_paged($page_number, $videos_per_page);
        $data['keyword'] = $keyword;
		$data['gallery_option'] = $this->BuilderEngine->get_option('videotube_option');
        $this->load->view('frontend/search.tpl', $data);
    }

    public function report_comment($user_page = null)
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        if($_GET){
            $comment = new VideoTubeComment($_GET['comment_id']);
            $comment->report($_GET['text']);
			if($user_page)
				redirect(base_url('videotube/channel/'.$user_page.'/discussion'), 'location');
			else
				redirect(base_url('videotube/video/'.$comment->media->get()->id), 'location');
        }
    }

    public function report_video()
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        if($_GET){
            $video = new VideoTubeMedia($_GET['media_id']);
            $video->report($_GET['text']);
            redirect(base_url('videotube/video/'.$video->id), 'location');
        }
    }

    public function video($id = null)
    {
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if($id == null)
			show_404();

        $this->load->helper(array('form', 'url','captcha'));
        $this->load->library('form_validation');

	    if($_POST){
			if(!$this->user->is_guest()){
				$user = new User($this->user->get_id());
				$user_id = $user->id;
				$user_name = $user->username;
			}
			else{
				$user_id = 0;
				$user_name = $this->input->post('name');
			}

			$data = array(
				'user_id' => $user_id,
				'name' => $user_name,
				'media_id' =>  $this->input->post('media_id', true),
				'text'       =>  $this->input->post('message', true)
			);
			$this->videotubecomment->create($data);
			redirect(base_url('videotube/video/'.$id));
		}

        $video = new VideoTubeMedia();
		$video = $video->where('id',$id)->get();
		$this->videotubemedia->where('id',$id)->update(array('views' => $video->views + 1));
		$comments = new VideoTubeComment();
		$author = new User();
		$author = $author->where('id',$video->user_id)->get();
		$likes = new VideoTubeLike();
		$follow = new VideoTubeFollow();
		$followed = $follow->where('following_id',$author->id)->where('follower_id',$this->user->get_id())->count();
	
		$data = array(
			'author' => $author,
			'video' => $video,
			'album' => $this->videotubealbum->where('id',$video->album_id)->get(),
			'author_albums' => $this->videotubealbum->where('user_id',$author->id)->get(),
			'num_albums' => $this->videotubealbum->where('user_id',$author->id)->count(),
			'comments' => $video->comments->get(),
			'num_authors_videos' => $video->where('user_id',$author->id)->count(),
			'num_video_views' => $this->visits->where('page','videotube/video/'.$id.'')->count(),
			'num_tags' => $this->BuilderEngine->get_option('videotube_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('videotube_show_tags'),
			'gallery_option' => $this->BuilderEngine->get_option('videotube_option'),
			'allow_ratings' => $this->BuilderEngine->get_option('videotube_allow_ratings'),
			'allow_comments' => $this->BuilderEngine->get_option('videotube_allow_comments'),
			'ratings' => $this->videotuberating->select_avg('rating')->where('media_id',$video->id)->get(),
			'num' => ($this->BuilderEngine->get_option('videotube_allow_ratings')=='yes')?12:9,
			'likes' => $video->likes->where('status','like')->count(),
			'unlikes' => $video->likes->where('status','unlike')->count(),
			'followers' => $this->videotubefollow->where('following_id',$author->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
        $this->load->view('frontend/single_video.tpl', $data);
    }

    public function get_albums()
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        return $this->videotubealbum->get();
    }

    public function get_comments($video_id)
    {
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        return $this->videotubecomment->where('media_id',$video_id)->get();
    }

    public function delete_comment($id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
        if(!$this->user->is_member_of("Administrators")){
            show_404();
		}
		$id = intval($id);
		$comment = new VideoTubeComment($id);
		$comment->delete();
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function rate_video() 
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if($_GET){
            if(!$this->user->is_guest()){
                $user = new User($this->user->get_id());
                $user_id = $user->id;
    		
				$data = array(
					'media_id' =>  $_GET['id'],				
					'user_id' => $user_id,
					'rating' => $_GET['rating']
				);
    			
				$rating = new VideoTubeRating();
				$rating->create($data);
				redirect($_SERVER['HTTP_REFERER']);				
            }
            else{
				if($this->BuilderEngine->get_option('videotube_option') != 'open')
					redirect($_SERVER['HTTP_REFERER']);
				else
					redirect(base_url('videotube/login'), 'location');
            }
		}
	}
	
	public function get_average_rating($media_id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		$ratings = new VideoTubeRating();
		$ratings = $ratings->select_avg('rating')->where('media_id',$media_id)->get();
		
		foreach($ratings as $item){
			$total_rate = round($item->rating);
		}
		return $total_rate;
	}

	public function add_album($first = null)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'), 'location');
		if($_POST){
			$album = new VideoTubeAlbum();
			$_POST['name'] = str_replace(array(' ','`','"','.'), '_', $_POST['name']);
			$album->create($_POST);
			redirect(base_url('videotube/upload'), 'location');
		}

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
			'first_album' => ($first)?'yes':'no',
		);	
		$this->load->view('frontend/add_album.tpl', $data);
	}

	public function youtube()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		if($this->input->post())
		{
			$new_video = new VideoTubeMedia();

			$user_id = $this->user->get_id();

			$data = array(
				'user_id' => $this->user->get_id(),
				'media_file' => $this->input->post('media_file'),
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
				'album_id' => $this->input->post('album_id'),
				'comments_allowed' => ($this->input->post('comments_allowed') != null)?'yes':'no',
				'tags' => $this->input->post('tags'),
				'groups_allowed' => $this->input->post('groups_allowed'),
				'status' => $this->input->post('status'),
				'type' => 'youtube',
			);

			$new_video->create($data);

			redirect(base_url('videotube/video/'.$new_video->id.''),'location');
		}
		$data = array();
		$this->load->view('frontend/add_youtube.tpl', $data);
	}

	public function get_youtube_player()
	{
		
	}

	public function vimeo()
	{
		$this->load->view('frontend/add_vimeo.tpl', $data);
	}

	public function get_vimeo_player()
	{
		
	}

	public function upload()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		add_action('be_foot','initialize_videoupload_js');
		
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		if($_POST){
			$new_video = new VideoTubeMedia();

			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			 if(!is_dir("files/users/user_".$user_id."/videotube"))
				mkdir("files/users/user_".$user_id."/videotube");
			 if(!is_dir("files/users/user_".$user_id."/videotube/videos"))
				mkdir("files/users/user_".$user_id."/videotube/videos");

			$data = array(
				'user_id' => $this->user->get_id(),
				'media_file' => base_url('files/users/user_'.$user_id.'/videotube/videos/'.$_POST['media_file']),
				'title' => $_POST['title'],
				'text' => $_POST['text'],
				'album_id' => $_POST['album_id'],
				'comments_allowed' => (isset($_POST['comments_allowed']))?'yes':'no',
				'tags' => $_POST['tags'],
				'groups_allowed' => $_POST['groups_allowed'],
				'status' => $_POST['status'],
			);
			$new_video->create($data);
			redirect(base_url('videotube/video/'.$new_video->id.''));
		}
		
		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->videotubefollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->videotubefollow->where('follower_id',$this->user->id)->get(),
			'num_videos' => $this->videotubemedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'videos' => $this->videotubemedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->videotubealbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->videotubealbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->videotubelike->where('user_id',$this->user->id)->get(),
		);

		$this->load->view('frontend/upload.tpl', $data);
	}

	public function upload_video()
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		$allowed = array('mp4', 'avi', 'mpeg' , 'mpg');

		if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

			$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
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
			$ext = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
			
			if(move_uploaded_file($_FILES['upl']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/videotube/videos/'.$newUniqueFileName.'.'.$ext)){
				echo '{"status":"success","newfileName":"'.$newUniqueFileName.'.'.$ext.'"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;		
	}
	
	public function edit_video($id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		if($_POST){
			if($_POST['type'] == 'file'){
				if(!isset($_POST['file'])){
					$placeholder = $_SERVER['DOCUMENT_ROOT'].'/builderengine/public/img/video_placeholder.png';
					$newUniqueFileName = md5(uniqid());
					$ext = pathinfo($placeholder, PATHINFO_EXTENSION);
					$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$this->user->get_id().'/videotube/videos/'.$newUniqueFileName.'.'.$ext;
					copy($placeholder,$newFileName);
					$_POST['file'] = base_url().'files/users/user_'.$this->user->get_id().'/videotube/videos/'.$newUniqueFileName.'.'.$ext;
				}else
					$_POST['file'] = base_url().'files/users/user_'.$this->user->get_id().'/videotube/videos/'.$_POST['file'];
			}
			$this->videotubemedia->where('id',$id)->update($_POST);
		}
		redirect(base_url('videotube/myvideos'),'location');
	}

	public function edit_album($id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		if($_POST){
			if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
				$allowed = array('jpg','jpeg','png');
				$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $allowed)){
					redirect(base_url('videotube/myalbums'),'location');
				}
				else{
					if(move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/videotube/videos/'.$_FILES['image']['name'])){
						$_POST['image'] = base_url('files/users/user_'.$user_id.'/videotube/videos/'.$_FILES['image']['name']);
					}
				}
			}			
			$this->videotubealbum->where('id',$id)->update($_POST);
		}
		redirect(base_url('videotube/myalbums'),'location');
	}

	public function delete_video($id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		$video = new VideoTubeMedia($id);
		$video_reports = new VideoTubeVideoReport();
		foreach($video_reports->where('media_id',$video->id)->get() as $video_report){
			$video_report->delete();
		}
		$likes = new VideoTubeLike();
		foreach($likes->where('media_id',$video->id)->get() as $like){
			$like->delete();
		}
		$comments = new VideoTubeComment();
		foreach($comments->where('media_id',$video->id)->get() as $comment){
			$comment_reports = new VideoTubeCommentReport();
			foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
				$comment_report->delete();
			}
			$comment->delete();
		}		
		$ratings = new VideoTubeRating();
		foreach($ratings->where('media_id',$video->id)->get() as $rating){
			$rating->delete();
		}
		//$extension = pathinfo($video->file, PATHINFO_EXTENSION);
		$file_path = str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$video->file);
		unlink($file_path);
		$video->delete();
		redirect(base_url('videotube/myvideos/'),'location');
	}

	public function delete_album($id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));
		$album = new VideoTubeAlbum($id);
		$videos = new VideoTubeMedia();
		foreach($videos->where('album_id',$album->id)->get() as $video){
			$video_reports = new VideoTubeVideoReport();
			foreach($video_reports->where('media_id',$video->id)->get() as $video_report){
				$video_report->delete();
			}
			$likes = new VideoTubeLike();
			foreach($likes->where('media_id',$video->id)->get() as $like){
				$like->delete();
			}
			$comments = new VideoTubeComment();
			foreach($comments->where('media_id',$video->id)->get() as $comment){
				$comment_reports = new VideoTubeCommentReport();
				foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}		
			$ratings = new VideoTubeRating();
			foreach($ratings->where('media_id',$video->id)->get() as $rating){
				$rating->delete();
			}
			$extension = pathinfo($video->file, PATHINFO_EXTENSION);
			$file_path = $this->session->userdata('user_dir').'/'.$file->name.'.'.$extension;
			unlink($file_path);
			$video->delete();
		}
		$album->delete();
		redirect(base_url('videotube/myalbums/'),'location');
	}

	public function delete_profile($user_id)
	{
		if($this->BuilderEngine->get_option('videotube_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('videotube_option') != 'open' && !$this->users->is_admin()))
			redirect(base_url('videotube/login'));

		$users = new VideoTubeUserSettings();
		$data = array('active' => 'no');
		foreach($users->get() as $u){
			$u->where('user_id',$user_id)->update($data);
		}
		$albums = $this->videotubealbum->where('user_id',$user_id)->get();
		foreach($albums as $album){
			$album->delete();
		}
		$videos = $this->videotubemedia->where('user_id',$user_id)->get();
		foreach($videos as $video){
			$video_reports = $this->videotubevideoreport->where('media_id',$video->id)->get();
			foreach($video_reports as $video_report){
				$video_report->delete();
			}
			$comments = $this->videotubecomment->where('media_id',$video->id)->get();
			foreach($comments as $comment){
				$comment_reports = $this->videotubecommentreport->where('comment_id',$comment->id)->get();
				foreach($comment_reports as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}
			$ratings = $this->videotuberating->where('media_id',$video->id)->get();
			foreach($ratings as $rating){
				$rating->delete();
			}
			$video->delete();
		}
		$followers = $this->videotubefollow->where('follower_id',$user_id)->get();
		foreach($followers as $follower){
			$follower->delete();
		}
		$followings = $this->videotubefollow->where('following_id',$user_id)->get();
		foreach($followings as $following){
			$following->delete();
		}
		$likes = $this->videotubelike->where('user_id',$user_id)->get();
		foreach($likes as $like){
			$like->delete();
		}
		$dir = $this->session->userdata('user_dir');
		system('/bin/rm -rf ' . escapeshellarg($dir));
		$this->logout();
	}
}