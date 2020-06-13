<?php
	class Ajax extends Module_Controller
	{
		public function upload()
		{
			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			 if(!is_dir("files/users/user_".$user_id."/booking_events"))
				mkdir("files/users/user_".$user_id."/booking_events");
			 if(!is_dir("files/users/user_".$user_id."/booking_events/images"))
				mkdir("files/users/user_".$user_id."/booking_events/images");

			$files = $this->_reArrangeFiles($_FILES['images']);

			foreach ($files as $file) {
				//echo 'File Name: ' . $file['name'];
				//echo 'File Type: ' . $file['type'];
				//echo 'File Size: ' . $file['size'];
				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/booking_events/images/'.$newUniqueFileName.'.'.$ext;
				move_uploaded_file($file['tmp_name'], $newFileName);
				echo $newUniqueFileName.'.'.$ext;
			}
			
		}

		public function remove_file()
		{
			if(isset($_POST['fileName'])){
				$fileName = $_POST['fileName'];
				$file = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/booking_events/images/'.$_POST['fileName'];
				if(file_exists($file)){
					unlink($file);
					echo 'file deleted: '.$fileName;
				}else
					echo 'file deletion for : '.$fileName.' failed!';	
			}else
				echo 'No file to delete!';
		}

		public function _reArrangeFiles(&$file_post) {

			$file_array = array();
			$file_count = count($file_post['name']);
			$file_keys = array_keys($file_post);

			for ($i=0; $i<$file_count; $i++) {
				foreach ($file_keys as $key) {
					$file_array[$i][$key] = $file_post[$key][$i];
				}
			}
			return $file_array;
		}

		public function get_uploaded_files($item_id)
		{
			$ad = new Booking_event($item_id);
			$images = array();
			if($ad->exists()){
				if($ad->additional_image->count() > 0){
					foreach($ad->additional_image->get() as $item){
						if(strpos($item->url,'be_demo') !== FALSE){
							$user_id = $this->user->get_id();
							if(!is_dir("files/users"))
								mkdir("files/users");
							if(!is_dir("files/users/user_".$user_id))
								mkdir("files/users/user_".$user_id);
							 if(!is_dir("files/users/user_".$user_id."/booking_events"))
								mkdir("files/users/user_".$user_id."/booking_events");
							 if(!is_dir("files/users/user_".$user_id."/booking_events/images"))
								mkdir("files/users/user_".$user_id."/booking_events/images");
							$img = base_url().$item->url;
							$img_name = basename($img);
							copy($_SERVER['DOCUMENT_ROOT'].$item->url,$_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/booking_events/images/'.$img_name);
							$item->url = base_url().'files/users/user_'.$user_id.'/booking_events/images/'.$img_name;
						}
						$image = array(
							'name' => basename($item->url),
							'size' => filesize(str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$item->url)),
							'url' => checkImagePath($item->url),
							'path' => str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$item->url)
						);
						array_push($images,$image);
					}
					echo json_encode($images);
				}
			}
		}
	}
