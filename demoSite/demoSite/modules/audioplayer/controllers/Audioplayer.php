<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function initialize_soundupload_js()
	{
		echo "
			<!-- jQuery File Upload Dependencies -->
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.ui.widget.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.iframe-transport.js')."\" type=\"text/javascript\"></script>
			<script src=\"".base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.fileupload.js')."\" type=\"text/javascript\"></script>
			<!-- Main file Upload JS file -->
			<script src=\"".base_url('builderengine/public/mediamodules/audioplayer/uploadsound.js')."\" type=\"text/javascript\"></script>
			";
	}
	function initialize_sound_tagit_js()
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

class Audioplayer extends Module_Controller {

    function __construct()
    {
        parent::__construct();
		$this->load->model('user');
		$this->load->model('users');
		$this->load->model('audioplayermedia');
		$this->load->model('audioplayerlike');
		$this->load->model('audioplayeralbum');
		$this->load->model('audioplayerfollow');
		$this->load->model('audioplayercomment');
		$this->load->model('audioplayerrating');
		$this->load->model('audioplayercommentreport');
		$this->load->model('audioplayersoundreport');
		$this->load->model('audioplayerusersettings');
		$this->load->model('visits');
    }
	
	public function login($info = null)
	{
		/*
		if($this->user->is_logged_in()){
			if($this->BuilderEngine->get_option('audioplayer_option')=='open')
				redirect(base_url('/audioplayer/mysettings'),'location');
			else
				redirect(base_url('/audioplayer/all_sounds'),'location');
		}
		*/
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		$this->load->model('users');
		if($info == 'info')
			$data['info'] = 'You must be signed in or registered user to be able to post !';
		if($info == 'approval')
			$data['info'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
		if($info == 'password')
			$data['info'] = 'Reset token has been sent to your email address!';		
		if($_POST){
			if(isset($_POST['email'])){
				$this->users->send_password_reset_email(urldecode($_POST['email']));
				redirect(base_url('audioplayer/login/password'),'location');
			}
            $userid = $this->users->verify_login($_POST['username'], $_POST['password']);
			$sound_user = new AudioPlayerUserSettings();
			$sound_user = $sound_user->where('user_id',$userid)->get();
			if($userid != -1 && $userid != 0 && $sound_user->user_id == $userid){
				$this->user->initialize($userid);
				
				if($this->builderengine->get_option('audioplayer_option')=='open')
					redirect(base_url('audioplayer/myfeed'), 'location');
				else
					redirect(base_url('audioplayer/all_audios'), 'location');
			}
			else{
				$registered_user = new User();
				$registered_user = $registered_user->where('username',$_POST['username'])->where('password',md5($_POST['password']))->get();
				if($registered_user->id > 0 && $registered_user->verified == 'no'){
					$data['error_msg'] = 'Your account has been registered and awaiting for approval.Once approved,you will be notified by email!';
				}
				elseif($registered_user->id > 0 && $registered_user->verified == 'yes'){
					$data['error_msg'] = 'In order to get permission for sound gallery ,please contact your <a href="mailto:'.$this->BuilderEngine->get_option('adminemail').'?Subject=AudioPlayer%20access%20request">admin</a> !';
				}
				else
					$data['error_msg'] = 'Invalid username or password';
			}
		}
		$data['errors'] = '';
		$data['login_info'] = $this->BuilderEngine->get_option('audioplayer_login_info');
		$this->load->view('frontend/login.tpl',$data);	
	}
	public function logout()
	{
		$this->user->logout(base_url('audioplayer/login'));
	}
		
	public function register($error = null)
	{
		/*
		if($this->user->is_logged_in())
			redirect(base_url('/audioplayer/all_sounds'),'location');
		*/
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
        $data['error'] = '';
		if($_POST){
            if($_POST['password'] != $_POST['password_re'])
                redirect(base_url('audioplayer/register/password'), 'location');
            else{
				if($this->BuilderEngine->get_option('audioplayer_access_groups'))
					$_POST['groups'] = $this->BuilderEngine->get_option('audioplayer_access_groups');
                $created = $this->users->register_user($_POST);
                if($created != false){
					$user_settings = new AudioPlayerUserSettings();
					$settings = array(
						'user_id' => $created,
						'about' => '',
						'background_img' => '',
					);
					$user_settings->create($settings);
                   // if(isset($_GET['token']) && $_GET['token'] != '')
					if($this->BuilderEngine->get_option('sign_up_verification') == 'admin')
						redirect(base_url('audioplayer/login/approval'), 'location');
					else
						redirect(base_url('audioplayer/login'), 'location');
                }
                else
                    redirect(base_url('audioplayer/register/exists'), 'location');
            }
		}
		$audioplayer_terms = $this->BuilderEngine->get_option('audioplayer_terms');
		$data['register_info'] = $this->BuilderEngine->get_option('audioplayer_register_info');
		$data['audioplayer_terms'] = (!empty($audioplayer_terms))?$audioplayer_terms:'';
		$this->load->view('frontend/register.tpl', $data);	
	}

	public function channel($username = null,$page = null)
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
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
			$this->audioplayercomment->create($data);
			redirect($_SERVER['HTTP_REFERER']);
		}
		$owner = new User();
		$owner = $owner->where('username',$username)->get();
		
		$settings = new AudioPlayerUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
		
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();		
		$data = array(
			'author' => $owner,
			'channel_owner' => $owner,
			'owner_settings' => $owner_settings,
			'gallery_option' => $this->BuilderEngine->get_option('audioplayer_option'),
			'albums' => $this->audioplayeralbum->where('user_id',$owner->id)->get(),
			'sounds' => $this->audioplayermedia->where('user_id',$owner->id)->get(),
			'followers' => $this->audioplayerfollow->where('following_id',$owner->id)->count(),
			'num_owners_sounds' => $this->audioplayermedia->where('user_id',$owner->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
		if($page == 'album'){
			$this->load->view('frontend/album.tpl',$data);
		}
		elseif($page == 'about'){
			$this->load->view('frontend/about.tpl',$data);
		}
		elseif($page == 'audios'){
			$this->load->view('frontend/audios.tpl',$data);
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
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'num_tags' => $this->BuilderEngine->get_option('audioplayer_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('audioplayer_show_tags'),
			'sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
			'sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/myfeed.tpl', $data);		
		
    }

	public function mysettings()
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
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
				 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
					mkdir("files/users/user_".$user_id."/audioplayer");
				 if(!is_dir("files/users/user_".$user_id."/audioplayer/avatars"))
					mkdir("files/users/user_".$user_id."/audioplayer/avatars");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/audioplayer/avatars/".$newFileName);
			
				$_POST['avatar'] = base_url().'files/users/user_'.$user_id.'/audioplayer/avatars/'.$newFileName;
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
				 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
					mkdir("files/users/user_".$user_id."/audioplayer");
				 if(!is_dir("files/users/user_".$user_id."/audioplayer/backgrounds"))
					mkdir("files/users/user_".$user_id."/audioplayer/backgrounds");

				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file_name, PATHINFO_EXTENSION);
				$newFileName = $newUniqueFileName.'.'.$ext;
				move_uploaded_file($file_tmp,"files/users/user_".$user_id."/audioplayer/backgrounds/".$newFileName);
			
				$_POST['background_img'] = base_url().'files/users/user_'.$user_id.'/audioplayer/backgrounds/'.$newFileName;
			}
			$current_settings = new AudioPlayerUserSettings();
			$current_settings = $current_settings->where('user_id',$user_id)->get();
			$setting = array(
				'background_img' => (isset($_POST['background_img']))?$_POST['background_img']:$current_settings->background_img,
				'about' => $_POST['about'],
				'channel_comments' => $_POST['channel_comments']
			);
			$this->audioplayerusersettings->where('user_id',$user_id)->update($setting);

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
            //if(strlen($_POST['password']) > 1)
            //    $update['password'] = md5($_POST['password']);
 
            $this->db->where('id', $user_id);
            $this->db->update('users', $update);
		}

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->audioplayerusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
		);
		$this->load->view('frontend/mysettings', $data);
    }

	public function mysounds()
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		add_action("be_foot", "initialize_sound_tagit_js");
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		
		$settings = new AudioPlayerUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->audioplayerusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'my_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/mysounds', $data);
	}

	public function myalbums()
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		$owner = new User();
		$owner = $owner->where('id',$this->user->id)->get();
		$settings = new AudioPlayerUserSettings();
		$owner_settings = $settings->where('user_id',$owner->id)->get();
	
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$owner->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'user_settings' => $this->audioplayerusersettings->where('user_id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'my_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'my_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
		);	
		$this->load->view('frontend/myalbums', $data);
	}

    public function all_audios()
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
        $sounds = new AudioPlayerMedia();
	
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('audioplayer_num_medias_displayed')){
            $sounds_per_page = 6;
        }
        else
            $sounds_per_page = $this->BuilderEngine->get_option('audioplayer_num_medias_displayed');

        $data['sounds'] = $sounds->get_paged($page_number, $sounds_per_page);
        $data['albums'] = $this->get_albums();
		$data['gallery_option'] = $this->BuilderEngine->get_option('audioplayer_option');
		$this->load->view('frontend/all_sounds.tpl', $data);
    }

    public function search($keyword = null)
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
        $keyword = urldecode($keyword);
        $sounds = new AudioPlayerMedia();
        if(isset($_GET['keyword'])){
            redirect(base_url('audioplayer/search/'.$_GET['keyword']), 'location');
        }

        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$this->BuilderEngine->get_option('audioplayer_num_medias_displayed')){
            $sounds_per_page = 6;
        }
        else
            $sounds_per_page = $this->BuilderEngine->get_option('audioplayer_num_medias_displayed');
        
        $data['albums'] = $this->get_albums();
        $data['sounds'] = $sounds->like('title', $keyword)->or_like('tags', $keyword)->or_like('description', $keyword)->order_by('time_created', 'desc')->get_paged($page_number, $sounds_per_page);
        $data['keyword'] = $keyword;
		$data['gallery_option'] = $this->BuilderEngine->get_option('audioplayer_option');
        $this->load->view('frontend/search.tpl', $data);
    }

    public function report_comment()
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
        if($_GET){
            $comment = new AudioPlayerComment($_GET['comment_id']);
            $comment->report($_GET['text']);
            redirect(base_url('audioplayer/sound/'.$comment->media->get()->id), 'location');
        }
    }

    public function report_sound()
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
        if($_GET){
            $sound = new AudioPlayerMedia($_GET['media_id']);
            $sound->report($_GET['text']);
            redirect(base_url('audioplayer/sound/'.$sound->id), 'location');
        }
    }

    public function sound($id = null)
    {
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
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
			
			$this->audioplayercomment->create($data);
			redirect(base_url('audioplayer/sound/'.$id));
		}

        $sound = new AudioPlayerMedia();
		$sound = $sound->where('id',$id)->get();
		$comments = new AudioPlayerComment();
		$author = new User();
		$author = $author->where('id',$sound->user_id)->get();
		$likes = new AudioPlayerLike();
		$follow = new AudioPlayerFollow();
		$followed = $follow->where('following_id',$author->id)->where('follower_id',$this->user->get_id())->count();

		$data = array(
			'author' => $author,
			'sound' => $sound,
			'sounds' => $this->audioplayermedia->where('album_id',$sound->album_id)->get(),
			'album' => $this->audioplayeralbum->where('id',$sound->album_id)->get(),
			'author_albums' => $this->audioplayeralbum->where('user_id',$author->id)->get(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$author->id)->count(),
			'comments' => $sound->comments->get(),
			'num_authors_sounds' => $sound->where('user_id',$author->id)->count(),
			'num_sound_views' => $this->visits->where('page','audioplayer/sound/'.$id.'')->count(),
			'num_tags' => $this->BuilderEngine->get_option('audioplayer_num_tags_displayed'),
			'show_tags' => $this->BuilderEngine->get_option('audioplayer_show_tags'),
			'gallery_option' => $this->BuilderEngine->get_option('audioplayer_option'),
			'allow_ratings' => $this->BuilderEngine->get_option('audioplayer_allow_ratings'),
			'allow_comments' => $this->BuilderEngine->get_option('audioplayer_allow_comments'),
			'ratings' => $this->audioplayerrating->select_avg('rating')->where('media_id',$sound->id)->get(),
			'num' => ($this->BuilderEngine->get_option('audioplayer_allow_ratings')=='yes')?12:9,
			'likes' => $sound->likes->where('status','like')->count(),
			'unlikes' => $sound->likes->where('status','unlike')->count(),
			'followers' => $this->audioplayerfollow->where('following_id',$author->id)->count(),
			'followed' => ($followed != 0)?'yes':'no',
		);
        $this->load->view('frontend/single_sound.tpl', $data);
    }

    public function get_albums()
    {
        return $this->audioplayeralbum->get();
    }

    public function get_comments($sound_id)
    {
        return $this->audioplayercomment->where('media_id',$sound_id)->get();
    }

    public function delete_comment($id)
	{
        if(!$this->user->is_member_of("Administrators")){
            show_404();
		}
		$id = intval($id);
		$comment = new AudioPlayerComment($id);
		$comment->delete();
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function rate_sound() 
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
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
    			
				$rating = new AudioPlayerRating();
				$rating->create($data);
				redirect($_SERVER['HTTP_REFERER']);				
            }
            else{
				if($this->BuilderEngine->get_option('audioplayer_option') != 'open')
					redirect($_SERVER['HTTP_REFERER']);
				else
					redirect(base_url('audioplayer/login'), 'location');
            }
		}
	}
	
	public function get_average_rating($media_id)
	{
		$ratings = new AudioPlayerRating();
		$ratings = $ratings->select_avg('rating')->where('media_id',$media_id)->get();
		
		foreach($ratings as $item){
			$total_rate = round($item->rating);
		}
		return $total_rate;
	}

	public function add_album($first = null)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'), 'location');
		if($_POST){
			$album = new AudioPlayerAlbum();
			$_POST['name'] = str_replace(array(' ','`','"','.'), '_', $_POST['name']);
			$album->create($_POST);
			redirect(base_url('audioplayer/upload'), 'location');
		}

		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
			'first_album' => ($first)?'yes':'no',
		);	
		$this->load->view('frontend/add_album.tpl', $data);
	}

	public function upload()
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		add_action('be_foot','initialize_soundupload_js');
		
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		if($_POST){
			$new_sound = new AudioPlayerMedia();
			
			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
				mkdir("files/users/user_".$user_id."/audioplayer");
			 if(!is_dir("files/users/user_".$user_id."/audioplayer/audios"))
				mkdir("files/users/user_".$user_id."/audioplayer/audios");

			$data = array(
				'user_id' => $user_id,
				'media_file' => base_url('files/users/user_'.$user_id.'/audioplayer/audios/'.$_POST['media_file']),
				'cover' => base_url('modules/audioplayer/assets/images/audio_placeholder.png'),
				'title' => $_POST['title'],
				'text' => $_POST['text'],
				'album_id' => $_POST['album_id'],
				'comments_allowed' => (isset($_POST['comments_allowed']))?'yes':'no',
				'tags' => $_POST['tags'],
				'groups_allowed' => $_POST['groups_allowed'],
				'status' => $_POST['status'],
			);	
			$new_sound->create($data);
			redirect(base_url('audioplayer/sound/'.$new_sound->id.''));
		}
		
		$data = array(
			'user' => $this->user->where('id',$this->user->id)->get(),
			'num_followers' => $this->audioplayerfollow->where('following_id',$this->user->id)->count(),
			'followers' => $this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'followings' =>$this->audioplayerfollow->where('follower_id',$this->user->id)->get(),
			'num_sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->count(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'sounds' => $this->audioplayermedia->where('user_id',$this->user->id)->get(),
			'num_albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->count(),
			'albums' => $this->audioplayeralbum->where('user_id',$this->user->id)->get(),		
			'likes' => $this->audioplayerlike->where('user_id',$this->user->id)->get(),
		);

		$this->load->view('frontend/upload.tpl', $data);
	}

	public function upload_sound()
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		$allowed = array('ogg','mpeg','mp3');

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
			 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
				mkdir("files/users/user_".$user_id."/audioplayer");
			 if(!is_dir("files/users/user_".$user_id."/audioplayer/audios"))
				mkdir("files/users/user_".$user_id."/audioplayer/audios");
			if(move_uploaded_file($_FILES['uplo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/audioplayer/audios/'.$_FILES['uplo']['name'])){
				echo '{"status":"success"}';
				exit;
			}
		}
		echo '{"status":"error"}';
		exit;		
	}

	public function edit_sound($id)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		if($_POST){	
			$user_id = $this->user->get_id();
			if(isset($_FILES['cover']) && $_FILES['cover']['error'] == 0){
				$allowed = array('jpg','jpeg','png');
				$extension = pathinfo($_FILES['cover']['name'], PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $allowed)){
					redirect(base_url('audioplayer/mysounds'),'location');
				}
				else{
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
						mkdir("files/users/user_".$user_id."/audioplayer");
					 if(!is_dir("files/users/user_".$user_id."/audioplayer/images"))
						mkdir("files/users/user_".$user_id."/audioplayer/images");
					if(move_uploaded_file($_FILES['cover']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/audioplayer/images/'.$_FILES['cover']['name'])){
						$_POST['cover'] = base_url('files/users/user_'.$user_id.'/audioplayer/images/'.$_FILES['cover']['name']);
					}
				}
			}
			$this->audioplayermedia->where('id',$id)->update($_POST);
		}
		redirect(base_url('audioplayer/mysounds'),'location');
	}

	public function edit_album($id)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		if($_POST){
			$user_id = $this->user->get_id();
			if(isset($_FILES['image']) && $_FILES['image']['error'] == 0){
				$allowed = array('jpg','jpeg','png');
				$extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				if(!in_array(strtolower($extension), $allowed)){
					redirect(base_url('audioplayer/myalbums'),'location');
				}
				else{
					if(!is_dir("files/users"))
						mkdir("files/users");
					if(!is_dir("files/users/user_".$user_id))
						mkdir("files/users/user_".$user_id);
					 if(!is_dir("files/users/user_".$user_id."/audioplayer"))
						mkdir("files/users/user_".$user_id."/audioplayer");
					 if(!is_dir("files/users/user_".$user_id."/audioplayer/images"))
						mkdir("files/users/user_".$user_id."/audioplayer/images");
					if(move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/audioplayer/images/'.$_FILES['image']['name'])){
						$_POST['image'] = base_url('files/users/user_'.$user_id.'/audioplayer/images/'.$_FILES['image']['name']);
					}
				}
			}			
			$this->audioplayeralbum->where('id',$id)->update($_POST);
		}
		redirect(base_url('audioplayer/myalbums'),'location');
	}

	public function delete_sound($id)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		$sound = new AudioPlayerMedia($id);
		$sound_reports = new AudioPlayerSoundReport();
		foreach($sound_reports->where('media_id',$sound->id)->get() as $sound_report){
			$sound_report->delete();
		}
		$likes = new AudioPlayerLike();
		foreach($likes->where('media_id',$sound->id)->get() as $like){
			$like->delete();
		}
		$comments = new AudioPlayerComment();
		foreach($comments->where('media_id',$sound->id)->get() as $comment){
			$comment_reports = new AudioPlayerCommentReport();
			foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
				$comment_report->delete();
			}
			$comment->delete();
		}		
		$ratings = new AudioPlayerRating();
		foreach($ratings->where('media_id',$sound->id)->get() as $rating){
			$rating->delete();
		}
		$file_path = str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$sound->file);
		unlink($file_path);
		$sound->delete();
		redirect(base_url('audioplayer/mysounds/'),'location');
	}

	public function delete_album($id)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));
		$album = new AudioPlayerAlbum($id);
		$sounds = new AudioPlayerMedia();
		foreach($sounds->where('album_id',$album->id)->get() as $sound){
			$sound_reports = new AudioPlayerSoundReport();
			foreach($sound_reports->where('media_id',$sound->id)->get() as $sound_report){
				$sound_report->delete();
			}
			$likes = new AudioPlayerLike();
			foreach($likes->where('media_id',$sound->id)->get() as $like){
				$like->delete();
			}
			$comments = new AudioPlayerComment();
			foreach($comments->where('media_id',$sound->id)->get() as $comment){
				$comment_reports = new AudioPlayerCommentReport();
				foreach($comment_reports->where('comment_id',$comment->id)->get() as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}		
			$ratings = new AudioPlayerRating();
			foreach($ratings->where('media_id',$sound->id)->get() as $rating){
				$rating->delete();
			}
			$extension = pathinfo($sound->file, PATHINFO_EXTENSION);
			$file_path = $this->session->userdata('user_dir').'/'.$file->name.'.'.$extension;
			unlink($file_path);
			$sound->delete();
		}
		$album->delete();
		redirect(base_url('audioplayer/myalbums/'),'location');
	}

	public function delete_profile($user_id)
	{
		if($this->BuilderEngine->get_option('audioplayer_active') !== 'yes')
			show_404();
		if(!$this->user->is_logged_in() || ($this->BuilderEngine->get_option('audioplayer_option') != 'open' &&  !$this->users->is_admin()))
			redirect(base_url('audioplayer/login'));

		$users = new AudioPlayerUserSettings();
		$data = array('active' => 'no');
		foreach($users->get() as $u){
			$u->where('user_id',$user_id)->update($data);
		}
		$albums = $this->audioplayeralbum->where('user_id',$user_id)->get();
		foreach($albums as $album){
			$album->delete();
		}
		$sounds = $this->audioplayermedia->where('user_id',$user_id)->get();
		foreach($sounds as $sound){	
			$sound_reports = $this->audioplayersoundreport->where('media_id',$sound->id)->get();
			foreach($sound_reports as $sound_report){
				$sound_report->delete();
			}
			$comments = $this->audioplayercomment->where('media_id',$sound->id)->get();
			foreach($comments as $comment){
				$comment_reports = $this->audioplayercommentreport->where('comment_id',$comment->id)->get();
				foreach($comment_reports as $comment_report){
					$comment_report->delete();
				}
				$comment->delete();
			}
			$ratings = $this->audioplayerrating->where('media_id',$sound->id)->get();
			foreach($ratings as $rating){
				$rating->delete();
			}
			$sound->delete();
		}
		$followers = $this->audioplayerfollow->where('follower_id',$user_id)->get();
		foreach($followers as $follower){
			$follower->delete();
		}
		$followings = $this->audioplayerfollow->where('following_id',$user_id)->get();
		foreach($followings as $following){
			$following->delete();
		}
		$likes = $this->audioplayerlike->where('user_id',$user_id)->get();
		foreach($likes as $like){
			$like->delete();
		}
		$dir = $this->session->userdata('user_dir');
		system('/bin/rm -rf ' . escapeshellarg($dir));
		$this->logout();
	}
}