<?php
  
  get_header();

  while(have_posts()) {
    the_post();
    //get_template_part('template-parts/banner');
    pagebanner();
    ?>

    <div class="container">

        <div class="row">
            <div class="col-12 person">
                <div class="person__portrait">
                    <?php the_post_thumbnail('personPortrait'); ?>
                </div>
                <div class="person__text">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>

      <?php 
      
      $relatedCompany = get_field('company_employe');

      if($relatedCompany) {
        echo '<hr class="section-break">';
        echo '<h2 class="">Company</h2>';
        echo '<ul class="link-list min-list">';
        foreach($relatedCompany as $program) { ?>
          <li><a href="<?= get_the_permalink($program); ?>"><?= get_the_title($program); ?></a></li>
        <?php }
        echo '</ul>';
      }

      ?>

    </div>
    

    
  <?php }

  get_footer();

?>