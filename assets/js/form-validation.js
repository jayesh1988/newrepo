jQuery.validator.addMethod("validate_email", function(value, element)
{
    if (/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value))
    {
        return true;
    }
    else
    {
        return false;
    }
}, "Enter valid email address");

jQuery.validator.addMethod("lettersonlys", function(value, element)
{
	return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
}, "Letters only please");

jQuery.validator.addMethod("exactlength", function(value, element, param)
{
	return this.optional(element) || value.length == param;
}, $.validator.format("Please enter exactly {0} characters."));


$("#appointmentform").validate({
	rules: {
		first_name: {
			required: true,
			maxlength:50,
			lettersonlys:true
		},
		last_name: {
			required: true,
			maxlength:50,
			lettersonlys:true
		},
		email: {
			required: true,
			email: true,
			validate_email:true
		},
		mobile: {
			required: true,
			number: true
		}
	},
	messages: {
		first_name: {
			required: "First name is required",
			maxlength: "Please enter less than 50 characters."
		},
		last_name: {
			required: "Last name is required",
			maxlength: "Please enter less than 50 characters."
		},
		email: {
			required: "Email address is required",
			email: "Enter valid email address"
		},
		mobile: {
			required: "Mobile number is required",
			number: "Enter valid mobile number"
		}
	}
});