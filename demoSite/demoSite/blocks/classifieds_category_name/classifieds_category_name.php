<? 
class Classifieds_category_name_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Category Name";
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
		$category = new ClassifiedsCategory($id);
		$output = '
			<h2>'.$category->name.'</h2>';
        return $output;
    }
}
?>

