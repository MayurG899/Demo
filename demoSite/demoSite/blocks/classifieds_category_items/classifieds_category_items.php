<? 
class Classifieds_category_items_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category items";
        $info['block_icon'] = "fa-envelope-o";
      
        return $info;
    }
    public function generate_admin()
    {

    }
    public function generate_content()
    {
        $CI = & get_instance();
        $CI->load->module('classifieds');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$category_id = $segments[$count-1];
		$category = new ClassifiedsCategory($category_id);

			$parent_category = new ClassifiedsCategory();
			$parent_category = $parent_category->where('id', $category->parent)->get();
			if($parent_category->exists())
			{
				$parent_parent = new ClassifiedsCategory();
				$parent_parent = $parent_parent->where('id', $parent_category->parent)->get();
				$parent_category = $parent_category;

				if($parent_parent->exists())
				{	
					$parent_parent = $parent_parent;
				}
			}

			$child_categories = new ClassifiedsCategory();
			$child_categories = $child_categories->where('parent', $category->id)->get();
			$all_items = new ClassifiedsItem();
			$i = 1;
			$n = 1;
			foreach($child_categories as $child_category)
			{
				if($child_category->exists())
				{
					$child_children = new ClassifiedsCategory();
					$child_children = $child_children->where('parent', $child_category->id)->get();
					foreach ($child_children as $child_child)
					{
						if($child_child->exists())
						{	
							if($i == 1)
							{
								$all_items->where('category_id', $child_child->id);
							}
							else
								$all_items->or_where('category_id', $child_child->id);

							$i++;
						}
						
					}

					if($i == 1)
						$all_items->where('category_id', $child_category->id);
					else
						$all_items->or_where('category_id', $child_category->id);

					$i++;
				}
				$n++;
			}

			if($n <= 1)
				$items = $category->item->where('sold', 'no')->where('ad_completed', 'yes')->get();
			else
			{
				$items = $all_items->where('sold', 'no')->where('ad_completed', 'yes')->get();
			}
			$count = 0;
			foreach($items as $i){
				$count++;
			}
        $output = '
		<link href="'.base_url('modules/classifieds/assets/css/theme.css').'" rel="stylesheet">
		<link href="'.base_url('modules/classifieds/assets/css/style.css').'" rel="stylesheet">
		<div class="search-result-top-bar">'.$count.' Ad';if($count > 1) $output .= 's';$output .=' Found in '.$category->name.'</div>
		<div class="tabbable classifieds-category"> <!-- Only required for left/right tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab1" data-toggle="tab">List view</a></li>
				<li><a href="#tab2" data-toggle="tab">Grid view</a></li>
			</ul>
			<div class="tabbable classifieds-category listings"> <!-- Only required for left/right tabs -->
				<div class="tab-content">
					<div class="tab-pane active" id="tab1">';
						foreach($items as $item){
							if($item->sold != 'yes'){
								$item_category = new ClassifiedsCategory($item->category_id);
								$output .='
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 classifieds-category-paddings">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ';if($item->featured == 'yes') $output .= ' premium ';$output .=' listing-row">
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
											<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
												<span class="thumbnail">
													<img src="'.checkImagePath($item->img).'">
												</span>
											</div>
										</a>
										<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
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
					<div class="tab-pane" id="tab2">';
						foreach($items as $item){
							if($item->sold != 'yes'){
								$item_category = new ClassifiedsCategory($item->category_id);
								$output .='
								<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 classifieds-category-paddings">
									<div class="';if($item->featured == 'yes') $output .= 'premium';$output.=' listing-row grid-listing-row">
											<a class="classifieds-category" href="'.base_url('classifieds/view_item/'.$item->id).'">';
												if($item->featured == 'yes'){
													$output .='
													<div class="ribbon-wrapper-red">
														<div class="ribbon-red">
															&nbsp;<span>Featured</span>
														</div>
													</div>';
												}
												$output.='
												<div class="grid-thumbnail">
													<span class="">
														<img src="'.checkImagePath($item->img).'">
													</span>
												</div>
												<div class="grid-box-padding">
													<h3>
													  '.$item->name.' 
													</h3>
													<p class="grid-classifieds-category">
														'.$item->location.'
														, '.$item->region.'
													</p>';
													$seller = new User($item->posting_member_id);
													$output .='
													<p class="grid-classifieds-category-posted">Posted '.$item->how_much_time_ago().' ago.</p>
													
													<span class="grid-price-text">';
														$currency = new Currency($item->currency_id);
														if($currency->symbol_position == "before"){
															$output .= $currency->symbol.number_format($item->price,2);
														}else{
															$output .= number_format($item->price,2).$currency->symbol;
														}
													$output .='
													</span>
											</a>
											
											<a class="grid-float-right" href="'.base_url('classifieds/view_category/'.$item_category->id).'">'.$item_category->name.'</a>
										</div>
										</a>
									</div>
								</div>';
							}
						}
					$output .='
					</div>
				</div>
			</div>
		</div>';

		return $output;
	}
}
?>

