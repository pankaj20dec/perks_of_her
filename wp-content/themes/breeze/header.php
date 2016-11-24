<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
	<?php do_action('before_head_end'); ?>
</head>
<body <?php body_class(); ?>>
	<header id="header">
		<nav id="navigation" class="navbar" role="navigation">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="mobile-logo"><?php echo the_custom_logo();?></div>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>
			<div class="col-sm-8 col-centered">
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="navbar-collapse-1">
					<?php if ( has_nav_menu( 'primary-left' ) ) : ?>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary-left',
								'menu_class'     => 'nav navbar-nav navbar-left',
							 ) );
						?>
					<?php endif; ?>

					<?php echo the_custom_logo();?>

					<?php if ( has_nav_menu( 'primary-right' ) ) : ?>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary-right',
								'menu_class'     => 'nav navbar-nav navbar-right',
							 ) );
						?>
					<?php endif; ?>
					<div class="cart-box mobile">
						<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>"></a>
					</div>
				</div>
				<!-- /.navbar-collapse -->		
			</div>
			
			<div class="cart-box">
				<a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>"></a>
			</div>
		</nav>
	</header>
