<article id="post-<?php the_ID(); ?>" <?php post_class('page__article'); ?>>
	<header class="page__article__header">
		<?php the_title( '<h1 class="page__article__header__title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<div class="page__article__content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page__article__content__links">' . __( 'Pages:', 'ex' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
