<?php
get_header(); ?>
<div class="page">
	
	<?php if (is_shop() || is_product_category() ) {
	?>	
	<?php
	$shop_id = get_option(woocommerce_shop_page_id); $shop_post = get_post($shop_id);
	$sub_heading = get_post_meta($shop_id, "breeze_custom_sub_heading", true);
	
	?>
<!--
		<div class="banner-slider clearfix">
			<div class="col-sm-7  banner-width">
				<h1 class="title"><?php echo $shop_post->post_title; ?>.</h1>
				<div class="banner-wrapper">					
					<div class="banner">
						<ul class="">
							<li><?php echo get_the_post_thumbnail( get_option( 'woocommerce_shop_page_id' ) ); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-sm-5">
				<div class="content cont-right-space">					
					<?php
					if(!empty($sub_heading))
					{
						?>
						<h2><?php echo nl2br($sub_heading); ?></h2>
						<?php
					}
					?>
				</div>
			</div>
		</div>	
-->
		
		
		<?php $catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC')); 
	?>
	<?php $post_slug=$post->post_name;	 ?>
		<div class="page-content">
			<div class="container">
				<h1 class="shop-title text-center">Shop</h1>
				<div class="shop-slider-container">
					<h5>this weeks picks</h5>
					<div class="row clearfix">
						<?php 
							$args = array(
								'post_type'=> 'shop-slider',
								'post_per_page'=> 10,
								'order'=>'ASC'
								);
						$the_query = new WP_Query( $args ); ?>
						<div class="col-md-4 centered shop-slider">
							<ul class="slides">
								<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
									<li>
										<?php the_post_thumbnail('latest-img'); ?>
									</li>
								<?php 
								endwhile;
								wp_reset_postdata();
								?>
							</ul>
							<div class="slider-arrows">
								<div id="sliderPrev"></div>
								<div id="sliderNext"></div>
							</div>
						</div>
					</div>
				</div>
				<?php woocommerce_content(); ?>
				<div class="text-center">
					<i class="fa fa-spinner fa-spin loader_product" style="display:none;" aria-hidden="true"></i>
					<a id="more_posts" class="back_link" href="javascript:void(0);">view more </a>
					<span class="no_more" style="display:none;">No more products</span>
				</div>
				<div class="latest-post">
					<h5>we think you’ll like:</h5>
					<div class="row clearfix">
						<?php $the_query = new WP_Query( 'posts_per_page=2' ); ?>
						<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
							<div class="latest-item-block col-sm-6">
								<div class="latest-item text-center">
									<div class="latest-item-content">
										<?php the_post_thumbnail('latest-img'); ?>
										<div class="item-desc">					
											<a href="<?php echo get_the_permalink(); ?>">
										<span class="date"> <?php echo get_the_date('j/m/y'); ?> </span>
										<h3><?php the_title(); ?></h3>
										</a>
										</div>
									</div>
									<a href="<?php echo get_the_permalink(); ?>" class="item-content-hover"></a>
								</div>
							</div>
						<?php 
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	} else {
	?>
	
		<div class="container">
			<?php woocommerce_content(); ?>
		</div>
	<?php } ?>
</div>
<?php get_footer(); ?>
