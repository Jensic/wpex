<article id="post-<?php the_ID(); ?>" <?php post_class('search-main__article'); ?>>

	<header class="search-main__article__header">
        <?php the_title(sprintf('<h2 class="search-main__article__header__title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
	</header><!-- .entry-header -->

	<div class="search-main__article__summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
