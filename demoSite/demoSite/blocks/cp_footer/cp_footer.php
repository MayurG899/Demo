<?php
class Cp_footer_block_handler extends  block_handler{
    function info()
    {
        $info['category_name'] = "Account Dashboard";
        $info['category_icon'] = "dsf";

        $info['block_name'] = "Account Dashboard Footer";
        $info['block_icon'] = "fa-envelope-o";

        return $info;
    }

    public function generate_admin()
    {
		$this->show_placeholder();
    }

    public function generate_content()
    {
		//Controller
		global $active_controller;
		$user = &$active_controller->user;
        $CI = & get_instance();
		$this->load_generic_styles();

		//View
        $output ='
			<div class="">
				<script src="'.base_url('modules/cp/assets/plugins/slimscroll/jquery.slimscroll.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/jquery-cookie/jquery.cookie.js').'"></script>
				<!-- ================== END BASE JS ================== -->

				<!-- ================== BEGIN PAGE LEVEL JS ================== -->
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/gritter/js/jquery.gritter.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-daterangepicker/moment.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker-new.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-daterangepicker/daterangepicker.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js').'"></script>

				<script src="'.base_url('modules/cp/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/masked-input/masked-input.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/password-indicator/js/password-indicator.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-select/bootstrap-select.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js').'"></script>
				<script src="'.base_url('modules/cp/assets/js/form-plugins.demo.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/DataTables-1.10.2/js/jquery.dataTables.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/DataTables-1.10.2/js/data-table.js').'"></script>

				<script src="'.base_url('modules/cp/assets/plugins/isotope/jquery.isotope.min.js').'"></script>
				<script src="'.base_url('modules/cp/assets/plugins/parsley/dist/parsley.js').'"></script>

				<script src="'.base_url('modules/cp/assets/js/cp.js').'"></script>
				<script>
					$(document).ready(function() {
						CP.init();
					});
					$(document).ready(function(){';
					if(($CI->BuilderEngine->get_option('be_booking_event_block_start_date') != NULL && !empty($CI->BuilderEngine->get_option('be_booking_event_block_start_date'))) && ($CI->BuilderEngine->get_option('be_booking_event_block_end_date') != NULL && !empty($CI->BuilderEngine->get_option('be_booking_event_block_end_date')))){
						//add event page
						$sd = explode('/',$CI->BuilderEngine->get_option('be_booking_event_block_start_date'));
						$ed = explode('/',$CI->BuilderEngine->get_option('be_booking_event_block_end_date'));
					}else{
						$sd = explode('/','01/01/2000');
						$ed = explode('/','02/01/2000');
					}
					$output .='
						var startDate = "'.$sd[1].'/'.$sd[0].'/'.$sd[2].';"
						var endDate = "'.$ed[1].'/'.$ed[0].'/'.$ed[2].';"
						var dateRange = [];

						for (var d = new Date(startDate);
							d <= new Date(endDate);
							d.setDate(d.getDate() + 1)) {
								dateRange.push(jQuery.datepicker.formatDate("dd/mm/yy", d));
							}
							//console.log(dateRange);

						$("#default-daterange").daterangepicker({
							opens: "right",
							format: "MM/DD/YYYY",
							separator: " to ",
							startDate: moment().subtract(29,"days"),
							endDate: moment(),
							minDate: "01/01/2012",
							maxDate: "12/31/2018",
						},
						function (start, end) {
							$("#default-daterange input").val(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
						});
						
						$(".endDate").datepicker({
							format: "dd/mm/yyyy",
							datesDisabled: dateRange,
							todayHighlight:true,
							autoclose:true
						});
						$("#bookingStartDate").datepicker({
							format: "dd/mm/yyyy",
							//datesDisabled: dateRange,
							todayHighlight:true,
							autoclose:true
						});
						$("#bookingEndDate").datepicker({
							format: "dd/mm/yyyy",
							//datesDisabled: dateRange,
							todayHighlight:true,
							autoclose:true
						});
						
						$("#bookingEventStartDate").datepicker({
							format: "dd/mm/yyyy",
							startDate: "today",
							datesDisabled: dateRange,
							clearBtn: true,
							todayHighlight: true,
							autoclose: true
						});
						$("#bookingEventEndDate").datepicker({
							format: "dd/mm/yyyy",
							startDate: "today",
							datesDisabled: dateRange,
							clearBtn: true,
							todayHighlight: true,
							autoclose:true
						});

						//booking settings page
						$("#bookingSettingEventStartDate").datepicker({
							format: "dd/mm/yyyy",
							todayHighlight:true,
							autoclose:true
						});
						$("#bookingSettingEventEndDate").datepicker({
							format: "dd/mm/yyyy",
							todayHighlight:true,
							autoclose:true
						});
						$("#datetimepickerStart").datetimepicker({
							//format: "LT",
							format: "HH:mm",
						});
						$("#datetimepickerEnd").datetimepicker({
							//format: "LT",
							format: "HH:mm",
						});
						$("#datetimepicker3").datetimepicker();
						$("#datetimepicker4").datetimepicker();
						$("#datetimepicker3").on("dp.change", function (e) {
							$("#datetimepicker4").data("DateTimePicker").minDate(e.date);
						});
						$("#datetimepicker4").on("dp.change", function (e) {
							$("#datetimepicker3").data("DateTimePicker").maxDate(e.date);
						});
					});
				</script>
			</div>
		';
		if(!$user->is_guest())
			return $output;
    }
}
?>