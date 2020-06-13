/*!
 * Custom js - BuilderEngine Themes
 */


/* Commas to Number
------------------------------------------------ */
var handleAddCommasToNumber = function(value) {
    return value.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
};


/* Page Container Show
------------------------------------------------ */
var handlePageContainerShow = function() {
    $('#page-container').addClass('in');
};

var tooltip = function () {
			// Bootstrap tooltip
			if($.fn.tooltip) {
				$('.add-tooltip').tooltip();
			}
		},
		popover = function () {
			// Bootstrap tooltip
			if($.fn.popover) {
				$('.add-popover').popover({
					trigger: 'focus'
				});
			}
		};

/* Application Controller
------------------------------------------------ */
var Loader = function () {
	"use strict";
	
	return {
		init: function () {
		    handlePageContainerShow();
			tooltip();
		}
  };
}(); 