<?php
get_header(); ?>
	<?php if ( have_posts() ) : ?>
		<div class="banner-slider page-default">
			<div class="col-sm-9 col-sm-offset-3 banner-width">
				<?php
					the_archive_title( '<h1 class="title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>
		</div>
		<?php
		while ( have_posts() ) : the_post();
			get_template_part( 'template-parts/content', get_post_format() );
		endwhile;

		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'          => __( 'Previous page', 'breeze' ),
			'next_text'          => __( 'Next page', 'breeze' ),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'breeze' ) . ' </span>',
		) );
	else :
		get_template_part( 'template-parts/content', 'none' );
	endif;
	?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>