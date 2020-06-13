/*   
BuilderEngine Module JS
*/

var handleFormWysihtml5 = function () {
	"use strict";
	$('#wysihtml5').wysihtml5();
};

var ForumDetailsPage = function () {
	"use strict";
    return {
        //main function
        init: function () {
            handleFormWysihtml5();
        }
    };
}();