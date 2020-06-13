<?
	class Ajax extends Module_Controller
	{
		public function get_state_lgas($state_id, $default_id = 0)
		{
			$lgas = new ClassifiedsLga();
			$lgas = $lgas->where('state_id', $state_id)->get();
			
			foreach($lgas as $lga)
			{
				$output = '<option value="'.$lga->name.'"';
				if($default_id != 0)
				{
					if($default_id == $lga->id)
						$output.= 'selected';
				}

				$output .='>'.$lga->name.'</option>';

				echo $output;
			}
		}
		
		public function get_make_models($make_id, $default_id = 0)
		{
			$models = new ClassifiedsModel();
			$models = $models->where('make_id', $make_id)->get();
			
			foreach($models as $model)
			{
				$output = '<option value="'.$model->name.'"';
				if($default_id != 0)
				{
					if($default_id == $model->id)
						$output.= 'selected';
				}

				$output .='>'.$model->name.'</option>';

				echo $output;
			}
		}

		public function upload()
		{
			$user_id = $this->user->get_id();
			if(!is_dir("files/users"))
				mkdir("files/users");
			if(!is_dir("files/users/user_".$user_id))
				mkdir("files/users/user_".$user_id);
			 if(!is_dir("files/users/user_".$user_id."/classifieds"))
				mkdir("files/users/user_".$user_id."/classifieds");
			 if(!is_dir("files/users/user_".$user_id."/classifieds/images"))
				mkdir("files/users/user_".$user_id."/classifieds/images");

			$files = $this->_reArrangeFiles($_FILES['image']);

			foreach ($files as $file) {
				//echo 'File Name: ' . $file['name'];
				//echo 'File Type: ' . $file['type'];
				//echo 'File Size: ' . $file['size'];
				$newUniqueFileName = md5(uniqid());
				$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
				$newFileName = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/classifieds/images/'.$newUniqueFileName.'.'.$ext;
				move_uploaded_file($file['tmp_name'], $newFileName);
				echo $newUniqueFileName.'.'.$ext;
			}
			
		}

		public function remove_file()
		{
			if(isset($_POST['fileName'])){
				$fileName = $_POST['fileName'];
				$file = $_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/classifieds/images/'.$_POST['fileName'];
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
			$ad = new ClassifiedsItem($item_id);
			$images = array();
			if($ad->exists()){
				if($ad->image->count() > 0){
					foreach($ad->image->get() as $item){
						if(strpos($item->image,'be_demo') !== FALSE){
							$user_id = $this->user->get_id();
							if(!is_dir("files/users"))
								mkdir("files/users");
							if(!is_dir("files/users/user_".$user_id))
								mkdir("files/users/user_".$user_id);
							 if(!is_dir("files/users/user_".$user_id."/classifieds"))
								mkdir("files/users/user_".$user_id."/classifieds");
							 if(!is_dir("files/users/user_".$user_id."/classifieds/images"))
								mkdir("files/users/user_".$user_id."/classifieds/images");
							$img = base_url().$item->image;
							$img_name = basename($img);
							copy($_SERVER['DOCUMENT_ROOT'].$item->image,$_SERVER['DOCUMENT_ROOT'].'/files/users/user_'.$user_id.'/classifieds/images/'.$img_name);
							$item->image = base_url().'files/users/user_'.$user_id.'/classifieds/images/'.$img_name;
						}
						$image = array(
							'name' => basename($item->image),
							'size' => filesize(str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$item->image)),
							'url' => checkImagePath($item->image),
							'path' => str_replace(base_url(),$_SERVER['DOCUMENT_ROOT'].'/',$item->image)
						);
						array_push($images,$image);
					}
					echo json_encode($images);
				}
			}
		}
	}

?>