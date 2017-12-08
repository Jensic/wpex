<?php get_header(); ?>

<?php get_template_part('template-parts/banner-archive'); ?>

<div class="container">
    <div class="row events">
        <div class="col-6">
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
