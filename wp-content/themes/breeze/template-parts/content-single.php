<?php
$sub_heading = get_post_meta($post->ID, "breeze_custom_sub_heading", true);
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), '1500x600' )[0];

if(get_field('banner_image')){
	$image = get_field('banner_image')['sizes']['1500x600'];
}

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="banner-slider detail">
		<div class="col-sm-12  banner-width">
			<div class="banner-wrapper">
				<?php the_title( '<h1 class="title cont-left-per-space">', '.</h1>' ); ?>
				<div class="banner">
					<ul class="slides">
						<li>
							<div class="single-img" style="background-image:url('<?php echo $image; ?>');"></div><?php //breeze_post_thumbnail(); ?>
						</li>
					</ul>
				</div>
			</div>
			<div class="title-content cont-left-per-space">
				<h3><?php echo nl2br($sub_heading); ?></h3>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="detail-content">
			<?php breeze_excerpt(); ?>
			<?php
				the_content(); ?>

		
				<hr>
				<div class="sharelinks">
					<span class="ttl">Share: </span>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>	
					
					<a href="https://twitter.com/home?status=<?php the_permalink(); ?>" target="_blank">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
					
					<a data-pin-do="buttonBookmark" data-pin-custom="true" data-pin-save="false" href="https://www.pinterest.com/pin/create/button/">
						<i class="fa fa-pinterest" aria-hidden="true"></i>
					</a>
				
					<a href="mailto:?&subject=Check out this page!">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</a>
				</div>
		
		
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'breeze' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'breeze' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

				if ( '' !== get_the_author_meta( 'description' ) ) {
					get_template_part( 'template-parts/biography' );
				}
			?>




		</div>
	</div>
	<?php get_template_part( 'template-parts/latest', 'blog' ); ?>
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
