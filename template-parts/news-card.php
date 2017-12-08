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