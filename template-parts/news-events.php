<div class="container-fluid news">
    <div class="container news__content">
        <div class="row">
            <div class="col-sm-6">
            <h2 class="news__content__header">Latest News</h2>
            <?php 
            $today = date('Ymd');
            $homepagePosts = new WP_Query(array(
                'posts_per_page'    =>  2
            ));

            while($homepagePosts->have_posts()) {
                $homepagePosts->the_post(); ?>
                <div class="card event-summary">
                    <div class="card-header">
                        <a class="event-summary__date" href="<?php the_permalink(); ?>">
                            <span class="event-summary__date__month"><?php the_time('M'); ?></span>
                            <span class="event-summary__date__day"><?php the_time('d'); ?></span>  
                      </a>
                    </div>
                  <div class="card-body event-summary__content">
                    <h5 class="card-title event-summary__content__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p class="card-text"><?php if(has_excerpt()) {
                        echo get_the_excerpt();
                    } else {
                       echo wp_trim_words(get_the_content(), 18); 
                    } ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                  </div>
                </div>
            <?php }

            ?>

            <p class="news__content__button"><a href="<?= site_url('/blog'); ?>" class="btn-ex-2 btn-ex-2--blue">View All News</a></p>

            </div>
          <div class="col-sm-6">
           <h2 class="news__content__header">Upcoming Events</h2>
           <?php 
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
                    )
                )
            ));

            while($homepageEvents->have_posts()) {
                $homepageEvents->the_post(); ?>
                <div class="card event-summary">
                    <div class="card-header">
                        <a class="event-summary__date" href="#">
                            <span class="event-summary__date__month"><?php 
                                $eventDate = new DateTime(get_field('event_date'));
                                echo $eventDate->format('M');
                            ?></span>
                            <span class="event-summary__date__day"><?php echo $eventDate->format('d'); ?></span>  
                      </a>
                    </div>
                  <div class="card-body event-summary__content">
                    <h5 class="card-title event-summary__content__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                    <p class="card-text"><?php if(has_excerpt()) {
                        echo get_the_excerpt();
                    } else {
                       echo wp_trim_words(get_the_content(), 18); 
                    } ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
                  </div>
                </div>
            <?php }
              wp_reset_postdata();
            ?>
            
            <p class="news__content__button"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn-ex-2 btn-ex-2--blue">View All Events</a></p>
            
          </div>
        </div>
    </div>
</div>
