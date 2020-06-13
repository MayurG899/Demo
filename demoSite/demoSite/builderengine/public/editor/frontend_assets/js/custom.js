/*   
BuilderEngine V3


::  1.0 BuilderEngine Admin - Default JS
---------------------------------------------------------
    1.1 General 
	1.2 Switchery - Slider Switcher Components
	1.3 Builder Right Sidebar
	
*/

/* -------------------------------------
   BuilderEngine Admin - Default JS
---------------------------------------- */

/* 1.1 General */



/* 1.2 Switchery - Slider Switcher Components */

var green = '#009688',
    red = '#F44336',
    blue = '#2196F3',
    purple = '#673AB7',
    orange = '#FF9800',
    black = '#212121';

var renderSwitcher = function() {
    if ($('[data-render=switchery]').length !== 0) {
        $('[data-render=switchery]').each(function() {
            var themeColor = green;
            if ($(this).attr('data-theme')) {
                switch ($(this).attr('data-theme')) {
                    case 'red':
                        themeColor = red;
                        break;
                    case 'blue':
                        themeColor = blue;
                        break;
                    case 'purple':
                        themeColor = purple;
                        break;
                    case 'orange':
                        themeColor = orange;
                        break;
                    case 'black':
                        themeColor = black;
                        break;
                }
            }
            var option = {};
                option.color = themeColor;
                option.secondaryColor = ($(this).attr('data-secondary-color')) ? $(this).attr('data-secondary-color') : '#dfdfdf';
                option.className = ($(this).attr('data-classname')) ? $(this).attr('data-classname') : 'switchery';
                option.disabled = ($(this).attr('data-disabled')) ? true : false;
                option.disabledOpacity = ($(this).attr('data-disabled-opacity')) ? parseFloat($(this).attr('data-disabled-opacity')) : 0.5;
                option.speed = ($(this).attr('data-speed')) ? $(this).attr('data-speed') : '0.5s';
            var switchery = new Switchery(this, option);
        });
    }
};

var checkSwitcherState = function() {
    $('[data-click="check-switchery-state"]').live('click', function() {
        alert($('[data-id="switchery-state"]').prop('checked'));
    });
    $('[data-change="check-switchery-state-text"]').live('change', function() {
        $('[data-id="switchery-state-text"]').text($(this).prop('checked'));
    });
};

var renderPowerRangeSlider = function() {
    if ($('[data-render="powerange-slider"]').length !== 0) {
        $('[data-render="powerange-slider"]').each(function() {
            var option = {};
                option.decimal = ($(this).attr('data-decimal')) ? $(this).attr('data-decimal') : false;
                option.disable = ($(this).attr('data-disable')) ? $(this).attr('data-disable') : false;
                option.disableOpacity = ($(this).attr('data-disable-opacity')) ? parseFloat($(this).attr('data-disable-opacity')) : 0.5;
                option.hideRange = ($(this).attr('data-hide-range')) ? $(this).attr('data-hide-range') : false;
                option.klass = ($(this).attr('data-class')) ? $(this).attr('data-class') : '';
                option.min = ($(this).attr('data-min')) ? parseInt($(this).attr('data-min')) : 0;
                option.max = ($(this).attr('data-max')) ? parseInt($(this).attr('data-max')) : 100;
                option.start = ($(this).attr('data-start')) ? parseInt($(this).attr('data-start')) : null;
                option.step = ($(this).attr('data-step')) ? parseInt($(this).attr('data-step')) : null;
                option.vertical = ($(this).attr('data-vertical')) ? $(this).attr('data-vertical') : false;
            if ($(this).attr('data-height')) {
                $(this).closest('.slider-wrapper').height($(this).attr('data-height'));
            }
            var switchery = new Switchery(this, option);
            var powerange = new Powerange(this, option);
        });
    }
};

var FormSliderSwitcher = function () {
	"use strict";
    return {
        //main function
        init: function () {
            // switchery
            renderSwitcher();
            checkSwitcherState();
            
            // powerange slider
            renderPowerRangeSlider();
        }
    };
}();


/* 1.3 Builder Right Sidebar */

var getRandomValue = function() {
    var value = [];
    for (var i = 0; i<= 19; i++) {
        value.push(Math.floor((Math.random() * 10) + 1));
    }
    return value;
};

var handleRenderKnobDonutChart = function() {
    $('.knob').knob();
};

var handleRenderSparkline = function() {
    var red		    = '#F44336',
        pink		= '#E91E63',
        orange	    = '#FF9800',
        yellow       = '#FFEB3B';
        
    var options = {
        height: '50px',
        width: '100%',
        fillColor: 'transparent',
        type: 'bar',
        barWidth: 9.9,
        barColor: red
    };
    
    var value = getRandomValue();
    $('#sidebar-sparkline-1').sparkline(value, options);
    
    value = getRandomValue();
    options.barColor = pink;
    $('#sidebar-sparkline-2').sparkline(value, options);
    
    value = getRandomValue();
    options.barColor = orange;
    $('#sidebar-sparkline-3').sparkline(value, options);
    
    value = getRandomValue();
    options.barColor = yellow;
    $('#sidebar-sparkline-4').sparkline(value, options);
};

var PageWithTwoSidebar = function () {
	"use strict";
    return {
        //main function
        init: function () {
          
        }
    };
}();


/* 1.4 FormPlugins */

var handleDatepicker = function() {
    $('#datepicker-default').datepicker({
        todayHighlight: true
    });
    $('#datepicker-inline').datepicker({
        todayHighlight: true
    });
    $('.input-daterange').datepicker({
        todayHighlight: true
    });
    $('#datepicker-disabled-past').datepicker({
        todayHighlight: true
    });
    $('#datepicker-autoClose').datepicker({
        todayHighlight: true,
        autoclose: true
    });
};

var handleIonRangeSlider = function() {
    $('#default_rangeSlider').ionRangeSlider({
        min: 0,
        max: 5000,
        type: 'double',
        prefix: "$",
        maxPostfix: "+",
        prettify: false,
        hasGrid: true
    });
    $('#customRange_rangeSlider').ionRangeSlider({
        min: 1000,
        max: 100000,
        from: 30000,
        to: 90000,
        type: 'double',
        step: 500,
        postfix: " €",
        hasGrid: true
    });
    $('#customValue_rangeSlider').ionRangeSlider({
        values: [
            'January', 'February', 'March',
            'April', 'May', 'June',
            'July', 'August', 'September',
            'October', 'November', 'December'
        ],
        type: 'single',
        hasGrid: true
    });
};

var handleFormMaskedInput = function() {
    "use strict";
    $("#masked-input-date").mask("99/99/9999");
    $("#masked-input-phone").mask("(999) 999-9999");
    $("#masked-input-tid").mask("99-9999999");
    $("#masked-input-ssn").mask("999-99-9999");
    $("#masked-input-pno").mask("aaa-9999-a");
    $("#masked-input-pkey").mask("a*-999-a999");
};

var handleFormColorPicker = function () {
    "use strict";
    $('#colorpicker').colorpicker({format: 'hex'});
    $('#colorpicker-prepend').colorpicker({format: 'hex'});
    $('#colorpicker-rgba').colorpicker();
};

var handleFormTimePicker = function () {
    "use strict";
    $('#timepicker').timepicker();
};

var handleFormPasswordIndicator = function() {
    "use strict";
    $('#password-indicator-default').passwordStrength();
    $('#password-indicator-visible').passwordStrength({targetDiv: '#passwordStrengthDiv2'});
};

var handleJqueryAutocomplete = function() {
    var availableTags = [
        'ActionScript',
        'AppleScript',
        'Asp',
        'BASIC',
        'C',
        'C++',
        'Clojure',
        'COBOL',
        'ColdFusion',
        'Erlang',
        'Fortran',
        'Groovy',
        'Haskell',
        'Java',
        'JavaScript',
        'Lisp',
        'Perl',
        'PHP',
        'Python',
        'Ruby',
        'Scala',
        'Scheme'
    ];
    $('#jquery-autocomplete').autocomplete({
        source: availableTags
    });
};

var handleBootstrapCombobox = function() {
    $('.combobox').combobox();
};

var handleTagsInput = function() {
    $('.bootstrap-tagsinput input').focus(function() {
        $(this).closest('.bootstrap-tagsinput').addClass('bootstrap-tagsinput-focus');
    });
    $('.bootstrap-tagsinput input').focusout(function() {
        $(this).closest('.bootstrap-tagsinput').removeClass('bootstrap-tagsinput-focus');
    });
};

var handleSelectpicker = function() {
    $('.selectpicker').selectpicker('render');
};

var handleJqueryTagIt = function() {
    $('#jquery-tagIt-default').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-inverse').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-white').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-primary').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-info').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-success').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-warning').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
    $('#jquery-tagIt-danger').tagit({
        availableTags: ["c++", "java", "php", "javascript", "ruby", "python", "c"]
    });
};

var handleDateRangePicker = function() {
    $('#default-daterange').daterangepicker({
        opens: 'right',
        format: 'MM/DD/YYYY',
        separator: ' to ',
        startDate: moment().subtract('days', 29),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2018',
    },
    function (start, end) {
        $('#default-daterange input').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
    
    
    $('#advance-daterange span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

    $('#advance-daterange').daterangepicker({
        format: 'MM/DD/YYYY',
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        minDate: '01/01/2012',
        maxDate: '12/31/2015',
        dateLimit: { days: 60 },
        showDropdowns: true,
        showWeekNumbers: true,
        timePicker: false,
        timePickerIncrement: 1,
        timePicker12Hour: true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right',
        drops: 'down',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-primary',
        cancelClass: 'btn-default',
        separator: ' to ',
        locale: {
            applyLabel: 'Submit',
            cancelLabel: 'Cancel',
            fromLabel: 'From',
            toLabel: 'To',
            customRangeLabel: 'Custom',
            daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
            monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            firstDay: 1
        }
    }, function(start, end, label) {
        $('#advance-daterange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
    });
};

var handleSelect2 = function() {
    $(".default-select2").select2();
    $(".multiple-select2").select2({ placeholder: "Select a state" });
};

var handleDateTimePicker = function() {
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker({
        format: 'LT'
    });
    $('#datetimepicker3').datetimepicker();
    $('#datetimepicker4').datetimepicker();
    $("#datetimepicker3").on("dp.change", function (e) {
        $('#datetimepicker4').data("DateTimePicker").minDate(e.date);
    });
    $("#datetimepicker4").on("dp.change", function (e) {
        $('#datetimepicker3').data("DateTimePicker").maxDate(e.date);
    });
};

var FormPlugins = function () {
	"use strict";
    return {
        //main function
        init: function () {
			handleJqueryTagIt();
			handleFormColorPicker();
        }
    };
}();


/* 1.5 */
