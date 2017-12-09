<?php get_header();

  while(have_posts()) {
    the_post(); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col-12 page">
                <?php get_template_part('template-parts/page/content', 'page'); ?>
            </main>
        </div>
    </div>
    
  <?php }

  get_footer(); ?>