<?php get_header(); ?>

<?php //get_template_part('template-parts/banner-archive'); ?>
<?php
pageBanner(array(
    'title'     => 'Events',
    'subtitle'  => 'have some fun together',
    'photo'     => get_theme_file_uri('/media/img/newsbanner.jpg')
));
?>

<div class="container">
    <div class="row events">
        <div class="col-12">
            <?php
              while(have_posts()) {
                the_post();
                get_template_part('template-parts/event-card');
              }
              echo paginate_links();
            ?>

            <hr class="section-break">

            <p>Looking for a recap of past events<a href="<?= site_url('/past-events') ?>">Check out our past events</a>.</p>
        </div>
    </div>
</div>

<?php get_footer(); ?>
