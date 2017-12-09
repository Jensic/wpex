<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <?php get_template_part('template-parts/banner'); ?>

    <div class="container">
        <div class="row">
            <div class="col-12 contact">
                    
            </div>
        </div>
    </div>
    
  <?php }

get_footer(); ?>