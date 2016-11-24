<?php
get_header(); ?>
	<div class="page">
		<div class="container">
			<?php if ( have_posts() ) : ?>
				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				<?php
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;

				// Previous/next page navigation.
				the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'dapper' ),
					'next_text'          => __( 'Next page', 'dapper' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'dapper' ) . ' </span>',
				) );
			else :
				get_template_part( 'template-parts/content', 'none' );
			endif;
			?>
		</div>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>