<?php get_header(); ?>

<?php //get_template_part('template-parts/banner-archive'); ?>
<?php pagebanner(); ?>

<div class="container">
    <div class="row">

        <div class="col-12">
            <?php if (have_posts()) : ?>
                <header>
                    <h1><?php the_archive_title(); ?></h1>
                    <p><?php the_archive_description(); ?></p>
                </header><!-- .page-header -->
            <?php endif; ?>
        </div>

		<main class="col-12" role="main">

		<?php
		if (have_posts()) : ?>
			<?php
			/* Start the Loop */
			while (have_posts()) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part('template-parts/post/content', get_post_format());

			endwhile;

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
