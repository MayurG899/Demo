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

/* 
 * TODO: Major cleanup and optimization
 */
global $BuilderEngine;
$BuilderEngine = null;
    class BuilderEngine extends CI_Model {
        private $options = array();   
        private $global_blocks = false;
        private $user;
        private static $page_path = false;
        private static $is_editor_active = false;
        function set_blocks_global($bool)
        {
            $this->global_blocks = $bool;
        }
        function is_public_version()
        {
            return $this->config->item("public_version") == true;
        }
        function get_blocks_global() { return $this->global_blocks; }
        function __construct()
        {
            parent::__construct(); 
            $this->load_settings();
//            $this->remove_old_uploaded_files();
            global $active_show;
            $this->user = &$active_show->controller->user;

            global $BuilderEngine;
            if($BuilderEngine == null){
                $BuilderEngine = $this;
            }
        }
        public function get_templating_engine()
        {
            if($this->config->item("templating_engine") == "smarty")
                return "smarty";
            else
                return "legacy";
        }
        public function is_editor_active()
        {
            return self::$is_editor_active;
        }
        public function set_editor_active()
        {
            self::$is_editor_active = true;
        }
        public function set_page_path($page_path)
        {
            self::$page_path = $page_path;
            $this->versions->load_page_blocks();
        }
        public function get_page_path()
        {
            if(!self::$page_path)
                return "{error:no_path_specified}";
            return self::$page_path;
            $path = "";
            $i = 1;
            if($this->uri->rsegments[1] == "module_manager")
            {
                $path = "module/";
                $i += 2;
            }

            for($i; $i <= count($this->uri->rsegments); $i++)
            {
                $path .= $this->uri->rsegments[$i]."/";
            }
            $path = trim($path, "/");
            return $path;
        }

        function load_settings()
        {    
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;
            $result = $this->db->get("options");
            $result = $result->result();
            foreach ($result as $option)
            {
                $this->options[$option->name] = $option->value;
            }
              
        }

        //Alias for handle_head() for backwards compatibility
        function integrate_builderengine_styles()
        {
            $this->handle_head();
        }
        function integrate_builderengine_js($options = array())
        {
            $this->handle_foot($options);
        }
        function generate_script_url($path)
        {
            return "<script src=\"".home_url($path)."\"></script>";
        }
        function include_script($path)
        {
            echo $this->generate_script_url($path);
        }
        function handle_head()
        {
            echo "
                <script type=\"text/javascript\">
                    site_root = \"".home_url('')."\";
                    theme_root = \"".get_theme_path()."\";
                </script>
            ";
            EventManager::fire('be_head');
            $this->_integrate_builderengine_styles();
        }
        function handle_foot($options = array())
        {
            $this->_integrate_builderengine_js($options);
            EventManager::fire('be_foot');
            echo "<script>";
            EventManager::fire('be_enqueue_scripts');
            echo "</script>";
        }
        function _integrate_builderengine_styles()
        {?>
            <script src="<?php echo home_url("/builderengine/public/js/jquery.js")?>"></script>
			<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
            <link rel='stylesheet' href="<?=base_url('/builderengine/public/css/font-awesome.min.css')?>" type='text/css' media='all' />
            <link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/editor/css/main.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/editor/css/be_styles.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/ecommerce/assets/css/ecommerce_styles.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/audioplayer/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/booking_events/assets/css/events_style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/booking_rooms/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/classifieds/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/forum/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/photogallery/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/modules/videotube/assets/css/style.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/animations/css/animate.min.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/lightbox.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/lity.css")?>" />
			<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/mediaplayer/build/mediaelementplayer.css")?>" />

            <?php 
            if(is_installed()):?>
            <?php

            $block = new Block('be_body_styler_'.$this->BuilderEngine->get_option('active_frontend_theme'));
            $block->set_global(true);
            if(!$block->load())
                $block->save();
            ?>
            
            <style>
            body
            {
                <?=$block->build_style(true)?>
            }
            <?php endif;?>
            </style>

        <?php
        }
        
        function _integrate_builderengine_js($options = array())
        {
            global $active_show;
            $user = $active_show->controller->user;
            ?>

            <script src="<?php echo home_url("/builderengine/public/js/jquery-ui.min.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/js/editor/ckeditor.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/js/angular.min.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/js/xeditable.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/js/absolute-json.js")?>"></script>
			<script src="<?php echo home_url("/builderengine/public/js/lightbox.js")?>"></script>
			<script src="<?php echo home_url("/builderengine/public/js/lity.js")?>"></script>
			<script src="<?php echo home_url("/builderengine/public/js/custom.js")?>"></script>

            
            <script type="text/javascript">
                var page_path = "<?=get_page_path()?>";
                var theme_path = "<?=get_theme_path()?>";
                var blocks_for_reload = {};
                var disable_auto_block_reload = false;
                var getting_block = false;

                var has_focus = true;
                var var_editor_mode = "";

            </script>


            <script type="text/javascript">

                $(document).ready(function(){
                    if(window.parent.page_url_change)
                    window.parent.page_url_change(page_path);
                    jQuery(document).bind('editor_mode_change',  function (event, action){
                        if(action == "editModeEnable")
                            var_editor_mode = "edit";
                        if(action == "blockStyleModeEnable")
                            var_editor_mode = "style";

                        console.log('Received event '+action);
                        if(action == "blockStyleModeEnable" || action == "editModeEnable" || action == 'resizeModeEnable' || action == 'moveModeEnable' || action == 'addBlockModeEnable' || action == 'deleteBlockModeEnable')
                        {
                            disable_auto_block_reload = true;
                        }

                        if(action == "blockStyleModeDisable" || action == "editModeDisable" || action == 'resizeModeDisable' || action == 'moveModeDisable' || action == 'addBlockModeDisable' || action == 'deleteBlockModeDisable')
                        {
                            var_editor_mode = "";
                            disable_auto_block_reload = false;
                        }
                    });
                    <?php  $copied_block = $user->get_session_data("copied_block");
                    if($copied_block):?>
                        $("#paste-block-button").parent().removeClass("disabled");
                    <?php endif;?>  


                    $("#editor-holder").css('display','none');
                    <?php if($user->is_member_of("Administrators") || $user->is_member_of("Frontend Editor") || $user->is_member_of("Frontend Manager")): ?>
                    //$("body").css("padding-top", "45px");

                   
                    <?php endif; ?>
                    //$("html").attr('ng-app','');
                    //$.getScript("/builderengine/public/js/angular128.min.js");
                });
            </script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/remove_block.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/undo_block.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/resize.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/admin.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/main.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/editor/js/edit_off_sorts.js")?>"></script>
            <script src="<?php echo home_url("/builderengine/public/js/frontend-editor.js")?>"></script>
            <?/*<script src="<?php echo home_url("/builderengine/public/js/bootstrap-wysihtml5.js")?>"></script> */?>
			<!--Start Module Specific JS-->
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/jquery-ui.min.js')?>"></script>
			<script src="<?=base_url('modules/cp/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js')?>"></script>
			<script src="<?=base_url('modules/cp/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker-new.js')?>"></script>
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/plugin/jquery.easing.js')?>"></script>
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/plugin/isotope.pkgd.min.js')?>"></script>
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/plugin/imagesloaded.pkgd.min.js')?>"></script>
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/theme.js')?>"></script>	
			<script src="<?=base_url('builderengine/public/mediamodules/common/js/plugin/upload/jquery.knob.js')?>"></script>
			<script src="<?=base_url('builderengine/public/mediaplayer/build/mediaelement-and-player.js')?>"></script>
			<script src="<?=base_url('builderengine/public/js/wow.min.js')?>"></script>
			<!--End Module Specific JS-->
            <?php
        }
        function get_option($name)
        {
            if (array_key_exists($name, $this->options) )
                return $this->options[$name];
            else
                return "";
        }
        function set_option($name, $value, $synch_db = true)
        {
            if($synch_db)
                if (array_key_exists($name, $this->options) )
                {
                    $this->db->where(array('name' => $name));
                    $this->db->update('options', array('value' => $value));
                }else{
                    $data = array(
                        'name' => $name,
                        'value' => $value
                    );
                    
                    $this->db->insert('options', $data);
                }
            $this->options[$name] = $value;
        }
        
        function get_frontend_theme()
        {
            return $this->get_option('active_frontend_theme');
        }
        function get_backend_theme()
        {
            return $this->get_option('active_backend_theme');
        }
        function get_user_backend_theme()
        {
            return $this->get_option('active_user_backend_theme');
        }
        
        function get_social_backend_theme()
        {
            return $this->get_option('active_social_backend_theme');
        }
        function activate_frontend_theme($theme)
        {
            $this->set_option("active_frontend_theme", $theme);
        }
        function activate_backend_theme($theme)
        {
            $this->set_option("active_backend_theme", $theme);
        }

        function register_visit($page_path)
        {
            $data = array(
                "ip"        => $_SERVER['REMOTE_ADDR'],
                "page"      => $page_path,
				"user_agent"=> $this->get_user_agent(),
				"ua_version"=> $this->get_user_agent_version(),
				"os"        => $this->get_os(),
				"device"    => $this->get_device(),
				"referrer"  => $this->get_referrer(),
                "date"      => date("Y-m-d"),
                "timestamp" => time()
                );
            $this->db->insert("visits", $data);
        }

		function get_user_agent()
		{
			$this->load->library('user_agent');

			if($this->agent->is_robot())
				$agent = $this->agent->robot();
			elseif($this->agent->is_mobile())
				$agent = $this->agent->browser();
			elseif($this->agent->is_browser())
				$agent = $this->agent->browser();
			else
				$agent = 'Unidentified';
			return $agent;
		}

		function get_user_agent_version()
		{
			$this->load->library('user_agent');

			if($this->agent->is_browser())
				$version = $this->agent->version();
			else
				$version = 'Unidentified';
			return $version;
		}

		function get_device()
		{
			$this->load->library('user_agent');

			if($this->agent->is_robot())
				$device = 'robot';
			elseif($this->agent->is_mobile())
				$device = 'mobile';
			else
				$device = 'desktop';
			return $device;
		}

		function get_os()
		{
			$this->load->library('user_agent');
			return $this->agent->platform();
		}

		function get_referrer()
		{
			$this->load->library('user_agent');
			$referrer = NULL;
			if ($this->agent->is_referral())
				$referrer = $this->agent->referrer();
			return $referrer;
		}

        function get_all_user_agents(){
			$this->db->select('DISTINCT(user_agent)',FALSE);
            $query = $this->db->get("visits");
			$i = 1;
			$result = array();
			foreach($query->result() as $row){
				$this->db->where('user_agent',$row->user_agent);
				$q = $this->db->get('visits');
				$result[$i]['label'] = $row->user_agent;
				$result[$i]['data'] = $q->num_rows;
				$i++;
			}
            return $result;
        }

        function get_all_platforms(){
			$this->db->select('DISTINCT(os)',FALSE);
            $query = $this->db->get("visits");
			$i = 1;
			$result = array();
			foreach($query->result() as $row){
				$this->db->where('os',$row->os);
				$q = $this->db->get('visits');
				$result[$i]['label'] = $row->os;
				$result[$i]['data'] = $q->num_rows;
				$i++;
			}
            return $result;
        }

        function get_all_devices(){
			$this->db->select('DISTINCT(device)',FALSE);
            $query = $this->db->get("visits");
			$i = 1;
			$result = array();
			foreach($query->result() as $row){
				$this->db->where('device',$row->device);
				$q = $this->db->get('visits');
				$result[$i]['label'] = $row->device;
				$result[$i]['data'] = $q->num_rows;
				$i++;
			}
            return $result;
        }

        function get_all_referrers(){
			$this->db->select('DISTINCT(referrer)',FALSE);
            $query = $this->db->get("visits");
			$i = 1;
			$result = array();
			foreach($query->result() as $row){
				$this->db->where('referrer',$row->referrer);
				$q = $this->db->get('visits');
				$result[$i]['label'] = $row->referrer;
				$result[$i]['data'] = $q->num_rows;
				$i++;
			}
            return $result;
        }

        function get_online_site_visitors($seconds = 300)
        {
            $this->db->select("COUNT(DISTINCT ip) as visitors");
            $time = time() - $seconds;
            $this->db->where("`timestamp` >= '$time'");
            $query = $this->db->get("visits");
            $result = $query->result();
            return $result[0]->visitors;
        }
        function get_total_site_visits($from, $to, $type)
        {
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;

            switch($type)
            {
                case "all":
                    $this->db->select("count(*) as count");

                    $this->db->where("timestamp > $from");
                    $this->db->where("timestamp < $to");

                    $query = $this->db->get("visits");
                    $result = $query->result();
                    return intval($result[0]->count);
                    break;

                case "unique":
                    $this->db->select("count(DISTINCT `ip`) as count");

                    $this->db->where("timestamp > $from");
                    $this->db->where("timestamp < $to");
                    //$this->db->group_by("date");

                    $query = $this->db->get("visits");
                    $result = $query->result();
                    return intval($result[0]->count);
                    break;
            }
        }

        function get_site_visits($type, $days, $single_day = false)
        {
            global $active_show;

            if(!$active_show->controller->is_installed())
                return;
            
            $distinct = false;
            switch($type){
                case "unique":
                    $distinct = true;

                case "all":
                for($i = 0; $i < $days; $i++)
                {
                    $visits[$i] = 0;
                    if($single_day)
                        break;
                }

                for($i = 0; $i < $days; $i++){
                    $date = date("Y-m-d",mktime(0,0,0,date("m"),date("d") - $i));
   
                    if($distinct)
                        $this->db->select("COUNT(DISTINCT `ip`) as visits");
                    else
                        $this->db->select("COUNT(*) as visits");
                    if(true)
                        $this->db->where("date = '$date'");   
                    else
                        $this->db->where("date >= '$date'");
                    $this->db->order_by("date DESC");
                    
                    $query = $this->db->get("visits");
                    $result = $query->result();
                    $visits[$i] = $result[0]->visits;                     
                }
                if(count($visits) == 1)
                    return $visits[0];
                else
                    return $visits;
                break;
            }
        }

         function getuserscount($today = NULL){
            $this->db->select("count(DISTINCT `ip`) as count");
             if($today) {
                 $date = date("Y-m-d");
                 $this->db->where("date = '$date'");
             }
            $query = $this->db->get("visits");
            $result = $query->result();
            return intval($result[0]->count);
        }

        function getVisitsByIp($ip){
            $this->db->select("count(`ip`) as count");
            $this->db->where("ip = '$ip'");
            $query = $this->db->get("visits");
            $result = $query->result();
            return $result[0]->count;
        }

    function getcountries(){
        $this->db->select("*");
        $query = $this->db->select('count(ip) count');
        $query = $this->db->group_by('ip');
        $query = $this->db->order_by('count DESC');
        $query = $this->db->limit(10);
        $query = $this->db->get("visits");

        $result = $query->result();
        return $result;
    }

         function todayvisitorscount(){
            $date = date("Y-m-d");
            $this->db->select("count(*) as countVisits");
            $this->db->where("date = '$date'");
            $query = $this->db->get("visits");
            $result = $query->result();
            return $result[0]->countVisits;
        }

        function lastweekvisitorscount(){
            $previous_week = strtotime("-1 week +1 day");
            $start_week = strtotime("last sunday midnight",$previous_week);
            $end_week = strtotime("next saturday",$start_week);
            $start_week = date("Y-m-d",$start_week);
            $end_week = date("Y-m-d",$end_week);
            $datelastweek = $start_week;
            $date = $datelastweek;
            $this->db->select("count(*) as countVisits");
            $this->db->where("date = '$date'");
            $query = $this->db->get("visits");
            $result = $query->result();
            return $result[0]->countVisits;
        }

        function getBlogCount()
        {
            return $this->db->count_all_results('blog_posts');
        }

        function getBlogCommentsCount(){
            return $this->db->count_all_results('blog_comments');
        }

        function getTotalEcommerceOrdersCount(){
			$module = 'ecommerce';
            $this->db->select("count(*) as countOrders");
            $this->db->where("module = '$module'");
            $query = $this->db->get("builderpayment_orders");
            $result = $query->result();
            return $result[0]->countOrders;
        }
		
        function getTodayEcommerceOrdersCount(){		
			$today = date("Y-m-d");
			$module = 'ecommerce';
            $this->db->where("module = '$module'");
            $query = $this->db->get("builderpayment_orders");
			$orders = array();
			foreach($query->result() as $row){
				$time_created = date("Y-m-d",$row->time_created);
				if($today == $time_created){
					array_push($orders,$row->id);
				}
			}
			$count = count($orders);
            return $count;
        }

        function getTotalEcommerceRevenue(){
			$this->db->select_sum('gross');
            $query = $this->db->get("builderpayment_orders");
            $result = $query->result();
			if(empty($result[0]->gross))
				return '0.00';
			else
				return number_format($result[0]->gross,2);
        }

        function getTodayEcommerceRevenue(){
			$today = date("Y-m-d");
			$module = 'ecommerce';
            $this->db->where("module = '$module'");
            $query = $this->db->get("builderpayment_orders");
			$orders_gross = 0;
			foreach($query->result() as $row){
				$time_created = date("Y-m-d",$row->time_created);
				if($today == $time_created){
					$orders_gross += $row->gross;
				}
			}
			return number_format($orders_gross,2);
        }
		
		public function getTotalUsersCount()
		{
			$allUsers = new User();
			$allUsers = $allUsers->where('verified','yes')->count();
			return $allUsers;
		}
    }
?>