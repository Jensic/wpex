<article id="post-<?php the_ID(); ?>" <?php post_class('post-content'); ?>>

	<header class="post-content__header">
        <h1 class="post-content__header__h1"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

    <div class="post-content__thumbnail">
        <?php the_post_thumbnail('large'); ?>
    </div><!-- .post-thumbnail -->

	<div class="post-content__text">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
