<?php
get_header(); ?>

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();
		// Include the single post content template.
		get_template_part( 'template-parts/content', 'single' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
		<div class="container">
			<?php
			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'breeze' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'breeze' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'breeze' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'breeze' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'breeze' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
			?>
		</div>
		<?php

		// End of the loop.
	endwhile;
	?>
<?php get_footer(); ?>