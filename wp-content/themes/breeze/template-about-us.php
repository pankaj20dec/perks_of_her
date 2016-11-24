<?php
/*
Template Name: About Us
*/
get_header();
while ( have_posts() ) : the_post();
	$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);
	?>
	<div class="about-page">
		<h1 class="title"><?php the_title();?></h1>
		<div class="featured-img">
			<?php the_post_thumbnail();?>
		</div>
		<div class="about-content">
			<div class="container">
				<?php the_content();?>
			</div>
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
<?php endwhile; ?>
<?php get_footer(); ?>
