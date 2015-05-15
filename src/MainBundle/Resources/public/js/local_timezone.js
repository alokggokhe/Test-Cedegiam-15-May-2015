$(document).ready(function(){
	var today               	= new Date();
	var time_zone_offset    	= parseInt(-today.getTimezoneOffset());
	var jan 					= new Date(today.getFullYear(), 0, 1);
    var jul 					= new Date(today.getFullYear(), 6, 1);
    var std_timezone_offset 	= Math.max(jan.getTimezoneOffset(), jul.getTimezoneOffset());
    var daylight_savings_time 	= 0; 

    if(today.getTimezoneOffset() < std_timezone_offset) {
    	daylight_savings_time = 1;
    }

    var object = new Object;
	object.time_zone_offset 		= time_zone_offset;
	object.daylight_savings_time 	= daylight_savings_time;
	$.ajax({
		type:"POST",
		url: ajax_set_user_timezone_url,
		data: object,
		async:false,
		success:function (callback) {
			try {
				if (callback.s_status != 'success') {
					$('.alert-message').html(callback.data);
					$('#popupCommonAlert').modal('show');
				}
			} catch (s_error) {
				$('.alert-message').html(s_error);
				$('#popupCommonAlert').modal('show');
			}
		}
	});
});
