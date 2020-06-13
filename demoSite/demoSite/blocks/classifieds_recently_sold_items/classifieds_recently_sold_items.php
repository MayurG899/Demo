<? 
  class Classifieds_recently_sold_items_block_handler extends  block_handler{
    function info()
    {
      $info['category_name'] = "Classifieds";
      $info['category_icon'] = "dsf";

      $info['block_name'] = "Recently sold items";
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
      $CI->load->model('item');

      $items = new ClassifiedsItem();
      $items = $items->where('sold', 'yes');
      $items = $items->order_by('time_of_sell');
      $items = $items->get();

      $output = '
      <div class="afeatureorange">
        <div class="row-fluid">
          <div class="span10 offset1">
            <div class="afmatter afmatter-recent">

              <div class="row-fluid section-title-row-recent">
                <div class="span12">
                  <h4 class="section-title">Recently sold</h4>
                </div>
              </div>

              <div class="row-fluid recent-thumbnails-row">';

      foreach ($items as $item)
      {
        $output .= '<div class="span4 thumbnail-span">
                      <a href="/classifieds/view_item/'.$item->id.'" class="thumbnail recent-ads-thumbnail">
                        <img class="recent-thumbnail" src="'.$item->img.'">
                      </a>
                    </div>
        ';
      }
      
      $output .= '
              </div>
            </div>
          </div>
        </div>
      </div>';

      return $output;
    }
  }
?>

