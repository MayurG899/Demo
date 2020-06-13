<?php
/**
 * Created by PhpStorm.
 * User: andres
 * Date: 25/02/2015
 * Time: 01:49 PM
 */

echo get_header() ?>


<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li><a href="<?=base_url('/admin')?>">Home</a></li>
        <li class="active">Install</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">BuilderEngine Installation <small>Administration Control Panel</small></h1>
    <!-- end page-header -->


    <!-- begin row -->
    <div class="row">
        <!-- begin col-+1 -->
        <div class="col-md-10">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    </div>
                    <h4 class="panel-title">Install</h4>
                </div>
                <div class="panel-body panel-form">
                            <div class="row">
                                <div class="col-xs-5 col-xs-offset-1">
                                    <?=form_fieldset('Site Information');?>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="site_name">Site Name</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="site_name" name="site_name" placeholder="Enter Site Name">
                                    </div>

                                    <?=form_fieldset_close();?>
                                    <br>

                                    <?=form_fieldset('Administrator Information');?>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="admin_user">Username</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="admin_user" name="admin_user" placeholder="Enter Administrator Username">
                                    </div>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="admin_email">Email Address</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="admin_email" name="admin_email" placeholder="Enter admin email address">
                                    </div>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="admin_pass">Admin user Password</label>
                                        <input type="password" class="form-control form-control-100 validate-field be_verify" id="admin_pass" name="admin_pass" placeholder="Enter admin password">
                                    </div>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="admin_pass_re">Confirm password</label>
                                        <input type="password" class="form-control form-control-100 validate-field be_verify" id="admin_pass_re" name="admin_pass_re" placeholder="confirm password">
                                    </div>

                                    <?=form_fieldset_close();?>

                                </div>


                                <div class="col-xs-4 col-xs-offset-1">

                                    <?=form_fieldset('Database Information');?>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="db_host">MySQL Host</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="db_host" name="db_host" placeholder="MySQL host name or IP">
                                    </div>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="db_user">MySQL Username</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="db_user" name="db_user" placeholder="Enter MySQL Username">
                                    </div>


                                    <div class="form-group" style="max-width:240px">
                                        <label for="db_pass">MySQL Password</label>
                                        <input type="password" class="form-control form-control-100 validate-field be_verify" id="db_pass" name="db_pass" placeholder="Enter MySQL password">
                                    </div>

                                    <div class="form-group" style="max-width:240px">
                                        <label for="db_name">MySQL Database</label>
                                        <input type="text" class="form-control form-control-100 validate-field be_verify" id="db_name" name="db_name" placeholder="Enter DataBase name">
                                    </div>

                                    <?=form_fieldset_close();?>

                                </div>

                            </div>

                            <div class="text-center">
                                <p>When you feel you are ready, please click the install button.</p>

                                <div id="zone_progressbar" class="hidden">
                                    <div id="status_message" class="text-center"></div>
                                    <?=get_progress()?>
                                </div>

                                <button id="install-button" style="margin-left: -80px; margin-top: 10px; margin-bot: 20px; font-weight: bold;margin-bottom: 20px;" class="ready btn btn-primary rounded">Begin Installation</button>
                            </div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <!-- end col -->


    </div>
    <!-- end row -->








    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->
<!-- end #content -->
<?php echo get_footer()?>




<script>
    // new validation
    $(document).ready(function(){
        setInterval(function(){
            var numItems = $('.has-success').length;
			var ready = $("#install-button").hasClass('ready');
            if(numItems >= 9 && ready){
                $("#install-button").prop( "disabled", false);
			}
        }, 1000);
    });
    dbHost = '';
    dbUser = '';
    dbPass = '';
    dbName = '';
    $('.validate-field').blur(function(){
        var fieldId = $(this).attr('id');
        if(fieldId == 'db_host')
            dbHost = $(this).attr('value');
        else if(fieldId == 'db_user')
            dbUser = $(this).attr('value');
        else if(fieldId == 'db_pass')
            dbPass = $(this).attr('value');
        else if(fieldId == 'db_name')
            dbName = $(this).attr('value');
        else{
            fieldValue = $(this).attr('value');
            if(fieldValue.trim().length > 0)
                give_feedback(fieldId, 'generic-success');
            else
                give_feedback(fieldId, 'generic-fail');
        }
        //check if time to perform connection check
        if(dbHost != '' && dbUser != '' && dbName != '')
            perform_connection_check();
    });
    function perform_connection_check(){
        console.log('check time!');
        $.ajax({
            type: "POST",
            url: "<?=base_url()?>index.php/admin/install/validate_info",
            data: {db_host: dbHost, db_user: dbUser, db_pass: dbPass, db_name: dbName},
            success:function(data) {
                toggle_db_fields_feedback(data);
            }
        });
    }
    function toggle_db_fields_feedback(response){
        give_feedback('db_host', response);
        give_feedback('db_user', response);
        give_feedback('db_pass', response);
        give_feedback('db_name', response);
    }
    function give_feedback(fieldId, response){
        var fieldParent = $('#' + fieldId).parent();
        if(response == 'connected'){
            fieldParent.removeClass('has-error').addClass('has-feedback').addClass('has-success');
            if(fieldParent.find('span.help-block').length != 0){
                fieldParent.find('span.help-block').remove();
                fieldParent.find('span.glyphicon').remove();
            }
            fieldParent.append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true">');
        }
        else if(response == 'denied'){
            fieldParent.removeClass('has-success').addClass('has-feedback').addClass('has-error');
            if(fieldParent.find('span.help-block').length != 0){
                fieldParent.find('span.help-block').remove();
                fieldParent.find('span.glyphicon').remove();
            }
            if(fieldId == 'db_name')
                fieldParent.append('<span class="help-block" style="color:red;">Access Denied. Username, password or database are not correct</span><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true">');
        }
        else if(response == 'generic-success'){
            fieldParent.removeClass('has-error').addClass('has-feedback').addClass('has-success');
            if(fieldParent.find('span.help-block').length != 0){
                fieldParent.find('span.help-block').remove();
                fieldParent.find('span.glyphicon').remove();
            }
            fieldParent.append('<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true">');
        }
        else if(response == 'generic-fail'){
            fieldParent.removeClass('has-success').addClass('has-feedback').addClass('has-error');
            if(fieldParent.find('span.help-block').length != 0){
                fieldParent.find('span.help-block').remove();
                fieldParent.find('span.glyphicon').remove();
            }
            fieldParent.append('<span class="help-block" style="color:red;">Field is required</span><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true">');
        }
        else{
            fieldParent.removeClass('has-success').addClass('has-feedback').addClass('has-error');
            if(fieldParent.find('span.help-block').length != 0){
                fieldParent.find('span.help-block').remove();
                fieldParent.find('span.glyphicon').remove();
            }
            if(fieldId == 'db_host')
                fieldParent.append('<span class="help-block" style="color:red;">Unable to Connect</span><span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true">');
        }
    }
    // old validations
    var validations = {
        db_credentials: false,
        txt_admin_email: false,
        txt_admin_password: false,
        txt_admin_passwordconf: false,
        txt_admin_username: false,
        txt_db_host: false,
        txt_db_name: false,
        txt_sitename: false
    };

    var installation_completed = false;
    var test = false;
    var test_dbdata = {
        host: 'localhost',
        user: 'cmstestb_46363',
        password: 'password',
        db: 'cmstestb_gsdg'
    };
    var test_site = {
        sitename: 'cmstest.builderengine.net',
        host: test_dbdata.host,
        user: test_dbdata.user,
        password: test_dbdata.password,
        db: test_dbdata.db
    };
    var test_admin ={
        admin_username: 'artiz',
        admin_password: '1024',
        admin_email: 'andresmg85@gmail.com'
    };


    function install_db()
    {
        $( "#status_message p:last").html(
            $('<p>').append($('<s>', {text: 'Preparing installation...'}))
        );

        $('#status_message').append(
            $('<p>', {text: '1. Installing Database. This may take a minute'})
        );
        _data = {
            host: $("#db_host").val(),
            user: $("#db_user").val(),
            password: $("#db_pass").val(),
            db: $("#db_name").val(),
        };

        $.post("<?=base_url()?>index.php/admin/install/install_db/",
            (test) ? test_dbdata : _data ,
            function (data) {
                if(data == "success"){
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '1. Installing Database. This may take a minute'}))
                    );
                    set_progress(40);
                    setTimeout(function(){configure_website();}, 1250);
                }else {
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '1. Installing Database. This may take a minute > error'}))
                    );
                    $('#status_message').append(
                        $('<p>', {text: data, style: 'color:red;'})
                    );
                    $("#install-button").prop( "disabled", false );
                }
            });
    }

    function configure_website()
    {

        $('#status_message').append(
            $('<p>', {text: '2. Configuring Website'})
        );

        $.post("<?=base_url()?>index.php/admin/install/configure/",
            (test) ? test_site :
            {
                sitename: $("#site_name").val(),
                host: $("#db_host").val(),
                user: $("#db_user").val(),
                password: $("#db_pass").val(),
                db: $("#db_name").val()
            }, function (data) {
                if(data.result){
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '2. Configuring Website'}))
                    );
                    set_progress(60);
                    setTimeout(function(){create_admin();}, 1250);
                }
                else{
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '2. Configuring Website > error'}))
                    );
                    $('#status_message').append(
                        $('<p>', {text: data, style: 'color:red;'})
                    );
                    $("#install-button").prop( "disabled", false );
                }
            }, 'json');
    }



    function create_admin()
    {

        $('#status_message').append(
            $('<p>', {text: '3. Creating Administrator Account'})
        );



        $.post("<?=base_url();?>index.php/admin/install/create_admin",
            (test) ? test_admin :
            {
                admin_username: $("#admin_user").val(),
                admin_password: $("#admin_pass").val(),
                admin_email: $("#admin_email").val()

            }, function (data) {

                if(data == "success"){
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '3. Creating Administrator Account'}))
                    );
                    set_progress(80);
                    setTimeout(function(){finishing();}, 1250);
                }else {
                    $( "#status_message p:last").html(
                        $('<p>').append($('<s>', {text: '3. Creating Administrator Account > error'}))
                    );
                    $('#status_message').append(
                        $('<p>', {text: data, style: 'color:red;'})
                    );
                    $("#install-button").prop( "disabled", false );
                }

            });
    }


    function finishing()
    {
        $('#status_message').append(
            $('<p>', {text: '4. Finishing Installation'})
        );

        $.get("<?=base_url()?>index.php/admin/install/finish", function (data) {

            if(data == "success"){
                $( "#status_message p:last").html(
                    $('<p>').append($('<s>', {text: '4. Finishing Installation'}))
                );
                set_progress(100);
                setTimeout(function(){
                    installation_completed = true;
                    $('#status_message').append(
                        $('<p>', {text: 'Congratulations! Your website installation is successfully completed.', style: 'color:blue;'})
                    );
                    $("#install-button").html("Redirect to Website");
                    $("#install-button").prop( "disabled", false );
                    if(test)
                        window.location = "/index.php/admin/update/index";

                }, 1750);
            }else {
                $( "#status_message p:last").html(
                    $('<p>').append($('<s>', {text: '4. Finishing Installation > error'}))
                );
                $('#status_message').append(
                    $('<p>', {text: data, style: 'color:red;'})
                );
                $("#install-button").prop( "disabled", false );
            }

        });
    }



    set_progress = function(payload){
        $('#zone_progressbar > .progress > .progress-bar').attr({
            style: "min-width: 2em; width: " +payload+ "%;",
            "aria-valuenow": payload
        });

        $('#zone_progressbar > .progress > .progress-bar').text(payload+'%');
    };


    $(document).ready(function(){
        $("#install-button").prop( "disabled", true );
        $("#install-button").click(function(){
			$(this).removeClass('ready');
            if(installation_completed) 
				window.location = "<?=base_url('/admin')?>";
			else{
                $(this).prop( "disabled", true );
                $('#zone_progressbar').removeClass( "hidden" ).addClass( "show" );
                set_progress(0);
                $('#status_message').html(
                    $('<p>', {text: 'Preparing installation...'})
                );

                setTimeout(function(){
                    set_progress(5);
                    install_db();
                }, 1250);
            }
        });

        if(test){
            $("#install-button").click();
        }else{
            $( ".be_verify-old" ).blur(function(){
                _data = {
                    input: $(this).attr('name'),
                    value: _value = $(this).val()
                };

                if(_data.input == '#admin_pass_re'){
                    _data.password = $('#admin_pass').val();
                }
                if(_data.input == '#db_user' || _data.input == '#db_pass'){
                    if($('#db_user').val() == '' || $('#db_pass').val() == '' || $('#db_host').val() == ''){
                        return;
                    }else{
                        _data.input = 'db_credentials';
                        _data.username = $('#db_user').val();
                        _data.passowrd = $('#db_pass').val();
                        _data.host = $('#db_host').val();
                    }

                }
                if(_data.input == '#db_name'){
                    if($('#db_user').val() == '' || $('#db_pass').val() == '' || $('#db_host').val() == ''){
                        return;
                    }else{
                        _data.username = $('#db_user').val();
                        _data.passowrd = $('#db_pass').val();
                        _data.host = $('#db_host').val();
                    }
                }

                _url = "<?php echo  base_url(); ?>index.php/admin/install/ajax_validate";

                $.post( _url, _data, function( data ) {

                    if(data.result){//feedback correct
                        validations[data.input] = true;
                        if(data.input == 'db_credentials'){
                            _parent = $('#db_user, #db_pass').parent();
                        }else {
                            _parent = $('#' + data.input).parent();
                        }
                        _parent.removeClass( "has-error" ).addClass( "has-success has-feedback" );
                        _parent.children("span").remove();
                        _parent.append(
                            $('<span>',{class:'glyphicon glyphicon-ok form-control-feedback', "aria-hidden":'true'})
                        );
                        _parent.append(
                            $('<span>',{id:data.input, class:'sr-only', text:'(success)'})
                        );
                    }else{
                        validations[data.input] = false;
                        if(data.input == 'db_credentials'){
                            _parent = $('#db_user, #db_pass').parent();
                        }else {
                            _parent = $('#' + data.input).parent();
                        }
                        _parent.removeClass( "has-success" ).addClass( "has-error has-feedback" );
                        _parent.children("span").remove();
                        _parent.append(
                            $('<span>',{class:"help-block",style:'color:red;' , text:data.error_message})
                        );
                        _parent.append(
                            $('<span>',{class:'glyphicon glyphicon-remove form-control-feedback', "aria-hidden":'true'})
                        );
                        _parent.append(
                            $('<span>',{id:data.input, class:'sr-only', text:'(error)'})
                        );
                    }
                }, 'json').always(function(){
                    clear = true;
                    $.each(validations,function(index, value){
                        if(!value){
                            clear = false;
                        }
                    });
                    if(clear){
                        $("#install-button").prop( "disabled", false );
                    }else{
                        $("#install-button").prop( "disabled", true );
                    }
                });
            });
        }

    });














</script>

