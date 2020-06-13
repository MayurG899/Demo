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
?>
<link href="<?=base_url('modules/layout_system/views/block_settings_popup_custom.css')?>" rel="stylesheet" />
<div id="block-editor" style="position:relative; width: 100%;">

    <script>
        $("#admin-window").css('display','block');
        $("#admin-window").draggable();
		
		$(".collapse-element").click(function () {
			$header = $(this);
			$content = $('.coll');
			$content.slideToggle(500, function () {
				$header.text(function () {
				});
			});
		});
		$('#popup-close').on('click',function(){
			$('.tooltip').removeClass('in');
		});
    </script>

    <div class="block-editor bepopup-settings"  data-sortable-id="ui-widget-7" style="position: absolute;width: 100%;">
        <div class="panel panel-inverse" style="width: 65%;margin-left: auto;margin-right: auto;">
            <div class="panel-heading">
				<div class="panel-heading-btn">
				   <a href="#" data-placement="top" class="collapse-element btn btn-xs btn-warning"><i class="fa fa-minus"></i></a>
				   <a href="#" id="popup-close" class="close i-close-2 btn btn-xs btn-danger" data-click="panel-remove" style="opacity:1 !important;"><i class="fa fa-times"></i></a>
					<a href="#" id="" class="" data-click=""><i class=""></i></a>
				</div>
				<h4 class="panel-title">Block Settings</h4>
            </div>
			<div class="panel-body coll">
                <div class="bwizard">
					<div class="widget-content" id='admin-window-content'> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>