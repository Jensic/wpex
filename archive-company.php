<?php get_header(); ?>

<?php get_template_part('template-parts/banner2'); ?>

<div class="container">

    <div class="row companies">
        <div class="col-6">
            <ul class="link-list min-list">

                <?php
                  while(have_posts()) {
                    the_post(); ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                  <?php }
                  echo paginate_links();
                ?>

            </ul>
        </div>
    </div>

</div>

<?php get_footer(); ?>
