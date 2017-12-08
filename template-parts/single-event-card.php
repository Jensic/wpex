<div class="card single-event-ex__container__card">
    <div class="card-header single-event-ex__container__card__header">
        <ul class="nav nav-tabs card-header-tabs single-event-ex__container__card__header__nav">
            <li class="nav-item single-event-ex__container__card__header__nav__item">
                <a class="nav-link single-event-ex__container__card__header__nav__item__home-link" href="<?php echo get_post_type_archive_link('event'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Event Home</a>
            </li>
        </ul>
        <h4 class="card-title single-event-ex__container__card__header__title"><?php the_title(); ?></h4>
    </div>
    <div class="card-body single-event-ex__container__card__body">
        <p class="card-text single-event-ex__container__card__body__text"><?php the_content(); ?></p>
    </div>
</div>