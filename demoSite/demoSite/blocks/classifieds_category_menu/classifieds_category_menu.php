<? 
  class Classifieds_category_menu_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Category Menu";
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

		$member = new User($user->id);

		$all_items = new ClassifiedsItem();
		$all_items -> where('sold', 'no');
		$all_items = $all_items->get();

		$item = new ClassifiedsItem($segments[$count-1]);
		if(empty($item->id) || $item->sold == 'yes')
			show_404();
		if($item->ad_completed != 'yes')
			redirect(base_url('classifieds/awaiting_approval'), 'location');

		$item_category = $item->category->get();

		$parent_category = new ClassifiedsCategory();
		$parent_category->where('id', $item_category->parent)->get();
		if($parent_category->exists())
		{
			$parent_category = $parent_category;
			$parent_parent = new ClassifiedsCategory();
			$parent_parent->where('id', $parent_category->parent)->get();
			if($parent_parent->exists())
			{
				$parent_parent = $parent_parent;
			}
		}
		
		$categories = new ClassifiedsCategory();
		$categories = $categories->get();

        $output = '
			<div class="row">
				<!-- new Category dropdown -->
				<style>
					.cat{display:block !important;}
				</style>
				<li class="dropdown cat classifieds-category-float">
					<a href="'.base_url('classifieds/view_category/All').'" title="" class="dropdown-toggle btn btn-sm btn-default classifieds-btn" data-toggle="dropdown" style="" aria-expanded="false">
						Categories
						<b class="caret"></b>                           
					</a>
					 
					<ul class="dropdown-menu dropdown-menu-left animated fadeIn panel classifieds-header-categories classifieds-user-dropdown-space">
						<div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-categories-dark">Classifieds Listing</div>
						<div class="classifieds-panel-body-category-dropdown">';
						foreach($categories->where('parent', 0)->get() as $department_category){
							if($department_category->has_children()){
								$output .='
								<li class="dropdown-submenu classifieds-category-submenu classifieds-panel-body-user-dropdown">
									<a href="'.base_url('classifieds/view_category/'.$department_category->id).'" class="dropdown-color-17 dropdown-size-17" title="" style="">'.$department_category->name.'</a>
									<ul class="dropdown-menu">';
										foreach($categories->where('parent', $department_category->id)->get() as $subcategory){
											if($subcategory->has_children()){
												$output .='
												<li class="dropdown-submenu classifieds-panel-body-user-dropdown">
													<a tabindex="-1" href="'.base_url('classifieds/view_category/'.$subcategory->id).'">'.$subcategory->name.'</a>
													<ul class="dropdown-menu classifieds-panel-body-user-dropdown">';
														foreach($categories->where('parent', $subcategory->id)->get() as $subsubcategory){
															$output .='<li><a href="'.base_url('classifieds/view_category/'.$subsubcategory->id).'">'.$subsubcategory->name.'</a></li>';
														}
													$output .='
													</ul>
												</li>';
											}else{
												$output .='<li><a href="'.base_url('classifieds/view_category/'.$subcategory->id).'">'.$subcategory->name.'</a></li>';
											}
										}
									$output .='
									</ul>
								</li>';
							}else{
								$output .='
								<li class="dropdown-submenu classifieds-category-submenu classifieds-panel-body-user-dropdown">
									<a href="'.base_url('classifieds/view_category/'.$department_category->id).'" class="dropdown-color-17 dropdown-size-17" title="" style="">'.$department_category->name.'</a>
								</li>';
							}
						}
						$output .='
						</div>  
					</ul>
				</li>
				<!--end new category dropdown-->
			</div> 
		';

        return $output;
    }
  }
?>

