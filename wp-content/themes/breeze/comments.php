<?php
if ( post_password_required() ) {
	return;
}
?>
<div class="page comments-area">
	<div class="container">
		<?php if ( have_comments() ) : ?>
			<h2 class="comments-title">
				<?php
					$comments_number = get_comments_number();
					if ( 1 === $comments_number ) {
						/* translators: %s: post title */
						printf( _x( 'One thought on &ldquo;%s&rdquo;', 'comments title', 'fields' ), get_the_title() );
					} else {
						printf(
							/* translators: 1: number of comments, 2: post title */
							_nx(
								'%1$s thought on &ldquo;%2$s&rdquo;',
								'%1$s thoughts on &ldquo;%2$s&rdquo;',
								$comments_number,
								'comments title',
								'fields'
							),
							number_format_i18n( $comments_number ),
							get_the_title()
						);
					}
				?>
			</h2>

			<?php the_comments_navigation(); ?>

			<ol class="comment-list">
				<?php
					wp_list_comments( array(
						'style'       => 'ol',
						'short_ping'  => true,
						'avatar_size' => 42,
					) );
				?>
			</ol><!-- .comment-list -->

			<?php the_comments_navigation(); ?>

		<?php endif; // Check for have_comments(). ?>

		<?php
			// If comments are closed and there are comments, let's leave a little note, shall we?
			if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="no-comments"><?php _e( 'Comments are closed.', 'fields' ); ?></p>
		<?php endif; ?>

	<div class="row">
		<div class="col-md-6">
			<?php
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );
				
				$comments_args = array(
					// change the title of send button
					'label_submit'=>'Submit',
					// change the title of the reply section
					'title_reply'=>'Leave a comment',
					// remove "Text or HTML to be displayed after the set of comment fields"
					//'comment_notes_after' => '<p><small>Your comment may be subject to editorial review.</small></p>',
					// redefine your own textarea (the comment body)
					'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="Type your comment" class="form-control" rows="6" cols="37" wrap="hard"></textarea></p>',
					'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' =>
				  '<p class="comment-form-author">' .
				  '<input id="author" class="form-control" placeholder="Name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				  '" size="30"' . $aria_req . ' required="required"/>' . ( $req ? '<span style="color:red" class="required">*</span>' : '' ) . '</p>',

				'email' =>
				  '<p class="comment-form-email">' .
				  '<input id="email" class="form-control" placeholder="Email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				  '" size="30"' . $aria_req . ' required="required" />' . ( $req ? '<span style="color:red" class="required">*</span>' : '' ) . '</p>',

				'url' =>
				  '<p class="comment-form-url">' .
				  '<input id="url" class="form-control" placeholder="Website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
				  '" size="30" /></p>'
				)
			  ),
			);
				comment_form($comments_args); ?>
			</div>
		</div>
	</div>
</div>