/**
 * Created by krastevd on 12/10/14.
 */
$("#asd").validate({
    rules: {
        password: { 
            required: true,
            minlength: 6,
            maxlength: 10,

        },
        confirm_password: { 
            equalTo: "#password",
            minlength: 6,
            maxlength: 10
        },
		tc: {
			required:true,
		}
    },
    messages:{
        password: { 
            required:"the password is required"

        },
		tc: {
			required:"this field is required"
		}
    }
});

$('.registration-buttons button').click(function(event){
    event.preventDefault();
	if ($('#tc').is(":checked"))
	{
		var tc = 'yes';
	}
	else
		var tc = 'no';
	
    var btn = $(this);
    btn.removeClass('btn-primary');
    btn.addClass('btn-warning');
    btn.text('Authenticating');
    btn.attr('disabled', 'disabled');

    setTimeout(function() {
        $.post(site_root + '/cp/ajax/registration/',
            {
                email: $("#email").val(),
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
                password: $("#password").val(),
                confirm_password: $("#confirm_password").val(),
				account_type: $("#account_type").val(),
				tc: tc
            }, function (data) {
                btn.removeClass('btn-warning');
                if(data == 'register with email'){
                    btn.addClass('btn-danger');
                    btn.text('You are registered, please activate with email.');

                    setTimeout(function() {
                        btn.removeAttr('disabled');
                        btn.text('Registration');
                        btn.removeClass('btn-danger');
                        btn.addClass('btn-primary');
                        window.location.href = site_root + "/cp/login";
                    },1500); 
                } else if(data == 'register with admin'){
                    btn.addClass('btn-danger');
                    btn.text('You are registered, but not approved.');

                    setTimeout(function() {
                        btn.removeAttr('disabled');
                        btn.text('Registration');
                        btn.removeClass('btn-danger');
                        btn.addClass('btn-primary');
                        window.location.href = site_root + "/cp/login";
                    },1500);
                }else{
                    data = $.parseJSON(data);
                    $.each(data, function(i,v){
                        $('[data-name='+i+']').html('');
                        $('[data-name='+i+']').html(v);
                    })
                    btn.addClass('btn-danger');
                    btn.text('Registration is not valid');

                    setTimeout(function() {
                        btn.removeAttr('disabled');
                        btn.text('Registration');
                        btn.removeClass('btn-danger');
                        btn.addClass('btn-primary');

                    },1000);
                }
            });
    }, 800);
})