<?php
class Photogallery_all_photos_thumbnails_user_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "User Photos Thumbnails";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('photogallery');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$usr = new User();
		$usr = $usr->where('username',$segments[$count-2])->get();
		$photos = $CI->photogallerymedia->where('user_id',$usr->id)->get();
		$albums = $CI->photogallery->get_albums();
        $page_number = 1;
        if(isset($_GET['page'])){
            $page_number = $_GET['page'];
        }
        if(!$CI->BuilderEngine->get_option('photogallery_num_medias_displayed')){
            $photos_per_page = 6;
        }
        else
            $photos_per_page = $CI->BuilderEngine->get_option('photogallery_num_medias_displayed');
			
		//View
        $output ='
                <div class="row">';
					foreach($photos as $photo){
					    $photo_album = new PhotoGalleryAlbum($photo->album_id);
						if($photo_album->status != 'private' || ($photo_album->status == 'private' && $user->get_id() == $photo_album->user_id)){
							$output .='
							<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 photogallery-allvideos-paddings">
								<div class="photogallery-item-box photogallery-item-grid-height">
									<a href="'.base_url('photogallery/photo/'.$photo->id.'').'">
										<img src="'.checkImagePath($photo->file).'" class="photogallery-item-container" alt="'.$photo->description.'" >
										<div class="photogallery-item-mask">
											<div class="photogallery-item-caption">
												<h5 class="white">'.str_replace('_',' ',$photo->title).'</h5>';
												$author = new User($photo->user_id);
												$output .='<p class="white">By '.$author->first_name.' '.$author->last_name.'</p>
											</div>
										</div>
									</a>
								</div>
							</div>';
						}
					}
        $output .='</div>';

        return $output;
    }
}
?>