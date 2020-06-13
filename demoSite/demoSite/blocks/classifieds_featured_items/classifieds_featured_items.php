<? 
class Classifieds_featured_items_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Featured items";
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
        $items = new ClassifiedsItem();
		$items = $items->where('ad_completed','yes')->where('featured','yes')->get();

        $output = '
		<div id="classifieds-featured-items-container-'.$this->block->get_id().'">
		<div class="tabbable classifieds-category listings"> <!-- Only required for left/right tabs -->
			<div class="tab-content">
				<div class="tab-pane active" id="tab1">';
					foreach($items as $item){
						if($item->sold != 'yes'){
							$item_category = new ClassifiedsCategory($item->category_id);
							$output .='
							<div class="classifieds-category-paddings">
								<div class="row classified-featured-margin-fix ';if($item->featured == 'yes') $output .= '';$output .=' classifieds-featured-bg listing-row">
									<a class="classifieds-category" href="'.base_url('classifieds/view_item/'.$item->id).'">';
										if($item->featured == 'yes'){
											$output .='
											<div class="ribbon-wrapper-red">
												<div class="ribbon-red">
													&nbsp;<span>Featured</span>
												</div>
											</div>';
										}
										$output .='
										<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
											<span class="thumbnail">
												<img src="'.checkImagePath($item->img).'">
											</span>
										</div>
									</a>
									<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
									<a class="classifieds-category" href="'.base_url('classifieds/view_item/'.$item->id).'">
										<h3>
											'.$item->name.' 
											<span class="price-text">';
												$currency = new Currency($item->currency_id);
												if($currency->symbol_position == "before"){
													$output .= $currency->symbol.number_format($item->price,2);
												}else{
													$output .= number_format($item->price,2).$currency->symbol;
												}
											$output .='
											</span>
										</h3>
										<p class="muted">Located in 
											<strong>
											'.$item->location.'
											, '.$item->region.'
											</strong>
										</p>';
										$seller = new User($item->posting_member_id);
										$output .='
										<p class="muted">Posted '.$item->how_much_time_ago().' ago. From: '.$seller->first_name.' '.$seller->last_name.'</p>
										<p class="classifieds-category-p">'.$item->description.'</p>
										</a>
										<a href="'.base_url('classifieds/view_category/'.$item_category->id).'"><strong>Category Listing: '.$item_category->name.'</strong></a>
									</div>
								</div>
							</div>';
						}
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
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-featured-items-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
		else
			return $output;
	}
}
?>

