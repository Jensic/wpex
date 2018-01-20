<?php 
/** 
* Template Name: About
**/
?>

<?php get_header();

  while(have_posts()) {
    the_post(); ?>
    
    <?php //get_template_part('template-parts/banner'); ?>
    <?php pagebanner(); ?>

    <div class="container">
        <div class="row">
            <div class="about">
                    
                <?php
                    $theParent = wp_get_post_parent_id(get_the_ID());
      
                    if ($theParent) { ?>
                        <div class="about__home">
                            <p><a class="about__home__link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="about__home__title"><?php the_title(); ?></span></p>
                        </div>
                  <?php }
                ?>
                
                <div class="about__container">
                
                    <?php 
                        $testArray = get_pages(array(
                            'child_of' => get_the_ID()
                        ));

                        if ($theParent or $testArray) { ?>
                            <div class="col-4 about__container__links">
                                <h2 class="about__container__links__title">
                                    <a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?>
                                    </a>
                                </h2>
                                <ul class="min-list">
                                    <?php
                                        if ($theParent) {
                                            $findChildrenOf = $theParent;
                                        } else {
                                            $findChildrenOf = get_the_ID();
                                        }

                                        wp_list_pages(array(
                                            'title_li' => NULL,
                                            'child_of' => $findChildrenOf,
                                            'sort_column' => 'menu_order'
                                        ));
                                    ?>
                                </ul>
                            </div>
                    <?php } ?>

                    <div class="col-8 about__container__content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <?php }

  get_footer(); ?>