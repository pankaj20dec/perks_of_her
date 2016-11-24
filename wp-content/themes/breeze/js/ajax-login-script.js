jQuery(document).ready(function($) {
    /***** Login ******/
        // Perform AJAX login on form submit
        $('form#signin').on('submit', function(e){
            var username = $.trim($('form#signin #login_username').val());
            var password = $.trim($('form#signin #login_password').val());
            var security = $.trim($('form#signin #security').val());
            
            $('form#signin p.status').show().html(ajax_login_object.loadingmessage);
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: { 
                    'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                    'username': username, 
                    'password': password, 
                    'security': security },
                success: function(data){
                    $('form#signin p.status').html(data.message);
                    if (data.loggedin == true){
                        document.location.href = ajax_login_object.redirecturl;
                    }
                }
            });
            e.preventDefault();
        });
    /***** Login ******/

    /**** Forgot Password ****/
        // Perform AJAX forget password on form submit
        $('form#reset-password').on('submit', function(e){
            $('p.status', this).show().html(ajax_login_object.loadingmessage);
            ctrl = $(this);
                        var user_login = $.trim($('form#reset-password #forgot_user_login').val());
            var forgotsecurity = $.trim($('form#reset-password #forgotsecurity').val());

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: { 
                    'action': 'ajaxforgotpassword',
                    'user_login': user_login, 
                    'security': forgotsecurity, 
                },
                success: function(data){
                    $('p.status',ctrl).html(data.message);
                }
            });
            e.preventDefault();
            return false;
        });
    /**** Forgot Password ****/

    /***** Signup ******/
        // Perform AJAX login/register on form submit
        $('form#signup').on('submit', function (e) {
            var pass        = $.trim($("#signup_password").val());
            var confrm_pass = $.trim($("#signup_confirm_password").val());
            $('p.status', this).show().html(ajax_login_object.loadingmessage);
                        if(pass != confrm_pass && pass != null)
            {
                $('p.status', this).show().html("Passwords do not match.");
                return false;
            }

            ctrl = $(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_login_object.ajaxurl,
                data: $('form#signup').serializeArray(),
                success: function (data) {
                    $('p.status', ctrl).html(data.message);
                    if (data.loggedin == true) {
                        document.location.href = ajax_login_object.redirecturl;
                    }
                }
            });
            e.preventDefault();
        });
    /***** Signup ******/
});
