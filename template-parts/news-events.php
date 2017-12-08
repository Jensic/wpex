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
                $homepagePosts->the_post();
                get_template_part('template-parts/news-card');
            }

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
                $homepageEvents->the_post();
                get_template_part('template-parts/event-card');
            }
              wp_reset_postdata();
            ?>
            
            <p class="news__content__button"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn-ex-2 btn-ex-2--blue">View All Events</a></p>
            
          </div>
        </div>
    </div>
</div>
