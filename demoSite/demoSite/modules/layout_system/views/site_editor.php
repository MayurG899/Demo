<?php /***********************************************************
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

function endswith($string, $test) {
    $strlen = strlen($string);
    $testlen = strlen($test);
    if ($testlen > $strlen) return false;
    return substr_compare($string, $test, -$testlen) === 0;
}


?>
<script src="<?php echo home_url("/builderengine/public/js/jquery.js")?>"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js" ></script>

<?php
/*<script type="text/javascript" src="<?php echo home_url("/themes/dashboard/js/plugins/tables/datatables/jquery.dataTables.min.js")?>"></script><!-- Init plugins only for page -->
<link href="<?php echo home_url("/themes/dashboard/css/icons.css")?>" rel="stylesheet" />*/?>
<link rel="stylesheet" media="screen" type="text/css" href="<?php echo home_url("/builderengine/public/js/editor/custom.css")?>" />
<link href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" rel="stylesheet" />
<link href="https://vitalets.github.io/angular-xeditable/dist/css/xeditable.css" rel="stylesheet" />

<link href="<?php echo home_url("/builderengine/public/css/block-editor.css")?>" rel="stylesheet" />
<link href="<?php echo home_url("/builderengine/public/css/fix.css")?>" rel="stylesheet" />
<link href="<?php echo home_url("/builderengine/public/css/bootstrap-switch.min.css")?>" rel="stylesheet" />

<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/normalize.css")?>" />
<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/demo.css")?>" />
<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/icons.css")?>" />
<link rel="stylesheet" type="text/css" href="<?php echo home_url("/builderengine/public/css/component.css")?>" />

<link rel='stylesheet' id='font-awesome-4-css'  href='<?php echo home_url("/builderengine/public/css/font-awesome.min.css")?>' type='text/css' media='all' />
    <link href="<?php echo home_url("/builderengine/public/jquery-ui/css/smoothness/jquery-ui-1.10.4.custom.css")?>" rel="stylesheet" />
<script src="<?php echo home_url("/builderengine/public/jquery-ui/js/jquery-ui-1.10.4.custom.js")?>"></script>

<script type="text/javascript" src="<?php echo home_url("/builderengine/public/js/versions-management.js")?>"></script>
<script type="text/javascript" src="<?php echo home_url("/builderengine/public/js/bootstrap-switch.min.js")?>"></script>

<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">


<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic" rel="stylesheet" type="text/css" />
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/plugins/bootstrap/css/bootstrap.min.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/plugins/font-awesome/css/font-awesome.min.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/css/animate.min.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/css/components.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/css/style.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/css/style-responsive.css")?>" rel="stylesheet" />
	<link href="<?php echo home_url("/builderengine/public/editor/frontend_assets/css/theme/default.css")?>" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="<?php echo home_url("/builderengine/public/editor/frontend_assets/plugins/pace/pace.min.js")?>"></script>
	<!-- ================== END BASE JS ================== -->

<style>
body {
  margin: 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.scroller{
    overflow-y:hidden !important;
}
.dl-menuwrapper a:hover {
    text-decoration: none !important;
}
.dl-menuwrapper ul
{
    margin-left: 0px !important;
}
</style>
<script>
var page_path = '<?=$BuilderEngine->get_page_path()?>';
var base_path = "<?=$this->config->base_url();?>";
var site_root = "<?=$this->config->base_url();?>";

function page_url_change(new_url)
{

  $.get(site_root + "admin/ajax/keep_editor_active",{});

  page_path = new_url;
  $( "#publish-button" ).attr('page', page_path);
  $( "#publish-button" ).unbind( "click.publish");
  $( "#publish-button" ).html( "Loading...");

  $.post(site_root + "layout_system/ajax/is_page_pending_submission",
  {
      page_path:page_path,
  },
  function(data,status){
    if(data == 'true')
      initialize_publish_button();
    else if(data == 'false')
    {
      $( "#publish-button" ).html( " PAGE IS LIVE");
    }else
      alert('There was an error processing a system operation.\nPlease contact customer support.');

  });
}
function reload_block(block_name, page_path, forced)
{
  runFunction("reload_block", [block_name, page_path, forced]);
    
}
function get_undo_steps(){

	$.post(site_root + 'layout_system/ajax/get_undo_steps',
	{
		'page_path':encodeURIComponent(page_path)
	},
	function(data){
		if(data != 'false'){
			$('#undo').attr('undo-id',data);
			$('.undo-li').show('fast');

		}
	});

	$('#undo').on('click',function(e){
		e.preventDefault();
		$.post(site_root + 'layout_system/ajax/get_redo_steps',
		{
			'page_path':encodeURIComponent(page_path)
		},
		function(datas){
			if(datas != 'false'){
				$('#redo').attr('redo-id',datas);
				$('.redo-li').show('fast');

			}
		});

		var version_id = $(this).attr('undo-id');
		$.get(site_root + 'admin/ajax/version_activate/' + version_id, function(datap){
			$.post(site_root + 'layout_system/ajax/get_undo_steps',
				{
					'page_path':encodeURIComponent(page_path)
				},
				function(dataz){
					if(dataz != 'false'){
						$('#undo').attr('undo-id',dataz);
					}else{
						$('.undo-li').hide('fast');
					}
				}
			);
			$('#content-frame')[0].contentWindow.location.reload();
		});
	});
}
function get_redo_steps(){

	$.post(site_root + 'layout_system/ajax/get_redo_steps',
	{
		'page_path':encodeURIComponent(page_path)
	},
	function(data){
		if(data != 'false'){
			$('#redo').attr('redo-id',data);
			$('.redo-li').show('fast');

		}
	});

	$('#redo').on('click',function(e){
		e.preventDefault();
		$.post(site_root + 'layout_system/ajax/get_undo_steps',
		{
			'page_path':encodeURIComponent(page_path)
		},
		function(datas){
			if(datas != 'false'){
				$('#undo').attr('undo-id',datas);
				$('.undo-li').show('fast');

			}
		});

		var version_id = $(this).attr('redo-id');
		$.get(site_root + 'admin/ajax/version_activate/' + version_id, function(datap){
			$.post(site_root + 'layout_system/ajax/get_redo_steps',
				{
					'page_path':encodeURIComponent(page_path)
				},
				function(dataz){
					if(dataz != 'false'){
						$('#redo').attr('redo-id',dataz);
					}else{
						$('.redo-li').hide('fast');
					}
				}
			);
			$('#content-frame')[0].contentWindow.location.reload();
		});
	});
	/*
	$.post(site_root + 'layout_system/ajax/get_undo_steps',
	{
		'page_path':encodeURIComponent(page_path)
	},
	function(data){
		//data = jQuery.parseJSON(data);
		if(data){
			$('#undo').attr('undo-id',data);
			$('.undo-li, .redo-li').show('fast');
			$('#undo').on('click',function(e){
				e.preventDefault();
				console.log(data);
				$('.undo-li, .redo-li').hide('fast');
				$.get(site_root+'admin/ajax/version_activate/' + data, function(data){
					$('#content-frame')[0].contentWindow.location.reload();
				});
				//console.log('block_name:'+data.block_name + 'version:' +data.version);
				
				$.post(site_root + 'layout_system/ajax/revert/' + data.block_name,{pending_version: data.version}, function(data){
					$('.undo-li, .redo-li').hide('fast');
					runFunction('editv3ModeDisable', ['']);
					runFunction('editModeDisable', ['']);
					$('#editorlabelStatus').html('IN-ACTIVE');
					$('#editorStatusLabel').removeClass('animated flash infinite');
					$('#simpleDesigner, #advancedDesigner').removeClass('active');
					$('#sd, #ad').removeClass('label-success').addClass('label-danger').text('OFF');
					$('#content-frame')[0].contentWindow.location.reload();
					//location.reload();
				});
				
			});
		}
	});
	*/
}
function initialize_versions_manager_controls() {
   $(".layout-versions-button").click(function () {

		var parent_li = $(this).parent().parent().parent();
        $(parent_li).addClass("active");
        $(".layout-versions-button").parent().removeClass("active");

        $("#admin-window").remove();
        $( "body" ).append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );

        
        
        $.post(site_root + 'layout_system/ajax/versions_window/layout',
        {
            'page_path':encodeURIComponent(page_path)
        },
        function(data) {
            initialize_versions_manager(data);
            $("#admin-window").css("z-index", "999");
            $("#admin-window").css("width", "100%");
            /*
            width = parseInt($("#admin-window").css("width"));
            half_width = width/2;
            screen_width = $( window ).width();
            left = (screen_width/2) - half_width;


            left = Math.round(left)+"px";
            $("#admin-window").css("left", left);*/

            $("#versions-close").click(function (event) {
                $(parent_li).removeClass("active");
                event.preventDefault();
            });
        });
        

    });

    $(".page-versions-button").click(function (e) {

		var parent_li = $(this).parent().parent().parent();
        $(parent_li).addClass("active");
        $(".page-versions-button").parent().removeClass("active");

        $("#admin-window").remove();
        $( "body" ).append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );

        $.post(site_root + 'layout_system/ajax/versions_window/page',
        {
            'page_path':encodeURIComponent(page_path)
        },
        function(data) {
            $("#admin-window").html(data);
            $("#admin-window").css("z-index", "999");
            $("#admin-window").css("width", "100%");
            /*
            width = parseInt($("#admin-window").css("width"));
            half_width = width/2;
            screen_width = $( window ).width();
            left = (screen_width/2) - half_width;


            left = Math.round(left)+"px";
            $("#admin-window").css("left", left);*/

            $("#versions-close").click(function (event) {
                $(".block-editor").remove();    
                $(parent_li).removeClass("active");
                event.preventDefault();
            });
        });
        
        e.preventDefault();
    });
}
<?php if( isset($_GET['force-editor-mode'])):?>
function do_magic()
{
  $("[editor-mode-switch!='']").each(
        function ()
        {
          var attr = $(this).attr('editor-mode-switch');

          // For some browsers, `attr` is undefined; for others,
          // `attr` is false.  Check for both.
          if (typeof attr === 'undefined' || attr === false)
            return;

          if(attr == '<?=$_GET['force-editor-mode']?>')
          {

            current_editor_mode = editor_mode;
            if(editor_mode != "")
            {
              $(this).removeClass('active');
              mode = editor_mode + 'ModeDisable';
              runFunction('fire_event', ['editor_mode_change',mode]);
              while(window.frames[0].window.getting_block){}
              runFunction( editor_mode + 'ModeDisable', ['']);
              
              
              editor_mode = "";
            }
            if(current_editor_mode != attr)
            {
                $(this).addClass('active');
                mode = attr + 'ModeEnable';

                runFunction('fire_event', ['editor_mode_change', mode]);
                while(window.frames[0].window.getting_block){}

                if(mode == 'addBlockModeEnable')
                    runFunction( attr + 'ModeEnable', [$(this).attr('block-type')]);
                else
                    runFunction( attr + 'ModeEnable', ['']);
                    
              
              
              editor_mode = attr;
            }
          }
        }
        );
}
<?php endif;?>

$(document).ready(function (){
  $("#erase-page").click(function(e){
    e.preventDefault();
    if(!confirm('This will erase this page content and will revert it to its default one. Are you sure you want to do that?'))
      return;
    href = $(this).attr('href');
    page_path = $( "#publish-button" ).attr('page');
    $.get(href + "?page_path=" + page_path);
    
    setTimeout(function(){var iframe = document.getElementById("content-frame");iframe.src = iframe.src;}, 1000);
    
  });
});
$(window).ready(function (){
	<?php if( isset($_GET['force-editor-mode'])):?>
		$(window.frames[0].window).ready(function (){
			setTimeout("do_magic()", 1000);
		});
	<?php endif;?>

    initialize_versions_manager_controls();
    <?php if($versions->get_pending_page_version_id(get_page_path()) || $versions->get_pending_page_version_id("layout")):?>
    initialize_publish_button();
    <?php endif;?>
  $('#content-frame').load(function (){$(this).contents().find(".be-edit-btn").remove();});

  $('#content-frame').css("height",$(window).height() - 42);
  $( window ).resize(function() {
    $('#content-frame').css("height",$(window).height() -42 );
  });
  $('#content-frame').css("border","none");

  /*$.get("/layout_system/editor_nav?page_path="+page_path+"&iframed=true", function(data) {
    $( "#editor-nav" ).html(data);
    initialize_versions_manager_controls();
    if(!$("#publish-button").hasClass("disabled"))
          initialize_publish_button();
  });*/
     $("[editor-size-switch!='']").each(
    function ()
    {
      var attr = $(this).attr('editor-size-switch');
      // For some browsers, `attr` is undefined; for others,
      // `attr` is false.  Check for both.
      if (typeof attr === 'undefined' || attr === false) 
        return;

      $(this).click(function (event){
        $("[editor-size-switch!='']").each(
          function ()
          {
            var attr = $(this).attr('editor-size-switch');

            // For some browsers, `attr` is undefined; for others,
            // `attr` is false.  Check for both.
            if (typeof attr === 'undefined' || attr === false) 
              return;
            $(this).removeClass('active');
          });

          size_mode = attr;
          if(attr != 'lg'){
            disableEditMod();
          }

          $("body").css('background-color', '#666');
          $("body").css('text-align', 'center');
          $(".scroller-inner").css('text-align', 'left');

          $("#content-frame").css('margin-left', 'auto');
          $("#content-frame").css('margin-right', 'auto');
          $("#content-frame").css('width', $(this).attr('editor-size-pixels'));
          $(this).addClass('active');
        
        event.preventDefault();
      });
    }
  );

    $("[editor-mode-switch!='']").each(
    function ()
    {
      var attr = $(this).attr('editor-mode-switch');

      // For some browsers, `attr` is undefined; for others,
      // `attr` is false.  Check for both.
      if (typeof attr === 'undefined' || attr === false) 
        return;

      $(this).click(function (event){
        $("[editor-mode-switch!='']").each(
          function ()
          {
            var attr = $(this).attr('editor-mode-switch');

            // For some browsers, `attr` is undefined; for others,
            // `attr` is false.  Check for both.
            if (typeof attr === 'undefined' || attr === false) 
              return;
            $(this).removeClass('active');
          });
        current_editor_mode = editor_mode;
        if(editor_mode != "")
        {
          if(editor_mode != 'edit'){
            $(this).removeClass('active');
			$('#content-frame').contents().find('body').removeClass('simple-editor-enabled');
            mode = editor_mode + 'ModeDisable';
            runFunction('fire_event', ['editor_mode_change',mode]);
            while(window.frames[0].window.getting_block){}
            runFunction( editor_mode + 'ModeDisable', ['']);
          }else{
			$('#content-frame').contents().find('body').addClass('simple-editor-enabled');
            disableEditMod();
			runFunction('editv3ModeDisable', ['']);
          }

          editor_mode = "";
        }
        if(current_editor_mode != attr)
        {
            if(attr != 'edit'){
                $(this).addClass('active');
				$('#content-frame').contents().find('body').removeClass('simple-editor-enabled');
                mode = attr + 'ModeEnable';

                runFunction('fire_event', ['editor_mode_change', mode]);
                while(window.frames[0].window.getting_block){}

                if(mode == 'addBlockModeEnable')
                    runFunction( attr + 'ModeEnable', [$(this).attr('block-type')]);
                else
                    runFunction( attr + 'ModeEnable', ['']);
                editor_mode = attr;
            }else if(size_mode == 'lg'){
				runFunction( 'refresh_editor', ['']);
				$(this).addClass('active');
				$('#content-frame').contents().find('body').addClass('simple-editor-enabled');
				FreeModeOff();
				$('#freeMode').show();
				editor_mode = attr;
            }
          // editor_mode = attr;
        }
        
        event.preventDefault();
      });
    }
  );

  function disableEditMod()
  {
    $('#freeMode').hide();
	$('#content-frame').contents().find('body').removeClass('simple-editor-enabled');
    $("[editor-mode-switch='edit']").removeClass('active');
    $('#change-color-switch').bootstrapSwitch('state', false, true);
    $('#freeModeText').text('Free Move OFF');
    if(is_free_mode_off_initialized){
      runFunction( 'FreeModeDisableOff', ['']);
      is_free_mode_off_initialized = false;
    }
    if(is_free_mode_on_initialized){
      runFunction( 'FreeModeDisableOn', ['']);
      is_free_mode_on_initialized = false;
    }
  }

  function FreeModeOn()
  {
    is_free_mode_on_initialized = true;
    mode = 'editModeEnable';

    if(is_free_mode_off_initialized){
      runFunction( 'FreeModeDisableOff', ['']);
      is_free_mode_off_initialized = false;
    }
    runFunction( 'FreeModeEnableOn', ['']);
  }

  function FreeModeOff()
  {
    is_free_mode_off_initialized = true;
    mode = 'editModeDisable';

    if(is_free_mode_on_initialized){
      runFunction( 'FreeModeDisableOn', ['']);
      is_free_mode_on_initialized = false;
    }
    runFunction( 'FreeModeEnableOff', ['']);
  }

  $('#change-color-switch').on('switchChange.bootstrapSwitch', function(event, state) {
    if(size_mode == 'lg')
      if(state){
        $('#freeModeText').text('Free Move ON');
        FreeModeOn();
      }else{
        $('#freeModeText').text('Free Move OFF');
        FreeModeOff();
      }
  });
});
</script>

<script src="<?php echo home_url("/builderengine/public/js/angular.min.js")?>"></script>
<script type="text/javascript">
var editor_mode = "";
var size_mode = "lg";
var is_free_mode_on_initialized = false;
var is_free_mode_off_initialized = false;
function initialize_publish_button()
{
    $("#publish-button").removeClass("disabled");
    $("#publish-button").html(" PUBLISH PAGE");
	
    $( "#publish-button" ).bind( "click.publish",function (event) {
        $("#publish-button").html(" PUBLISHING...");
		$("#publish-button").css('background','orange');
		$('.undo-li, .redo-li').hide('fast');
        setTimeout("publish_button_action();", 1000);

        event.preventDefault();
    });
}
function publish_button_action()
{
    $.post(site_root + "layout_system/ajax/publish_version",
    {
        page:$("#publish-button").attr("page")
    },
    function(data,status){
        $("#publish-button").unbind( "click.publish");
        $("#publish-button").addClass("disabled");
        $("#publish-button").html(" PAGE IS LIVE");
		$("#publish-button").css('background','#458bad');
		get_undo_steps();
		get_redo_steps();
    });
}
function notifyChange()
{
    if($("#publish-button").hasClass("disabled"))
		initialize_publish_button();
}
function runFunction(name, arguments)
{

    if($('#content-frame').length > 0)
      $('#content-frame')[0].contentWindow["runFunction"](name,arguments);
}
  function stopEditor()
  {
    window.top.location.href = $('#content-frame').attr('src');
  }
  function MainCtrl($scope) {
    $scope.updateIframe = function() {

      document.getElementById('content-frame').contentWindow.updatedata($scope);
    };
    
  }

function showAdminWindowIframe(url)
{
    $("#admin-window").remove();
    $('body').append( "<div id='admin-window' style='position:fixed; top: 70px;'></div>" );

	$.get(site_root + 'layout_system/ajax/admin_popup',
	{
	  //'asd':'asd'
	},
	function(data) {
	  $("#admin-window").html(data);
	  $("#admin-window-content").html("<iframe src='" + url + "' style='width:100%; border:none;min-height:600px'></iframe>");
	  $("#admin-window").css("z-index", "999");
	  $("#admin-window").css("width", "100%");

	  /*width = parseInt($("#admin-window").css("width"));
	  half_width = width/2;
	  screen_width = $( window ).width();
	  left = (screen_width/2) - half_width;


	  left = Math.round(left)+"px";
	  $("#admin-window").css("left", left);*/

	  $("#popup-close").click(function (event) {
		  $(".block-editor").remove();    
		  event.preventDefault();
	  });
	  
	  //$('#content-frame')[0].contentWindow["runFunction"]("reload_angular",['']);

	});
}
function showAdminWindow(content)
{
  $("#admin-window").remove();
  $('body').append( "<div id='admin-window' style='position:fixed; top: 100px;'> </div>" );
  $.get(site_root + 'layout_system/ajax/admin_popup',
  {
      //'asd':'asd'
  },
  function(data) {
      $("#admin-window").html(data);
      $("#admin-window-content").html(content);
      $("#admin-window").css("z-index", "999");
      $("#admin-window").css("width", "100%");
      /*
      width = parseInt($("#admin-window").css("width"));
      half_width = width/2;
      screen_width = $( window ).width();
      left = (screen_width/2) - half_width;


      left = Math.round(left)+"px";
      $("#admin-window").css("left", left);*/

      $("#popup-close").click(function (event) {
          $(".block-editor").remove();    
          event.preventDefault();
      });
      
      //$('#content-frame')[0].contentWindow["runFunction"]("reload_angular",['']);

    });
}
</script>
<script src="<?=base_url('/builderengine/public/js/modernizr.custom.js')?>"></script>

<body ng:app ng:controller="MainCtrl">
   
<style>
body
{
  overflow-y:hidden;
  overflow-x:hidden;
}
.be-edit-btn{
	-webkit-background-clip: border-box;
	-webkit-background-origin: padding-box;
	-webkit-background-size: auto;
	background-attachment: scroll;
	background-clip: border-box;
	background-color: rgb(88, 95, 105);
	background-image: none;
	background-origin: padding-box;
	background-size: auto;
	border-bottom-left-radius: 0px;
	border-bottom-right-radius: 0px;
	border-top-left-radius: 0px;
	border-top-right-radius: 0px;
	color: rgb(255, 255, 255);
	cursor: pointer;
	display: block;
	font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
	font-size: 18px;
	font-style: italic;
	height: 28px;
	line-height: 28.799999237060547px;
	padding-bottom: 7px;
	padding-left: 9px;
	padding-right: 9px;
	padding-top: 7px;
	position: fixed;
	right: -105px;
	top: 37px;
	width: 135px;
	z-index: 555555;
}
#launch_editor {
	display:none;
}

.top-nav .active
{
	background: #3A80A1; /* Old browsers */
	background: -moz-linear-gradient(top, #3A80A1 0%, #2F6B88 100%); /* FF3.6+ */
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#3A80A1), color-stop(100%,#2F6B88)); /* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #3A80A1 0%,#2F6B88 100%); /* Chrome10+,Safari5.1+ */
	background: -o-linear-gradient(top, #3A80A1 0%,#2F6B88 100%); /* Opera 11.10+ */
	background: -ms-linear-gradient(top, #3A80A1 0%,#2F6B88 100%); /* IE10+ */
	background: linear-gradient(to bottom, #3A80A1 0%,#2F6B88 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3A80A1', endColorstr='#2F6B88',GradientType=0 ); /* IE6-9 */

}
</style>
<script>
	$(document).ready(function (){

		$('.be-edit-btn').hover(function () {
			$('.be-edit-btn').animate({right: '0px'}, 500);
		},
		function () {
			$('.be-edit-btn').animate({right: '-105px'}, 500);
		}
		);
	})
</script>
<form action='' method='post' id='launch_editor'>
	<input type="hidden" name='be_launch_editor'>
</form>
<!--<i class="be-edit-btn" id='trigger'>Edit This Page</i>-->
<?php     $params = array_merge($_GET, array("iframed" => "true"));
    $params = http_build_query($params);

    $url = strtok($url, '?');

    if(endswith($url, "/editor"))
        $url = str_replace("/editor", "", $url); 
    else
        $url = str_replace("/editor/", "/", $url);

?>
<!--<div id="editor-nav"></div>-->
<div class="containers">
	<!-- Push Wrapper -->
	<div class="mp-pusher" id="mp-pusher">
		<?require_once('site_editor_left_block_sidebar.php');?>
		<script>
			$(document).ready(function() {
				function pulsate() {
					$("#the-builderengine-logo").animate({ opacity: 0.8 }, 1500, 'linear').animate({ opacity: 1 }, 1500, 'linear', pulsate);
				}
				pulsate();
			});
		</script>
		<div class="scroller"><!-- this is for emulating position fixed of the nav -->
			<div class="scroller-inner">
				<!-- begin #top-menu -->
				<!-- begin #page-container -->
				<div id="page-container" class="page-container page-sidebar-minified fade page-sidebar-fixed page-header-fixed page-with-top-menu page-with-wide-sidebar page-with-two-sidebar page-right-sidebar-collapsed be-frontend">
					<?require_once('site_editor_top_bar.php');?>
					<?require_once('site_editor_right_sidebar.php');?>
					<?require_once('site_editor_theme_panel.php');?>
					<!-- begin #content -->
					<!-- end #content -->
				</div>
				<!-- end page container -->
            </div><!-- /scroller-inner -->
			<iframe id="content-frame" src="<?=$url?>?<?=$params?>" style="width:100%; border:none"></iframe>
		</div><!-- /scroller -->
	</div><!-- /pusher -->
</div><!-- /container -->
<div id="myModalDelete" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm delete-modal" role="document" style="border:2px solid red;">
		<div class="modal-content">
			<div class="modal-header" style="background:#aaa;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title text-center" id="gridSystemModalLabel">Delete Block</h4>
			</div>
			<div class="modal-body" style="background:#eee;">
				<div class="row">
					<h4 class="text-center">Are you sure?</h4>
				</div>
			</div>
			<div class="modal-footer" style="background:#aaa;">
				<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
				<button id="deleteMyBlock" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
			</div>
		</div>
	</div>
</div>
	<style>
	  .be-edit-btn{
		  -webkit-background-clip: border-box;
		  -webkit-background-origin: padding-box;
		  -webkit-background-size: auto;
		  background-attachment: scroll;
		  background-clip: border-box;
		  background-color: #2d353c;
		  background-image: none;
		  background-origin: padding-box;
		  background-size: auto;
		  border-bottom-left-radius: 0px;
		  border-bottom-right-radius: 0px;
		  border-top-left-radius: 0px;
		  border-top-right-radius: 0px;
		  color: rgb(255, 255, 255);
		  cursor: pointer;
		  display: block;
		  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
		  font-size: 18px;
		  font-style: italic;
		  height: 28px;
		  line-height: 28.799999237060547px;
		  padding-bottom: 7px;
		  padding-left: 9px;
		  padding-right: 9px;
		  padding-top: 7px;
		  position: fixed;
		  
		  height: 40px;
		  width: 135px;
		  z-index: 555555;
	  }

	  #page-styler
	  {
		  right: -80px;
		  top: 87px;
	  }
		.mp-level-open:not(.mp-level-overlay){
			overflow-y:auto;
		}
	  </style>
	<script>
		$(document).ready(function (){

			get_undo_steps();
			get_redo_steps();

			$('#change-color-switch').bootstrapSwitch();
			$('.bootstrap-switch.bootstrap-switch-wrapper.bootstrap-switch-id-change-color-switch').css({'height':'30px','border-radius': '20px'});
			$('#freeMode').hide();

		   /* $('#page-styler').hover(function () {
				$(this).animate({right: '0px'}, 500);
			},
			function () {
				$(this).animate({right: '-80px'}, 500);
			}
			);
			$('#page-styler').click( function (){
				showAdminWindowIframe('/layout_system/ajax/block_styler/be_body_styler_'+'<?=$this->BuilderEngine->get_option("active_frontend_theme")?>'+'?page_path=page/index');
			});*/
			$('.designerSwitch').click(function(){
				if($('#simpleDesigner').hasClass('active')){
					//keith - uncomment this line show rightsidebar// $('.contextual-menu').show();
					//$('.layout-blocks').hide();
					$('#pushMenuContent').removeClass('advanced').show();
					$('#sd').text('ON').removeClass('label-danger').addClass('label-success');
					$('#editorStatus').html('Simple');
					$('#editorlabelStatus').html('ACTIVE');
					$('#editorStatusLabel').addClass('animated flash infinite').css('animation-duration','1.5s');
					$('#content-frame').contents().find('.be-column-block').each(function(index){
						var child_container = $(this).find('.block-children');
						var child_element = $(child_container).find('div');
						if($(child_element).length == 0){
							//add class to the column with no child blocks in it:
							$(child_container).addClass('be-empty-column-fill');
						}
					});
				}else{
					$('#content-frame').contents().find('.be-column-block').each(function(index){
						var child_container = $(this).find('.block-children');
						var child_element = $(child_container).find('div');
						if($(child_element).length == 0){
							//remove class from the column with no child blocks in it:
							$(child_container).removeClass('be-empty-column-fill');
						}
					});
					$('#pushMenuContent').removeClass('advanced').hide();
					$('#sd').removeClass('label-success').addClass('label-danger').text('OFF');
				}
				if($('#advancedDesigner').hasClass('active')){
					//keith - uncomment this line show rightsidebar// $('.contextual-menu').show();
					$('.layout-blocks').show();
					$('#freeMode').show();
					$('#pushMenuContent').addClass('advanced').show();
					$('#ad').text('ON').removeClass('label-danger').addClass('label-success');
					$('#editorStatus').html('Standard');
					$('#editorlabelStatus').html('ACTIVE');
					$('#editorStatusLabel').addClass('animated flash infinite').css('animation-duration','1.5s');
				}else{
					$('#ad').removeClass('label-success').addClass('label-danger').text('OFF');
				}
				if(!$('#advancedDesigner').hasClass('active') && !$('#simpleDesigner').hasClass('active')){
					$('.contextual-menu').hide();
					$('#freeMode').hide();
					$('#pushMenuContent').removeClass('advanced').hide();
					$('#editorStatus').html('Page');
					$('#editorlabelStatus').html('IN-ACTIVE');
					$('#editorStatusLabel').removeClass('animated flash infinite');
				}
			});
		})
	</script>

	<!-- ================== BEGIN BASE JS ================== -->
	
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/jquery/jquery-migrate-1.1.0.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/bootstrap/js/bootstrap.min.js')?>"></script>
	<!--[if lt IE 9]>
		<script src="/builderengine/public/editor/frontend_assets/crossbrowserjs/html5shiv.js"></script>
		<script src="/builderengine/public/editor/frontend_assets/crossbrowserjs/respond.min.js"></script>
		<script src="/builderengine/public/editor/frontend_assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/jquery-cookie/jquery.cookie.js')?>"></script>
	<!-- ================== END BASE JS ================== -->
	
	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/switchery/switchery.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/jquery-tag-it/js/tag-it.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/js/custom.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/editor/frontend_assets/js/apps.js')?>"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	<script>
		$(document).ready(function() {
			App.init();
			FormPlugins.init();
			FormSliderSwitcher.init();
			PageWithTwoSidebar.init();
		});
	</script>
	<script src="<?=base_url('/builderengine/public/js/classie.js')?>"></script>
	<script src="<?=base_url('/builderengine/public/js/mlpushmenu.js')?>"></script>
	<script src="<?=base_url('themes/dashboard/assets/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
	<script>
	//$(document).ready(function() {
	//	new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'trigger' ) );
	//});
	function openPushMenu(block_id){
		var blockOpener = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'closeMenu' ) );
		$('*[block-type]').each(
			function(){
				$(this).removeClass().addClass('be-addblocks-panel sidebar-blocks panel panel-inverse insert-block-' + block_id);
				$(this).attr('data-identifier' ,'trigger-' + block_id);
			}
		);
		blockOpener._openMenu();
		$('#closeMenu').show();
	}
	function closePushMenu(){
		var blockOpener = new mlPushMenu( document.getElementById( 'mp-menu' ), document.getElementById( 'closeMenu' ) );
		blockOpener._resetMenu();
	}
	</script>
</body>