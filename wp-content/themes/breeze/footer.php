	<footer>
		<?php if(!is_page_template('template-editorials.php') ) { ?>
			<?php if(YOUTUBE_LINK != "" || INSTAGRAM_LINK != "" || FACEBOOK_LINK != "" || TWITTER_LINK != ""){?>
			<div class="social-icons">
				<ul>
					<?php if(YOUTUBE_LINK != "") { ?> 
					<li class="icon">
						<a href="<?php echo YOUTUBE_LINK;  ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri();?>/images/youtube.png" />
						</a>
					</li>
					<?php } ?>
					
					<?php if(INSTAGRAM_LINK != "") { ?> 
					<li class="icon">
						<a href="<?php echo INSTAGRAM_LINK;  ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri();?>/images/instagram.png" />
						</a>
					</li>
					<?php } ?>
					<?php if(FACEBOOK_LINK != "") { ?> 
					<li class="icon">
						<a href="<?php echo FACEBOOK_LINK;  ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri();?>/images/facebook.png" />
						</a>
					</li>
					<?php } ?>
					
					<?php if(TWITTER_LINK != "") { ?> 
					<li class="icon">
						<a href="<?php echo TWITTER_LINK;  ?>" target="_blank">
							<img src="<?php echo get_template_directory_uri();?>/images/twitter.png" />
						</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<?php } ?>
		
		<div class="signup" style="background-image:url('<?php echo SIGNUP_BG_IMG; ?>')">
			<div class="container-fluid">
				<div class="row">
					<div class="sign-up-form">
						<div class="sign-up-content">
							<?php if ( is_active_sidebar( 'mailchimp-1' )  ) : ?>
								<aside id="secondary" class="sidebar widget-area" role="complementary">
									<?php dynamic_sidebar( 'mailchimp-1' ); ?>
								</aside><!-- .sidebar .widget-area -->
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="instagram-wrapper">
			<?php if ( is_active_sidebar( 'instagram-1' )  ) : ?>
				<?php dynamic_sidebar( 'instagram-1' ); ?>
			<?php endif; ?>
		</div>
	<?php } // if_page_template ends ?>
		<?php 
		if(FOOTER_LOGO != ""){?>
			<div class="footer-logo">
				<a href="<?php echo site_url();?>"><img src="<?php echo FOOTER_LOGO; ?>" /></a>
			</div>
		<?php } ?>
		<div class="footer-link">			
			<?php if ( has_nav_menu( 'secondary' ) ) : ?>
				<?php
					wp_nav_menu( array(
						'theme_location' => 'secondary',
						'menu_class'     => 'breadcrumb text-center',
					 ) );
				?>
			<?php endif; ?>
		</div>
		<div class="copyright">
			<ol class="breadcrumb text-center">
				<li>Copyright <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?></li>
				<li><a href="http://firstflightstudio.com" target="_blank">Fuelled by First Flight</a></li>
			</ol>
		</div>
	</footer>
	<?php wp_footer(); ?>
	
</body>
</html>
