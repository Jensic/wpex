<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    <?php get_template_part('template-parts/banner'); ?>

    <div class="container">
        <div class="row single-company">
            <div class="col-8">
                <article class="single-company__article">
                    <div class="single-company__article__header">
                        <p><a class="single-company__article__header__link" href="<?php echo get_post_type_archive_link('company'); ?>"><i class="fa fa-home" aria-hidden="true"></i> All Companies</a></p>
                        <h2 class="single-company__article__header__title"><?php the_title(); ?></h2>
                    </div>

                    <div class="single-company__article__img">
                        <?php the_post_thumbnail('medium'); ?>
                    </div>

                    <div class="single-company__article__content">
                        <?php the_content(); ?>
                    </div>
                </article>

              <?php
                $relatedPersons = new WP_Query(array(
                    'posts_per_page'    =>  -1,
                    'post_type'         =>  'person',
                    'orderby'           =>  'title',
                    'order'             =>  'ASC',
                    'meta_query'        =>  array(
                        array(
                            'key'       =>  'company_employe',
                            'compare'   =>  'LIKE',
                            'value'     =>  '"' . get_the_ID() . '"'
                        )
                    )
                ));

                if($relatedPersons->have_posts()) {
                    echo'<hr class="section-break">';
                    echo '<h2 class="">' . get_the_title() . ' Persons</h2>';

                    echo '<ul class="single-company__list">';
                    while($relatedPersons->have_posts()) {
                        $relatedPersons->the_post(); ?>
                        <li class="single-company__list__item">
                          <a class="" href="<?php the_permalink(); ?>">
                            <img class="" src="<?php the_post_thumbnail_url('thumbnail'); ?>" alt="">
                            <span class=""><?php the_title(); ?></span>
                          </a>
                        </li>
                    <?php }
                    echo '</ul>';
                }

                wp_reset_postdata();

              //WORK IN PROGRESS
                $today = date('Ymd');
                $homepageEvents = new WP_Query(array(
                    'posts_per_page'    =>  2,
                    'post_type'         =>  'event',
                    'meta_key'          =>  'event_date',
                    'orderby'           =>  'meta_value_num',
                    'order'             =>  'ASC',
                    'meta_query'        =>  array(
                        array(
                            'key'       =>  'event_date',
                            'compare'   =>  '>=',
                            'value'     =>  $today,
                            'type'      => 'numeric'
                        ),
                        array(
                            'key'       =>  'event_host',
                            'compare'   =>  'LIKE',
                            'value'     =>  '"' . get_the_ID() . '"'
                        )
                    )
                ));

                if($homepageEvents->have_posts()) {
                    echo'<hr class="section-break">';
                    echo '<h2 class="">Upcoming ' . get_the_title() . ' Events</h2>';

                    while($homepageEvents->have_posts()) {
                        $homepageEvents->the_post(); ?>
                        <div class="event-summary">
                          <a class="event-summary__date" href="#">
                            <span class="event-summary__month"><?php 
                                $eventDate = new DateTime(get_field('event_date'));
                                echo $eventDate->format('M');
                            ?></span>
                            <span class="event-summary__day"><?php echo $eventDate->format('d'); ?></span>  
                          </a>
                          <div class="event-summary__content">
                            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                            <p><?php if(has_excerpt()) {
                                echo get_the_excerpt();
                            } else {
                               echo wp_trim_words(get_the_content(), 18); 
                            } ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                          </div>
                        </div>
                    <?php }
                }

                ?>
            </div>
        </div>
    </div>
    

    
  <?php }

  get_footer();

?>