<?php
class forum_header_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Forum";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Forum Header";
        $info['block_icon'] = "fa-envelope-o public";

        return $info;
    }
    public function generate_admin()
    {
			$this->show_placeholder();
    }
    public function generate_style()
    {
    }
    public function generate_content()
    {
 		//Controller
		global $active_controller;
		$user = &$active_controller->user;		
        $CI = & get_instance();
        $CI->load->module('forum');
		$CI->load->model('users');
		$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$segments = explode('/', $_SERVER['REQUEST_URI_PATH']);
		$this->load_generic_styles();
		$single_element = '';
		$count = count($segments);
		$title = 'Forums';
		if($segments[$count-1] == 'search' || $segments[$count-2] == 'search'){
			$title = 'Forum Search';
		}
		if($segments[$count-2] == 'new_thread'){
			$title = 'New Forum Thread';
		}
		if($segments[$count-2] == 'area'){
			$area = new Area();
			$name = $segments[$count-1];
			$name = str_replace('%20',' ',$name);
			$area = $area->where('name',$name)->get();
			$title = 'Topic:';
		}
		if($segments[$count-2] == 'topic'){
			$top = new Forum_topic();
			$name = $segments[$count-1];
			$name = str_replace('%20',' ',$name);
			$top = $top->where('name',$name)->get();
			$topic_area = new Area($top->area_id);
			$title = 'Forum:';
		}
		if($segments[$count-2] == 'category'){
			$cat = new Forum_category();
			$id = $segments[$count-1];
			$category = $cat->where('id',$id)->get();
			$cat_topic = new Forum_topic($category->topic_id);
			$top_area = new Area($cat_topic->area_id);
			$title = 'Thread:';
		}
		//View
        $output ='
			<!-- ================== END BASE CSS STYLE ================== -->	
			<!-- begin container -->
			<div id="forums-main-header-container-'.$this->block->get_id().'">
			<div class="container forums-header forums-page-blockheader-title">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 forums-header-breadcrumb-padding">	
			
			<!-- begin breadcrumb -->
				<ul class="be-breadcrumb">
					<li><a href="'.base_url('forum/all_topics').'">Forum Directory</a></li>';
				if($title == 'Thread:'){	
					$output .='
					<li><a href="'.base_url('forum/area/'.$top_area->name.'').'">'.$top_area->name.'</a></li>
					<li><a href="'.base_url('forum/topic/'.$cat_topic->name.'').'">'.$cat_topic->name.'</a></li>
					<li>'.$category->name.'</li>
					<li class="active">&nbsp;</li>';
				}
				if($title == 'Topic:'){	
					$output .='
					<li>'.$area->name.'</li>
					<li class="active">&nbsp;</li>';
				}
				if($title == 'Forum:'){	
					$output .='
					<li><a href="'.base_url('forum/area/'.$topic_area->name.'').'">'.$topic_area->name.'</a></li>
					<li><a href="'.base_url('forum/topic/'.$top->name.'').'">'.$top->name.'</a></li>
					<li class="active">&nbsp;</li>';
				}	
		$output .='</ul></div>
				<!-- end breadcrumb -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 forums-header-breadcrumb-padding">';
			if($title != 'Thread:'){
				if($segments[$count-2] == 'topic'){
					$output .='<h1 class="pull-left">'.$top->name.'</h1>';
				}
				elseif($segments[$count-2] == 'area'){
					$output .='<h1 class="pull-left">Forum Section</h1>';
				}
				else{
					$output .='<h1 class="pull-left">All Forum Topics</h1>';
				}
			}
			else{
                $output .='
					<h1 class="pull-left"><b>'.$category->name.'</b>';
					$cl = ($category->locked == 'yes')?'<span style="color:red;"> [locked] </span> ':' ';
					$output .= $cl;
					if($CI->users->is_admin()){
						if($category->locked == 'no'){
							$text = 'Lock';
							$button ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-danger"><i class="fa fa-lock"></i> '.$text.' </a>';
						}
						else{
							$text = 'Unlock';
							$button ='<a href="'.base_url('forum/toggle_lock_thread/'.$category->id.'').'" class="btn btn-xs btn-success"><i class="fa fa-unlock-alt"></i> '.$text.' </a>';					
						}
						$output .= $button;
					}
					$output .='</h1>';
			}
        $output .='</div>
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 forums-header-breadcrumb-padding">
				<ul class="forums-topbar forums">
				<li>
					<form class="navbar-form forum-search-header-margin" method="get" action="'.base_url('/forum/search').'" >
						<div class="form-group">
							<input type="text" class="form-control" name="keyword" placeholder="Enter Keywords..." />
							<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</li>';
				if(!$user->is_logged_in()){
					$output .='<li class="forums-btn-margin"><a href="'.base_url('cp/login').'" type="button" class="btn btn-sm forums-btn btn-default">Sign In</a></li>
					<li class="forums-btn-margin"><a href="'.base_url('cp/register').'" type="button" class="btn btn-sm forums-btn btn-default">Create Account</a></li>';
				}else{
					$output .='
						<li class="forums-btn-margin"><a href="'.base_url('cp/logout').'" type="button" class="btn btn-sm forums-btn btn-default">Log Out</a></li>
						<li class="forums-btn-margin"><a href="'.base_url('cp/dashboard').'" type="button" class="btn btn-sm forums-btn btn-default">My Account</a></li>
					';
					/*<li><a href="'.base_url('user/main/dashboard').'" type="button" class="btn btn-default">My account</a></li>'; */
				}		
				
			$output .='</ul>
			</div>
			</div>
			</div>
			<!-- end container -->';

        if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'forums-main-header-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
        return $output;
    }
}
?>