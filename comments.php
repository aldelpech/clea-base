<?php
/* If a post password is required or no comments are given and comments/pings are closed, return. */
if ( post_password_required() || ( !have_comments() && !comments_open() && !pings_open() ) )
	return;
?>

<div id="comments-template">

	<div id="comments">

		<?php if ( have_comments() ) : ?>

			<h3 id="comments-number" class="comments-header"><?php comments_number( __( 'No Responses', 'clea-base' ), __( 'One Response', 'clea-base' ), __( '% Responses', 'clea-base' ) ); ?></h3>

			<?php if ( get_option( 'page_comments' ) ) : ?>
				<div class="comments-nav">
					<?php previous_comments_link( __( '&larr; Previous', 'clea-base' ) ); ?>
					<span class="page-numbers"><?php printf( __( 'Page %1$s of %2$s', 'clea-base' ), ( get_query_var( 'cpage' ) ? absint( get_query_var( 'cpage' ) ) : 1 ), get_comment_pages_count() ); ?></span>
					<?php next_comments_link( __( 'Next &rarr;', 'clea-base' ) ); ?>
				</div><!-- .comments-nav -->
			<?php endif; ?>

			<ol class="comment-list">
				<?php wp_list_comments( hybrid_list_comments_args() ); ?>
			</ol><!-- .comment-list -->

		<?php endif; ?>

		<?php if ( pings_open() && !comments_open() ) : ?>

			<p class="comments-closed pings-open">
				<?php printf( __( 'Comments are closed, but <a href="%s" title="Trackback URL for this post">trackbacks</a> and pingbacks are open.', 'clea-base' ), esc_url( get_trackback_url() ) ); ?>
			</p><!-- .comments-closed .pings-open -->

		<?php elseif ( !comments_open() ) : ?>

			<p class="comments-closed">
				<?php _e( 'Comments are closed.', 'clea-base' ); ?>
			</p><!-- .comments-closed -->

		<?php endif; ?>

	</div><!-- #comments -->

	<?php comment_form(); // Loads the comment form. ?>

</div><!-- #comments-template -->