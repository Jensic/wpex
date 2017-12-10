<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <?php get_template_part('template-parts/banner'); ?>

    <div class="container">
        <div class="row sitemap">
            <main class="col-6">
                <?php the_content(); ?>    
            </main>
        </div>
    </div>
    
  <?php }

get_footer(); ?>