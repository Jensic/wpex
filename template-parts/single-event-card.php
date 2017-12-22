<?php 
                  
    $likeCount = new WP_Query(array(
        'post_type'   =>  'like',
        'meta_query'  =>  array(
            array(
                'key'     => 'liked_event_id',
                'compare' => '=',
                'value'   => get_the_ID()
            )
        )
    ));

    $existStatus = 'no';

    if (is_user_logged_in()) {
        $existQuery = new WP_Query(array(
            'author'      =>  get_current_user_id(),
            'post_type'   =>  'like',
            'meta_query'  =>  array(
            array(
                'key'     => 'liked_event_id',
                'compare' => '=',
                'value'   => get_the_ID()
            )
            )
      ));

        if($existQuery->found_posts) {
            $existStatus = 'yes';
        }
    }

?>


<div class="card single-event-ex__container__card">
    <div class="card-header single-event-ex__container__card__header">
        <ul class="nav nav-tabs card-header-tabs single-event-ex__container__card__header__nav">
            <li class="nav-item single-event-ex__container__card__header__nav__item">
                <a class="nav-link single-event-ex__container__card__header__nav__item__home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home</a>
            </li>
        </ul>
        <h4 class="card-title single-event-ex__container__card__header__title"><?php the_title(); ?></h4>
        <span class="like-box" data-like="<?php echo $existQuery->posts[0]->ID; ?>" data-event="<?php the_ID(); ?>" data-exists="<?php echo $existStatus; ?>">
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <i class="fa fa-heart" aria-hidden=true></i>
            <span class="like-count"><?php echo $likeCount->found_posts; ?></span>
        </span>
    </div>
    <div class="card-body single-event-ex__container__card__body">
        <p class="card-text single-event-ex__container__card__body__text"><?php the_content(); ?></p>
    </div>
</div>