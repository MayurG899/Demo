<?php
class photogallery_single_photo_file_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Photo File";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$curr_photo_id = $this->block->data('photo');
		$available_photos = array();
		$all_photos = new PhotoGalleryMedia();
		foreach($all_photos->where('status','public')->get() as $key => $value){
			$available_photos[$value->id] = stripslashes(str_replace('_',' ',$value->title));
		}
		$this->admin_select('photo', $available_photos, 'Photos: ', $curr_photo_id);
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
		//Controller
        $CI = & get_instance();
        $CI->load->module('photogallery');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$this->load_generic_styles();
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$curr_photo_id = $this->block->data('photo');
		if(strpos($segments[$count-1],'.html') !== FALSE || $CI->uri->total_segments() == 0 || strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE){
			if(empty($curr_photo_id))
				$curr_photo_id = 1;
		}else{
			$curr_photo_id = $segments[$count-1];
		}
		$photo = new PhotoGalleryMedia($curr_photo_id);
		$photos = $CI->photogallerymedia->where('album_id',$photo->album_id)->get();
		$single_element = '';
		//View
        $output ='
		<section id="photo-file-container-'.$this->block->get_id().'" class="photogalleries-galleryimageview">
			<div class="">
				<div class="">				
					<div class="photogalleries-singlebox-photo-container">
						<!--<div class="owl-carousel image-slider o-flow-hidden galleryview1">-->
							<div class="item">';
								$left = array();
								$right = array();

								foreach($photos as $related)
								{
									if($related->id != $photo->id && $related->id != 0)
									{
										if($related->id < $photo->id)
										{
											array_push($left,$related->id);
										}
										else
											array_push($right,$related->id);
									}
								}
								if(!empty($left)){
									$output .='<a class="hackL" href="'.base_url('photogallery/photo/'.end($left).'').'">
										<i class="fa fa-angle-left"></i>
									</a>';
								}
								if(!empty($right)){
									$output .='<a class="hackR" href="'.base_url('photogallery/photo/'.end($right).'').'">
										<i class="fa fa-angle-right"></i>
									</a>';
								}
								if(is_numeric($curr_photo_id)){
									$output .='<a class="example-image-link img-responsive photogalleries-single-photo-be" href="'.checkImagePath($photo->file) .'" data-lightbox="example-1"><img class="" src="'.checkImagePath($photo->file) .'" alt="'.ChEditorfix($photo->description).'"/></a>
									';
								}
								else{
									$output .='<img src="'.base_url('builderengine/public/img/photo_placeholder.png') .'" class="img-responsive" style="width:100%" alt="'.ChEditorfix($photo->description).'" />';
								}
							$output .='</div>
						<!--</div>-->
					</div>
				</div>
			</div>
		</section>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photo-file-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>