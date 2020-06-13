var test = 'test';
function initializeRemoveBlock()
{
    $(".block .block-controls .remove").bind( "click.delete_block",function (event) {
		event.stopPropagation();
		event.preventDefault();
		var block = this;
		//confirmation_text = "Are you sure you want to delete this block?";
		//if(!confirm(confirmation_text))
		//  return;
		$('#myModalDelete', window.top.document).modal('show');
		$('.delete-modal', window.top.document).css('z-index','123456');
		
		$('#deleteMyBlock', window.top.document).on('click',function(){
			var block_obj_to_delete = $(block).closest('.block');
			var parent_name = $(block_obj_to_delete).closest('.block-children').attr('block-name');
			var children_container = $(block_obj_to_delete).closest('.block-children');
			$.ajax(site_root+"/layout_system/ajax/delete_block/" + $(block_obj_to_delete).attr("name") + "/" + parent_name + "?page_path=" + page_path).error(function() {
			  var success = false; 
			  alert('There was an error performing this operation.\nPlease contact customer support.') 
			}).success(function()
			{
				//modify parent column min.height if Simple Designer is on and column left empty
				var simpleDesigner = window.top.$('#simpleDesigner');
				if($(simpleDesigner).hasClass('active')){
					if($(children_container).is(':empty')){
						var overlay = 
							'<div class="block-controls blockOverLay drag ui-sortable-handle">'+
								'<div class="be-simple-editor-generic-controls">' +
									'<div class="block-controls-inner panel-heading-btn">' +
										'<p class="new-block-clarification" style="margin-left: 45% !important;">Right-click options</p>' +
										'<a rel="tooltip" data-placement="top" title="Remove Block" href="#close" class="remove btn btn-xs btn-danger"><i class="fa fa-times"></i></a>' +
										'<span rel="tooltip" data-placement="top" title="Move" class="drag btn btn-xs btn-white"><i class="fa fa-arrows"></i></span>' +
										'<a rel="tooltip" data-placement="top" title="Add Block" href="#" onclick="window.top.openPushMenu(0);" class="btn btn-xs btn-inverse be-simple-editor-addblock-generic" id="trigger-82"><i class="fa fa-plus"></i></a>' +
										'<a rel="tooltip" data-placement="top" title="Edit Content" href="#" class="btn btn-xs btn-success be-simple-editor-edit-generic" id="blockEdit-0"><i class="fa fa-edit"></i></a>' +
										'<a rel="tooltip" data-placement="top" title="Undo" href="#undo" class="undo btn btn-xs btn-white be-simple-editor-undo"><i class="fa fa-undo"></i></a>' +
									'</div>' +
								'</div>' +
								'<div class="be-block-hover-caption">' +
								'</div>' +
							'</div>';
						$(children_container).empty();
						$(children_container).append(overlay);
						$(children_container).addClass('be-empty-column-fill');
						refresh_editor();
					}
				}
				notifyChange();
			});

			block_obj_to_delete.remove();
			block_obj_to_delete = null;
			//$('#myModalDelete', window.top.document).removeClass('in');
			$('.delete-modal', window.top.document).css('z-index','1');
			$('#myModalDelete', window.top.document).modal('hide');
		});
    });
}