<?php
class Audioplayer_upload_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Audio Player";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Sound Upload";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
	public function generate_style($active_menu = '')
	{
		include FCPATH.'/builderengine/public/animations/animations.php';

		$background_active = $this->block->data('background_active');
		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');

		$text_align = $this->block->data('text_align');
		$text_color = $this->block->data('text_color');
		$custom_css = $this->block->data('custom_css');
		$custom_classes = $this->block->data('custom_classes');

		$active_options = array("color" => "Use color background", "image" => "Use image background");
		$text_options = array("left" => "Left", "center" => "Center", "right" => "Right");

		$animation_type = $this->block->data('animation_type');
		$animation_duration = $this->block->data('animation_duration');
		//$animation_event = $this->block->data('animation_event');
		//$animation_delay = $this->block->data('animation_delay');
		?>
		<div role="tabpanel">
			<ul class="nav nav-tabs" role="tablist" style="margin-left: -20px;">
				<li role="presentation" class="<?if($active_menu == 'style' || $active_menu == '') echo 'active'?>"><a href="#title" aria-controls="text" role="tab" data-toggle="tab">Background Styles</a></li>
				<li role="presentation" class="<?if($active_menu == 'custom' || $active_menu == '') echo 'active'?>"><a href="#text" aria-controls="profession" role="tab" data-toggle="tab">Custom</a></li>
				<li role="presentation" class="<?if($active_menu == 'animation' || $active_menu == '') echo 'active'?>"><a href="#animations" aria-controls="animations" role="tab" data-toggle="tab">Animations</a></li>
				<?php if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1):?>
					<li role="presentation" class="<?if($active_menu == 'global_style' || $active_menu == '') echo 'active'?>"><a href="#global" aria-controls="global" role="tab" data-toggle="tab">Global</a></li>
				<?php endif;?>
			</ul>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'style' || $active_menu == '') echo 'in active'?>" id="title">
					<?php
					$this->admin_input('text_color','text', 'Font Color: ', $text_color);
					$this->admin_select('text_align', $text_options, 'Text align: ', $text_align);
					$this->admin_select('background_active', $active_options, 'Background option: ', $background_active);
					$this->admin_input('background_color','text', 'Background color: ', $background_color);
					$this->admin_file('background_image','Background image: ', $background_image, 'contactform'.$this->block->get_id(), true );
					?>
					<script>
						$("#contactform<?=$this->block->get_id()?>").click(function(e){
							e.preventDefault();
						});
					</script>
				</div>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'custom') echo 'in active'?>" id="text">
					<?php
					$this->admin_textarea('custom_css','Custom CSS: ', $custom_css, 4);
					$this->admin_textarea('custom_classes','Custom Classes: ', $custom_classes, 2);
					?>
				</div>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'animation') echo 'in active'?>" id="animations">
					<?php
					$this->admin_select('animation_type', $types,'Animation: ', $animation_type);
					$this->admin_select('animation_duration', $durations,'Animation state: ', $animation_duration);
					//$this->admin_select('animation_event', $events,'Animation Start: ',$animation_event);
					//$this->admin_select('animation_delay', $delays,'Animation Delay: ',$animation_delay);
					?>
				</div>
				<?php if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1):?>
				<div role="tabpanel" class="tab-pane fade <?if($active_menu == 'global_style') echo 'in active'?>" id="global">
					<?php
					$global_options = array ('true' => 'Yes','false' => 'No');
					$global = $this->block->data('globaltype');
					if(empty($global))
						$global = 'false';
					$this->admin_select('globaltype', $global_options, 'Global (Replicate on all pages) :', $global);
					?>
				</div>
				<?php endif;?>
			</div>
		</div>
		<?php
	}
	public function load_generic_styling()
	{
		$background_active = $this->block->data('background_active');
		$background_color = $this->block->data('background_color');
		$background_image = $this->block->data('background_image');

		$text_align = $this->block->data('text_align');
		$text_color = $this->block->data('text_color');
		$custom_css = $this->block->data('custom_css');

		$animation_type = $this->block->data('animation_type');
		$animation_duration = $this->block->data('animation_duration');
		//$animation_event = $this->block->data('animation_event');
		//$animation_delay = $this->block->data('animation_delay');

		if(!empty($animation_type)){
			$this->block->force_data_modification();
			$this->block->add_css_class('animated '.$animation_duration.' '.$animation_type);
		}
		//$settings[0][0] = 'new-container-'.$this->block->get_id();
		//$settings[0][1] = $animation_event;
		//$settings[0][2] = $animation_duration.' '.$animation_delay.' '.$animation_type;
		//add_action("be_foot", generate_animation_events($settings));
		
		$style_arr = $this->block->data("style");
		if($background_active == 'color')
			$style_arr['background-color'] = $background_color;
		else
			$style_arr['background-image'] = $background_image;
		$style_arr['text-align'] = $text_align;
		$style_arr['color'] = $text_color;
		$style_arr['text'] = ';'.$custom_css;
		$this->block->set_data("style", $style_arr);
	}
    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('audioplayer');
		$this->load_generic_styling();
		$num_albums = $CI->audioplayeralbum->where('user_id',$user->id)->count();
		$albums = $CI->audioplayeralbum->where('user_id',$user->id)->get();
		//View
		$output ='
				<div id="audioplayer-upload-'.$this->block->get_id().'">
					<div class="row">		
						<h2 class="text-center">Upload New Audio Track</h2>
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<form id="uploadP" class="upload" method="post" action="'.base_url('audioplayer/upload_sound').'" enctype="multipart/form-data">
								<div id="dropP">
									Drop Here
									<a>Browse</a>
									<input type="file" name="uplo"/>
								</div>
								<ul>
									<!-- The file uploads will be shown here -->
								</ul>
							</form>
						</div>
					</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div id="uploadFormP" class="audiogallery-video-night-bg" style="display:none;">';
							if($num_albums > 0){
								$output .='<form method="post" id="forsP" style="">';
							}
								$output .='<input id="uploadedFileP" type="hidden" name="media_file" >
								<style>.control-label{color:#fff;}</style>
								<div class="form-group">';
								if($num_albums > 0){
								    $disabled = '';
								    $output .='<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname">Select Album:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
											<select name="album_id" style="width:100%;appearance:select;" required>
												<option value="" required>Select Album</option>';
												foreach($albums as $album){
													$output .='<option value="'.$album->id.'">'.str_replace('_',' ',$album->name).'</option>';
												}
											$output .='</select>
									</div>';
								}else{
										$disabled = 'disabled';
										$output .='<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname"></label>
										<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
											<a href="'.base_url('audioplayer/add_album/first').'" class="btn btn-md btn-white-line animated infinite flash" style="margin-bottom:15px;"><i class="fa fa-cloud left"></i>Click here to Create an Album</a>
										</div>';
								}
								$output .='</div>							
								<div class="form-group">
									<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname">Sound Title:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
										<input class="form-control" type="text" id="title" name="title" placeholder="Sound title" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
								<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname">Description:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
										<script type="text/javascript" src="'.base_url('builderengine/public/ckeditor/ckeditor.js').'"></script>
										<textarea class="textarea form-control" name="text" id="cke" placeholder="Post text" rows="20"></textarea>
										<script>CKEDITOR.replace( "text");</script>
									</div>
								</div>
								<div class="form-group">
								<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname">Tags:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
										<input class="form-control" type="text" id="tags" name="tags" placeholder="Tags (comma separated)" data-parsley-required="true" required />
									</div>
								</div>
								<div class="form-group">
									<input type="hidden" name="groups_allowed" value="Administrators,Members,Guests">
									<input type="hidden" name="status" value="Public">
								<!--
								   <label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="status">Sound Status:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
										<select id="user-groups-select" name="status">
											<option value="public">Public</option>
											<option value="private">Private</option>
										</select>
									</div>
								-->
									<label class="control-label audiogallery-upload-album-label col-md-2 col-sm-2" for="fullname">Allow Comments:</label>
									<div class="audiogallery-upload-album-padding col-md-10 col-sm-10">
										<input type="checkbox" name="comments_allowed" style="appearance:checkbox;-webkit-appearance:checkbox;">
									</div>
								</div>	
								<div class="form-group">
								<label class="control-label col-md-2 col-sm-2" for="fullname"></label>
									<div class="col-md-10 col-sm-10">
										<button type="submit" class="btn btn-sm btn-primary '.$disabled.'" name="submit"><i class="fa fa-floppy-o"></i> Publish Audio Track</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
        <hr />
		</div>';

		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'audioplayer-upload-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>