<?php

add_action('rest_api_init', 'exRegisterSearch');

function exRegisterSearch() {
    register_rest_route('ex/v1', 'search', array(
        'methods'       => WP_REST_SERVER::READABLE,
        'callback'      => 'exSearchResults'
    ));
}

function exSearchResults($data) {
    $mainQuery = new WP_Query(array(
        'post_type'         =>  array('post', 'page', 'person', 'around', 'company', 'event'),
        's'                 =>  sanitize_text_field($data['term']),
        'posts_per_page'    => -1
    ));

    $results = array(
        'generalInfo'   => array(),
        'persons'       => array(),
        'companies'     => array(),
        'events'        => array(),
        'arounds'       => array()
    );

    while($mainQuery->have_posts()) {
        $mainQuery->the_post();

        if(get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title'         => get_the_title(),
                'permalink'     => get_the_permalink(),
                'postType'      => get_post_type(),
                'authorName'    => get_the_author()
            ));
        }

        if(get_post_type() == 'person') {
            array_push($results['persons'], array(
                'title'         => get_the_title(),
                'permalink'     => get_the_permalink(),
                'image'         => get_the_post_thumbnail_url(0, 'personLandscape')
            ));
        }

        if(get_post_type() == 'around') {
            $relatedAround = get_field('related_around');

            if($relatedAround) {
                foreach($relatedAround as $around) {
                    array_push($results['arounds'], array(
                        'title'     => get_the_title($around),
                        'permalink' => get_the_permalink($around)
                    ));
                }
            }

            array_push($results['arounds'], array(
                'title'         => get_the_title(),
                'permalink'     => get_the_permalink(),
                'id'            => get_the_id()
            ));
        }

        if(get_post_type() == 'company') {
            array_push($results['companies'], array(
                'title'         => get_the_title(),
                'permalink'     => get_the_permalink()
            ));
        }

        if(get_post_type() == 'event') {
            $eventDate = new DateTime(get_field('event_date'));
            $description = null;
            if(has_excerpt()) {
                $description = get_the_excerpt();
            } else {
                $description = wp_trim_words(get_the_content(), 18); 
            }

            array_push($results['events'], array(
                'title'         => get_the_title(),
                'permalink'     => get_the_permalink(),
                'month'         => $eventDate->format('M'),
                'day'           => $eventDate->format('d'),
                'description'   => $description
            ));
        }
    }

    if($results['events']) {
        $eventsMetaQuery = array('relation' => 'OR');
        
            foreach($results['events'] as $item) {
                array_push($eventsMetaQuery, array(
                    'key'       => 'related_company',
                    'compare'   => 'LIKE',
                    'value'     => '"' . $item['id'] . '"'
                ));
            }
        
            $eventRelationshipQuery = new WP_Query(array(
                'post_type'         => array('person', 'event'),
                'meta_query'        => $eventMetaQuery
            ));
        
            while($eventRelationshipQuery->have_posts()) {
                $eventRelationshipQuery->the_post();
        
                if(get_post_type() == 'event') {
                    $eventDate = new DateTime(get_field('event_date'));
                    $description = null;
                    if(has_excerpt()) {
                        $description = get_the_excerpt();
                    } else {
                        $description = wp_trim_words(get_the_content(), 18); 
                    }
        
                    array_push($results['companies'], array(
                        'title'         => get_the_title(),
                        'permalink'     => get_the_permalink(),
                        'month'         => $eventDate->format('M'),
                        'day'           => $eventDate->format('d'),
                        'description'   => $description
                    ));
                }

                if(get_post_type() == 'person') {
                    array_push($results['persons'], array(
                        'title'         => get_the_title(),
                        'permalink'     => get_the_permalink(),
                        'image'         => get_the_post_thumbnail_url(0, 'personLandscape')
                    ));
                }
            }
        
            $results['persons'] = array_values(array_unique($results['persons'], SORT_REGULAR));
            $results['companies'] = array_values(array_unique($results['companies'], SORT_REGULAR));
    }

    return $results;

}