<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function initialize_photoupload_js()
	{
		echo "
			<!-- jQuery File Upload Dependencies -->
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.ui.widget.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.iframe-transport.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.fileupload.js')."\" type=\"text/javascript\"></script>
			<!-- Main file Upload JS file -->
			<script src=\"".base_url('builderengine/public/mediamodules/photogallery/uploadphoto.js')."\" type=\"text/javascript\"></script>
			";
	}
	function initialize_photo_tagit_js()
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

class Photogallery extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('users');
		$this->load->model('photogallerymedia');
		$this->load->model('photogallerylike');
		$this->load->model('photogalleryalbum');
		$this->load->model('photogalleryfollow');
		$this->load->model('photogallerycomment');
		$this->load->model('photogalleryrating');
		$this->load->model('photogallerycommentreport');
		$this->load->model('photogalleryphotoreport');
		$this->load->model('photogalleryusersettings');
		$this->load->model('visits');
    }
	
	public function login($info = null)
	{
		/*
		if($this->user->is_logged_in()){
			if($this->BuilderEngine->get_option('photogallery_option')=='open')
				redirect(base_url('/photogallery/mysettings'),'location');
			else
				redirect(base_url('/photogallery/all_photos'),'location');
		}
		*/
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
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
				redirect(base_url('photogallery/login/password'),'location');
			}
            $userid = $this->users->verify_login($_POST['username'], $_POST['password']);
			$photo_user = new PhotoGalleryUserSettings();
			$photo_user = $photo_user->where('user_id',$userid)->get();
			if($userid != -1 && $userid != 0 && $photo_user->user_id == $userid){
				$this->user->initialize($userid);

				if($this->builderengine->get_option('photogallery_option')=='open')
					redirect(base_url('photogallery/myfeed'), 'location');
				else
					redirect(base_url('photogallery/all_photos'), 'location');
			}
			else{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$data['error_msg'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				elseif($registered_user->id > 0 && $registered_user->verified == 'yes'){
					$data['error_msg'] = 'In order to get permission for photo gallery ,please contact your <a href="mailto:'.$this->BuilderEngine->get_option('adminemail').'?Subject=Photo%20Gallery%20access%20request">admin</a> !';
				}
				else
					$data['error_msg'] = 'Invalid username or password';
			}
		}
		$data['errors'] = '';
		$data['login_info'] = $this->BuilderEngine->get_option('photogallery_login_info');
		$this->load->view('frontend/login.tpl',$data);	
	}
	public function logout()
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		$this->user->logout(base_url('/photogallery/login'));
	}
		
	public function register($error = null)
	{
		/*
		if($this->user->is_logged_in())
			redirect(base_url('/photogallery/all_photos'),'location');
		*/
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        $data['error'] = '';
		if($_POST){
            if($_POST['password'] != $_POST['password_re'])
                redirect(base_url('/photogallery/register/password'), 'location');
            else{
				if($this->BuilderEngine->get_option('photogallery_access_groups'))
					$_POST['groups'] = $this->BuilderEngine->get_option('photogallery_access_groups');
                $created = $this->users->register_user($_POST);
                if($created != false){
					$user_settings = new PhotoGalleryUserSettings();
					$settings = array(
						'user_id' => $created,
						'about' => '',
						'background_img' => '',
					);
					$user_settings->create($settings);
                   // if(isset($_GET['token']) && $_GET['token'] != '')
					if($this->BuilderEngine->get_option('sign_up_verification') == 'admin')
						redirect(base_url('/photogallery/login/approval'), 'location');
					else
						redirect(base_url('/photogallery/login'), 'location');
                }
                else
                    redirect(base_url('/photogallery/register/exists'), 'location');
            }
		}
		$photogallery_terms = $this->BuilderEngine->get_option('photogallery_terms');
		$data['register_info'] = $this->BuilderEngine->get_option('photogallery_register_info');
		$data['photogallery_terms'] = (!empty($photogallery_terms))?$photogallery_terms:'';
		$this->load->view('frontend/register.tpl', $data);	
	}

	public function channel($username = null,$page = null)
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if($username == null)
			show_404();
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
			$this->photogallerycomment->create($data);
			redirect($_SERVER['HTTP_REFERER']);
		}
		$owner = new User();
		$owner = $owner->where('username',$username)->get();
		
		$settings = new PhotoGalleryUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
		
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();		
		$data = array(
			'author' => $owner,
			'channel_owner' => $owner,
			'owner_settings' => $owner_settings,
			'gallery_option' => $this->BuilderEngine->get_option('photogallery_option'),
			'albums' => $this->photogalleryalbum->where('user_id',$owner->id)->get(),
			'photos' => $this->photogallerymedia->where('user_id',$owner->id)->get(),
			'followers' => $this->photogalleryfollow->where('following_id',$owner->id)->count(),
			'num_owners_photos' => $this->photogallerymedia->where('user_id',$owner->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
		if($page == 'album'){
			$this->load->view('frontend/album.tpl',$data);
		}
		elseif($page == 'about'){
			$this->load->view('frontend/about.tpl',$data);
		}
		elseif($page == 'photos'){
			$this->load->view('frontend/photos.tpl',$data);
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
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'num_tags' => $this->BuilderEngine->get_option('photogallery_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('photogallery_show_tags'),
			'photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
			'photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/myfeed.tpl', $data);		
		
    }

	public function mysettings()
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		$user_id = $this->user->get_id();
		if($_POST){
			$this->load->model('users');
			
			if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name'])){
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
				 if(!is_dir("files/users/user_".$user_id."/photogallery"))
					mkdir("files/users/user_".$user_id."/photogallery");
				 if(!is_dir("files/users/user_".$user_id."/photogallery/avatars"))
					mkdir("files/users/user_".$user_id."/photogallery/avatars");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/photogallery/avatars/".$newFileName);
			
				$_POST['avatar'] = base_url().'files/users/user_'.$user_id.'/photogallery/avatars/'.$newFileName;
			}

			if(isset($_FILES['background_img']) && !empty($_FILES['background_img']['name'])){
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
				 if(!is_dir("files/users/user_".$user_id."/photogallery"))
					mkdir("files/users/user_".$user_id."/photogallery");
				 if(!is_dir("files/users/user_".$user_id."/photogallery/backgrounds"))
					mkdir("files/users/user_".$user_id."/photogallery/backgrounds");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/photogallery/backgrounds/".$newFileName);
			
				$_POST['background_img'] = base_url().'files/users/user_'.$user_id.'/photogallery/backgrounds/'.$newFileName;
			}
			$current_settings = new PhotoGalleryUserSettings();
			$current_settings = $current_settings->where('user_id',$user_id)->get();
			$setting = array(
				'background_img' => (isset($_POST['background_img']))?$_POST['background_img']:$current_settings->background_img,
				'about' => $_POST['about'],
				'channel_comments' => $_POST['channel_comments']
			);

			$this->photogalleryusersettings->where('user_id',$user_id)->update($setting);

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
			'user_settings' => $this->photogalleryusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/mysettings', $data);
    }

	public function myphotos()
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		add_action("be_foot", "initialize_photo_tagit_js");
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		
		$settings = new PhotoGalleryUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->photogalleryusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'my_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/myphotos', $data);
	}

	public function myalbums()
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		
		$settings = new PhotoGalleryUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->photogalleryusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'my_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'my_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/myalbums', $data);
	}

    public function all_photos()
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        $photos = new PhotoGalleryMedia();
	
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('photogallery_num_medias_displayed')){
            $photos_per_page = 6;
        }
        else
            $photos_per_page = $this->BuilderEngine->get_option('photogallery_num_medias_displayed');

        $data['photos'] = $photos->get_paged($page_number, $photos_per_page);
        $data['albums'] = $this->get_albums();
		$data['gallery_option'] = $this->BuilderEngine->get_option('photogallery_option');
		$this->load->view('frontend/all_photos.tpl', $data);
    }

    public function search($keyword = null)
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        $keyword = urldecode($keyword);
        $photos = new PhotoGalleryMedia();
        if(isset($_GET['keyword'])){
            redirect(base_url('photogallery/search/'.$_GET['keyword']), 'location');
        }

        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('photogallery_num_medias_displayed')){
            $photos_per_page = 6;
        }
        else
            $photos_per_page = $this->BuilderEngine->get_option('photogallery_num_medias_displayed');
        
        $data['albums'] = $this->get_albums();
        $data['photos'] = $photos->like('title', $keyword)->or_like('tags', $keyword)->or_like('description', $keyword)->order_by('time_created', 'desc')->get_paged($page_number, $photos_per_page);
        $data['keyword'] = $keyword;
		$data['gallery_option'] = $this->BuilderEngine->get_option('photogallery_option');
        $this->load->view('frontend/search.tpl', $data);
    }

    public function report_comment()
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        if($_GET){
            $comment = new PhotoGalleryComment($_GET['comment_id']);
            $comment->report($_GET['text']);
            redirect(base_url('/photogallery/photo/'.$comment->media->get()->id), 'location');
        }
    }

    public function report_photo()
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        if($_GET){
            $photo = new PhotoGalleryMedia($_GET['media_id']);
            $photo->report($_GET['text']);
            redirect(base_url('/photogallery/photo/'.$photo->id), 'location');
        }
    }

    public function photo($id = null)
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        $photo = new PhotoGalleryMedia();
		$photo = $photo->where('id',$id)->get();

		if($id == null || (int)$id !== (int)$photo->id)
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
			
			$this->photogallerycomment->create($data);
			redirect(base_url('photogallery/photo/'.$id));
		}

		$comments = new PhotoGalleryComment();
		$author = new User();
		$author = $author->where('id',$photo->user_id)->get();
		$likes = new PhotoGalleryLike();
		$follow = new PhotoGalleryFollow();
		$followed = $follow->where('following_id',$author->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'author' => $author,
			'photo' => $photo,
			'photos' => $this->photogallerymedia->where('album_id',$photo->album_id)->get(),
			'album' => $this->photogalleryalbum->where('id',$photo->album_id)->get(),
			'author_albums' => $this->photogalleryalbum->where('user_id',$author->id)->get(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$author->id)->count(),
			'comments' => $photo->comments->get(),
			'num_authors_photos' => $photo->where('user_id',$author->id)->count(),
			'num_photo_views' => $this->visits->where('page','photogallery/photo/'.$id.'')->count(),
			'num_tags' => $this->BuilderEngine->get_option('photogallery_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('photogallery_show_tags'),
			'gallery_option' => $this->BuilderEngine->get_option('photogallery_option'),
			'allow_ratings' => $this->BuilderEngine->get_option('photogallery_allow_ratings'),
			'allow_comments' => $this->BuilderEngine->get_option('photogallery_allow_comments'),
			'ratings' => $this->photogalleryrating->select_avg('rating')->where('media_id',$photo->id)->get(),
			'num' => ($this->BuilderEngine->get_option('photogallery_allow_ratings')=='yes')?12:9,
			'likes' => $photo->likes->where('status','like')->count(),
			'unlikes' => $photo->likes->where('status','unlike')->count(),
			'followers' => $this->photogalleryfollow->where('following_id',$author->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
        $this->load->view('frontend/single_photo.tpl', $data);
    }

    public function get_albums()
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        return $this->photogalleryalbum->get();
    }

    public function get_comments($photo_id)
    {
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        return $this->photogallerycomment->where('media_id',$photo_id)->get();
    }

    public function delete_comment($id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
        if(!$this->user->is_member_of("Administrators")){
            show_404();
		}
		$id = intval($id);
		$comment = new PhotoGalleryComment($id);
		$comment->delete();
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function rate_photo() 
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
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
    			
				$rating = new PhotoGalleryRating();
				$rating->create($data);
				redirect($_SERVER['HTTP_REFERER']);				
            }
            else{
				if($this->BuilderEngine->get_option('photogallery_option') != 'open')
					redirect($_SERVER['HTTP_REFERER']);
				else
					redirect(base_url('/photogallery/login'), 'location');
            }
		}
	}
	
	public function get_average_rating($media_id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		$ratings = new PhotoGalleryRating();
		$ratings = $ratings->select_avg('rating')->where('media_id',$media_id)->get();
		
		foreach($ratings as $item){
			$total_rate = round($item->rating);
		}
		return $total_rate;
	}

	public function add_album($first = null)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('/photogallery/login'), 'location');
		if($_POST){
			$album = new PhotoGalleryAlbum();
			$_POST['name'] = str_replace(array(' ','`','"','.'), '_', $_POST['name']);
			$album->create($_POST);
			redirect(base_url('/photogallery/upload'), 'location');
		}

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
			'first_album' => ($first)?'yes':'no',
		);	
		$this->load->view('frontend/add_album.tpl', $data);
	}

	public function upload()
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		add_action('be_foot','initialize_photoupload_js');
		
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		if($_POST){
			$new_photo = new PhotoGalleryMedia();
			
			$data = array(
				'user_id' => $this->user->get_id(),
				'media_file' => base_url('files/users/user_'.$this->user->get_id().'/photogallery/photos').'/'.$_POST['media_file'],
				'title' => $_POST['title'],
				'text' => $_POST['text'],
				'album_id' => $_POST['album_id'],
				'comments_allowed' => (isset($_POST['comments_allowed']))?'yes':'no',
				'tags' => $_POST['tags'],
				'groups_allowed' => $_POST['groups_allowed'],
				'status' => $_POST['status'],
			);	
			$new_photo->create($data);
			redirect(base_url('photogallery/photo/'.$new_photo->id.''));
		}
		
		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->photogalleryfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->photogalleryfollow->where('follower_id',$this->user->id)->get(),
			'num_photos' => $this->photogallerymedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'photos' => $this->photogallerymedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->photogalleryalbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->photogallerylike->where('user_id',$this->user->id)->get(),
		);

		$this->load->view('frontend/upload.tpl', $data);
	}

	public function upload_photo()
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		$allowed = array('jpg','jpeg','png','gif','JPG','JPEG');

		if(isset($_FILES['uplo']) && $_FILES['uplo']['error'] == 0){

			$extension = pathinfo($_FILES['uplo']['name'], PATHINFO_EXTENSION);

			if(!in_array(strtolower($extension), $allowed)){
				echo '{"status":"error"}';
				exit;
			}
			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			 if(!is_dir("files/users/user_".$user_id."/photogallery"))
				mkdir("files/users/user_".$user_id."/photogallery");
			 if(!is_dir("files/users/user_".$user_id."/photogallery/photos"))
				mkdir("files/users/user_".$user_id."/photogallery/photos");
			if(move_uploaded_file($_FILES['uplo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/photogallery/photos/'.$_FILES['uplo']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;		
	}

	public function edit_photo($id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		if($_POST){
			if(!isset($_POST['file'])){
				$placeholder = $_SERVER['DOCUMENT_ROOT'].'/builderengine/public/img/photo_placeholder.png';
				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($placeholder, PATHINFO_EXTENSION);
				$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$this->user->get_id().'/photogallery/photos/'.$newUniqueFileName.'.'.$ext;
				copy($placeholder,$newFileName);
				$_POST['file'] = base_url().'files/users/user_'.$this->user->get_id().'/photogallery/photos/'.$newUniqueFileName.'.'.$ext;
			}else
				$_POST['file'] = base_url().'files/users/user_'.$this->user->get_id().'/photogallery/photos/'.$_POST['file'];
			$this->photogallerymedia->where('id',$id)->update($_POST);
		}
		redirect(base_url('photogallery/myphotos'),'location');
	}

	public function edit_album($id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		if($_POST){
			$user_id = $this->user->get_id();
			if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
				$allowed = array('jpg','jpeg','png');
				$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $allowed)){
					redirect(base_url('photogallery/myalbums'),'location');
				}
				else{
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/photogallery"))
						mkdir("files/users/user_".$user_id."/photogallery");
					 if(!is_dir("files/users/user_".$user_id."/photogallery/images"))
						mkdir("files/users/user_".$user_id."/photogallery/images");
					if(move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/photogallery/images/'.$_FILES['image']['name'])){
						$_POST['image'] = base_url('files/users/user_'.$user_id.'/photogallery/images/'.$_FILES['image']['name']);
					}
				}
			}			
			$this->photogalleryalbum->where('id',$id)->update($_POST);
		}
		redirect(base_url('photogallery/myalbums'),'location');
	}

	public function delete_photo($id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		$photo = new PhotoGalleryMedia($id);
		$photo_reports = new PhotoGalleryPhotoReport();
		foreach($photo_reports->where('media_id',$photo->id)->get() as $photo_report){
			$photo_report->delete();
		}
		$likes = new PhotoGalleryLike();
		foreach($likes->where('media_id',$photo->id)->get() as $like){
			$like->delete();
		}
		$comments = new PhotoGalleryComment();
		foreach($comments->where('media_id',$photo->id)->get() as $comment){
			$comment_reports = new PhotoGalleryCommentReport();
			foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
				$comment_report->delete();
			}
			$comment->delete();
		}		
		$ratings = new PhotoGalleryRating();
		foreach($ratings->where('media_id',$photo->id)->get() as $rating){
			$rating->delete();
		}
		$extension = pathinfo($photo->file, PATHINFO_EXTENSION);
		$file_path = $this->session->userdata('user_dir').'/'.$file->name.'.'.$extension;
		unlink($file_path);
		$photo->delete();
		redirect(base_url('photogallery/myphotos/'),'location');
	}

	public function delete_album($id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));
		$album = new PhotoGalleryAlbum($id);
		$photos = new PhotoGalleryMedia();
		foreach($photos->where('album_id',$album->id)->get() as $photo){
			$photo_reports = new PhotoGalleryPhotoReport();
			foreach($photo_reports->where('media_id',$photo->id)->get() as $photo_report){
				$photo_report->delete();
			}
			$likes = new PhotoGalleryLike();
			foreach($likes->where('media_id',$photo->id)->get() as $like){
				$like->delete();
			}
			$comments = new PhotoGalleryComment();
			foreach($comments->where('media_id',$photo->id)->get() as $comment){
				$comment_reports = new PhotoGalleryCommentReport();
				foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}		
			$ratings = new PhotoGalleryRating();
			foreach($ratings->where('media_id',$photo->id)->get() as $rating){
				$rating->delete();
			}
			$extension = pathinfo($photo->file, PATHINFO_EXTENSION);
			$file_path = $this->session->userdata('user_dir').'/'.$file->name.'.'.$extension;
			unlink($file_path);
			$photo->delete();
		}
		$album->delete();
		redirect(base_url('photogallery/myalbums/'),'location');
	}

	public function delete_profile($user_id)
	{
		if($this->BuilderEngine->get_option('photogallery_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || $this->BuilderEngine->get_option('photogallery_option') != 'open')
			redirect(base_url('photogallery/login'));

		$users = new PhotoGalleryUserSettings();
		$data = array('active' => 'no');
		foreach($users->get() as $u){
			$u->where('user_id',$user_id)->update($data);
		}
		$albums = $this->photogalleryalbum->where('user_id',$user_id)->get();
		foreach($albums as $album){
			$album->delete();
		}
		$photos = $this->photogallerymedia->where('user_id',$user_id)->get();
		foreach($photos as $photo){	
			$photo_reports = $this->photogalleryphotoreport->where('media_id',$photo->id)->get();
			foreach($photo_reports as $photo_report){
				$photo_report->delete();
			}
			$comments = $this->photogallerycomment->where('media_id',$photo->id)->get();
			foreach($comments as $comment){
				$comment_reports = $this->photogallerycommentreport->where('comment_id',$comment->id)->get();
				foreach($comment_reports as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}
			$ratings = $this->photogalleryrating->where('media_id',$photo->id)->get();
			foreach($ratings as $rating){
				$rating->delete();
			}
			$photo->delete();
		}
		$followers = $this->photogalleryfollow->where('follower_id',$user_id)->get();
		foreach($followers as $follower){
			$follower->delete();
		}
		$followings = $this->photogalleryfollow->where('following_id',$user_id)->get();
		foreach($followings as $following){
			$following->delete();
		}
		$likes = $this->photogallerylike->where('user_id',$user_id)->get();
		foreach($likes as $like){
			$like->delete();
		}
		$dir = $this->session->userdata('user_dir');
		system('/bin/rm -rf ' . escapeshellarg($dir));
		$this->logout();
	}
}