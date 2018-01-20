<?php get_header();

  while(have_posts()) {
    the_post(); ?>

    <?php //get_template_part('template-parts/banner-archive'); ?>
    <?php pagebanner(); ?>

    <div class="container">
        <div class="row single-event-ex">
            <div class="col-12">
                <div class="single-event-ex__container">
                    <?php get_template_part('template-parts/single-event-card'); ?>
                </div>

                <?php 

                    $relatedPrograms = get_field('related_programs');

                    if($relatedPrograms) {
                    echo '<hr class="section-break">';
                    echo '<h2 class="">Related program(s)</h2>';
                    echo '<ul class="link-list min-list">';
                    foreach($relatedPrograms as $program) { ?>
                      <li><a href="<?= get_the_permalink($program); ?>"><?= get_the_title($program); ?></a></li>
                <?php }
                    echo '</ul>';
                }

                ?>
            </div>
        </div>
    </div>
    
    <?php }

get_footer(); ?>