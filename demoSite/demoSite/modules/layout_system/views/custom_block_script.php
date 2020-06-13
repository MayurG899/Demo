<script>
    $(document).ready(function(){
        blockId = "";
        blockName = "";
        blockPagePath = "";
        outputModule = "";
        outputObjectType = "";
        outputObjectId = "";
        $('<?=$html_parent_element?>')
            .mousedown(function(event) {
                if(event.which == 3)
                {
                    blockId = $(this).attr('block-id');
                    blockName = $(this).attr('block-name');
                    blockPagePath = $(this).attr('block-path');
                    outputModule = $(this).attr('module');
                    outputObjectType = $(this).attr('object-type');
                    outputObjectId = $(this).attr('object-id');
                    document.oncontextmenu = RightMouseDown;
                    console.log("right-click-down. Opening custom block quick menu");
                    var x = event.clientX;
                    var y = event.clientY - 85;
                    var quickMenuOutput = '<div class="builder-quick-menu">' + '<div class="quick-menu-item menu-item-1" style="visibility: hidden"><i class="fa fa-cogs"></i>&nbspempty</div>' + '<div class="quick-menu-item menu-item-2"><i class="fa fa-cogs"></i>&nbspChoose Output</div>' + '<div class="quick-menu-item menu-item-3"><i class="fa fa-plus-square"></i>&nbspBackground</div>' + '</div>';
                    if($('.builder-quick-menu').length == 0){
                        $("body").append(quickMenuOutput);
                        $(".builder-quick-menu").css("left", x).css("top", y);
                    }
                    else
                    {
                        $(".builder-quick-menu").remove();
                        $("body").append(quickMenuOutput);
                        $(".builder-quick-menu").css("left", x).css("top", y);
                    }
                }
                function RightMouseDown() { return false;}
            })
            .mouseup(function(event) {
                if(event.which == 3)
                {
                    console.log("right-click-up in block");
                    $(".builder-quick-menu").remove();
                }
        });
        $(document)
            .on('mouseup','.menu-item-2', function(event){
                if(event.which == 3) {
                    var output = $.ajax({
                        type: "GET",
                        url: '<?=base_url()?>layout_system/ajax/get_output_for/' + outputModule + '/' + outputObjectType,
                        async: false
                    }).responseText;
                    var detailed_settings_sidebar = $('<div class="detailed-settings-sidebar module-choose-output-sidebar" block-id="' + blockId + '"><ul class="nav nav-pills nav-stacked">' + output + '</ul></div>');
                    if($('.detailed-settings-sidebar').length == 0){
                        $("body").append(detailed_settings_sidebar);
                    }
                    else
                    {
                        $(".detailed-settings-sidebar").remove();
                        $("body").append(detailed_settings_sidebar);
                    }
                }
            })
            .on('mouseup','.menu-item-3', function(event){
                if(event.which == 3) {
                    console.log("background settings");
                }
            })
            .on('mouseup','.builder-quick-menu', function(event){
                if(event.which == 3) {
                    console.log("right-click-up in menu");
                    $(".builder-quick-menu").remove();
                }
            });
    });
    $(document).on('click', '.select-output', function(event){
        if($(this).parent().parent().parent().hasClass('module-choose-output-sidebar')){
            newOutputId = $(this).attr('object-id');

            $.ajax({
                type: "GET",
                url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + blockName,
                async: false
            });
            var output = $.ajax({
                type: "GET",
                url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + blockName,
                async: false
            }).responseText;
            $("div[name='" + blockName + "']").replaceWith(output);
            $('.detailed-settings-sidebar').remove();
        }
    });
</script>