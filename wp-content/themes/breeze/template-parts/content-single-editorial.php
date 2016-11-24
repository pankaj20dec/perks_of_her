<?php
$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);
//$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '1500x600' )[0];

if(get_field('banner_image')){
	//$image = get_field('banner_image')['sizes']['1500x600'];
}

?>
<div class="col-sm-12 col-introduce text-center text-uppercase">
		<h2><?php the_title(); ?></h2>
</div>
<div class="col-sm-12 editorial-featured">
	<div class="row featured-row">
		<div class="featured-col">
			<div class="featured-left text-right">
				<span class="text-uppercase upperline-text">cool girl series</span>
				<h3 class="text-lowercase">
					<?php 
						if(get_field('editorial_sub_title')){
							echo get_field('editorial_sub_title');
						}
					?>
				</h3>
				<p>
				<span class="date"><?php echo get_the_date('M j, Y'); ?></span>
				<span class="comment">
					<?php 
							if(get_field('editorial_comment')){
								echo get_field('editorial_comment');
							}
					?>
				</span>
				<span class="location">
					<?php 
							if(get_field('editorial_location')){
								echo get_field('editorial_location');
							}
					?>
				</span>
				</p>
				<div class="featured_description">
				<?php 
							if(get_field('editorial_featured_description')){
								echo get_field('editorial_featured_description');
							}
					?>
				</div>
			</div>
			<div class="featured-right">
			<?php 
							if(get_field('editorial_featured_image')){
								?>
								<img src="<?php echo get_field('editorial_featured_image'); ?>" alt=""/>
								
								<?php
							}
					?>
			</div>	
		</div>
	</div>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="container editorial-container">
		<div class="editorial-detail">			
			<?php the_content(); ?>
		</div>
		<div class="related-posts">
			<!-- begin custom related loop, isa --> 
				<h3 class="text-uppercase text-center">Related Posts:</h3>
				<div class="related-block-items">
				<?php  
				
				// arguments
				$args = array(
				'post_type' => 'editorial',
				'post_status' => 'publish',
				'posts_per_page' => 2, 
				'orderby' => 'rand',				
				'post__not_in' => array ($post->ID),

				);

				$related_items = new WP_Query( $args );
				// loop over query
				if ($related_items->have_posts()) :
				$i = 1;
				while ( $related_items->have_posts() ) : $related_items->the_post();
				$tn_id = get_post_thumbnail_id( $loop->ID );
				$img = wp_get_attachment_image_src( $tn_id, '' );
				$img_width = $img[1];
				$img_height = $img[2];

				if($img_width <= $img_height){
				$style ="potrait";
				
				}
				else{
				$style = "landscape";
				
				}
				$x = 1;
				?>
				
				<?php if($img_width < $img_height){
				while($x <= 2) {	
					
				?>
				
				<div class="editorial-item-block col-sm-6 <?php echo $style.$k ?> ">
						<div class="editorial-item text-center">
							<div class="item-content">
								
								<?php the_post_thumbnail(); ?>
								
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
				 $x++;
				 break;
				}
				
				}
				$i++;
				endwhile;

				

				endif;
				// Reset Post Data
				wp_reset_postdata();
				?> 

				<!-- end custom related loop, isa -->
			</div>
		</div>
	</div>
	
	<?php // get_template_part( 'template-parts/latest', 'blog' ); ?>
	<div class="container">
		<footer class="entry-footer">
			<?php breeze_entry_meta(); ?>
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'breeze' ),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-## -->
