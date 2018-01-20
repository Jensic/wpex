<?php get_header(); ?>

<?php //get_template_part('template-parts/banner-archive'); ?>
<?php pagebanner(); ?>

<div class="container">
    <div class="row events">
        <div class="col-12">
            <?php
    
                $today = date('Ymd');
                $pastEvents = new WP_Query(array(
                    'paged'             =>  get_query_var('paged', 1),
                    'post_type'         =>  'event',
                    'meta_key'          =>  'event_date',
                    'orderby'           =>  'meta_value_num',
                    'order'             =>  'ASC',
                    'meta_query'        =>  array(
                        array(
                            'key'       =>  'event_date',
                            'compare'   =>  '<',
                            'value'     =>  $today,
                            'type'      => 'numeric'
                        )
                    )
                ));

              while($pastEvents->have_posts()) {
                $pastEvents->the_post();
                    get_template_part('template-parts/news-card');
              }
              echo paginate_links(array(
                'total'   =>  $pastEvents->max_num_pages
              ));
            ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>