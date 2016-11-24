<?php
/*** Ajax Login ***/
    function ajax_login_init(){

        wp_register_script('ajax-login-script', get_template_directory_uri() . '/js/ajax-login-script.js', array('jquery') ); 
        wp_enqueue_script('ajax-login-script');

        wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'redirecturl' => home_url(),
            'loadingmessage' => __('Sending user info, please wait...', 'breeze')
        ));

        // Enable the user with no privileges to run ajax_login() in AJAX
        add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
    }

    // Execute the action only if the user isn't logged in
    if (!is_user_logged_in()) {
        add_action('init', 'ajax_login_init');
    }
    function ajax_login(){
        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-login-nonce', 'security' );

        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_login'] = $_POST['username'];
        $info['user_password'] = $_POST['password'];
        $info['remember'] = true;

        $user_signon = wp_signon( $info, false );
        if ( is_wp_error($user_signon) ){
            echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.', 'breeze')));
        } else {
            echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...', 'breeze')));
        }

        die();
    }
/*** Ajax Login ***/
/**** Forgot Password **/

    function ajax_auth_init(){
        // Enable the user with no privileges to run ajax_forgotPassword() in AJAX
        add_action( 'wp_ajax_nopriv_ajaxforgotpassword', 'ajax_forgotPassword' );
    }
    if (!is_user_logged_in()) {
        add_action('init', 'ajax_auth_init');
    }

    function ajax_forgotPassword(){
             
        global $wpdb, $wp_hasher;

        $result = array("success"=>false,"message"=>'Enter a username or e-mail address.');

        if ( isset( $_POST['user_login'] ) && check_ajax_referer( 'ajax-forgot-nonce', 'security' ) ) {
            $result = retrieve_password_ajax();
        }

        echo json_encode($result);
        die();
    }
/**** Forgot Password **/
/*** Signup Form Extra Fields ***/
    // Set woocommerce_registration_generate_password to 'yes' on pages where _scholar_coursecat is set
    add_filter('pre_option_woocommerce_registration_generate_password', 'custom_registration_auto_password');

    function custom_registration_auto_password( $option ) {
        $option = 'yes';
        return $option;
    }
    function ajax_auth_init2(){
        // Enable the user with no privileges to run ajax_register1() in AJAX
        add_action( 'wp_ajax_nopriv_ajaxregister', 'ajax_register1' );
    }

    // Execute the action only if the user isn't logged in
    if (!is_user_logged_in()) {
        add_action('init', 'ajax_auth_init2');
    }

    function ajax_register1(){
        global $wpdb;

        // First check the nonce, if it fails the function will break
        check_ajax_referer( 'ajax-register-nonce', 'signupsecurity' );

        // Nonce is checked, get the POST data and sign user on
        $info = array();
        $info['user_nicename'] = $info['nickname'] = $info['display_name'] = $info['first_name'] = sanitize_user($_POST['user_name']) ;
        $info['user_password'] = sanitize_text_field($_POST['password']);
        $info['user_login'] = $info['user_email'] = sanitize_email( $_POST['user_email']);

        // Register the user

        $new_customer = woocommerce_create_new_customer($info['user_email'],$info['user_login'],$info['user_password']);
        if (is_wp_error($new_customer))
        {
            echo json_encode(array('loggedin'=>false, 'message'=> @implode("<br />",$new_customer->get_error_messages())));
        }
        else
        {
            /**** Woocommerce updating user display_name with user_login. So reupdate his display_name with first name ******/
                // Get user data by field and data, fields are id, slug, email and login
                $user = get_user_by( 'email', $info['user_email'] );
                
                $update_user = wp_update_user( array ( 'ID' => $user->ID, 'display_name' => sanitize_user($_POST['user_name']) ) );
            /**** Woocommerce updating user display_name with user_login. So reupdate his display_name with first name ******/

            /** Make user auto login on registration **/
            $info['remember'] = true;

            $user_signon = wp_signon(apply_filters( 'woocommerce_login_credentials', $info ), false );
            /** Make user auto login on registration **/

            echo json_encode(array('loggedin'=>true, 'message'=> "Registration successfully completed."));
        }
        die();
    }
    /**
    * Validate the extra register fields.
    *
    * @param  string $username          Current username.
    * @param  string $email             Current email.
    * @param  object $validation_errors WP_Error object.
    *
    * @return void
    */
    function wooc_validate_extra_register_fields( $validation_errors ) {
        if ( isset( $_POST['user_name'] ) && empty( $_POST['user_name'] ) ) {
            $validation_errors->add( 'user_name_error', __( 'Name is required!', 'woocommerce' ) );
        }
        if ( isset( $_POST['user_email'] ) && empty( $_POST['user_email'] ) ) {
            $validation_errors->add( 'user_email_error', __( 'Email is required!.', 'woocommerce' ) );
        }
        return $validation_errors;
    }
    add_filter( 'woocommerce_registration_errors', 'wooc_validate_extra_register_fields' );
    //add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

    /**
    * Save the extra register fields.
    *
    * @param  int  $customer_id Current customer ID.
    *
    * @return void
    */
    function wooc_save_extra_register_fields( $customer_id ) {
        if ( isset( $_POST['user_name'] ) ) {
            // WordPress default first name field.
            update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['user_name'] ) );

            // WooCommerce billing first name.
            update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['user_name'] ) );
        }
    }

    add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );
/*** Signup Form Extra Fields ***/
?>