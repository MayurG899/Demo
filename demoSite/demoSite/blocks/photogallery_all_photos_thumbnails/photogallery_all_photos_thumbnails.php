<?php
class Photogallery_all_photos_thumbnails_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "All Photos Thumbnails";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
	public function generate_style($active_menu = '')
	{
	
	}
	public function load_generic_styling()
	{
		
	}
    public function apply_custom_css()
    {
        $style_arr = $this->block->data("style");
        if(!isset($style_arr['color']))
            $style_arr['color'] = '';
        if(!isset($style_arr['text-align']))
            $style_arr['text-align'] = '';
        if(!isset($style_arr['background-color']))
            $style_arr['background-color'] = '';

        return '
        <style>
        div[name="'.$this->block->get_name().'"] h1{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h2{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h3{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h4{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] h5{
                color: '.$style_arr['color'].' !important;
        }
        div[name="'.$this->block->get_name().'"] p{
            /*    color: '.$style_arr['color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] span{
            /*    color: '.$style_arr['color'].' !important; */
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] div{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ul{
                color: '.$style_arr['color'].' !important;
                text-align: '.$style_arr['text-align'].' !important;
            /*    background-color: '.$style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] ol{
                color: ' . $style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
             /*   background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] li{
                color: '.$style_arr['color'].' !important;
                text-align: ' . $style_arr['text-align'].' !important;
            /*    background-color: ' . $style_arr['background-color'].' !important; */
        }
        div[name="'.$this->block->get_name().'"] a{
            /*    color: '.$style_arr['color'].' !important; */
        }
		.bckgrd{
			background-color: '.$style_arr['background-color'].' !important;
		}
        </style>';
    }
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('photogallery');
		$this->load_generic_styles();
		$photos = $CI->photogallerymedia->get();
		$albums = $CI->photogallery->get_albums();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);

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
			<div id="photogallery-all-photos-thumbnails-'.$this->block->get_id().'">
                <div class="">';
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
        $output .='</div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-all-photos-thumbnails-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>