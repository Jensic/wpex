<?php get_header(); ?>

<?php //get_template_part('template-parts/banner-404'); ?>
<?php 
pageBanner(array(
    'title'     => '404',
    'subtitle'  => 'Something whent wrong',
    'photo'     => get_theme_file_uri('/media/img/newsbanner.jpg')
));
?> 

<div class="container">
	<div class="row">
		<main class="col-12" role="main">

			<section class="error-404">
				<header class="error-404__header">
					<h1 class="error-404__header__title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'ex' ); ?></h1>
				</header><!-- .page-header -->
				<div class="error-404__content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'ex' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
