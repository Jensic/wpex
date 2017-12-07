<?php get_header(); ?>

<?php get_template_part('template-parts/banner-news'); ?>

<?php
    while(have_posts()) {
        the_post();
        ?>
        <div class="container">
            <div class="row post">
                <div class="col-6">
                    <article class="card post__container">
                        <div class="card-img-top post__container__img">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>
                        <div class="card-body post__container__text">
                            <h2 class="card-title"><a class="post__container__text__link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p class="card-text post__container__text__excerpt"><?php the_excerpt(); ?></p>
                            <a class="post__container__text__link" href="<?php the_permalink(); ?>">Continue reading &raquo;</a>
                            <p class="card-text post__container__text__author">Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 post-links">
                <?php echo paginate_links(); ?>
            </div>
        </div>
    </div>
    <?php
?>

<?php get_footer(); ?>