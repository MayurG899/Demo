<?	
 class ClassifiedsFiles extends CI_Model
 {
    function upload_image($name, $folder, $subfolder)
        {
            if(!is_dir("files"))
                mkdir("files");
 
            if(!is_dir("files/".$folder))
                mkdir("files/".$folder);

            if(!is_dir("files/".$folder."/".$subfolder))
                mkdir("files/".$folder."/".$subfolder);
 
 
            $this->load->library('upload');
 
            $file = $name;
            // Check if there was a file uploaded - there are other ways to
            // check this such as checking the 'error' for the file - if error
            // is 0, you are good to code
 
 
            // Specify configuration for File
            $filename = md5(rand());
            $config['file_name'] = $filename.".jpg";
            $config['upload_path'] = 'files/'.$folder.'/'.$subfolder.'/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '11100';
            $config['max_width']  = '22048';
            $config['max_height']  = '22048';
            $config['overwrite']  = true;
 
            // Initialize config for File
            $this->upload->initialize($config);
 
            // Upload file
            if ($this->upload->do_upload($file))
            {
                $result = $this->upload->data();
                return "/".$config['upload_path'].$filename.".jpg";
            }
    }


    function upload_avatar($input_name, $username)
        {
            if(!is_dir("files"))
                mkdir("files");
 
            if(!is_dir("files/avatars"))
                mkdir("files/avatars");
 
 
            $this->load->library('upload');
 
            $file = $input_name;
            // Check if there was a file uploaded - there are other ways to
            // check this such as checking the 'error' for the file - if error
            // is 0, you are good to code
 
 
            // Specify configuration for File
            $filename = $username;
            $config['file_name'] = $filename.".jpg";
            $config['upload_path'] = 'files/avatars/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '11100';
            $config['max_width']  = '22048';
            $config['max_height']  = '22048';
            $config['overwrite']  = true;
 
            // Initialize config for File
            $this->upload->initialize($config);
 
            // Upload file
            if ($this->upload->do_upload($file))
            {
                $result = $this->upload->data();
                return "/".$config['upload_path'].$filename.".jpg";
            }
    }
}