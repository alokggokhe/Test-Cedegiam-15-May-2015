$(document).ready(function(){
	$('span[title]').tooltip({placement:'top'});
	var is_schedule_edit = $('#is_edit').val();
	if(is_schedule_edit == 1){
		$(".form_scheduledatetime").datetimepicker({
			format: 'yyyy-mm-dd hh:ii',
			showMeridian: true,
			autoclose: true,
			todayBtn: true,
			endDate: '+1y',
			minuteStep: 30,
			todayHighlight: true,
			pickerPosition: "bottom-left"
		});
	}else{
		$(".form_scheduledatetime").datetimepicker({
			format: 'yyyy-mm-dd hh:ii',
			showMeridian: true,
			autoclose: true,
			todayBtn: true,
			startDate: new Date(),
			endDate: '+1y',
			minuteStep: 30,
			todayHighlight: true,
			pickerPosition: "bottom-left"
		});
	}	
});

function cancelSchedule(schdule_id) {
	$('.alert-message').html('You have already cancelled this session');
	$('#popupCommonAlert').modal('show');
	return false;
}
