$(function () {
	"use strict";

	if ($("#datePickerExample, #datePickerExample1").length) {
		$("#datePickerExample, #datePickerExample1").datepicker({
			format: "yyyy-mm-dd",
			todayHighlight: true,
			autoclose: true,
		});
	}
});
