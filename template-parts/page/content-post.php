<div class="">
    <h2 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
    <div class="">
    <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
    </div>

    <div class="">
    <?php the_excerpt(); ?>
    <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
    </div>

</div>