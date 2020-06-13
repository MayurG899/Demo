<? 
class Classifieds_latest_ads_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Latest Ads";
      $info['block_icon'] = "fa-envelope-o";
      
      return $info;
    }
    public function generate_admin()
    {

    }
    public function generate_content()
    {
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
        $CI->load->module('classifieds');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$item = new ClassifiedsItem($segments[$count-1]);
		$seller = new ClassifiedsMember($item->posting_member_id);
		$output = '
			<div class="panel classifieds-header-light">
				<div class="panel-heading navbar-user-box classifieds-header-dark">Latest Ads from '.$seller->first_name.' '.$seller->last_name.'</div>
				<div class="panel-body classifieds-panel-body-seller-latest">';
					$seller_items = new ClassifiedsItem();
					$i = 1;
					foreach ($seller_items->where('posting_member_id', $seller->id)->where('id !=', $item->id)->where('ad_completed','yes')->order_by('time_of_creation', 'DESC')->limit(4)->get() as $seller_item){
						$item_category = new ClassifiedsCategory($seller_item->category_id);
						$item_currency = new Currency($seller_item->currency_id);
						$price = $item_currency->symbol.' '.number_format($seller_item->price,2);
						$output .='
						<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 other-from-seller">
							<div class="row">
								<a href="'.base_url('classifieds/view_item/'.$seller_item->id).'">
									<img class="recent-item-image" src="'.checkImagePath($seller_item->img).'">
								</a>
							</div>
							<div class="recent-item-info-row">
								<div class="">
									<div class="">
										<div class="classifieds-seller-latest-price-font">
											<p><a href="'.base_url('classifieds/view_item/'.$seller_item->id).'">
											<strong>'.$seller_item->name.'</strong></a>
											</p>
										</div>
									</div>
									<div class="">
										<div class="classifieds-seller-latest-price">
											<p>'.$price.'</p>
										</div>
									</div>
									<div class="">
										<div class="">    
											<p style="classifieds-seller-latest-category"><a href="'.base_url('classifieds/view_category/'.$item_category->id).'">'.$item_category->name.'</a></p>
										</div>
									</div>
									<div class="">
										<div class="classifieds-seller-latest-posted">    
											<p>'.$seller_item->how_much_time_ago().' ago</p>
										</div>
									</div>
								</div>
							</div>
						</div>';
						$i++;
					}
				$output .='
				</div>
			</div>';
        return $output;
    }
}
?>

