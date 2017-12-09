<?php get_header(); ?>

<?php get_template_part('template-parts/banner-page') ?>

<div class="container">
	<div class="row">
		<main class="col-12 page" role="main">

			<?php
			while (have_posts() ) : the_post();

				get_template_part('template-parts/page/content', 'page');

				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
