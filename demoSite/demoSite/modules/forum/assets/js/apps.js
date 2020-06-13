/*   
BuilderEngine Module JS
*/



/* 02. Handle Pace Page Loading Plugins
------------------------------------------------ */
var handlePaceLoadingPlugins = function() {
    Pace.on('hide', function(){
        setTimeout(function() {
            $('.pace').addClass('hide');
        }, 1000);
    });
};


/* 03. Handle Tooltip Activation
------------------------------------------------ */
var handleTooltipActivation = function() {
    if ($('[data-toggle=tooltip]').length !== 0) {
        $('[data-toggle=tooltip]').tooltip('hide');
    }
};


/* 04. Handle Theme Panel Expand
------------------------------------------------ */
var handleThemePanelExpand = function() {
    $('[data-click="theme-panel-expand"]').on('click', function() {
        var targetContainer = '.theme-panel';
        var targetClass = 'active';
        if ($(targetContainer).hasClass(targetClass)) {
            $(targetContainer).removeClass(targetClass);
        } else {
            $(targetContainer).addClass(targetClass);
        }
    });
};



/* Application Controller
------------------------------------------------ */
var App = function () {
	"use strict";
	
	return {
		//main function
		init: function () {
		   // handlePaceLoadingPlugins();
		    handleTooltipActivation();
		    handleThemePanelExpand();
		}
  };
}();