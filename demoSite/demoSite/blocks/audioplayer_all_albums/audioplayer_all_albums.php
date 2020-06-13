<?php
class Audioplayer_all_albums_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
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
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$this->load_generic_styling();
		$albums = $CI->audioplayeralbum->get();
		//View
        $output ='
			<div id="audioplayer-all-albums-container-'.$this->block->get_id().'">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<p class="audiogallery-featured-title-3">Albums</p>
				</div>
				<div class="audioplayer-container">
			';
				foreach($albums as $album){
					$album_owner = new User($album->user_id);
					if($album->status != 'private' || ($album->status == 'private' && $user->id == $album_owner->id)){
						$output .='	
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 audiogallery-recent-paddings">
							<div class="audiogallery-item-box">
								<div class="audiogallery-allvideos-outline">
									<a href="'.base_url('audioplayer/channel/'.$album_owner->username.'/album/'.$album->id).'">';
										$audios = new AudioPlayerMedia();
										$audios = $audios->where('album_id',$album->id)->get();
										$i = 1;
										foreach($audios as $audio){
											if($i == 1){
												$audio = $audio;
											}
											$i++;
										}
										$output .=' 
										<img src="'.checkImagePath($album->image).'" alt="'.$audio->description.'" >
										<div class="audiogallery-item-mask audiogallery-item-mask-albums">
											<div class="audiogallery-item-caption">
												<h4 class="white">View Tracks</h4>
											</div>
										</div>
										<div class="audiogallery-allvideos-box module-colors module-colors-bg">
											<p><span class="audiogallery-text-dark">'.str_replace('_',' ',$album->name).'</span></p>
											<p class="audiogallery-text-gray"><span>By: '.$album_owner->first_name.' '.$album_owner->last_name.'</span></p>
										</div>
									</a>
								</div>
							</div>
						</div>';
					}
				}
			$output .='
				</div>
			</div>
			</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-all-albums-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>