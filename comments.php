<?php

if (post_password_required()) {
	return;
}
?>

<div id="comments" class="news-comments">

	<?php
	// You can start editing here -- including this comment!
	if (have_comments()) : ?>
		<h2 class="news-comments__title">
			<?php
				$comments_number = get_comments_number();
				if ('1' === $comments_number) {
					/* translators: %s: post title */
					printf(_x('One Reply to &ldquo;%s&rdquo;', 'comments title', 'ex'), get_the_title());
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'ex'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="news-comments__list">
			<?php
				wp_list_comments(array(
					'avatar_size' => 100,
					'style'       => 'ol',
					'short_ping'  => true,
				));
			?>
		</ol>

		<?php 
	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if (! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments')) : ?>

		<p class="news-comments__no-comments"><?php _e('Comments are closed.', 'ex'); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
