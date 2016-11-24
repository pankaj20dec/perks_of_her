<?php
	/* 	Colors
	================================================ */

	define( 'NO_HEADER_TEXT', true );

	function tcx_register_theme_customizer( $wp_customize ) {
	 
	 
	 	//primary Color
	    $wp_customize->add_setting(
	        'primary_color',
	        array(
	            'default'     => '#f7f7f7'
	        )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'primary_color',
	            array(
	                'label'      => __( 'Primary Color', 'tcx' ),
	                'section'    => 'colors',
	                'settings'   => 'primary_color'
	            )
	        )
	    );


		//secondary color
	    $wp_customize->add_setting(
	        'secondary_color',
	        array(
	            'default'     => '#000'
	        )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'secondary_color',
	            array(
	                'label'      => __( 'Secondary Color', 'tcx' ),
	                'section'    => 'colors',
	                'settings'   => 'secondary_color'
	            )
	        )
	    );



		//tertiary color
	    $wp_customize->add_setting(
	        'tertiary_color',
	        array(
	            'default'     => '#2b5c7c'
	        )
	    );

	    $wp_customize->add_control(
	        new WP_Customize_Color_Control(
	            $wp_customize,
	            'tertiary_color',
	            array(
	                'label'      => __( 'Tertiary Color', 'tcx' ),
	                'section'    => 'colors',
	                'settings'   => 'tertiary_color'
	            )
	        )
	    );
	    
	    
	    

	 
	}
	add_action( 'customize_register', 'tcx_register_theme_customizer' );

	    
	// add to head
	function tcx_customizer_css() {
	    ?>
	    <style type="text/css">
/* 		    Primary */
		    body {
		        color: <?php echo get_theme_mod( 'secondary_color' ); ?>; 			    
		    }
	        footer .copyright .breadcrumb,
	        .home-content,
	        .contact-content form input, .contact-content form select, .contact-content form textarea,
	        .comment-respond #commentform textarea.form-control, .comment-respond #commentform .nf-form-wrap.ninja-forms-form-wrap textarea, .nf-form-wrap.ninja-forms-form-wrap .comment-respond #commentform textarea { 
		        background-color: <?php echo get_theme_mod( 'primary_color' ); ?>; 
		    }



/* 			Secondary */
		    .home-banner, .banner-slider, .contact-slider,
		    #header,
		    .default-page .bg-default-half {
			    position: relative;
				background-image: none;
		    }
		    .home-banner:before, .banner-slider:before, .contact-slider:before,
		    #header:before,
		    .default-page .bg-default-half:before {
			    content: '';
			    display: block;
			    position: absolute;
			    top:0;
			    left: 0;
			    width: 50%;
				height: 100%;
		        background-color: <?php echo get_theme_mod( 'primary_color' ); ?>; 

		    }

/* Tertiary */

			footer .footer-link li.current-menu-item a, footer .footer-link a:hover,
			#header #navigation .nav > li > a:hover, #header #navigation .nav > li > a:focus, #header #navigation .nav li.current_page_item a {
				color: <?php echo get_theme_mod( 'tertiary_color' ); ?>;
			}


	    </style>
	<?php
	}
	add_action( 'before_head_end', 'tcx_customizer_css' );
	
?>
