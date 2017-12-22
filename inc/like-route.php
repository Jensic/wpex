<?php

add_action('rest_api_init', 'exLikeRoutes');

function exLikeRoutes() {
    register_rest_route('ex/v1','manageLike', array(
        'methods'   =>  'POST',
        'callback'  =>  'createLike'
    ));

    register_rest_route('ex/v1','manageLike', array(
        'methods'   =>  'DELETE',
        'callback'  =>  'deleteLike'
    ));
}

function createLike($data) {
    if(is_user_logged_in()) {
        $event = sanitize_text_field($data['eventId']);

        $existQuery = new WP_Query(array(
            'author'      =>  get_current_user_id(),
            'post_type'   =>  'like',
            'meta_query'  =>  array(
              array(
                'key'     => 'liked_event_id',
                'compare' => '=',
                'value'   => $event
              )
            )
          ));

        if($existQuery->found_posts == 0 AND get_post_type($event) == 'event') {
            return wp_insert_post(array(
                'post_type'     => 'like',
                'post_status'   => 'publish',
                'post_title'    =>  '2nd LIKE Test',
                'meta_input'    =>  array(
                    'liked_event_id'    => $event
                )
            ));
        } else {
            die("Invalid event id");
        }
   
    } else {
        die("Only logged in users can create a like.");
    }
}

function deleteLike($data) {
    $likeId = sanitize_text_field($data['like']);
    if(get_current_user_id() == get_post_field('post_author', $likeId) AND get_post_type($likeId) == 'like') {
        wp_delete_post($likeId, true);
        return 'Congrats, like deleted.';
    } else {
        die("You do not have permission to delete that.");
    }
}