$(document).ready(function(){
	var today               = new Date();
	var time_zone_abbr      = String(String(today).split("(")[1]).split(")")[0];
	var time_zone_offset    = parseInt(-today.getTimezoneOffset());
	var object = new Object;
	object.time_zone_abbr   = time_zone_abbr;
	object.time_zone_offset = time_zone_offset;
	$.ajax({
		type:"POST",
		url: ajax_set_user_timezone_url,
		data: object,
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
