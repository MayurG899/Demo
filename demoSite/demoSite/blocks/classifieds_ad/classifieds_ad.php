<? 
class Classifieds_ad_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Ad Post";
        $info['block_icon'] = "fa-envelope-o public";
      
        return $info;
    }
    public function generate_admin()
    {
		$curr_item_id = $this->block->data('item_id');
		$available_items = array();
		$all_items = new ClassifiedsItem();
		foreach($all_items->where('ad_completed','yes')->where('sold','no')->get() as $key => $value){
			$available_items[$value->id] = stripslashes(str_replace('_',' ',$value->name));
		}
		$this->admin_select('item_id', $available_items, 'Classifieds Items: ', $curr_item_id);
    }
    public function generate_content()
    {
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('classifieds');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$this->load_generic_styles();
		$count = count($segments);
		$curr_item_id = $this->block->data('item_id');
		$single_element = '';
		$allowed_to_buy_groups = explode(',',$CI->BuilderEngine->get_option('be_classifieds_shop_groups'));
		$item = new ClassifiedsItem();
		if(strpos($_SERVER['REQUEST_URI_PATH'],'classifieds/view_item/') !== FALSE)
			$item = $item->where('id',$segments[$count-1])->get();
		else{
			if(empty($curr_item_id))
				$item = $item->where('id',1)->get();
			else
				$item = $item->where('id',$curr_item_id)->get();
		}

		if(isset($_POST['classifieds'.$this->block->get_id()]))
		{
			$review = new ClassifiedsReview();
			if($user->is_guest())
			{
				$review->user = $_POST['user'];
			}
			else
			{
				$review->user = $user->username;
				$review->user_id = $user->id;
			}
			$review->item_id = $item->id;
			$review->content = isset($_POST['content'])?$_POST['content']:'';
			$review->date = date('d/m/Y');
			$review->save();
		}

        $output = '
        <div id="listings-page" class="classifieds classifieds-ad-container-'.$this->block->get_id().'">
			<link rel="stylesheet" type="text/css" href="'.base_url('modules/classifieds/assets/js/fancybox/jquery.fancybox.css?v=2.1.5').'" media="screen" />
			<link rel="stylesheet" type="text/css" href="'.base_url('modules/classifieds/assets/js/fancybox/helpers/jquery.fancybox-buttons.css?v=2.1.5').'" media="screen" />
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="center zoom-gallery">
						<div class="">
							<div class="panel-body classifieds-panel-body">
								<a class="fancybox" rel="group" href="'.checkImagePath($item->img).'">';
									$images = $item->image->get();
									$i = 1;
									foreach($images as $img){
										if($i == 1)
											$output .='<img id="img_01" alt="" class="raised" src="'.checkImagePath($img->image).'"/>';
										
										$i++;
									}
								$output .='
								</a>
								<br />
								<br />
								<div class="row" id="gallery" >';
									$j = 1;
									foreach($images as $image){
										if($j != 1){
											$output .='
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 
												<a href="'.checkImagePath($image->image).'" class="fancybox thumbnail" rel="group" >
													<img alt="" src="'.checkImagePath($image->image).'"/>
												</a>
											</div>';
										}
										$j++;
									}
								$output .='
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel classifieds-header-dark">';
								$seller = new ClassifiedsMember($item->posting_member_id);
								$output .='
								<div class="panel-heading navbar-user-box">
									<img src="'.$seller->avatar.'"> '.$seller->first_name.' '.$seller->last_name.' <br> 
									<div class="text-grey">'.$item->region.' - Private Seller</div>
								</div>
								<div class="panel-body classifieds-panel-body-white">
									<div class="classifieds-reply-button">';
										if($user->is_guest()){
											$output .='<a class="btn message-button" href="'.base_url('classifieds/login').'"><i class="fa fa-envelope-o"></i> Message Seller</a>';
										}elseif($user->id != $item->posting_member_id){
											$output .='<button data-toggle="modal" data-target="#myModal" class="btn message-button" type="button"><i class="fa fa-envelope-o"></i> Message Seller</button>';
										}
									$output .='
									</div>
									
									<div class="btn call-button"><i class="fa fa-phone"></i> Call: '.$item->phone.'</div>';
									$watched = 'no';
									$followed = 'no';
									$member = new ClassifiedsMember($user->id);
									if($member->id != $item->posting_member_id)
									{
										$watchlist = $member->watchlist->where('item_id', $item->id);
										$watchlist = $member->watchlist->get();
										$i = 0;
										foreach ($watchlist as $watched)
										{
											$i++;
										}
										if($i > 0)
											$watched = 'yes';

										$following = new ClassifiedsFollowing();
										$following->where('following_user', $user->id);
										$following->where('followed_user', $item->posting_member_id);
										$following->get();
										$i = 0;
										foreach ($following as $follow)
										{
											$i++;
										}
										if($i > 0)
											$followed = 'yes';
									}
									if($user->is_guest()){
										$output .='
										<a class="btn silver-button" href="'.base_url('classifieds/login').'"><i class="fa fa-star"></i> Add to Watch list</a>
										<a class="btn silver-button" href="'.base_url('classifieds/login').'"><i class="fa fa-share"></i> Follow '.$seller->first_name.' '.$seller->last_name.'</a>';
									}else{
										if($user->id != $item->posting_member_id){
											if($watched == 'yes'){
												$output .='<a class="btn call-button" href="'.base_url('classifieds/my_watchlist').'"><i class="fa fa-star"></i> Item watched</a>';
											}else{
												$output .='<a class="btn silver-button" href="'.base_url('classifieds/add_to_watchlist/'.$item->id).'"><i class="fa fa-star"></i> Add to Watch List</a>';
											}

											if($followed == 'yes'){
												$output .='<a class="btn call-button" href="#"><i class="fa fa-share"></i> Following '.$seller->first_name.' '.$seller->last_name.'</a>';
											}else{
												$output .='<a class="btn silver-button" href="'.base_url('classifieds/follow_owner/'.$item->id).'"><i class="fa fa-share"></i> Follow '.$seller->first_name.' '.$seller->last_name.'</a>';
											}
										}
									}
									$output .='
									<a class="btn silver-button" href="'.base_url('classifieds/profile/'.$seller->id).'"><i class="fa fa-bars"></i> View All Ads From This Seller</a>
								</div>
							</div>
						</div>			
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="panel classifieds-header-dark">
								<div class="panel-body classifieds-panel-body-white">
									<a class="btn silver-button" href="'.base_url('classifieds/view_category/All').'"><i class="fa fa-home"></i> View Classifieds Directory</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
			<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
					<div class="panel classifieds-header-light">
						<div class="panel-body classifieds-panel-body-white classifieds-header-font12">
							<h2>'.$item->name.'</h2>
							<p>Posted: '.$item->how_much_time_ago().' ago &nbsp;&nbsp; '.$item->views.' views &nbsp;&nbsp; Location: 
							'.$item->address.'
							, '.$item->location.'
							, '.$item->region.'
							</p>
							<p class="classifieds-price">';
								$currency = new Currency($item->currency_id);
								$currency->symbol = str_replace('$', '&#36;',$currency->symbol);
								if($currency->symbol_position == "before"){
									$output .= $currency->symbol. number_format($item->price,2);
								}else{
									$output .= number_format($item->price,2).$currency->symbol;
								}
								if($CI->BuilderEngine->get_option('be_classifieds_buy_now') == 'yes'){
									if($user->is_member_of_any($allowed_to_buy_groups))
										$output .=' <a href="'.base_url('classifieds/checkout?item='.$item->id).'" class="btn btn-primary btn-sm" style="margin-left:10px;"><i class="fa fa-money"></i> BUY NOW !</a>';
								}
								$output .='
								<span class="pull-right">
									<a href="https://twitter.com/share" class="twitter-share-button">Tweet Ad</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>
								</span>
							</p>
						</div>
					</div>
					<div class="panel classifieds-header">
						<div class="panel-body classifieds-panel-body-white be-classifieds-ad-desc">
						<h4>Description</h4>
						<p>'.$item->description.'</p>
						</div>
					</div>
					<div class="classifieds-report-bottom">
					<a href="'.base_url('classifieds/create_report/'.$item->id).'" class="btn btn-sm btn-danger"><i class="fa fa-bullhorn"></i> Report Ad</a>
					</div>
				</div>
                <div class="col-sm-4">
                </div>
            </div>
			
			<div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="panel classifieds-header-dark">';
						$reviews = $item->review->get();
						$output .='
						<div class="panel-heading navbar-user-box">Comments ('.$item->review->count().')</div>
							<div class="panel-body classifieds-panel-body-white classifieds-panel-comments-ad">
								<h4 style="margin-bottom:20px">Write a Comment to the Seller of this Ad</h4>
								<form method="post" style="margin-bottom:25px">
								<input type="hidden" name="classifieds'.$this->block->get_id().'" value="capblock" />';
									if($user->is_guest()){
										$output .= '
										<div class="form-group">
											<label>Your Name</label>
											<input type="text" name="user" class="form-control">
										</div>';
									}else
										$output .=' <input type="hidden" name="user" value="'.$user->username.'">';
									$output .='
									<div class="form-group">
										<label class="control-label" for="name">Your Comment</label>
										<textarea class="form-control" name="content" placeholder="Write your comment here"></textarea>
										<input type="hidden" name="product_id" value="'.$item->id.'">
									</div>
									<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> Submit Comment</button>
								</form>';
								if(empty($reviews))
									$output .= ' <p style ="color: #2E363F">No comments exist for this Ad yet. Be the first to write one!</p>';
								$i = 1;
								foreach ($reviews as $review){
									$output .='
									<div class="classifieds-review">
										<h5><b>From:</b> '.$review->user.'</h5>
										<p class="rmeta"><small>'.$review->date.'</small></p>
										<p>'.$review->content.'</p>';
										$comment_author = new User($review->user_id);
										if($user->is_logged_in()){
											$output .='<a id="reportButton'.$i.'" class="btn btn-xs btn-warning classifieds-report-btn" style="padding:3px 3px 3px;margin-right:5px;"><i class="fa fa-bullhorn"></i> Report</a>';
										}
										if($user->is_member_of("Administrators")){
											$output .='<a href="'.base_url('classifieds/delete_comment/'.$review->id).'" class="btn btn-xs btn-danger classifieds-report-btn" style="padding:3px 3px 3px"><i class="fa fa-trash"></i> Delete</a>';
										}
										$output .='
										<div id="reportDiv'.$i.'" class="hide" style="border:1px solid #ddd;margin-top:5px;">
											<div class="modal-header">
												<h4 class="modal-title" id="myModalLabel">Report Comment</h4>
											</div>
											<form id="reportForm'.$i.'" method="get" action="'.base_url('classifieds/report_comment/'.$seller->username).'">
												<div class="modal-body">
													<input type="hidden" name="review_id" value="'.$review->id.'">
													<input type="hidden" name="item_id" value="'.$item->id.'">
													<p>Please describe what aspect of this comment or it\'s author you find inadequate, inappropriate or insulting</p>
													<div class="form-group">
														<textarea class="form-control" name="text" placeholder="Describe your reason for reporting this comment"></textarea>
													</div>
												</div>
												<div class="modal-footer">
													<button id="closeForm'.$i.'" type="button" class="btn btn-xs btn-color classifieds-report-btn" style="padding:3px 3px 3px"><i class="fa fa-times"></i> Cancel</button>
													<button id="subForm'.$i.'" type="submit" class="btn btn-xs btn-danger classifieds-report-btn"  style="padding:3px 3px 3px"><i class="fa fa-send"></i> Submit</button>
												</div>
											</form>
										</div>
									</div>
									<script>
										$(document).ready( function(){
											$(\'#reportButton'.$i.'\').click(function(event){
												$(\'#reportDiv'.$i.'\').addClass(\'show\').fadeIn(600).addClass(\'animated zoomIn\');	
												event.preventDefault();
											});
											$(\'#subForm'.$i.'\').click(function(event){
												$(\'#reportDiv'.$i.'\').addClass(\'animated zoomOut\').fadeIn( 800 );
												$(\'#reportForm'.$i.'\').submit();
												event.preventDefault();
											});
											$(\'#closeForm'.$i.'\').click(function(event){
												$(\'#reportDiv'.$i.'\').removeClass(\'show\').fadeOut(1000);
												$(\'#reportDiv'.$i.'\').addClass(\'hide\').fadeIn(600);				
												event.preventDefault();
											});
										});
									</script>
									';
									$i++;
								}
								$output .='
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Message Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<h4 class="modal-title" id="myModalLabel">Send Message to '.$seller->first_name.' '.$seller->last_name.'</h4>
							<p class="hidden-xs">Enquiring About Classified Ad: <b>'.$item->name.'</b></p>
						</div>
						<form class="form-vertical" method="post" action="'.base_url('classifieds/send_message?username='.$seller->username.'&item='.$item->id).'">
							<div class="modal-body">
								<fieldset>
									<div class="row">  
										<div class="col-sm-12" >
											<div class="form-group">
												<label>Message</label>
												<div class="row">
													<div class="col-sm-12">
														<textarea name="content" class="form-control" rows="4" placeholder="Write your message to the Seller. Note: Abusive messages will not be tolerated and will result in your account being deleted."></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
								</fieldset>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-sm btn-primary">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!--End Message Modal-->
		';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-ad-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>

