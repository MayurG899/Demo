<script>
    $(document).ready(function(){
        lastClickedElement = "";
        activeBlockName = "";
        editedObject = "";
        $('.section-block-<?=$block_id?>')
            .mousedown(function(event) {
                if(event.which == 3)
                {
                    editedObject = $(this);
                    highlightEditedBlock(editedObject);
                    lastClickedElement = LastClickedElementId(event);
                    var lastClickedObject = $(lastClickedElement);
                    activeBlockName = lastClickedObject.parent().attr('name');
                        document.oncontextmenu = function () {
                            return false;
                        };
//                        document.oncontextmenu = RightMouseDown();
                        console.log("right-click-down. Opening quick menu");
                        var x = event.clientX - 55;
                        var y = event.clientY - 50; // zvonko edit -> prev. value :-85 (temp. unreachable first menu item fix when right click on header)
                        if($('.builder-quick-menu-<?=$block_id?>').length == 0){
                            $("body").append('<?=$quick_menu?>');
                            $(".builder-quick-menu-<?=$block_id?>").css("left", x).css("top", y);
                        }
                        else
                        {
                            $(".builder-quick-menu-<?=$block_id?>").remove();
                            $("body").append('<?=$quick_menu?>');
                            $(".builder-quick-menu-<?=$block_id?>").css("left", x).css("top", y);
                        }
                }
                function RightMouseDown() { return false;}
            });
        $(document)
            .on('mouseup','.add-block-<?=$block_id?>', function(event){
                event.stopImmediatePropagation();
                setTimeout(function(){
                    highlightEditedBlock(editedObject);
                }, 10);
                if(event.which == 3) {
                    var blocks = $.ajax({
                        type: "GET",
                        url: '<?=base_url("/layout_system/ajax/get_blocks_for/".$section_type."/".$block_id."/".$block_name)?>',
                        async: false
                    }).responseText;
                    var detailed_settings_sidebar = $('<div class="detailed-settings-sidebar <?=$section_type?>-add-block-sidebar" style="width:0px" name="' + "<?=$block_name?>" + '"><ul class="nav nav-pills nav-stacked"><li><i id="remove-sidebar" class="fa fa-long-arrow-left"></i></li>' + blocks + '</ul></div>');
                    if($('.detailed-settings-sidebar').length == 0){
                        $("body").append(detailed_settings_sidebar);
                        $(detailed_settings_sidebar).animate({
                            width: 280
                        }, 200);
                    }
                    else
                    {
                        $(".detailed-settings-sidebar").remove();
                        $("body").append(detailed_settings_sidebar);
                        $(detailed_settings_sidebar).animate({
                            width: 280
                        }, 200);
                    }
                    $(".builder-quick-menu-<?=$block_id?>").remove();
                }
            });
            $(document).on('mouseup','.animation-<?=$block_id?>', function(event){
                if(event.which == 3) {
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + $(this).attr('block-name') + '/styler/animation' + '?page_path=<?=$page_path?>');
                    unhighlightEditedBlock(editedObject);
                }
            });
            $(document).on('mouseup','.style-<?=$block_id?>', function(event){
                if(event.which == 3){
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + $(this).attr('block-name') + '/styler/style' + '?page_path=<?=$page_path?>');
                    unhighlightEditedBlock(editedObject);
                }
            });
            $(document).on('mouseup','.global_style-<?=$block_id?>', function(event){
                if(event.which == 3){
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + $(this).attr('block-name') + '/styler/global_style' + '?page_path=<?=$page_path?>');
                    unhighlightEditedBlock(editedObject);
                }
            });
            $(document).on('mouseup','.custom-<?=$block_id?>', function(event){
                if(event.which == 3){
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + $(this).attr('block-name') + '/styler/custom' + '?page_path=<?=$page_path?>');
                    unhighlightEditedBlock(editedObject);
                }
            });
            $(document).on('mouseup','.builder-quick-menu-<?=$block_id?>', function(event){
                if(event.which == 3) {
                    console.log("right-click-up in menu");
                    $(".builder-quick-menu-<?=$block_id?>").remove();
                    unhighlightEditedBlock(editedObject);
                }
            });
    });
    $(".section-block-<?=$block_id?>")
        .mouseup(function(event) {
            if(event.which == 3)
            {
                console.log("right-click-up in block");
                $(".builder-quick-menu-<?=$block_id?>").remove();
                unhighlightEditedBlock(editedObject);
            }
        });
    $(document)
        .mouseup(function(event) {
        if(event.which == 3)
        {
            $(".builder-quick-menu-<?=$block_id?>").remove();
//                unhighlightEditedBlock(editedObject);
        }
        });
    $(document).on('click', '.insert-block-<?=$block_id?>', function(event){
        event.stopImmediatePropagation();
        if($(this).parents(".<?=$section_type?>-add-block-sidebar")){
            block_type = $(this).attr('block-type');
            content = $("div[name='" + "<?=$block_name?>" + "']").closest(".block").find(".block-children").first();
            var data_class = $(this).attr('block-class');
            console.log('searching with a div with the name: ' + "<?=$block_name?>");
            if(data_class == 'block-holder'){
                initiate_hamster_load();
                setTimeout(function(){
                    insertBlockHolder("<?=$block_name?>", block_type);
                }, 100);
            }
            else{
            $.post(site_root + "/layout_system/ajax/add_block/" + "<?=$block_name?>" + "/" + block_type,
            {
                page_path: page_path,
                data_class: data_class
            },

            function(data) {
                $('.<?=$section_type?>-add-block-sidebar').remove();
				$('.block-preview-container').remove();
                notifyChange();
                $parentBlock = content.prepend(data);

                $childBlock = $parentBlock.find('.block.be-content-block').first();
                $childBlock.find('.block-content').attr("contenteditable", "true");
                $("#edit-button").parent().addClass("active");
                editModeRefresh();
                refresh_editor();
                if(editedObject)
                    unhighlightEditedBlock(editedObject);
            });
            }


        }
    });
    $(document).on('click', '#remove-sidebar', function(){
        if($('.block-preview-container').length != 0)
            $('.block-preview-container').remove();
        var sidebar = $(this).parent().parent().parent();
        var sidebarWidth = sidebar.width();
        $(sidebar).animate({
            width: 0
        }, 200, function(){
            sidebar.remove();
            unhighlightEditedBlock(editedObject);
        });
    });
    $('body')
        .on('mouseover', '.insert-block-<?=$block_id?>', function(){
        if($('.block-preview-container').length != 0)
            $('.block-preview-container').remove();
        var blockType = $(this).attr('block-type');
        if(blockType != 'column' && blockType != 'row' && blockType != 'content' && blockType != 'generic' && blockType != 'header' && blockType != 'page' && blockType != 'footer'){
            var blockImageURL = '<?=base_url()?>blocks/' + blockType + '/preview.png';
            $('body').append('<div class="block-preview-container"><h4>Block Preview</h4><i class="fa fa-times close-block-preview"></i><img src="' + blockImageURL + '" alt="no preview available"></div>');
        }
    })
        .on('mouseout', '.insert-block-<?=$block_id?>', function(){
            if($('.block-preview-container').length != 0)
                $('.block-preview-container').remove();
    });
    $('body').on('click', '.close-block-preview', function(){
        $(this).parent().remove();
    });
    function insertBlockHolder(blockToAddTo, BlockHolderName){
        blockName = blockToAddTo;
        lastCreatedId = '';
        instructions = '';
        content = $("div[name='" + blockName + "']").closest(".block").find(".block-children").first();
        $.ajax({
            type: 'POST',
            url: site_root + "/layout_system/ajax/get_block_holder_instructions/" + BlockHolderName,
            data: {},
            async:false,
            success: function(data){
                instructions = data;
            }
        });
        instructions = JSON.parse(instructions);
        for(instruction in instructions){
            var singleInstruction = instructions[instruction].split('#');
            if(singleInstruction[1] == 'holder'){
                $.ajax({
                    type: 'POST',
                    url: site_root + "/layout_system/ajax/add_block/" + blockName + "/" + singleInstruction[0],
                    data: { page_path : page_path, data_class : singleInstruction[2] },
                    async:false,
                    success: function(data){
                        $parentBlock = content.prepend(data);
                        $childBlock = $parentBlock.find('.block.be-content-block').first();
                        $childBlock.find('.block-content').attr("contenteditable", "true");
                        $("#edit-button").parent().addClass("active");
                    }
                });
            }
            else{
                $.ajax({
                    type: 'POST',
                    url: site_root + "/layout_system/ajax/get_newest_block/" + singleInstruction[1],
                    async:false,
                    success: function(data){
                        lastCreatedId = data;
                    }
                });
                content = $("div[name='" + lastCreatedId + "']").closest(".block").find(".block-children").first();
                if(singleInstruction[0] == 'generic'){
                    $.ajax({
                        type: 'POST',
                        url: site_root + "/layout_system/ajax/add_block/" + lastCreatedId + "/" + singleInstruction[0],
                        data: { page_path : page_path, data_class : singleInstruction[2], custom_content : singleInstruction[3]},
                        async:false,
                        success: function(data){
                            $parentBlock = content.prepend(data);
                            $childBlock = $parentBlock.find('.block.be-content-block').first();
                            $childBlock.find('.block-content').attr("contenteditable", "true");
                            $("#edit-button").parent().addClass("active");
                        }
                    });
                }else{
                    $.ajax({
                        type: 'POST',
                        url: site_root + "/layout_system/ajax/add_block/" + lastCreatedId + "/" + singleInstruction[0],
                        data: { page_path : page_path, data_class : singleInstruction[2]},
                        async:false,
                        success: function(data){
                            $parentBlock = content.prepend(data);
                            $childBlock = $parentBlock.find('.block.be-content-block').first();
                            $childBlock.find('.block-content').attr("contenteditable", "true");
                            $("#edit-button").parent().addClass("active");
                        }
                    });
                }
            }
        }
        $('.block-preview-container').remove();
        $('.detailed-settings-sidebar').remove();
        stop_hamster_load();
    }
    function LastClickedElementId(e) {
        var targ;
        if (!e) var e = window.event;
        if (e.target) targ = e.target;
        else if (e.srcElement) targ = e.srcElement;
        if (targ.nodeType == 3) // defeat Safari bug
            targ = targ.parentNode;
        console.log(e.target.id);
        return e.target;
    }
    function highlightEditedBlock(object){
        object.css('background-color', '#167116');
        object.parent().css('border', '2px solid #056F05');
        object.parent().css('border-radius', '7px');
        console.log('highlight');
    }
    function unhighlightEditedBlock(object){
        object.css('background-color', '#2d353c');
        object.parent().css('border', '1px solid #DDDDDD');
        object.parent().css('border-radius', '4px');
        console.log('unfocusing');
    }
</script>