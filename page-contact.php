<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <?php get_template_part('template-parts/banner'); ?>

    <div class="container">
        <div class="row contact">
            <main class="col-6 contact__form">
                <?php the_content(); ?>    
            </main>
        </div>
    </div>
    
  <?php }

get_footer(); ?>