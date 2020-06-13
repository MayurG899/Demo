<?php
class Content_home_mediaplayer_video_block_handler extends  block_handler{
	function info()
	{
		$info['category_name'] = "Basic Blocks";
		$info['category_icon'] = "dsf";

		$info['block_name'] = "Home MediaPlayer Video";
		$info['block_icon'] = "fa-envelope-o public";
		
		return $info;
	}
    public function generate_admin()
    {
		$this->block->set_data('content','1',true);
		$small_title = $this->block->data('small_title');
		$big_title = $this->block->data('big_title');
		$video_type = $this->block->data('video_type');
		$video_file = $this->block->data('video_file');
		$video_link = $this->block->data('video_link');
		$video_looped = $this->block->data('video_looped');
		$video_muted = $this->block->data('video_muted');
		$audio_button = $this->block->data('audio_button');
		$poster = $this->block->data('poster');
		$image_poster = $this->block->data('image_poster');
		
		$posters = array(
			'video' => 'Video Poster',
			'image' => 'Custom Image'
		);
		$video_types = array(
			'file' => 'Video File',
			'youtube' => 'YouTube Link',
			'vimeo' => 'Vimeo Link',
		);
		$opts = array(
			'yes' => 'Yes',
			'no' => 'No',
		);
		$this->admin_input('small_title', 'text', 'Small Title (above Big Title): ', $small_title);
		$this->admin_input('big_title', 'text', 'Big Title: ', $big_title);
		$this->admin_select('video_type', $video_types, 'Video Type: ', $video_type, $this->block->get_id());
		
		?>
		<script>
            $(document).ready(function (){
				var option = '<?=$video_type?>';
				if(option == 'file' || option == '')
					$('#file-input-<?=$this->block->get_id();?>').show();
				else
					$('#file-link-<?=$this->block->get_id();?>').show();
				
                $('#video_type<?=$this->block->get_id()?>').change(function () {
					if($(this).val() == 'file'){
						$('#file-input-<?=$this->block->get_id();?>').show();
						$('#file-link-<?=$this->block->get_id();?>').hide();
					}else{
						$('#file-input-<?=$this->block->get_id();?>').hide();
						$('#file-link-<?=$this->block->get_id();?>').show();
					}
                });
			});
		</script>
		<div id="file-input-<?=$this->block->get_id();?>"  style="display:none" >
			<?
				$this->admin_file('video_file', 'Video File', $video_file, 'video-file-'.$this->block->get_id(), true);
			?>
		</div>
		<div id="file-link-<?=$this->block->get_id();?>"  style="display:none" >
			<?
				$this->admin_input('video_link', 'text', 'Video Link (YouTube: use url, Vimeo: use video id only: ', $video_link);
			?>
		</div>
		<?
		$this->admin_select('video_looped', $opts, 'Looped: ', $video_looped, $this->block->get_id());
		$this->admin_select('audio_button', $opts, 'Show Audio On/Off Button: ', $audio_button, $this->block->get_id());
		$this->admin_select('video_muted', $opts, 'Muted: ', $video_muted, $this->block->get_id());
		?>
		<div id="poster-option-<?=$this->block->get_id();?>"  style="display:none" >
			<?
				$this->admin_select('poster', $posters, 'Show Poster Image on video end (non-looped videos only): ', $poster, $this->block->get_id());
			?>
			<div id="image-poster-<?=$this->block->get_id();?>"  style="display:none" >
				<?
					$this->admin_file('image_poster', 'Custom Image Poster:', $image_poster, 'img-poster-'.$this->block->get_id(), true);
				?>
			</div>
		</div>
		<script>
            $(document).ready(function (){
				var option = '<?=$video_looped?>';
				if(option == 'yes' || option == '')
					$('#poster-option-<?=$this->block->get_id();?>').hide();
				else
					$('#poster-option-<?=$this->block->get_id();?>').show();
				
                $('#video_looped<?=$this->block->get_id()?>').change(function () {
					if($(this).val() == 'no'){
						$('#poster-option-<?=$this->block->get_id();?>').show();
					}else{
						$('#poster-option-<?=$this->block->get_id();?>').hide();
					}
                });
				var posterOption = '<?=$poster?>';
				if(posterOption == 'video' || option == '')
					$('#image-poster-<?=$this->block->get_id();?>').hide();
				else
					$('#image-poster-<?=$this->block->get_id();?>').show();
				
                $('#poster<?=$this->block->get_id()?>').change(function () {
					if($(this).val() == 'image'){
						$('#image-poster-<?=$this->block->get_id();?>').show();
					}else{
						$('#image-poster-<?=$this->block->get_id();?>').hide();
					}
                });
			});
		</script>
		<?
    }
    public function set_initial_values_if_empty()
    {
        $content = $this->block->data('content');

        if(!is_array($content) || empty($content))
        {
			$this->block->set_data('small_title','Welcome to our new website',true);
			$this->block->set_data('big_title','Rock Candy Funk Party',true);
			$this->block->set_data('video_type','youtube',true);
			$this->block->set_data('video_file','',true);
			$this->block->set_data('video_link','https://www.youtube.com/watch?v=Ug6EBu-2J78&list=RDUg6EBu-2J78&t=5',true);
			$this->block->set_data('video_looped','yes',true);
			$this->block->set_data('video_muted','yes',true);
			$this->block->set_data('audio_button','yes',true);
			$this->block->set_data('poster','',true);
			$this->block->set_data('image_poster','',true);
			$this->block->set_data('content', array('1'=>'1'), true);
        }
    }
    public function generate_content()
    {	
        global $active_controller;
        $CI = &get_instance();
        $CI->load->module('layout_system');

        $this->set_initial_values_if_empty();
        $content = $this->block->data('content');
        //generic styles
		$this->load_generic_styles();

		$small_title = $this->block->data('small_title');
		$big_title = $this->block->data('big_title');
		$video_type = $this->block->data('video_type');
		$video_file = $this->block->data('video_file');
		$video_link = $this->block->data('video_link');
		$video_looped = $this->block->data('video_looped');
		$video_muted = $this->block->data('video_muted');
		$audio_button = $this->block->data('audio_button');
		$poster = $this->block->data('poster');
		$image_poster = $this->block->data('image_poster');

        foreach($content as $key => $element)
        {
            $element = (object)$element;
			$loop = '';
			$muted = 'muted';
			if($video_looped == 'yes')
				$loop = 'loop';
			if($video_muted == 'yes')
				$muted = 'muted';
			else
				$muted = 'unmuted';
            $output = '
                <div class="block-column-wide-12" id="home-mediaplayer-video-container-'.$this->block->get_id().'">
                    <section id="html5vid-intro" class="html5vid-intro-fullscreen html5vid-bg-image" data-background-img="'.base_url('blocks/content_home_video/images/globevid.jpg').'">
						<div class="html5vid-intro-caption-waper html5vid-dark-bg">
							<div class="intro-full-height container">
								<div class="html5vid-intro-content">
									<div class="html5vid-intro-content-inner">

										<h3 class="page-title-alt mb-30">'.$small_title.'</h3>

										<h1 class="html5vid-intro-title mb-30">'.$big_title.'</h1>';
										if($muted == 'unmuted')
											$vol = 'off';
										else
											$vol = 'up';
										if($audio_button == 'yes'){
											$output .='
											<a id="sound-control'.$this->block->get_id().'" data-sound="'.$muted.'" class="btn btn-warning btn-color scroll-down" href="#" style="width:60px;font-size:28px;border-radius:50%;padding:15px 15px;margin-top:-55px;margin-left:30px;">
												<i id="sound-icon'.$this->block->get_id().'" class="fa fa-volume-'.$vol.'"></i>
											</a>
											<script>
												var hidden = false;
												$(document).ready(function() {
													var j;
													$(document).mousemove(function() {
														if (!hidden) {
															hidden = false;
															clearTimeout(j);
															$("#sound-control'.$this->block->get_id().'").fadeIn("fast");
															j = setTimeout("hide();", 600);
														}
													});
												});
												function hide(){
													$("#sound-control'.$this->block->get_id().'").fadeOut("fast");
												}
											</script>
											';
										}
									$output .='
									</div>
								</div>
							</div>
						</div>';
						if($video_type == 'file'){
							$output .='
							<video id="homeMediaplayerVideo'.$this->block->get_id().'" data-sound="'.$muted.'" src="'.checkImagePath($video_file).'" class="video" autoplay '.$muted.' '.$loop.' style="width:100%;height:auto;">
								<source src="'.checkImagePath($video_file).'" type="video/mp4">
								<source src="'.checkImagePath($video_file).'" type="video/ogg">
								Your browser does not support HTML5 video.
							</video>
							<script>
								$(document).ready(function() {
									$("#homeMediaplayerVideo'.$this->block->get_id().'").mediaelementplayer({';
										if($poster == 'video')
											$show_poster = $video_file;
										else
											$show_poster = $image_poster;
										$output .='
										poster:"'.$show_poster.'",
										videoWidth: "100%",
										videoHeight: "100%",
										showPosterWhenEnded: true,
										success: function(mediaElement, originalNode, instance) {';
											if($video_looped == 'no'){
												$output .='
												mediaElement.addEventListener("ended", function(e){
													$("#sound-control'.$this->block->get_id().'").css("display","none");
													$(".mejs__overlay-button").css("display","none");
												},false);';
											}
											$output .='
											$(".mejs__poster").css("display","none");
											instance.load();
											$("#sound-control'.$this->block->get_id().'").on("click",function(e){
												e.preventDefault();
												if($(this).attr("data-sound") == "muted"){
													$(this).attr("data-sound","unmuted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-up").addClass("fa-volume-off");
													instance.setMuted(false);
												}else{
													$(this).attr("data-sound","muted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-off").addClass("fa-volume-up");
													instance.setMuted(true);
												}
											});
										}
									});
									$("#homeMediaplayerVideo'.$this->block->get_id().'").bind("contextmenu",function(){
										return false;
									});
									//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
								});
							</script>';
						}
						if($video_type == 'youtube'){
							$output .='
							<video id="homeMediaplayerVideo'.$this->block->get_id().'" data-sound="'.$muted.'" class="video" autoplay '.$muted.' '.$loop.' style="width:100%;height:auto;">
								<source type="video/youtube" src="'.$video_link.'" />
							</video>
							<script>
								$(document).ready(function() {
									$("#homeMediaplayerVideo'.$this->block->get_id().'").mediaelementplayer({';
										if($poster == 'video')
											$show_poster = $video_file;
										else
											$show_poster = $image_poster;
										$output .='
										poster:"'.$show_poster.'",
										videoWidth: "100%",
										videoHeight: "100%",
										showPosterWhenEnded: true,
										success: function(mediaElement, originalNode, instance) {';
											if($video_looped == 'no'){
												$output .='
												mediaElement.addEventListener("ended", function(e){
													$("#sound-control'.$this->block->get_id().'").css("display","none");
													$(".mejs__overlay-button").css("display","none");
													setTimeout(function(){
														var $thisMediaElement = (mediaElement.id) ? jQuery("#"+mediaElement.id) : jQuery(mediaElement);
														$thisMediaElement.parents(".mejs__inner").find(".mejs__poster").show();
													},200);
												},false);';
											}
											$output .='
											$(".mejs__poster").css("display","none");
											instance.load();
											$("#sound-control'.$this->block->get_id().'").on("click",function(e){
												e.preventDefault();
												if($(this).attr("data-sound") == "muted"){
													$(this).attr("data-sound","unmuted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-up").addClass("fa-volume-off");
													instance.setMuted(false);
												}else{
													$(this).attr("data-sound","muted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-off").addClass("fa-volume-up");
													instance.setMuted(true);
												}
											});
										}
									});
									$("#homeMediaplayerVideo'.$this->block->get_id().'").bind("contextmenu",function(){
										return false;
									});
									//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
								});
							</script>';
						}
						if($video_type == 'vimeo'){
							$output .='
							<iframe src="https://player.vimeo.com/video/'.$video_link.'?autoplay=1" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							<script>
								$(document).ready(function() {
									$("#homeMediaplayerVideo'.$this->block->get_id().'").mediaelementplayer({';
										if($poster == 'video')
											$show_poster = $video_file;
										else
											$show_poster = $image_poster;
										$output .='
										poster:"'.$show_poster.'",
										videoWidth: "100%",
										videoHeight: "100%",
										showPosterWhenEnded: true,
										success: function(mediaElement, originalNode, instance) {';
											if($video_looped == 'no'){
												$output .='
												mediaElement.addEventListener("ended", function(e){
													$("#sound-control'.$this->block->get_id().'").css("display","none");
													$(".mejs__overlay-button").css("display","none");
													setTimeout(function(){
														var $thisMediaElement = (mediaElement.id) ? jQuery("#"+mediaElement.id) : jQuery(mediaElement);
														$thisMediaElement.parents(".mejs__inner").find(".mejs__poster").show();
													},200);
												},false);';
											}
											$output .='
											$(".mejs__poster").css("display","none");
											instance.load();
											$("#sound-control'.$this->block->get_id().'").on("click",function(e){
												e.preventDefault();
												if($(this).attr("data-sound") == "muted"){
													$(this).attr("data-sound","unmuted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-up").addClass("fa-volume-off");
													instance.setMuted(false);
												}else{
													$(this).attr("data-sound","muted");
													$("#sound-icon'.$this->block->get_id().'").removeClass("fa-volume-off").addClass("fa-volume-up");
													instance.setMuted(true);
												}
											});
										}
									});
									$("#homeMediaplayerVideo'.$this->block->get_id().'").bind("contextmenu",function(){
										return false;
									});
									//$(".mejs__controls").append("<div class=\"mejs_button mejs__download\"><a role=\"button\" href=\"checkImagePath($sound->file)\" download><i class=\"fa fa-download\"></i></a></div>");
								});
							</script>';
						}
					$output .='
					</section>
				</div>
			';
        }
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'home-mediaplayer-video-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>