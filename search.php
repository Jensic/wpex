<?php

get_header();
pageBanner(array(
  'title'     => 'Search Results',
  'subtitle'  => 'You searched for &ldquo;' . esc_html(get_search_query()) . '&rdquo;'
));
?>

<div class="container">
    <?php
        if(have_posts()) {
          while(have_posts()) {
            the_post(); 
            get_template_part('template-parts/page/content', get_post_type());

         }
          echo paginate_links();
        } else {
          echo '<h2 class="">No result match that search</h2>';
        }

        get_search_form();

    ?>
</div>

<?php get_footer();

?>