<?php
get_header(); ?>
<div class="default-page">
	<div class="bg-default-half"></div>
	<div class="container">
		<div class="content">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'breeze' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'breeze' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div>
	</div>
</div>
<?php get_footer(); ?>