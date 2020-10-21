function opendate(id)
{
	$('#datetimepicker'+id).datetimepicker({
		defaultDate: new Date(),
		minDate:new Date(),
		format: 'DD-MM-YYYY LT',
		sideBySide: true,
		showClose:true,
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down",
			previous: "fa fa-chevron-left",
			next: "fa fa-chevron-right",
			today: "fa fa-clock-o",
			clear: "fa fa-trash-o"
		}
	}).on('dp.show', function (event)
	{
		$('.btn_appointment').not('#btn_appointment_'+id).prop('disabled',true);

		if ($('#mySecondDiv').length === 0)
		{
			$('.bootstrap-datetimepicker-widget').append('<div id="mySecondDiv"><button class="btn btn-primary" id="dateContinue" onclick="dateContinue('+id+')">Continue</button></div>');
		}

		$(document).on('mouseup touchend', function (e)
		{
			var container = $('.bootstrap-datetimepicker-widget');
			if (!container.is(e.target) && container.has(e.target).length === 0)
			{
				container.parent().datetimepicker('hide');
			}
		});

	}).on('dp.hide', function (event)
	{
		$('.btn_appointment').prop('disabled',false);
	});
}

function dateContinue(id)
{
	var date		=	$('#datetimepicker'+id).find("input").val();
	var option		=	$('#btn_appointment_'+id).data("option");
	$.ajax({
		url: "home/getDateformat",
		type : "POST",
		data : {date:date},
		dataType:'json',
		success : function(response)
		{
			$('.appointmentdate').text(response.newdate);
			$('.appointmenttime').text(response.newtime);
		}
	});
	$('#appointment_id').val(id);
	$('#appointment_date').val(date);
	$('.appointmentname').text(option.app_name);
	$('.appointmentprice').text('$ '+option.app_price);
	$('#pills-tab a[href="#pills-info"]').removeClass('disabled');
	$('#pills-tab a[href="#pills-confirm"]').addClass('disabled');
	$('#pills-tab a[href="#pills-info"]').tab('show');
}

function completeAppointment()
{
	var formStatus	=	$('#appointmentform').validate().form();
	if(true == formStatus)
	{
		var first_name	=	$('#first_name').val();
		var last_name	=	$('#last_name').val();
		$('#confirm_firstname').text(first_name);
		$('#confirm_lastname').text(last_name);
		$('#pills-tab a[href="#pills-info"]').addClass('disabled');
		$('#pills-tab a[href="#pills-confirm"]').removeClass('disabled');
		$('#pills-tab a[href="#pills-confirm"]').tab('show');
	}
}

function confirmAppointment()
{
	$('#confirm_appointment').html('Booking <i class="fa fa-spinner fa-pulse fa-fw"></i>');
	var first_name			=	$('#first_name').val();
	var last_name			=	$('#last_name').val();
	var email				=	$('#email').val();
	var mobile				=	$('#mobile').val();
	var appointment_id		=	$('#appointment_id').val();
	var appointment_date	=	$('#appointment_date').val();

	$.ajax({
		url: "home/confirmAppointment",
		type : "POST",
		data : {appointment_id:appointment_id, appointment_date:appointment_date, first_name:first_name, last_name:last_name, email:email, mobile:mobile},
		dataType:'json',
		success : function(response)
		{
			if(response.status == 'success')
			{
				location.reload();
			}
			else
			{
				$('#message').html(response.message);
			}
		}
	});
	$('#confirm_appointment').text('Confirm & Submit');
}