<?php

  get_header();

  while(have_posts()) {
    the_post();
    pageBanner(); 
    // pageBanner(array(
    //   'title'     => 'Hello there this is the title',
    //   'subtitle'  => 'Hi, this is the subtitle',
    //   'photo'     => 'https://images.unsplash.com/photo-1494633114655-819eb91fde40?auto=format&fit=crop&w=1050&q=80&ixid=dW5zcGxhc2guY29tOzs7Ozs%3D' 
    // ));
    ?>

    <div class="container">
    
    <?php
      $theParent = wp_get_post_parent_id(get_the_ID());
      if ($theParent) { ?>
        <div class="">
      <p><a class="" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class=""><?php the_title(); ?></span></p>
    </div>
      <?php }
    ?>

    
    
    <?php 
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    if ($theParent or $testArray) { ?>
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
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
    

    <div class="">
          <?php get_search_form(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>