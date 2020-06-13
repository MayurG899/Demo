<? 
  class Classifieds_categories_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Sections";
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

      $categories = new ClassifiedsCategory();
      $categories = $categories->where('parent', 0)->get();

      $output = '  
			<style>
				.cat{display:block !important;}
			</style>
			<div id="classifieds-category-items-container-'.$this->block->get_id().'">
			<div class="">
			<li class="dropdown cat classifieds-category-listing-list">			 
				<ul class="dropdown-menu dropdown-menu-left animated fadeIn panel classifieds-header-categories classifieds-user-dropdown-space classifieds-category-listing-open">
					<div id="user-panel-heading" class="panel-heading navbar-user-box classifieds-header-categories-dark">Classifieds Listing</div>
					<div class="classifieds-panel-body-category-dropdown">';
					foreach($categories as $department_category){
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
														$output .='
														<li><a href="'.base_url('classifieds/view_category/'.$subsubcategory->id).'">'.$subsubcategory->name.'</a></li>';
													}
												$output .='
												</ul>
											</li>';
										}else{
											$output .='
											<li><a href="'.base_url('classifieds/view_category/'.$subcategory->id).'">'.$subcategory->name.'</a></li>';
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
		</div>
		</div>';

      if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='with_settings_global';
		else
			$menu ='with_settings';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-category-items-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
  }
?>

