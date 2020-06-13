<? 
class Classifieds_recent_items_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Recent items";
      $info['block_icon'] = "fa-envelope-o public";
      
      return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
    public function generate_content()
    {
        $CI = & get_instance();
        $CI->load->module('classifieds');
		$this->load_generic_styles();
		$single_element = '';

		$output = '';
		$output .= '
				<div id="classifieds-recent-items-container-'.$this->block->get_id().'">
				<div class="classifieds">
				<div class="panel classifieds-header-light classifieds-recent-listings">
					<div class="panel-heading navbar-user-box classifieds-header-dark">Recent Ads on '.$CI->BuilderEngine->get_option('website_title').'</div>
					<div class="panel-body classifieds-panel-body-seller-latest">';
						$limit = $CI->BuilderEngine->get_option("be_classifieds_recent_items_count");
						$recent_items = new ClassifiedsItem();
						$recent_items->order_by('time_of_creation', "DESC");
						$recent_items->limit($limit);
						$recent_items->where('sold', 'no');
						$recent_items->where('ad_completed', 'yes');
						$recent_items = $recent_items->get();
						foreach($recent_items as $single_item){
							$output .='
							<div class="row listing-row">
								<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
									<a href="'.base_url('classifieds/view_item/'.$single_item->id).'" class="thumbnail" ><img src="'.checkImagePath($single_item->img).'"></a>
								</div>   
								<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 classifieds-recent-ads-paddingtop">
									<div class="row">
										<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
											<h3><a href="'.base_url('classifieds/view_item/'.$single_item->id).'">'.$single_item->name.'</a></h3>
										</div>                    
										<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
											<h3 class="price-text">
												<strong>';
													$currency = new Currency($single_item->currency_id);
													if($currency->symbol_position == "before"){
														$output .= $currency->symbol.$single_item->price;
													}else{
														$output .= $single_item->price.$currency->symbol;
													}
												$output .='
												</strong>
											</h3>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<p class="muted">Located in 
												<strong>';
													$output .= $single_item->address;
													$output .= ', '.$single_item->location;
													$output .= ', '.$single_item->region;
												$output .='
												</strong>
											</p>';
											$seller = new ClassifiedsMember($single_item->posting_member_id);
											$output .='
											<p class="muted">
												Posted '.$single_item->how_much_time_ago().' ago. 
												From: <a href="'.base_url('classifieds/profile/'.$seller->id).'">'.$seller->first_name.' '.$seller->last_name.'</a>
											</p>
										</div>
									</div>
								</div>
							</div>';
						}
					$output .='
					</div>
				</div>
			</div>
		</div>';
        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-recent-items-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
    }
}
?>

