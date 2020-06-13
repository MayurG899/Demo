<? 
  class Classifieds_search_section_advanced_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Classifieds";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Advanced Search";
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

        $regions = new ClassifiedsRegion();
        $regions = $regions->get();

        $locations = new ClassifiedsLocation();
        $locations = $locations->get();

        $categories = new ClassifiedsCategory();
        $categories = $categories->get();

        $output = '
        <div class="classifieds-search-container home-tron-search classifieds" id="top-search-section'.$this->block->get_id().'">
            <div class="">
                <div class="row">
                    <div class="">
                        <div class="home-tron-search-inner">
                            <div class="row">
                                <form method="get" id="advancedsearchform'.$this->block->get_id().'" action="'.base_url('classifieds/search').'">
                                    <div class="classifieds-search-advanced-filters" style="display:block;">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <select name="category_id" class="form-control">
                                                    <option>Choose Category</option>';
                                                    foreach($categories as $category)
                                                    {
                                                        $output .= '<option value="'.$category->id.'"';
                                                        if(isset($_GET['category_id']) && $_GET['category_id'] == $category->id)
                                                            $output .= 'selected';
                                                        $output .= '>'.$category->name.'</option>';
                                                    }
                                                    $output .='
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="region" class="form-control">
                                                    <option>Choose Region</option>';
                                                    foreach($regions as $region)
                                                    {
                                                        $output .= '<option value="'.$region->name.'"';
                                                        if(isset($_GET['region']) && $_GET['region'] == $region->name)
                                                            $output .= 'selected';
                                                        $output .= '>'.$region->name.'</option>';
                                                    }
                                                    $output .='
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <select name="location" class="form-control">
                                                    <option>Choose Location</option>';
                                                    foreach($locations as $location)
                                                    {
                                                        $output .= '<option value="'.$location->name.'"';
                                                        if(isset($_GET['location']) && $_GET['location'] == $location->name)
                                                            $output .= 'selected';
                                                        $output .= '>'.$location->name.'</option>';
                                                    }
                                                    $output .='
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row classifieds-search-advanced-rowmargin">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span style="min-width: 40px;" class="input-group-addon">$</span>
                                                    <input name="min_price" type="text" class="form-control price-input" placeholder="min"';
                                                    if(isset($_GET['min_price']) && $_GET['min_price'] != '')
                                                        $output .= ' value="'.$_GET['min_price'].'"';
                                                    $output .= '/>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span style="min-width: 40px;" class="input-group-addon">$</span>
                                                    <input name="max_price" type="text" class="form-control price-input" placeholder="max"';
                                                    if(isset($_GET['max_price']) && $_GET['max_price'] != '')
                                                        $output .= ' value="'.$_GET['max_price'].'"';
                                                    $output .= '/>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="filter" value="featured" ';
                                                        if(isset($_GET['filter']) && $_GET['filter'] == 'featured')
                                                            $output .= 'checked';
                                                        $output .= '>
                                                        Featured ads
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="filter" value="only_picture" ';
                                                        if(isset($_GET['filter']) && $_GET['filter'] == 'only_picture')
                                                            $output .= 'checked';
                                                        $output .= '>
                                                        Ads with pictures
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" name="keyword" class="form-control col-sm-3" placeholder="Search Classifieds with Filters">
                                            <div class=" input-group-addon hidden-xs">
                                                <a onclick="document.getElementById("advancedsearchform'.$this->block->get_id().'").submit();" class="btn btn-sm btn-default classifieds-category-search-btn">Search</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		';

        return $output;
    }
  }
?>

