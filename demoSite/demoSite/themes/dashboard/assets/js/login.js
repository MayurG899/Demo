/*
BuilderEngine Dashboard
*/
    $('.login-buttons button').click(function(event){
        event.preventDefault();

        var btn = $(this);
        btn.removeClass('btn-primary');
        btn.addClass('btn-warning');
        btn.text('Authenticating');
        btn.attr('disabled', 'disabled');

        setTimeout(function() {
            $.post(site_root + '/admin/ajax/verify_admin_login/',
                {
                    user: encodeURIComponent($("#user").val()),
                    pass: encodeURIComponent($("#password").val())
                }, function (data) {
                    btn.removeClass('btn-warning');

                    if (data == "success") {
                        btn.addClass('btn-success');
                        btn.text('Authenticated');
                        setTimeout(function() {
                            window.location.href = site_root + "/admin/main/dashboard";
                        },500);
                    } else if(data == "denied") {
                        btn.addClass('btn-danger');
                        btn.text('You do not have this permission');

                        setTimeout(function() {
                            btn.removeAttr('disabled');
                            btn.text('Login');
                            btn.removeClass('btn-danger');
                            btn.addClass('btn-primary');

                        },800);
                    } else if(data == "banned") {
                        btn.addClass('btn-danger');
                        btn.text('Account suspended due to security reasons');

                        setTimeout(function() {
                            btn.removeAttr('disabled');
                            btn.text('Login');
                            btn.removeClass('btn-danger');
                            btn.addClass('btn-primary');
							$('#securityAlert').css('display','block');
                        },800);
                    } else {
                        btn.addClass('btn-danger');
                        btn.text('Invalid username or password');

                        setTimeout(function() {
                            btn.removeAttr('disabled');
                            btn.text('Login');
                            btn.removeClass('btn-danger');
                            btn.addClass('btn-primary');

                        },800);
                    }
                });



        }, 500);
    })