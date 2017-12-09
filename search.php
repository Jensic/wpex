<?php get_header(); ?>

<?php get_template_part('template-parts/banner-search'); ?>

<div class="container">
        
        <div class="row">

        <div class="col-12 search">
            <header class="search__header">
                <?php if (have_posts()) : ?>
                    <h1 class="search__header__title"><?php printf(__('Search Results for: %s', 'ex'), '<span>' . get_search_query() . '</span>'); ?></h1>
                <?php else : ?>
                    <h1 class="search__header__title"><?php _e('Nothing Found', 'ex'); ?></h1>
                <?php endif; ?>
            </header><!-- .page-header -->
        </div>

		<main class="col-12 search-main" role="main">

		<?php
		if (have_posts()) :
			/* Start the Loop */
			while (have_posts()) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part('template-parts/post/content', 'excerpt');

			endwhile; // End of the loop.

		else : ?>

			<p><?php _e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'ex'); ?></p>
			<?php
				get_search_form();

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer(); ?>
