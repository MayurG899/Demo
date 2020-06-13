<?php
class forum_search_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Search";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }
    public function generate_admin()
    {
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
 		//Controller
		//require_once('forum_helper.php');

		//global $active_controller;
		//$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('users');
		$CI->load->model('area');
		$CI->load->model('forum_topic');
		$CI->load->model('forum_thread');
		$posts = $CI->forum_thread->get();
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$count = count($segments);
		$keyword = $segments[$count-1];
		$keyword = urldecode($keyword);
        if(isset($_GET['keyword']))
            redirect(base_url('/forum/search/'.$_GET['keyword']), 'location');
        $page_number = 1;
        if(isset($_GET['page']))
            $page_number = $_GET['page'];
        if(!$CI->BuilderEngine->get_option('forum_num_posts_displayed'))
            $posts_per_page = 6;
        else
            $posts_per_page = $CI->BuilderEngine->get_option('forum_num_posts_displayed');

        $posts = $posts->like('title', $keyword)->or_like('text', $keyword)->order_by('time_created', 'desc')->get_paged($page_number, $posts_per_page);
		
		//View
        $output ='
            <!-- begin panel-forum -->
			<div class="panel panel-forum">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title"><a href="#"><b>Search Results:</b></a></h4>
                </div>
                <!-- end panel-heading -->
                <!-- begin forum-list -->                   
					<ul class="forum-list forum-topic-list forums-category-box">';
						foreach($posts as $post){
							$output .='<li>
                                <div class="media">';
								if(($post->image == '') || ($post->image == 'image')){
									$output .='<img src="http://placehold.it/64x64" alt="" />';
								}else{
                                    $output .='<img src="'.$post->image.'" alt="" />';
								}
                                $output .='</div>
								<div class="info-container">
									<div class="info">';
										   $user = new User($post->user_id);
										   $post_category = new Forum_category();
										   $post_category = $post_category->where('id',$post->category_id)->get();
										   $post_topic = new Forum_topic();
										   $post_topic = $post_topic->where('id',$post_category->topic_id)->get();
										   $post_area = new Area();
										   $post_area = $post_area->where('id',$post_topic->area_id)->get();
										  
										$output .='<h4 class="title"><a href="'.base_url('forum/topic/'.$post_topic->name.'/category/'.$post->category_id.'#'.$user->username.'/'.$post->time_created.'/'.$post->id.'').'"> '.$post_area->name.'/'.$post_topic->name.'/'.$post_category->name.''.'</a></h4>
										<ul class="info-start-end">
											<li style="list-style-type:none;"><i>Post by: </i> <a> '.$user->first_name.' '.$user->last_name.''.'</a></li>
											<li style="list-style-type:none;"><i>Posted: </i> '.date('d M, Y', $post->time_created).'</li> ';

											$text_without_slashes = strip_tags(ChEditorfix($post->text));
											if(strlen($post->text) > 300)
											{
												$text = substr($text_without_slashes, 0, 300).'...';
											}
											else{
												$text = $text_without_slashes;
											}

										$output .='</ul>
									</div>
									<div class="date-replies-search">
									<br>
									<p class="text-left"><b>Post Text Results:</b></p>s
										'.$text.'
									</div>
									<div class="date-replies-search pull-right">
										<a href="'.base_url('forum/topic/'.$post_topic->name.'/category/'.$post->category_id.'#'.$user->username.'/'.$post->time_created.'/'.$post->id.'').'" class="btn btn-sm btn-success"><i class="fa fa-sign-out"></i> View Forum Post</a>
									</div>
								</div>
							</li>';
						}
					$output .='</ul>
					<!-- PAGINATION -->
					<div class="text-center">
						<ul class="pagination">';
							$number_of_posts = $posts->count();
							if(!$CI->BuilderEngine->get_option('forum_num_posts_displayed'))
					        {
					            $posts_per_page = 6;
					        }
					        else{
					            $posts_per_page = $CI->BuilderEngine->get_option('forum_num_posts_displayed');
							}
					        $total_pages = ceil($number_of_posts / $posts_per_page);

					        if(!isset($_GET['page']))
					        	$current_page = 1;
					       	else
					       		$current_page = $_GET['page'];

					       	$back_page =  $current_page - 1;
					       	if($back_page > 0){
								$output .='<li><a href="'.base_url('forum/search/?page='.$back_page).'"><i class="fa fa-chevron-left"></i></a></li>';
							}
					        for($i = 1; $i <= $total_pages; $i++){
					        	$output .='<li><a href="'.base_url('forum/search/?page='.$i).'" '; 
								if($i == $current_page){
									$output .='class="active"';
								}
					        }
							$output .='>'.$i.'</a></li>';

					        $front_page =  $current_page + 1;
					       	if($front_page <= $total_pages){
								$output .='<li><a href="'.base_url('forum/search/?page='.$front_page).'"><i class="fa fa-chevron-right"></i></a></li>';
							}
						$output .='</ul>
					</div>
					<!-- /PAGINATION -->
			</div>		
		';
        return $output;
    }
}
?>