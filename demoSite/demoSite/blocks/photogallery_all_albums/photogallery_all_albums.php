<?php
class Photogallery_all_albums_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Photo Gallery";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "All Albums";
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
		$albums = $CI->photogalleryalbum->get();
		$owner = new User();

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
			<div id="photogallery-all-albums-'.$this->block->get_id().'">
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="photogallery-albums-title-2">Photo Albums</p>
				</div>
				<div class="photogallery-container-albums">';
				foreach($albums as $album){
						if($album->status != 'private' || ($album->status == 'private' && $user->get_id() == $album->user_id)){
							$author = new User($album->user_id);
							$output .='
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 be-photogallery-col-left-0">
							<div class="photogallery-item-box">
								<div class="photogallery-allvideos-outline">
								<a href="'.base_url('photogallery/channel/'.$author->username.'/album/'.$album->id).'">';
								$photos = new PhotoGalleryMedia();
								$photos = $photos->where('album_id',$album->id)->get();
								$i = 1;
								foreach($photos as $photo){
									if($i == 1){
										$photo = $photo;
									}
									$i++;
								}
								$output .='<img src="'.checkImagePath($album->image).'" />
									<div class="photogallery-item-mask photogallery-item-mask-albums">
										<div class="photogallery-item-caption photogallery-album-caption">
											<h4 class="white">Browse Photos</h4>
										</div>
									</div>
									<div class="photogallery-allvideos-box module-colors module-colors-bg">
										<p><span class="photogallery-text-dark">'.str_replace('_',' ',$album->name).'</span></p>
										<p class="photogallery-text-gray"><span>By: '.$author->first_name.' '.$author->last_name.'</span></p>
									</div>
								</a>
								</div>
							</div>
						</div>';
					}
				}
		$output .='</div>
				</div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$this->apply_custom_css().$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'photogallery-all-albums-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output.$this->apply_custom_css();
    }
}
?>