<? 
class Classifieds_page_listing_filters_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Page Listing Filter";
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

		$output = '
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 be-classifieds-filters-contain">
			<div class="panel classifieds-header-light">
				<div class="panel-heading navbar-user-box classifieds-header-dark">Page Listing Filters</div>
				<div class="panel-body classifieds-panel-body-user-dropdown">
					<form class="form-inline mini" method="get" style="margin-bottom: 0px;">
						<fieldset>        
							<div class="row filter-row">
								<div class="col-sm-4">
									<h5>Sort by</h5>
								</div>
								<div class="col-sm-8">
									<select name="order" class=" form-control">
										<option value="0" selected>No Sorting</option>
										<option value="1" '; if (isset($_GET['order']) && $_GET['order'] == 1) $output .= 'selected';$output.='>Name (A-Z)</option>
										<option value="2" '; if (isset($_GET['order']) && $_GET['order'] == 2) $output .= 'selected';$output.='>Name (Z-A)</option>
										<option value="3" '; if (isset($_GET['order']) && $_GET['order'] == 3) $output .= 'selected';$output.='>Price (Low-High)</option>
										<option value="4" '; if (isset($_GET['order']) && $_GET['order'] == 4) $output .= 'selected';$output.='>Price (High-Low)</option>
									</select>
								</div>
							</div>
							<div class="row filter-row">
								<div class="col-sm-12">
									<h5>Price range</h5>
								</div>
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input name="min_price" type="text" class="form-control price-input" placeholder="min" value="';if(isset($_GET['min_price'])) $output .= $_GET['min_price'];$output .='"/>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="input-group">
										<span class="input-group-addon">$</span>
										<input name="max_price" type="text" class="form-control price-input" placeholder="max" value="';if(isset($_GET['max_price'])) $output .= $_GET['max_price'];$output .='"/>
									</div>
								</div>
							</div>
							<div class="row filter-row">
								<div class="col-sm-12">
									<h5>Search only:</h5>
								</div>
								<div class="col-sm-12">
									<div class="radio">
										<label>
											<input type="radio" name="filter" value="featured" ';if(isset($_GET['filter']) && $_GET['filter'] == 'featured') $output .= 'checked';$output .='>
											Featured ads
										</label>
									</div><br />
									<div class="radio">
										<label>
											<input type="radio" name="filter" value="only_picture" ';if(isset($_GET['filter']) && $_GET['filter'] == 'only_picture') $output .= 'checked';$output .='>
											Only ads with pictures
										</label>
									</div>
								</div>
							</div>
							<div class="row filter-row">  
								<div class="col-sm-2 pull-right" style="margin-top: 10px;">
									<button class="btn btn-sm btn-inverse pull-right" type="submit">Update Results</button>
								</div>
							</div>            
						</fieldset>
					</form>
				</div>
			</div>
		</div>';
        return $output;
    }
}
?>

