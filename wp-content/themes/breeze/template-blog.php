<?php
/*
Template Name: Blog
*/
get_header(); ?>
<?php
while ( have_posts() ) : the_post();
	$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);
	?>
	<div class="banner-slider featured for-blog clearfix">
		<div class="col-sm-7 banner-width">
			<div class="banner-wrapper">
				<?php
				$slider_data = get_post_meta($post->ID, "breeze_slider_data", true);
				if(is_array($slider_data))
				{
					?>
					<div class="banner">
						<ul class="slides">							
							<?php
							foreach ($slider_data as $key => $slide)
							{
								?>
								<li>
									<img src="<?php if(!empty($slide['breeze_slider_images']['url'])){ echo $slide['breeze_slider_images']['url']; } ?>" alt="" />
									<p class="flex-caption">
										<span class="rotate">
											<span class="heading-rotate">
												<?php echo $slide['breeze_slider_text'];?>
											</span> 
											<span class="subheading-rotate"><?php echo $slide['breeze_slider_small_text'];?></span>
										</span>
										<?php
										if(!empty($slide['breeze_slider_link']))
										{
											?>
											<a href="<?php echo $slide['breeze_slider_link'];?>" target="_blank">Shop now</a>
											<?php
										}?>
									</p>
								</li>
								<?php
							}
							?>
						</ul>
					</div>
					<div class="slider-function">
						<div id="sliderPrev"></div>
						<div class="slide-count"><span class="current-slide">1</span> <span>of</span> <span class="total-slides"></span></div>
						<div id="sliderNext"></div>
					</div>
					<?php
				}
				else
				{
					?>
					<div class="banner">
						<ul class="slides">
							<li>
								<?php breeze_post_thumbnail(); ?>
							</li>
						</ul>
					</div>
					<?php
				}?>
			</div>
		</div>
		<div class="col-sm-5">
			<?php
			if(!empty($sub_heading))
			{
				?>
				<h1 class="title"><?php echo nl2br($sub_heading); ?></h1>
				<?php
			}
			else
			{
				the_title( '<h1 class="title">', '</h1>' );
			}
			?>
			<div class="content cont-right-space">
				<?php the_content();?>
			</div>
		</div>		
	</div>
	<div class="container blog-page">
		<h4 class="page-title">latest.</h4>
		<div class="grid">
			<div class="grid-sizer"></div>
			<?php
			$args = array(
			'posts_per_page' => get_option('posts_per_page'),
			'orderby' => 'post_date',
			'order' => 'DESC',
			'post_type' => 'post',
			'paged' => ( get_query_var('paged') ? get_query_var('paged') : 1) );
			$the_query = new WP_Query( $args );
			if ( $the_query->have_posts() ) :
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
					$grid_size = get_post_meta($post->ID, "breeze_custom_grid_size", true);
					if(empty($grid_size))
					{
						$grid_size = 6;
					}
					?>
					<div class="grid-item--width<?php echo $grid_size; ?>">
						<img src="<?php echo $image[0];?>" alt="<?php echo the_title(); ?>" />
						<div class="blog-post-link">
							<div class="post-link-wrapper">
								<h4><?php echo the_title(); ?></h4>
								<a href="<?php echo get_permalink(); ?>" class="read-more button">read more</a>
							</div>
						</div>
					</div>
					<?php
				endwhile;
			else:
				?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php
			endif; ?>
		</div>
		<?php
		if ( $the_query->have_posts() ) :
			?>
			<div class="row">
				<div class="col-sm-6"><?php next_posts_link( '<div class="newest">newest</div>', $the_query->max_num_pages ); ?></div>
				<div class="col-sm-6 text-right"><?php previous_posts_link( '<div class="older">oldest</div>' ); ?></div>
			</div>
			<?php
		endif;
		wp_reset_postdata();
		?>
	</div>
	<?php
endwhile;
?>
<?php get_footer(); ?>