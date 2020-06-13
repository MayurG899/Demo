<? 
  class Classifieds_directories_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Directories";
      $info['block_icon'] = "fa-envelope-o public";
      
      return $info;
    }
    public function generate_admin()
    {
		$this->show_placeholder();
    }
	public function generate_style($active_menu = '')
	{
		
	}
	public function load_generic_styling()
	{
		
	}
    public function generate_content()
    {
        $CI = & get_instance();
        $CI->load->module('classifieds');
		$this->load_generic_styles();

        $categories = new ClassifiedsCategory();

        $output = '
			<div id="classifieds-directories-container-'.$this->block->get_id().'">
			<div class="panel classifieds-header-light">
			<div class="panel-heading navbar-user-box classifieds-header-dark classifieds-directory-maintitle"><span>Directory listings</span></div>
			<div class="panel-body classifieds-profile-body-info classifieds-directory">
        ';
        $output .= '
        <div class="row classifieds-directory">
            <div class="col-xs-12">';
                foreach($categories->where('parent', 0)->get() as $parent_category)
                {
                    $output .= '
                    <div class="directory-block col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="col-sm-3">
                            <div class="classifieds-directory-thumbnails-margin-left">
							<!-- left front thumbnail -->
                            <div class="left-front-thumbnail">
                              <img class="section-thumbnail-image" src="'.checkImagePath($parent_category->image2).'">
                            </div>
                            <!-- left back thumbnail -->
                            <div class="left-back-thumbnail">
                            </div>
                            <!-- right thumbnail -->
                            <div class="right-thumbnail classifieds-directory-thumbnails-margin-right">
                              <img class="section-thumbnail-image" src="'.checkImagePath($parent_category->image).'">
                            </div>
							</div>
                        </div>
                        <div class="col-sm-9 classifieds-directory-list-center">
                            <h4><a href="'.base_url('classifieds/view_category/'.$parent_category->id).'" >'.$parent_category->name.'</a></h4>
                            <p>';

                            $child_categories = new ClassifiedsCategory();
                            $i = 1;
                            foreach($child_categories->where('parent', $parent_category->id)->get() as $child_category)
                            {
                                $count = $child_categories->result_count();
                                if($i == $count)
                                    $output .= '<a href="'.base_url('classifieds/view_category/'.$child_category->id).'" >'.$child_category->name.'</a>';
                                else
                                    $output .= '<a href="'.base_url('classifieds/view_category/'.$child_category->id).'" >'.$child_category->name.'</a>, <br>'; 
                                $i++;
                            }

                            $output .= '
                            </p>
                        </div>
                    </div>';
                }
            $output .= '
            </div>
        </div>
		</div>
		</div>
		</div>';
		if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
			$menu ='global_style';
		else
			$menu ='style';
		if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
			return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'classifieds-directories-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), '', $this->block->get_name(), $menu);
		else
			return $output;
    }
  }
?>

