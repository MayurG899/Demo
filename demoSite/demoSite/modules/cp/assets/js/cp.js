/*   
----------------------------
 BuilderEngine User Account
----------------------------
*/


/* Scrollbar
------------------------------------------------ */
var handleSlimScroll = function() {
    "use strict";
    $('[data-scrollbar=true]').each( function() {
        generateSlimScroll($(this));
    });
};
var generateSlimScroll = function(element) {
    if ($(element).attr('data-init')) {
        return;
    }
    var dataHeight = $(element).attr('data-height');
        dataHeight = (!dataHeight) ? $(element).height() : dataHeight;
    
    var scrollBarOption = {
        height: dataHeight, 
        alwaysVisible: true
    };
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        $(element).css('height', dataHeight);
        $(element).css('overflow-x','scroll');
    } else {
        $(element).slimScroll(scrollBarOption);
    }
    $(element).attr('data-init', true);
};


/* Sidebar - Menu
------------------------------------------------ */
var handleSidebarMenu = function() {
    "use strict";
    $('.be-uaccount-sidebar .nav > .has-sub > a').click(function() {
        var target = $(this).next('.sub-menu');
        var otherMenu = '.be-uaccount-sidebar .nav > li.has-sub > .sub-menu';
    
        if ($('.page-sidebar-minified').length === 0) {
            $(otherMenu).not(target).slideUp(0, function() {
                $(this).closest('li').removeClass('expand');
            });
            $(target).slideToggle(0, function() {
                var targetLi = $(this).closest('li');
                if ($(targetLi).hasClass('expand') || !$(target).is(':visible')) {
                    $(targetLi).removeClass('expand');
                } else {
                    $(targetLi).addClass('expand');
                }
            });
        }
    });
    $('.be-uaccount-sidebar .nav > .has-sub .sub-menu li.has-sub > a').click(function() {
        if ($('.page-sidebar-minified').length === 0) {
            var target = $(this).next('.sub-menu');
            $(target).slideToggle(0, function() {
                var targetLi = $(this).closest('li');
                if ($(targetLi).hasClass('expand')) {
                    $(targetLi).removeClass('expand');
                } else {
                    $(targetLi).addClass('expand');
                }
            });
        }
    });
};


/* Sidebar - Mobile View Toggle
------------------------------------------------ */
var handleMobileSidebarToggle = function() {
    var sidebarProgress = false;
    $('.be-uaccount-sidebar').bind('click touchstart', function(e) {
        if ($(e.target).closest('.be-uaccount-sidebar').length !== 0) {
            sidebarProgress = true;
        } else {
            sidebarProgress = false;
            e.stopPropagation();
        }
    });
    
    $(document).bind('click touchstart', function(e) {
        if ($(e.target).closest('.be-uaccount-sidebar').length === 0) {
            sidebarProgress = false;
        }
        if (!e.isPropagationStopped() && sidebarProgress !== true) {
            if ($('#be-uaccount-page-container').hasClass('page-sidebar-toggled')) {
                sidebarProgress = true;
                $('#be-uaccount-page-container').removeClass('page-sidebar-toggled');
            }
            if ($(window).width() <= 767) {
                if ($('#be-uaccount-page-container').hasClass('page-right-sidebar-toggled')) {
                    sidebarProgress = true;
                    $('#be-uaccount-page-container').removeClass('page-right-sidebar-toggled');
                }
            }
        }
    });
    
    $('[data-click=right-sidebar-toggled]').click(function(e) {
        e.stopPropagation();
        var targetContainer = '#be-uaccount-page-container';
        var targetClass = 'page-right-sidebar-collapsed';
            targetClass = ($(window).width() < 979) ? 'page-right-sidebar-toggled' : targetClass;
        if ($(targetContainer).hasClass(targetClass)) {
            $(targetContainer).removeClass(targetClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(targetClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) {
            $('#be-uaccount-page-container').removeClass('page-sidebar-toggled');
        }
        $(window).trigger('resize');
    });
    
    $('[data-click=sidebar-toggled]').click(function(e) {
        e.stopPropagation();
        var sidebarClass = 'page-sidebar-toggled';
        var targetContainer = '#be-uaccount-page-container';

        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
        } else if (sidebarProgress !== true) {
            $(targetContainer).addClass(sidebarClass);
        } else {
            sidebarProgress = false;
        }
        if ($(window).width() < 480) {
            $('#be-uaccount-page-container').removeClass('page-right-sidebar-toggled');
        }
    });
};


/* Sidebar - Minify / Expand
------------------------------------------------ */
var handleSidebarMinify = function() {
    $('[data-click=sidebar-minify]').click(function(e) {
        e.preventDefault();
        var sidebarClass = 'page-sidebar-minified';
        var targetContainer = '#be-uaccount-page-container';
        $('#be-uaccount-sidebar [data-scrollbar="true"]').css('margin-top','0');
        $('#be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('data-init');
        $('#be-uaccount-sidebar [data-scrollbar=true]').stop();
        if ($(targetContainer).hasClass(sidebarClass)) {
            $(targetContainer).removeClass(sidebarClass);
            if ($(targetContainer).hasClass('page-sidebar-fixed')) {
                if ($('#be-uaccount-sidebar .slimScrollDiv').length !== 0) {
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('style');
                }
                generateSlimScroll($('#be-uaccount-sidebar [data-scrollbar="true"]'));
                $('#be-uaccount-sidebar [data-scrollbar=true]').trigger('mouseover');
            } else if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                if ($('#be-uaccount-sidebar .slimScrollDiv').length !== 0) {
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('style');
                }
                generateSlimScroll($('#be-uaccount-sidebar [data-scrollbar="true"]'));
            }
        } else {
            $(targetContainer).addClass(sidebarClass);
    
            if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                if ($(targetContainer).hasClass('page-sidebar-fixed')) {
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('#be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('style');
                }
                $('#be-uaccount-sidebar [data-scrollbar=true]').trigger('mouseover');
            } else {
                $('#be-uaccount-sidebar [data-scrollbar="true"]').css('margin-top','0');
                $('#be-uaccount-sidebar [data-scrollbar="true"]').css('overflow', 'visible');
            }
        }
        $(window).trigger('resize');
    });
};


/* Mobile Sidebar Scrolling Feature
------------------------------------------------ */
var handleMobileSidebar = function() {
    "use strict";
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if ($('#be-uaccount-page-container').hasClass('page-sidebar-minified')) {
            $('#be-uaccount-sidebar [data-scrollbar="true"]').css('overflow', 'visible');
            $('.page-sidebar-minified #be-uaccount-sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
            $('.page-sidebar-minified #be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('style');
            $('.page-sidebar-minified #be-uaccount-sidebar [data-scrollbar=true]').trigger('mouseover');
        }
    }

    var oriTouch = 0;
    $('.page-sidebar-minified .be-uaccount-sidebar [data-scrollbar=true] a').bind('touchstart', function(e) {
        var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
        var touchVertical = touch.pageY;
        oriTouch = touchVertical - parseInt($(this).closest('[data-scrollbar=true]').css('margin-top'));
    });

    $('.page-sidebar-minified .be-uaccount-sidebar [data-scrollbar=true] a').bind('touchmove',function(e){
        e.preventDefault();
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            var touch = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
            var touchVertical = touch.pageY;
            var elementTop = touchVertical - oriTouch;
            
            $(this).closest('[data-scrollbar=true]').css('margin-top', elementTop + 'px');
        }
    });

    $('.page-sidebar-minified .be-uaccount-sidebar [data-scrollbar=true] a').bind('touchend', function(e) {
        var targetScrollBar = $(this).closest('[data-scrollbar=true]');
        var windowHeight = $(window).height();
        var sidebarTopPosition = parseInt($('#be-uaccount-sidebar').css('padding-top'));
        var sidebarContainerHeight = $('#be-uaccount-sidebar').height();
        oriTouch = $(targetScrollBar).css('margin-top');

        var sidebarHeight = sidebarTopPosition;
        $('.be-uaccount-sidebar').not('.sidebar-right').find('.nav').each(function() {
            sidebarHeight += $(this).height();
        });
        var finalHeight = -parseInt(oriTouch) + $('.be-uaccount-sidebar').height();
        if (finalHeight >= sidebarHeight && windowHeight <= sidebarHeight && sidebarContainerHeight <= sidebarHeight) {
            var finalMargin = windowHeight - sidebarHeight - 20;
            $(targetScrollBar).animate({marginTop: finalMargin + 'px'});
        } else if (parseInt(oriTouch) >= 0 || sidebarContainerHeight >= sidebarHeight) {
            $(targetScrollBar).animate({marginTop: '0px'});
        } else {
            finalMargin = oriTouch;
            $(targetScrollBar).animate({marginTop: finalMargin + 'px'});
        }
    });
};


/* Handle Top Menu - Unlimited Top Menu Render
------------------------------------------------ */
var handleUnlimitedTopMenuRender = function() {
    "use strict";
    // function handle menu button action - next / prev
    function handleMenuButtonAction(element, direction) {
        var obj = $(element).closest('.nav');
        var marginLeft = parseInt($(obj).css('margin-left'));  
        var containerWidth = $('.top-menu').width() - 88;
        var totalWidth = 0;
        var finalScrollWidth = 0;

        $(obj).find('li').each(function() {
            if (!$(this).hasClass('menu-control')) {
                totalWidth += $(this).width();
            }
        });
        
        switch (direction) {
            case 'next':
                var widthLeft = totalWidth + marginLeft - containerWidth;
                if (widthLeft <= containerWidth) {
                    finalScrollWidth = widthLeft - marginLeft + 128;
                    setTimeout(function() {
                        $(obj).find('.menu-control.menu-control-right').removeClass('show');
                    }, 150);
                } else {
                    finalScrollWidth = containerWidth - marginLeft - 128;
                }

                if (finalScrollWidth != 0) {
                    $(obj).animate({ marginLeft: '-' + finalScrollWidth + 'px'}, 150, function() {
                        $(obj).find('.menu-control.menu-control-left').addClass('show');
                    });
                }
                break;
            case 'prev':
                var widthLeft = -marginLeft;
    
                if (widthLeft <= containerWidth) {
                    $(obj).find('.menu-control.menu-control-left').removeClass('show');
                    finalScrollWidth = 0;
                } else {
                    finalScrollWidth = widthLeft - containerWidth + 88;
                }
                $(obj).animate({ marginLeft: '-' + finalScrollWidth + 'px'}, 150, function() {
                    $(obj).find('.menu-control.menu-control-right').addClass('show');
                });
                break;
        }
    }

    // handle page load active menu focus
    function handlePageLoadMenuFocus() {
        var targetMenu = $('.top-menu .nav');
        var targetList = $('.top-menu .nav > li');
        var targetActiveList = $('.top-menu .nav > li.active');
        var targetContainer = $('.top-menu');
        
        var marginLeft = parseInt($(targetMenu).css('margin-left'));  
        var viewWidth = $(targetContainer).width() - 128;
        var prevWidth = $('.top-menu .nav > li.active').width();
        var speed = 0;
        var fullWidth = 0;
        
        $(targetActiveList).prevAll().each(function() {
            prevWidth += $(this).width();
        });

        $(targetList).each(function() {
            if (!$(this).hasClass('menu-control')) {
                fullWidth += $(this).width();
            }
        });

        if (prevWidth >= viewWidth) {
            var finalScrollWidth = prevWidth - viewWidth + 128;
            $(targetMenu).animate({ marginLeft: '-' + finalScrollWidth + 'px'}, speed);
        }
        
        if (prevWidth != fullWidth && fullWidth >= viewWidth) {
            $(targetMenu).find('.menu-control.menu-control-right').addClass('show');
        } else {
            $(targetMenu).find('.menu-control.menu-control-right').removeClass('show');
        }

        if (prevWidth >= viewWidth && fullWidth >= viewWidth) {
            $(targetMenu).find('.menu-control.menu-control-left').addClass('show');
        } else {
            $(targetMenu).find('.menu-control.menu-control-left').removeClass('show');
        }
    }

    // handle menu next button click action
    $('[data-click="next-menu"]').click(function(e) {
        e.preventDefault();
        handleMenuButtonAction(this,'next');
    });

    // handle menu prev button click action
    $('[data-click="prev-menu"]').click(function(e) {
        e.preventDefault();
        handleMenuButtonAction(this,'prev');

    });

    // handle unlimited menu responsive setting
    $(window).resize(function() {
        $('.top-menu .nav').removeAttr('style');
        handlePageLoadMenuFocus();
    });

    handlePageLoadMenuFocus();
};


/* Handle Top Menu - Sub Menu Toggle
------------------------------------------------ */
var handleTopMenuSubMenu = function() {
    "use strict";
    $('.top-menu .sub-menu .has-sub > a').click(function() {
        var target = $(this).closest('li').find('.sub-menu').first();
        var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
        $(otherMenu).not(target).slideUp(250, function() {
            $(this).closest('li').removeClass('expand');
        });
        $(target).slideToggle(250, function() {
            var targetLi = $(this).closest('li');
            if ($(targetLi).hasClass('expand')) {
                $(targetLi).removeClass('expand');
            } else {
                $(targetLi).addClass('expand');
            }
        });
    });
};


/* Top Menu - Mobile Sub Menu Toggle
------------------------------------------------ */
var handleMobileTopMenuSubMenu = function() {
    "use strict";
    $('.top-menu .nav > li.has-sub > a').click(function() {
        if ($(window).width() <= 767) {
            var target = $(this).closest('li').find('.sub-menu').first();
            var otherMenu = $(this).closest('ul').find('.sub-menu').not(target);
            $(otherMenu).not(target).slideUp(250, function() {
                $(this).closest('li').removeClass('expand');
            });
            $(target).slideToggle(250, function() {
                var targetLi = $(this).closest('li');
                if ($(targetLi).hasClass('expand')) {
                    $(targetLi).removeClass('expand');
                } else {
                    $(targetLi).addClass('expand');
                }
            });
        }
    });
};


/* Top Menu - Mobile Top Menu Toggle
------------------------------------------------ */
var handleTopMenuMobileToggle = function() {
    "use strict";
    $('[data-click="top-menu-toggled"]').click(function() {
        $('.top-menu').slideToggle(250);
    });
};


/* Handle Clear Sidebar Selection & Hide Mobile Menu
------------------------------------------------ */
var handleClearSidebarSelection = function() {
    $('.be-uaccount-sidebar .nav > li, .be-uaccount-sidebar .nav .sub-menu').removeClass('expand').removeAttr('style');
};
var handleClearSidebarMobileSelection = function() {
    $('#be-uaccount-page-container').removeClass('page-sidebar-toggled');
};


/* Handle Toggle Navbar Search
------------------------------------------------ */

var handleToggleNavbarSearch = function() {
    $('[data-toggle="navbar-search"]').click(function(e) {
        e.preventDefault();
        $('.navbar').addClass('navbar-search-toggled');
    });
};


/* Handle Dismiss Navbar Search
------------------------------------------------ */
var handleDismissNavbarSearch = function() {
    $('[data-dismiss="navbar-search"]').click(function(e) {
        e.preventDefault();
        $('.navbar').removeClass('navbar-search-toggled');
    });
};


/* Handle Toggle Navbar Profile
------------------------------------------------ */
var handleToggleNavProfile = function() {
    $('[data-toggle="nav-profile"]').click(function(e) {
        e.preventDefault();
        
        var targetLi = $(this).closest('li');
        var targetProfile = $('.be-uaccount-sidebar .nav-profile');
        var targetClass = 'active';
        
        if ($(targetLi).hasClass(targetClass)) {
            $(targetLi).removeClass(targetClass);
            $(targetProfile).removeClass(targetClass);
        } else {
            $(targetLi).addClass(targetClass);
            $(targetProfile).addClass(targetClass);
        }
    });
};

/* Handle Page Load - Fade in
------------------------------------------------ */
var handlePageContentView = function() {
    "use strict";
    $.when($('#page-loader').addClass('hide')).done(function() {
        $('#be-uaccount-page-container').addClass('in');
    });
};

/* Page Structure Configuration 
------------------------------------------------ */
var handleThemePageStructureControl = function() {

    // COOKIE - Sidebar Styling Setting
    if ($.cookie && $.cookie('sidebar-styling')) {
        if ($('.be-uaccount-sidebar').length !== 0 && $.cookie('sidebar-styling') == 'grid') {
            $('.be-uaccount-sidebar').addClass('sidebar-grid');
            $('[name=sidebar-styling] option[value="2"]').prop('selected', true);
        }
    }
    
    // SIDEBAR - grid or default
    $('.theme-panel [name=sidebar-styling]').on('change', function() {
        if ($(this).val() == 2) {
            $('#be-uaccount-sidebar').addClass('sidebar-grid');
            $.cookie('sidebar-styling', 'grid');
        } else {
            $('#be-uaccount-sidebar').removeClass('sidebar-grid');
            $.cookie('sidebar-styling', 'default');
        }
    });
    
    // SIDEBAR - fixed or default
    $(document).on('change', '.theme-panel [name=sidebar-fixed]', function() {
        if ($(this).val() == 1) {
            if ($('.theme-panel [name=header-fixed]').val() == 2) {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar.');
                $('.theme-panel [name=header-fixed] option[value="1"]').prop('selected', true);
                $('#be-uaccount-header').addClass('navbar-fixed-top');
                $('#be-uaccount-page-container').addClass('page-header-fixed');
            }
            $('#be-uaccount-page-container').addClass('page-sidebar-fixed');
            if (!$('#be-uaccount-page-container').hasClass('page-sidebar-minified')) {
                generateSlimScroll($('.be-uaccount-sidebar [data-scrollbar="true"]'));
            }
        } else {
            $('#be-uaccount-page-container').removeClass('page-sidebar-fixed');
            if ($('.be-uaccount-sidebar .slimScrollDiv').length !== 0) {
                if ($(window).width() <= 979) {
                    $('.be-uaccount-sidebar').each(function() {
                        if (!($('#be-uaccount-page-container').hasClass('page-with-two-sidebar') && $(this).hasClass('sidebar-right'))) {
                            $(this).find('.slimScrollBar').remove();
                            $(this).find('.slimScrollRail').remove();
                            $(this).find('[data-scrollbar="true"]').removeAttr('style');
                            var targetElement = $(this).find('[data-scrollbar="true"]').parent();
                            var targetHtml = $(targetElement).html();
                            $(targetElement).replaceWith(targetHtml);
                        }
                    });
                } else if ($(window).width() > 979) {
                    $('.be-uaccount-sidebar [data-scrollbar="true"]').slimScroll({destroy: true});
                    $('.be-uaccount-sidebar [data-scrollbar="true"]').removeAttr('style');
                }
            }
            if ($('#be-uaccount-page-container .be-uaccount-sidebar-bg').length === 0) {
                $('#be-uaccount-page-container').append('<div class="be-uaccount-sidebar-bg"></div>');
            }
        }
    });
    
    // HEADER - fixed or default
    $(document).on('change', '.theme-panel [name=header-fixed]', function() {
        if ($(this).val() == 1) {
            $('#be-uaccount-header').addClass('navbar-fixed-top');
            $('#be-uaccount-page-container').addClass('page-header-fixed');
            $.cookie('header-fixed', true);
        } else {
            if ($('.theme-panel [name=sidebar-fixed]').val() == 1) {
                alert('Default Header with Fixed Sidebar option is not supported. Proceed with Default Header with Default Sidebar.');
                $('.theme-panel [name=sidebar-fixed] option[value="2"]').prop('selected', true);
                $('#be-uaccount-page-container').removeClass('page-sidebar-fixed');
                if ($('#be-uaccount-page-container .be-uaccount-sidebar-bg').length === 0) {
                    $('#be-uaccount-page-container').append('<div class="be-uaccount-sidebar-bg"></div>');
                }
            }
            $('#be-uaccount-header').removeClass('navbar-fixed-top');
            $('#be-uaccount-page-container').removeClass('page-header-fixed');
            $.cookie('header-fixed', false);
        }
    });
};

/* Handle After Page Load Add Class Function
------------------------------------------------ */
var handleAfterPageLoadAddClass = function() {
    if ($('[data-pageload-addclass]').length !== 0) {
        $(window).load(function() {
            $('[data-pageload-addclass]').each(function() {
                var targetClass = $(this).attr('data-pageload-addclass');
                $(this).addClass(targetClass);
            });
        });
    }
};


/* Application Controller
------------------------------------------------ */
var CP = function () {
	"use strict";
	
	return {
		//main function
		init: function () {
		    this.initSidebar();
		    this.initTopMenu();
		    this.initPageLoad();
		    this.initComponent();
		    this.initThemePanel();
		},
		initSidebar: function() {
			handleSidebarMenu();
			handleMobileSidebarToggle();
			handleSidebarMinify();
			handleMobileSidebar();
		},
		initSidebarSelection: function() {
		    handleClearSidebarSelection();
		},
		initSidebarMobileSelection: function() {
		    handleClearSidebarMobileSelection();
		},
		initTopMenu: function() {
			handleUnlimitedTopMenuRender();
			handleTopMenuSubMenu();
			handleMobileTopMenuSubMenu();
			handleTopMenuMobileToggle();
		},
		initPageLoad: function() {
			handlePageContentView();
		},
		initComponent: function() {
			handleSlimScroll();
			handleAfterPageLoadAddClass();
			handleToggleNavProfile();
			handleDismissNavbarSearch();
			handleToggleNavbarSearch();
		},
		initThemePanel: function() {
			handleThemePageStructureControl();
		}
  };
}();