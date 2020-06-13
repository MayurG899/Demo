<script>
        lastClickedElement = "";
        new_slide_number = <?=$last_key?> +1;
        $('<?=$html_parent_element?>').on('blur', '.designer-editable', function () {
            if(checkEditorEnabled() == true)
                saveNewBlock($(this), "<?=$block_id?>", "<?=$block_name?>");
        });
        function saveNewBlock(object, blockId, blockRealName) {
            //        var objectContentArray = object.html().split("field_name=\"");
            //        var objectContentArray = objectContentArray[1].split('"');
            //        var fieldName =  objectContentArray[0];
            var fieldName = object.attr("field_name");
            var fieldValue = object.html();
            $.ajax({
                method: 'POST',
                url: site_root + "/index.php/layout_system/ajax/new_block_save",
                async: false,
                data: {
                    blockName: "custom-block-" + blockId,
                    isArray: "true",
                    fieldName: fieldName,
                    fieldValue: fieldValue,
                    pagePath: "<?=$page_path?>",
                    realName: blockRealName
                }
            }).fail(function (data) {
                alert(console.log("error"))
            });
            $.ajax({
                url: site_root + "/index.php/layout_system/ajax/return_new_block_output/<?=str_replace('/', '_', $page_path)?>/" + blockRealName
            });
            console.log("saved");
        }

            $('<?=$html_parent_element?>')
                .mousedown(function (event) {
                    if(checkEditorEnabled() == true){
                        if (event.which == 3) {
//                            document.oncontextmenu = RightMouseDown();
                            document.oncontextmenu = function () {
                                return false;
                            };
                            lastClickedElement = LastClickedElementId(event);
                            console.log("right-click-down");
                            var x = event.clientX - 55;
                            var y = event.clientY - 85;
                            $("body").append('<?=$quick_menu?>');
                            $(".builder-quick-menu-<?=$block_id?>").css("left", x).css("top", y);

                        }
                        function RightMouseDown() {
                            return false;
                        }
                    }
                });
            $('body').on('mousedown','.section-block-<?=$block_id?>',function (event) {
                    if(checkEditorEnabled() == true){
                        if (event.which == 3) {
    //                            document.oncontextmenu = RightMouseDown();
                            document.oncontextmenu = function () {
                                return false;
                            };
                            lastClickedElement = LastClickedElementId(event);
                            console.log("right-click-down");
                            var x = event.clientX - 55;
                            var y = event.clientY - 85;
                            $("body").append('<?=$quick_menu?>');
                            $(".builder-quick-menu-<?=$block_id?>").css("left", x).css("top", y);

                        }
                        function RightMouseDown() {
                            return false;
                        }
                    }
            });
            $('.quick-menu-options')
                .click(function (event) {
                    if(checkEditorEnabled() == true){
                        document.oncontextmenu = RightMouseDown;
                        console.log("right-click-down");
                        var x = event.clientX - 55;
                        var y = event.clientY - 85;
                        $("body").append('<?=$quick_menu?>');
                        $(".builder-quick-menu-<?=$block_id?>").css("left", x).css("top", y);

                        function RightMouseDown() {
                            return false;
                        }
                    }
                });
        $(document).on('mouseup', '.add-element-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true){
                if (event.which == 3) {
                    new_slide_number = <?=$last_key?> +1;

                    var newElementHtml = '<?=$new_element_html?>';
                    newElementHtml = newElementHtml.replaceAll('key_to_replace', new_slide_number);
                    // temp edit for milestones
                    if (new_slide_number == 1)
                        newElementHtml = newElementHtml.replaceAll('class_to_replace', 'col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3');
                    else if (new_slide_number == 2)
                        newElementHtml = newElementHtml.replaceAll('class_to_replace', 'col-md-6 col-sm-6');
                    else if (new_slide_number == 3)
                        newElementHtml = newElementHtml.replaceAll('class_to_replace', 'col-md-4 col-sm-4');
                    else
                        newElementHtml = newElementHtml.replaceAll('class_to_replace', 'col-md-3 col-sm-3');

                    $('<?=$html_parent_element?>').append(newElementHtml);
                    editModeRefresh();
                    refresh_editor();
                    new_slide_number++;

                }
            }
        });
        $(document).on('mouseup', '.output-<?=$block_id?>', function (event) {
            if(event.which == 3) {
                var blocks = $.ajax({
                    type: "GET",
                    url: '<?=base_url("/layout_system/ajax/get_output_for/".$output['module']."/".$output['object']."/".$block_id)?>',
                    async: false
                }).responseText;
                var detailed_settings_sidebar = $('<div class="detailed-settings-sidebar" style="width:0px" name="' + "<?=$block_name?>" + '"><ul class="nav nav-pills nav-stacked"><li><i id="remove-sidebar" class="fa fa-long-arrow-right"></i></li>' + blocks + '</ul></div>');
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
        $(document).on('mouseup', '.delete-element-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true) {
                if (event.which == 3)
                    deleteClickedElement(lastClickedElement);
            }
        });
        $(document).on('mouseup', '.animation-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true) {
                if (event.which == 3) {
                    console.log('clicked animations');
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '/styler/animation' + '?page_path=<?=$page_path?>');
                }
            }
        });
        $(document).on('mouseup', '.style-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true) {
                if (event.which == 3)
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '/styler/style' + '?page_path=<?=$page_path?>');
            }
        });
        $(document).on('mouseup', '.global_style-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true) {
                if (event.which == 3)
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '/styler/global_style' + '?page_path=<?=$page_path?>');
            }
        });
        $(document).on('mouseup', '.custom-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true){
                if (event.which == 3)
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '/styler/custom' + '?page_path=<?=$page_path?>');
            }
        });
        $(document).on('mouseup', '.settings-<?=$block_id?>', function (event) {
            if(checkEditorEnabled() == true) {
                if (event.which == 3)
                    showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '?page_path=<?=$page_path?>');
            }
        });
        $(document).on('click', '#blockSettings-<?=$block_id?>', function (event) {
			event.preventDefault();
			//if(checkSimpleEditorEnabled() == true)
				showAdminWindowIframe('<?=base_url()?>layout_system/ajax/block_admin/' + "<?=$block_name?>" + '?page_path=<?=$page_path?>');
        });
        $(document).on('click', '#blockEdit-<?=$block_id?>', function (event) {
			event.preventDefault();
			//if(checkSimpleEditorEnabled() == true){
				var element = $(event.target).closest('div:has([block-editor])').children(':first-child').children();
				if(element.is(':focus')){
					element.blur();
					$(event.target).closest('.block-controls').addClass('blockOverLay');
				}else{
					$(event.target).closest('.block-controls').removeClass('blockOverLay');
					element.focus();
					element.trigger('click');
				}
			//}
        });
        $(document).on('click', '#trigger-<?=$block_id?>', function (event) {
			event.preventDefault();
			//window.parent.$('.mp-pusher').addClass('mp-pushed');
			//window.parent.$('.mp-pusher').css('transform','translate3d(300px, 0px, 0px)');
			//window.parent.$('.mp-level').addClass('mp-level-open');
			//window.parent.$('#trigger').click();
			//window.parent.rUn();
			//window.parent.$('#advancedDesigner').addClass('animated flash infinite');
        });
        $(document)
            .on('mouseup', '.builder-quick-menu-<?=$block_id?>', function (event) {
                if(checkEditorEnabled() == true) {
                    if (event.which == 3) {
                        console.log("right-click-up in menu");
                        $(".builder-quick-menu-<?=$block_id?>").remove();
                    }
                }
            });
        $("<?=$html_parent_element?>")
            .mouseup(function (event) {
                if (event.which == 3) {
                    if(checkEditorEnabled() == true) {
                        console.log("right-click-up in block");
                        $(".builder-quick-menu-<?=$block_id?>").remove();
                    }
                }
            });
        $('body').on('mouseup','.section-block-<?=$block_id?>',function (event) {
                if (event.which == 3) {
                    if(checkEditorEnabled() == true) {
                        console.log("right-click-up in block");
                        $(".builder-quick-menu-<?=$block_id?>").remove();
                    }
                }
        });
        $(document)
            .mouseup(function(event) {
                if(event.which == 3)
                {
                    $(".builder-quick-menu-<?=$block_id?>").remove();
                }
            });
        String.prototype.replaceAll = function (search, replacement) {
            var target = this;
            return target.replace(new RegExp(search, 'g'), replacement);
        };
        $(document).on('click', '.select-output-<?=$block_id?>', function(){
            if($(this).parent().parent().parent().hasClass('detailed-settings-sidebar')){
                var BlockName = '<?=$block_name?>';
                var TitleBlockName = $('[block-type="ecommerce_product_title"]').attr('name');
                var PriceBlockName = $('[block-type="ecommerce_product_price"]').attr('name');
                var GalleryBlockName = $('[block-type="ecommerce_product_gallery"]').attr('name');
                var DescBlockName = $('[block-type="ecommerce_product_desc_and_reviews"]').attr('name');

                var newOutputId = $(this).attr('object-id');
                var blockPagePath = '<?=$page_path?>';
                var blockPagePath = blockPagePath.replaceAll('/', '_');
                var blockId = 0;

                // changing output for all product blocks
                // default
                initiate_hamster_load();
                setTimeout(function(){
                    $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + BlockName,
                        async: false
                    });
                    var output = $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + BlockName,
                        async: false
                    }).responseText;
                    $("div[name='" + BlockName + "']").replaceWith(output);
                    // title
                    $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + TitleBlockName,
                        async: false
                    });
                    var output = $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + TitleBlockName,
                        async: false
                    }).responseText;
                    $("div[name='" + TitleBlockName + "']").replaceWith(output);
                    // price
                    $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + PriceBlockName,
                        async: false
                    });
                    var output = $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + PriceBlockName,
                        async: false
                    }).responseText;
                    $("div[name='" + PriceBlockName + "']").replaceWith(output);
                    // gallery
                    $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + GalleryBlockName,
                        async: false
                    });
                    var output = $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + GalleryBlockName,
                        async: false
                    }).responseText;
                    $("div[name='" + GalleryBlockName + "']").replaceWith(output);
                    // desc and reviews
                    $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/change_module_block_output/" + blockId + "/" + newOutputId + "/" + blockPagePath + "/" + DescBlockName,
                        async: false
                    });
                    var output = $.ajax({
                        type: "GET",
                        url: site_root + "/layout_system/ajax/return_new_block_output/" + blockPagePath + "/" + DescBlockName,
                        async: false
                    }).responseText;
                    $("div[name='" + DescBlockName + "']").replaceWith(output);
                    // output change end
                    $('.detailed-settings-sidebar').remove();
                    stop_hamster_load();
                }, 100);
            }
        });
        function LastClickedElementId(e) {
            var targ;
            if (!e) var e = window.event;
            if (e.target) targ = e.target;
            else if (e.srcElement) targ = e.srcElement;
            if (targ.nodeType == 3) // defeat Safari bug
                targ = targ.parentNode;
            console.log(e.target.id);
            return e.target.id;
        }

        function deleteClickedElement(elementId) {
            var safeToDelete = elementId.indexOf("remove") > -1;
            if (safeToDelete == true) {
                var removalInfo = elementId.split("-");
                var objectToDelete = "";
                if (parseInt(removalInfo[1]) == 0) {
                    objectToDelete = $("#" + elementId);
                    objectToDelete.remove();
                }
                else if (parseInt(removalInfo[1]) == 1) {
                    objectToDelete = $("#" + elementId).parent();
                    objectToDelete.remove();
                }
                else if (parseInt(removalInfo[1]) == 2) {
                    objectToDelete = $("#" + elementId).parent().parent();
                    objectToDelete.remove();
                }
                else if (parseInt(removalInfo[1]) == 3) {
                    objectToDelete = $("#" + elementId).parent().parent().parent();
                    objectToDelete.remove();
                }
                else
                    console.log("problem");
                var objectToDeleteInfo = objectToDelete.attr("id").split("-");
                deleteElementWithKey(objectToDeleteInfo[2], objectToDeleteInfo[3]);
            }
        }

        function deleteElementWithKey(key, blockId) {
            console.log("deleting " + key);
            $.ajax({
                method: 'POST',
                url: site_root + "/index.php/layout_system/ajax/new_block_delete",
                async: false,
                data: {blockName: "custom-block-" + blockId, keyToDelete: key, pagePath: "<?=$page_path?>"}
            }).fail(function (data) {
                alert(console.log("error"))
            });
            console.log("deleted");
        }
        function checkEditorEnabled(){
            var bodyClass = $('body').attr('class');

            if(bodyClass.indexOf("test editor-mode-active") >= 0)
                return true;
            else
                return false;
        }
        function checkSimpleEditorEnabled(){
            var bodyClass = $('body').attr('class');

            if(bodyClass.indexOf("test simple-editor-enabled") >= 0)
                return true;
            else
                return false;
        }
</script>