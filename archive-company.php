<?php get_header(); ?>

<?php //get_template_part('template-parts/banner2'); ?>
<?php
pageBanner(array(
    'title'     => 'Companies',
    'subtitle'  => 'We are here',
    'photo'     => get_theme_file_uri('/media/img/newsbanner.jpg')
));
?>

<div class="container">

    <div class="row">
        <div class="col-12 companies">
            <ul class="link-list min-list">

                <?php
                  while(have_posts()) {
                    the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php }
                  echo paginate_links();
                ?>

            </ul>
        </div>
    </div>

</div>

<?php get_footer(); ?>
