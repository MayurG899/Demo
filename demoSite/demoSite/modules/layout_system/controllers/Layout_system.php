<?php
/***********************************************************
* BuilderEngine Community Edition v1.0.0
* ---------------------------------
* BuilderEngine CMS Platform - BuilderEngine Limited
* Copyright BuilderEngine Limited 2012-2017. All Rights Reserved.
*
* http://www.builderengine.com
* Email: info@builderengine.com
* Time: 2017-01-17 | File version: 1.0.0
*
***********************************************************/
	class Layout_system extends Module_Controller {
		public function index()
		{
			echo "Layout_system::index()";
		}
		public function test()
		{
			echo "Yep working wtf";
		}
		public function query1($string)
		{
			echo "Layout_system::query()"; 
		}

		public function editor_nav()
		{
			$this->show->disable_full_wrapper();

			$data['page_path'] = $_REQUEST['page_path'];
			$this->BuilderEngine->set_page_path($data['page_path']);
			$this->load->view('editor_nav');
		}
		public function erase_all_blocks()
		{
			deleteDirectoryFiles($_SERVER['DOCUMENT_ROOT'].'/builderengine/third_party/Smarty-3.1.8/templates_c');
			$this->db->query('truncate be_blocks');
			$this->db->query('truncate be_block_relations');
			$this->db->query('truncate be_page_versions');
			redirect(base_url('/'), 'location');
		}
		public function erase_page_blocks()
		{
			deleteDirectoryFiles($_SERVER['DOCUMENT_ROOT'].'/builderengine/third_party/Smarty-3.1.8/templates_c');
			$page_path = $_GET['page_path'];
			$this->db->where('path', $page_path);
			$this->db->delete('be_page_versions');
			//redirect(base_url('/'), 'location');  

		}
        // edit for blocks 2.0
        public function load_section_script($block_id, $page_path, $section_type, $block_name, $global_menu = null)
        {
			$data['section_type'] = $section_type;
			if($global_menu)
				$data['quick_menu'] = $this->get_quick_menu('add_block_global', $block_id, $block_name);
			else
				$data['quick_menu'] = $this->get_quick_menu('add_block', $block_id, $block_name);
			$data['block_id'] = $block_id;
			$data['page_path'] = $page_path;
			$data['block_name'] = $block_name;

            return $this->load->view('section_script', $data, true);
        }
        public function load_new_block_scripts($block_id, $html_parent_element, $page_path, $new_element_html, $block_name = 'unavailable', $quick_menu_type = 'style', $output = array())
        {
            $this->BuilderEngine->set_page_path($page_path);
            $block = new Block('custom-block-'.$block_id);
            $block->load();
            $content = $block->data('content');
            if(is_array($content) && !empty($content))
            {
                end($content);
                $data['last_key'] = key($content);
            }
            else
                $data['last_key'] = 0;

            $data['block_id'] = $block_id;
			if (strpos($html_parent_element, 'generic-block') !== false) {
				$data['html_parent_element'] = '.'.$html_parent_element;
			}
			else if (strpos($html_parent_element, 'ordered-list') !== false) {
				$data['html_parent_element'] = '#'.$html_parent_element;
			}
			else if (strpos($html_parent_element, 'unordered-list') !== false) {
				$data['html_parent_element'] = '#'.$html_parent_element;
			}
			else
            	$data['html_parent_element'] = '#block-content-id-'.$block_name;
			$data['page_path'] = $page_path;
			$data['new_element_html'] = $new_element_html;
			$data['block_name'] = $block_name;
			$data['block_type'] = $block->type();
			$data['quick_menu'] = $this->get_quick_menu($quick_menu_type, $block_id, $block_name);
			if(empty($output))
				$output = array(
					'module' => '',
					'object' => ''
				);
			$data['output'] = $output;

			return $block_scripts = $this->load->view('new_block_scripts', $data, true);
        }

		public function get_quick_menu($type, $block_id, $block_name)
		{
			$data['type'] = $type;
			$data['block_id'] = $block_id;
			$data['block_name'] = $block_name;

			return trim(preg_replace('/\s+/', ' ', $this->load->view('quick_menu', $data, true)));
		}
	}

	function initialize_tutorial_js()
	{
		echo "
		<script>
			currentStep = 0;
			steps = '';
			tutorial = '';
			stepsNumber = 0;
			$(document).ready(function() {
				var tutorialInfo = $.ajax({
					type: 'POST',
					url: '".base_url('/layout_system/ajax/check_for_tutorials/')."',
					data: { page_path : '".$_SERVER['REQUEST_URI']."'},
					async: false
				}).responseText;
				if(tutorialInfo == 'false')
					return;
				tutorialInfo = JSON.parse(tutorialInfo);
				steps = tutorialInfo.steps;
				tutorial = tutorialInfo.tutorial;
				stepsNumber = getStepsNumber(steps);

				if(tutorial.display == 'always'){
					var firstStepInfo = getNextStepInfo(steps);
					var tutorialBox = getTutorialBox(firstStepInfo);
					$('body').append(tutorialBox);
				}
				else if(tutorial.display == 'first_load'){
					var tutorialCookie = getCookie(tutorial.name);
					if(tutorialCookie == null){
						var firstStepInfo = getNextStepInfo(steps);
						var tutorialBox = getTutorialBox(firstStepInfo);
						$('body').append(tutorialBox);
					}
					document.cookie = tutorial.name + '=true; expires=Fri, 31 Dec 9999 23:59:59 UTC';
				}
				else if(tutorial.display == 'discreet_notification'){
					createTutorialNotification('discreet');
				}
				else if(tutorial.display == 'important_notification'){
					createTutorialNotification('important');
				}

				$('body').on('click', '.tutorial-next-button', function(){
					var nextStepInfo = getNextStepInfo(steps);
					tutorialBox = getTutorialBox(nextStepInfo);
					$('body').append(tutorialBox);
					$(this).parent().parent().remove();
				});

				$('body').on('click', '.tutorial-cancel-button', function(){
					if(tutorial.cancel == 'yes'){
						$(this).parent().parent().remove();
					}
					else if(tutorial.cancel == 'confirm'){
						if(!confirm('This tutorial may provide useful information for one to use BuilderEngine\'s full potential. Are you sure you want to cancel it?')) return false;
						$(this).parent().parent().remove();
					}
					else if(tutorial.cancel == 'no'){
						return confirm('This tutorial provides necessary information for the effective use of BuilderEngine. To close it please go through all the steps.')
					}
				});

				$('body').on('click', '.fa-question-circle', function(){
					$(this).parent().css('height', '350px');
					$(this).parent().css('width', '350px');
					$(this).parent().find('.tutorial-title').css('display', 'block');
					$(this).parent().find('.message-container').css('display', 'block');
					$(this).parent().find('.btn-container').css('display', 'block');
					$(this).remove();
				});
				$('body').on('click', '.important-notification', function(){
					$(this).parent().css('height', '350px');
					$(this).parent().css('width', '350px');
					$(this).parent().find('.tutorial-title').css('display', 'block');
					$(this).parent().find('.message-container').css('display', 'block');
					$(this).parent().find('.btn-container').css('display', 'block');
					$(this).remove();
				});
			});
			function getStepsNumber(steps){
				var i = 1;
				for(var step in steps){
					i++;
				}
				return i - 1;
			}
			function createTutorialNotification(type){
				var notificationBox = '';
				if(type == 'discreet'){
					notificationBox = '<div id=\"tutorial-box\" style=\"top:0;left:0px;width:auto;height:auto\"><i class=\"fa fa-question-circle\" aria-hidden=\"true\"></i><span style=\"display:none;height:26%;font-size:26px\" class=\"tutorial-title\">' + tutorial.name + '</span><span style=\"display:none;height:41%\" class=\"message-container\">Tutorial available. To start it click on \"Begin\".</span><div style=\"display:none\" class=\"btn-container\"><a class=\"btn btn-danger tutorial-cancel-button\">Cancel</a><a class=\"btn btn-primary tutorial-next-button\">Begin</a></div></div>';
				}
				if(type == 'important'){
					notificationBox = '<div id=\"tutorial-box\" style=\"top:0;left:0px;width:auto;height:auto\"><div class=\"important-notification\"><span>Tutorial Available</span><i class=\"fa fa-question-circle\" aria-hidden=\"true\"></i></div><span style=\"display:none;height:26%;font-size:26px\" class=\"tutorial-title\">' + tutorial.name + '</span><span style=\"display:none;height:41%\" class=\"message-container\">Tutorial available. To start it click on \"Begin\".</span><div style=\"display:none\" class=\"btn-container\"><a class=\"btn btn-danger tutorial-cancel-button\">Cancel</a><a class=\"btn btn-primary tutorial-next-button\">Begin</a></div></div>';
				}
				$('body').append(notificationBox);
			}
			function getNextStepInfo(steps){
				var nextStepInfo = [];
				var i = 1;
				for(var step in steps){
					if(i == currentStep + 1){
						nextStepInfo['content'] = steps[step].content;
						nextStepInfo['position_type'] = steps[step].position_type;
						nextStepInfo['position'] = steps[step].position;
						nextStepInfo['highlighter'] = steps[step].highlighter;
					}
					i++;
				}
				currentStep += 1;
				return nextStepInfo;
			}
			function getTutorialBox(stepInfo){
				var tutorialBox = '';

				var rightButton = 'Next';
				if(currentStep == stepsNumber)
					rightButton = 'Finish';

				if(stepInfo['position_type'] == 'absolute'){
					var positioning = stepInfo['position'].split(',');
					tutorialBox = '<div id=\"tutorial-box\" style=\"top:' + positioning[0] + 'px;left:' + positioning[1] + 'px;\"><span class=\"tutorial-title\">' + tutorial.name + '</span><span class=\"message-container\">' + stepInfo['content'] + '</span><div class=\"btn-container\"><a class=\"btn btn-danger tutorial-cancel-button\">Cancel</a><a class=\"btn btn-primary tutorial-next-button\">' + rightButton + '</a></div></div>';
				}
				else if(stepInfo['position_type'] == 'window_border'){
					var windowWidth = $(window).width() - 350;
					var windowHeight = $(window).height() - 350;
					var halfWindowWidth = windowWidth / 2;
					var halfWindowHeight = windowHeight / 2;

					var positioning = [];
					if(stepInfo['position'] == 'top-left')
						positioning = ['0','0'];
					else if(stepInfo['position'] == 'top-right')
						positioning = ['0',windowWidth];
					else if(stepInfo['position'] == 'bottom-left')
						positioning = [windowHeight,'0'];
					else if(stepInfo['position'] == 'bottom-right')
						positioning = [windowHeight,windowWidth];
					else if(stepInfo['position'] == 'top-center')
					positioning = ['0',halfWindowWidth];
					else if(stepInfo['position'] == 'right-center')
					positioning = [halfWindowHeight,windowWidth];
					else if(stepInfo['position'] == 'bottom-center')
					positioning = [windowHeight,halfWindowWidth];
					else if(stepInfo['position'] == 'left-center')
					positioning = [halfWindowHeight,'0'];

					tutorialBox = '<div id=\"tutorial-box\" style=\"top:' + positioning[0] + 'px;left:' + positioning[1] + 'px;\"><span class=\"tutorial-title\">' + tutorial.name + '</span><span class=\"message-container\">' + stepInfo['content'] + '</span><div class=\"btn-container\"><a class=\"btn btn-danger tutorial-cancel-button\">Cancel</a><a class=\"btn btn-primary tutorial-next-button\">' + rightButton + '</a></div></div>';
				}
				return tutorialBox;
			}
			function getCookie(name) {
				var dc = document.cookie;
				var prefix = name + \"=\";
				var begin = dc.indexOf(\"; \" + prefix);
				if (begin == -1) {
					begin = dc.indexOf(prefix);
					if (begin != 0) return null;
				}
				else
				{
					begin += 2;
					var end = document.cookie.indexOf(\";\", begin);
					if (end == -1) {
						end = dc.length;
					}
				}
				return unescape(dc.substring(begin + prefix.length, end));
			}
		</script>
		";
	}
	//if(isset($_SESSION['editoR']))
	//add_action("be_foot", "initialize_tutorial_js");

?>