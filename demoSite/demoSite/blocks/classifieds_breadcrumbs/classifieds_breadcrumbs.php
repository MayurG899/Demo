<? 
  class Classifieds_breadcrumbs_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Breadcrumbs";
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
		$id = $segments[$count-1];
		if( //strpos($segments[$count-1],'.html') !== FALSE ||
			//strpos($_SERVER['REQUEST_URI_PATH'],'/layout_system/ajax/') !== FALSE ||
			strpos($_SERVER['REQUEST_URI_PATH'],'/classifieds/view_item/') !== FALSE ||
			(strpos($_SERVER['REQUEST_URI_PATH'],'/classifieds/view_category/') !== FALSE && is_int($id))
		){
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
				<ol class="be-breadcrumb">
					<li><a href="'.base_url().'classifieds/view_category/All">Classifieds</a></li>';
					if($parent_category->exists()){
						if($parent_parent->exists()){
							$output .='
							<li><a href="'.base_url().'classifieds/view_category/'.$parent_parent->id.'?page=1">'.$parent_parent->name.'</a></li>
							<li><a href="'.base_url().'classifieds/view_category/'.$parent_category->id.'?page=1">'.$parent_category->name.'</a></li>';
						}else{
							$output .='<li><a href="'.base_url().'classifieds/view_category/'.$parent_category->id.'?page=1">'.$parent_category->name.'</a></li>';
						}
					}
					$output .='
					<li><a href="'.base_url().'classifieds/view_category/'.$item_category->id.'?page=1">'.$item_category->name.'</a></li>
					<li class="active" style="pointer-events: none"><a href="#">'.$item->name.'</a></li>
				</ol>
			';
		}else{
			$output = '
				<ol class="be-breadcrumb">
					<li><a href="'.base_url().'classifieds/view_category/All">Classifieds</a></li>
					<li class="active" style="pointer-events: none"><a href="#">Directory</a></li>
				</ol>
			';
		}

        return $output;
    }
  }
?>

