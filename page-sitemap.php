<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <?php //get_template_part('template-parts/banner'); ?>
    <?php pagebanner(); ?>

    <div class="container">
        <div class="row sitemap">
            <main class="col-12">
                <?php the_content(); ?>    
            </main>
        </div>
    </div>
    
  <?php }

get_footer(); ?>