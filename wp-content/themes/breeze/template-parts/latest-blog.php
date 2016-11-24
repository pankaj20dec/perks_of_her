<?php
wp_reset_query();
$args = array(
    'numberposts' => 10,
    'orderby' => 'post_date',
    'order' => 'DESC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'suppress_filters' => true );
/*
'include' => ,
'exclude' => ,
'meta_key' => ,
'meta_value' =>,
'offset' => 0,
'category' => 0,
'post_status' => 'draft, publish, future, pending, private',*/

$recent_posts = wp_get_recent_posts( $args );
if(is_array($recent_posts) && count($recent_posts) > 0)
{
	?>
	<div class="blog-post">	
		<div class="post-slider">
			<?php
			foreach( $recent_posts as $recent )
			{
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $recent["ID"] ), '500Height' );
				?>
				<div class="item">
					<div class="post-link-wrapper">
						<h4><?php echo $recent["post_title"]; ?></h4>
						<a href="<?php echo get_permalink($recent["ID"]); ?>" class="read-more button">read more</a>
					</div>				
					<?php if(!empty($image[0])){ echo sprintf( '<a href="%s" class="latest-subtitle" rel="bookmark">', esc_url( get_permalink($recent["ID"]) ) ).'<img src="'.$image[0].'"  alt="'.$recent["post_title"].'" /></a>'; } ?>
				</div>
				<?php
			}
			?>
		</div>
		<div class="post-next-slide text-right pull-right cont-right-space"></div>  
		<div class="text-center"> <a class="back-blog" href="<?php echo home_url( '/blog' ); ?>">back to blog</a> 
	</div>
	<?php
}
wp_reset_query();
?>
