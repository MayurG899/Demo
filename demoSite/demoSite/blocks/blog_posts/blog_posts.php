<?php
    class Blog_posts_block_handler extends  block_handler{
        function info()
        {
            $info['category_name'] = "Blog";
            $info['category_icon'] = "dsf";

            $info['block_name'] = "Blog Posts";
            $info['block_icon'] = "fa-envelope-o public";
            
            return $info;
        }
        public function generate_admin()
        {
            $post = $this->block->data('post');
            
            $posts_option = array();
            $CI = & get_instance();
            $CI->load->model('post');
			$CI->load->model('category');
			$uc = $CI->category;
			$unallocated_category = $uc->where('name','Unallocated')->get();			
            $posts = $CI->post;
            $all_posts = $posts->where('category_id !=',$unallocated_category->id)->get();
            foreach ($all_posts->all as $key => $value) {
                $posts_option[$value->id] = stripslashes(str_replace('_',' ',$value->title));
            }
            $this->admin_select('post', $posts_option, 'Posts: ', $post);
        }
        public function generate_style($active_menu = '')
        {
			
        }
		public function load_generic_styling()
		{
			
		}
		public function set_initial_values_if_empty()
		{
			$content = $this->block->data('content');

			if(!is_array($content) || empty($content))
			{
				$content = array();
				$content[0] = new stdClass();
				$content[0]->slug = "blog-post-2";
				$content[0]->title = "Blog Post 2";
				$content[0]->text = "<h4>Translation</h4> <p>Contrary to popular belief Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.&nbsp;</p> <p>Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.&nbsp;</p> <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>";
				$content[0]->image = base_url('files/blogimage.jpg');
				$content[0]->tags = "Blog,Tag,Example";
				$content[0]->time_created = '1458906467';

				$this->block->set_data('content', $content, true);
			}
		}
        public function generate_content()
        {
            global $active_controller;
            $CI = &get_instance();
            $CI->load->module('layout_system');

            $post_id = $this->block->data('post');
			//$settings[0][0] ='blog'.$this->block->get_id();
			//$settings[0][1] = $sections_animation_event;
			//$settings[0][2] = $sections_animation_duration.' '.$sections_animation_delay.' '.$sections_animation_type;
			//add_action("be_foot", generate_animation_events($settings));

            $CI = & get_instance();
            $CI->load->library('session');
            $CI->load->library('form_validation');

            $BuilderEngine = new BuilderEngine();
            $user = new User();
            $users = new Users();
            $CI->load->model('post');
            $post = $CI->post;
			$CI->load->model('category');
			$uc = $CI->category;
			$unallocated_category = $uc->where('name','Unallocated')->get();	
            $post = $post->where('id', $post_id)->where('category_id !=',$unallocated_category->id)->get();
            $CI->load->model('comment');
            $comments = $CI->comment;
            $comments = $comments->where('post_id',$post->id)->get();
            $pub_user = $user->get_by_id($post->user_id);

			$this->set_initial_values_if_empty();
			$content = $this->block->data('content');
			$single_element = '';

			//generic animations
			$this->load_generic_styles();
			//
			$output = '';
			foreach($content as $key => $element){
				$element = (object)$element;
				if($post->id > 0){
					$element->slug = $post->slug;
					$element->title = $post->title;
					$element->text = $post->text;
					$element->image = $post->image;
					$element->tags = $post->tags;
					$element->time_created = $post->time_created;
				}
				$output .= '
					<div id="blog-post-container-'.$this->block->get_id().'" class="block-colors-light">
					<div class="blog-post-container" id="blog">
					<li class="blog-post-block block-colors-light-bg">
						<div class="blog-post-header">
						   <a field_name="content-'.$key.'-slug" class="designer-editable"  id="blog_posts-slug-'.$this->block->get_id().'" href="'.base_url('blog/post').'/'.$element->slug.'"> <h3 field_name="content-'.$key.'-title" class="designer-editable">Blog: '.stripslashes(str_replace('_',' ',$element->title)).'</h3></a>
							<small class="space18">';
								$post_comments=array();
								foreach($comments as $comment)
									{array_push($post_comments,$comment->id);}
							$count = count($post_comments);
							$pluralizer = ($count == 1) ? 'Comment' : 'Comments';
							$output .= '
								<a href="'.base_url('blog/post').'/'.$element->slug.'" class="scrollTo label label-colors label-md"><i class="fa fa-comment-o"></i> '.$count.' '.$pluralizer.'</a>
								<span class="label label-colors label-md"><b>Date:</b> '.date('d M Y',$element->time_created).'</span> 
								<a href="'.base_url('cp/user/'.$user->id).'" class="label label-colors blog-post-container-label-posted pull-right"><b>Blog:</b> '.$pub_user->first_name.' '.$pub_user->last_name.'</a>
							</small>
						</div>';

						if(!empty($element->image)){
							$output .= '
								<div field_name="content-'.$key.'-image" class="designer-editable blog-post-image">
									<a href="'.base_url('blog/post').'/'.$element->slug.'"><img src="'.checkImagePath($element->image).'" class="img-responsive blog-post-thumbnail" alt="img" /></a>
								</div>';
						}
				$output .= '             
				   <div field_name="content-'.$key.'-text" class="designer-editable">
					   '.ChEditorfix($element->text).'
					</div>

					<hr />';

						if($BuilderEngine->get_option('be_blog_show_tags') != 'no'){
							$output .= '
								<p> <b>Blog Tags: </b>';
										if($element->tags != ''){
											$tags = explode(',',$element->tags);
											foreach($tags as $tag){
												$output .= '
													<a class="label label-colors label-md" href="'.base_url('blog/search/'.$tag).'" ><i class="fa fa-tags"></i> '.str_replace('_',' ',$tag).'</a> ';
											}
										}else{
											$output .= '-';
										}
							$output .= '
							   <div class="clearfix"></div>
							</p>
						</li>';
						}
				$output .= '<div class="divider"></div>';
					$comments_alowed = 'no';foreach( $post->stored as $key => $val ){ if( $key == 'comments_allowed' && $val == 'yes'){ $comments_alowed = 'yes';}}
					// if($comments_alowed == 'yes' && $BuilderEngine->get_option('be_blog_allow_comments') != 'no'){
					//     $output .= '
					//         <div id="comments">
					//             <h4>'.$count.' '.$pluralizer.'</h4>';
					//             $i = 1;
					//             foreach($comments as $comment){
					//                 $output .= '
					//                     <div class="comment">
					//                         <span class="user-avatar">';
					//                         if($comment->user_id == 0 || $comment->user_id == ''){
					//                             $output .= '<img class="pull-left media-object" src="'.get_theme_path().'/images/avatars/no_avatar.jpg" width="64" height="64" alt="">';
					//                         }else{
					//                             $commenter = new User($comment->user_id);
					//                             $allow_avatar = new Setting();
					//                             if(isset($allow_avatar->get_user_settings($comment->user_id)->all[0]->allow_avatar) && $allow_avatar->get_user_settings($comment->user_id)->all[0]->allow_avatar != 0)
					//                                 $allow_avatar = 1;
					//                             else
					//                                 $allow_avatar = 0;
					//                             if((!isset($commenter->avatar) || $commenter->avatar == '') || !intval($allow_avatar)){
					//                                 $output .= '<img class="pull-left media-object" src="'.get_theme_path().'/images/avatars/no_avatar.jpg" width="64" height="64" alt="">';
					//                             }else{
					//                                 $output .= '<img class="pull-left media-object" src="'.base_url().''.$commenter->avatar.'" width="64" height="64" alt="">';
					//                             }
					//                         }
					//                 $output .= '
					//                     </span>

					//                     <div class="media-body">
					//                         <h3 class="media-heading bold">'.$comment->name.'</h3>
					//                         <small class="block">'.date('d.M.Y - h:i',$comment->time_created).'</small>
					//                         <br/>
					//                         '.$comment->text.'
					//                     </div>

					//                     <div class="btn-group pull-right" role="group">
					//                         <a href="#commentForm" data-toggle="modal" data-target="#report'.$i.'" class="btn btn-danger blogPostBtn">Report</a>';
					//                         if($users->is_admin()){
					//                             $output .= '<a href="javascript:;" data-id="'.$comment->id.'" class="btn btn-danger blogPostBtn delete-comment">Delete</a>';
					//                         }
					//                 $output .= '
					//                     </div>
					//                     <!-- Modal -->
					//                     <div class="modal fade" id="report'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					//                         <div class="modal-dialog" style="z-index:10">
					//                             <div class="modal-content">
					//                                 <div class="modal-header">
					//                                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					//                                     <h4 class="modal-title" id="myModalLabel">Report Comment</h4>
					//                                 </div>
					//                                 <form method="get" action="'.base_url('blog/report_comment').'">
					//                                     <div class="modal-body">
					//                                         <input type="hidden" name="comment_id" value="'.$comment->id.'">
					//                                         <p>Please describe what aspect of this comment or it`s author you find inadequate, inappropriate or insulting</p>
					//                                         <div class="form-group">
					//                                             <textarea class="form-control" name="text" placeholder="Describe your reason for reporting this comment"></textarea>
					//                                         </div>
					//                                     </div>
					//                                     <div class="modal-footer">
					//                                         <button type="button" class="btn btn-default blogPostBtn" data-dismiss="modal">Close</button>
					//                                         <button type="submit" class="btn btn-primary blogPostBtn">Report</button>
					//                                     </div>
					//                                 </form>
					//                             </div>
					//                         </div>
					//                     </div>
					//                 </div>';
					//                 $i++;
					//             }
					//             if($BuilderEngine->get_option('be_blog_comments_private') == 'private'){
					//                 if(!($CI->session->userdata('user_id') == 0)){
					//                     $output .= '
					//                         <br/>
					//                         <div class="divider"></div>
					//                         <h4>Leave a comment</h4>
					//                         <form id="commentForm" action="'.base_url().'blog/post/'.$post->slug.'" class="form-horizontal" method="post">
					//                             <input type="hidden" name="post_id" value="'.$post->id.'">
					//                             <div class="row">
					//                                 <div class="col-md-12">
					//                                     <textarea required class="form-control input-lg" id="comment" name="text" rows="5" placeholder="Your Comment">'.$CI->form_validation->set_value('text').'</textarea>
					//                                     '.form_error('text').'
					//                                 </div>
					//                             </div>
					//                             <br>';
					//                             $check_captcha = $BuilderEngine->get_option('be_blog_captcha') == 'yes';
					//                             if($check_captcha){
					//                                 $output .= '
					//                                     <div class="row">
					//                                         <div class="col-md-2">
					//                                             <label>Captcha *</label>
					//                                         </div>
					//                                         <div class="col-md-3">
					//                                             <input required class="form-control input-lg" type="text" name="captcha" id="captcha" />
					//                                         </div>
					//                                         <div class="col-md-4">
					//                                             '.$this->createCaptcha().'
					//                                         </div>
					//                                         <div class="clearfix"></div>
					//                                         '.form_error('captcha').'
					//                                     </div>';
					//                             }
					//                         $output .= '
					//                             <div class="row">
					//                                 <div class="col-md-12">
					//                                     <p><button class="btn btn-primary blogPostBtn">Post Comment</button></p>
					//                                 </div>
					//                             </div>
					//                         </form>';
					//                 }
					//             }else{
					//                 $output .= '
					//                 <br/>
					//                 <div class="divider"></div>
					//                 <h4>Leave a comment</h4>
					//                 <form id="commentForm" class="form-horizontal" method="post">
					//                     <div class="row">
					//                         <input type="hidden" name="post_id" value="'.$post->id.'">';
					//                         if($CI->session->userdata('user_id') == 0){
					//                             $output .= '
					//                                 <div class="col-md-4">
					//                                     <label>Name *</label>
					//                                     <input required class="form-control input-lg" type="text" name="name" id="author" value="'.$CI->form_validation->set_value('name').'" />
					//                                     '.form_error('name').'
					//                                 </div>';
					//                         }
					//                 $output .= '
					//                     </div>
					//                     <div class="row">
					//                         <div class="col-md-12">
					//                             <textarea required class="form-control input-lg" id="comment" name="text" rows="5" placeholder="Your Comment">'.$CI->form_validation->set_value('text').'</textarea>
					//                             '.form_error('text').'
					//                         </div>
					//                     </div>
					//                     <br>';
					//                     $check_captcha = $BuilderEngine->get_option('be_blog_captcha') == 'yes';
					//                     if($check_captcha){
					//                         $output .= '
					//                             <div class="row">
					//                                 <div class="col-md-2">
					//                                     <label>Captcha *</label>
					//                                 </div>
					//                                 <div class="col-md-3">
					//                                     <input required class="form-control input-lg" type="text" name="captcha" id="captcha" />
					//                                 </div>
					//                                 <div class="col-md-4">
					//                                     '.$this->createCaptcha().'
					//                                 </div>
					//                                 <div class="clearfix"></div>
					//                                 '.form_error('captcha').'
					//                             </div>';
					//                     }
					//                 $output .= '
					//                     <div class="row">
					//                         <div class="col-md-12">
					//                             <p><button class="btn btn-primary">Post Comment</button></p>
					//                         </div>
					//                     </div>
					//                 </form>';
					//             }
					//     $output .= '</div>';
					// }
				$output .= '</div>';
				if($users->is_admin()){
					$output .= '
						<div class="modal fade" id="delete-comment" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog" style="z-index:10">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete comment</h4>
									</div>
									<form method="post" action="'.base_url('blog/deleteComment').'">
										<div class="modal-body">
											<p>Are you sure you want to delete this comment?</p>
											<input type="hidden" name="comment_id">
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default blogPostBtn" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary blogPostBtn">Delete</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					';
				}
				$output .='</div>';
			}
			if($this->block->has_class_css('header-section') == 1 || $this->block->has_class_css('footer-section') == 1)
				$menu ='with_settings_global';
			else
				$menu ='with_settings';
			if((isset($_SESSION['editoR']) && $_SESSION['editoR']))
				return $output.$CI->layout_system->load_new_block_scripts($this->block->get_id(), 'blog_post-container-'.$this->block->get_id(), $CI->BuilderEngine->get_page_path(), $single_element, $this->block->get_name(), $menu);
			else
				return $output;
        }
    }
?>