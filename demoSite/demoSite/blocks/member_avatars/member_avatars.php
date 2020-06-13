<?php
class Member_avatars_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Content Blocks";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Member Avatars";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }

    public function generate_admin()
    {
		$opts = array(
			'company' => 'Group / Show Users By Company Names',
			'usergroup' => 'Group / Show Users By UserGroup'
		);
		$type = $this->block->data('type');
		$this->admin_select('type', $opts, 'User Selection Type: ', $type, $this->block->get_id());
		
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();
		$CI->load->model('users');
		$type = $this->block->data('type');
		if($type == null || $type == '')
			$type = 'usergroup';
		$companies = $CI->users->get_all_user_company_names();
		$usergroups = $CI->users->get_groups();
		$website_name = $CI->BuilderEngine->get_option('website_name');
		//View
        $output ='
		<div id="member-avatars-container-'.$this->block->get_id().'">
			<link href="'.base_url('builderengine/public/filterizr_lightbox/lightbox.css').'" rel="stylesheet">
			<div id="userdashboard-container">
				<div id="be-uaccount-page-container" class="be-uaccount-main-pad ps-handbook">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<h3 class="user-account-title">'.$website_name.' Members <small> Who is who</small></h3>
					</div>
					<div id="options" class="m-b-10">
						<span class="gallery-option-set" id="filter" data-option-key="filter">';
							if($type == 'company'){
								$output .='
								<a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
									All '.$website_name.' Companies
								</a>
								';
								foreach($companies as $company){
									$class_name = str_replace(' ','_',$company);
									$output .='
									<a href="#'.$class_name.'" class="btn btn-default btn-xs" data-option-value=".'.$class_name.'">
									   '.$company.'
									</a>';
								}
								$all_members = new User();
								$unknown_company = false;
								foreach($all_members->where('verified','yes')->get() as $member){
									if($member->extended->get()->company == '' || $member->extended->get()->company == null)
										$unknown_company = true;
								}
								if($unknown_company){
									$output .='
									<a href="#unknown" class="btn btn-default btn-xs" data-option-value=".unknown">
									   Unknown
									</a>';
								}
							}
							if($type == 'usergroup' || $type == '' || $type == null){
								$output .='
								<a href="#show-all" class="btn btn-default btn-xs active" data-option-value="*">
									All '.$website_name.' People
								</a>
								';
								foreach($usergroups as $group){
									$class_name = str_replace(' ','_',$group->name);
									$output .='
									<a href="#'.$class_name.'" class="btn btn-default btn-xs" data-option-value=".'.$class_name.'">
									   '.$group->name.'
									</a>';
								}
							}
							$output .='
						</span>
					</div>
					<style>
						.gallery{
							margin-top:15px;
						}
					</style>
					<div id="gallery" class="gallery">';
						if($type == 'company'){
							foreach($companies as $company){
								$class_name = str_replace(' ','_',$company);
								$company_members = $CI->users->get_users_by_company_name($company);
								foreach($company_members as $member){
									if($member->level == 'Administrator')
										$member->level = 'Admin';
									$output .='
									<div class="image '.$class_name.'">
										<div class="image-inner">
											<a href="'.base_url('cp/user/'.$member->id).'" alt="'.$member->first_name.' '.$member->last_name.'" data-title="'.$member->first_name.' '.$member->last_name.'" data-lightbox="'.$class_name.'">
												<img src="'.$member->avatar.'" />
											</a>
											<p class="image-caption">
												'.$member->first_name.' '.$member->last_name.'
											</p>
										</div>
										<div class="image-info">
											<h5 class="title">'.$member->level.' <small><a href="'.base_url('cp/user/'.$member->id).'" target="_blank"> View Profile</a></small></h5>
										</div>
									</div> ';
								}
							}
							$all_members = new User();
							foreach($all_members->where('verified','yes')->get() as $member){
								if($member->level == 'Administrator')
									$member->level = 'Admin';
								if($member->extended->get()->company == '' || $member->extended->get()->company == null){
									$class_name = 'unknown';
									$output .='
									<div class="image '.$class_name.'">
										<div class="image-inner">
											<a href="'.base_url('cp/user/'.$member->id).'" alt="'.$member->first_name.' '.$member->last_name.'" data-title="'.$member->first_name.' '.$member->last_name.'" data-lightbox="'.$class_name.'">
												<img src="'.$member->avatar.'" />
											</a>
											<p class="image-caption">
												'.$member->first_name.' '.$member->last_name.'
											</p>
										</div>
										<div class="image-info">
											<h5 class="title">Unknown <small><a href="'.base_url('cp/user/'.$member->id).'" target="_blank"> Profile</a></small></h5>
										</div>
									</div> ';
								}
								
							}
						}
						if($type == 'usergroup'){
							foreach($usergroups as $group){
								$class_name = str_replace(' ','_',$group->name);
								$members = new User();
								foreach($members->get() as $member){
									if($member->level == 'Administrator')
										$member->level = 'Admin';
									$member_groups = $CI->users->get_user_group_ids($member->id);
									if(in_array($group->id,$member_groups)){
										$output .='
										<div class="image '.$class_name.'">
											<div class="image-inner">
												<a href="'.$member->avatar.'"  alt="'.$member->first_name.' '.$member->last_name.'" data-title="'.$member->first_name.' '.$member->last_name.'" data-lightbox="'.$class_name.'">
													<img src="'.$member->avatar.'" />
												</a>
												<p class="image-caption">
													'.$member->first_name.' '.$member->last_name.'
												</p>
											</div>
											<div class="image-info">
												<h5 class="title">'.$member->level.' <small><a href="'.base_url('cp/user/'.$member->id).'" target="_blank"> View Profile</a></small></h5>
											</div>
										</div> ';
									}
								}
							}
						}
						$output .='
					</div>
					<!-- end -->
				</div>
				<!-- end #content -->
			</div>
			<script src="http://zvonko1.builderengine.com/modules/cp/assets/plugins/isotope/jquery.isotope.min.js"></script>
			<script src="'.base_url('builderengine/public/filterizr_lightbox/filterizr.js').'"></script>
				<script src="'.base_url('builderengine/public/filterizr_lightbox/lightbox.js').'"></script>
				<script type="text/javascript">
					function calculateDivider() {
						var dividerValue = 4;
						if ($(this).width() <= 480) {
							dividerValue = 1;
						} else if ($(this).width() <= 767) {
							dividerValue = 2;
						} else if ($(this).width() <= 980) {
							dividerValue = 3;
						}
						return dividerValue;
					}
					var handleIsotopesGallery = function() {
						"use strict";
						$(window).load(function() {
							var container = $("#gallery");
							var dividerValue = calculateDivider();
							var containerWidth = $(container).width() - 20;
							var columnWidth = containerWidth / dividerValue;
							$(container).isotope({
								resizable: true,
								masonry: {
									columnWidth: columnWidth
								}
							});
							
							$(window).smartresize(function() {
								var dividerValue = calculateDivider();
								var containerWidth = $(container).width() - 20;
								var columnWidth = containerWidth / dividerValue;
								$(container).isotope({
									masonry: { 
										columnWidth: columnWidth 
									}
								});
							});
							
							var $optionSets = $("#options .gallery-option-set"),
							$optionLinks = $optionSets.find("a");
							
							$optionLinks.click( function(){
								var $this = $(this);
								if ($this.hasClass("active")) {
									return false;
								}
								var $optionSet = $this.parents(".gallery-option-set");
								$optionSet.find(".active").removeClass("active");
								$this.addClass("active");
							
								var options = {};
								var key = $optionSet.attr("data-option-key");
								var value = $this.attr("data-option-value");
									value = value === "false" ? false : value;
									options[ key ] = value;
								$(container).isotope( options );
								return false;
							});
						});
					};


					var Gallery = function () {
						"use strict";
						return {
							//main function
							init: function () {
								handleIsotopesGallery();
							}
						};
					}();
					handleIsotopesGallery();
					$(function(){
						$(".filtr-container").each(function(){
							var elementId = $(this).attr("id");
							$("#" + elementId).filterizr();
						});
					});
					lightbox.option({
					  "resizeDuration": 200,
					  "wrapAround": true,
					  "disableScrolling": true,
					  "maxWidth":1600,
					  "maxHeight":880,
					  "fitImagesInViewport": true,
					  //"positionFromTop":30
					});	
			</script>
		</div>
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'member-avatars-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>