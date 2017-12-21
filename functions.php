<?php

require get_theme_file_path('/inc/search-route.php');

function ex_custom_rest() {
    register_rest_field('post', 'authorName', array(
        'get_callback'  =>  function() {return get_the_author();}
    ));
    
    register_rest_field('note', 'userNoteCount', array(
        'get_callback'  =>  function() {return count_user_posts(get_current_user_id(), 'note');}
    ));
}

add_action('rest_api_init', 'ex_custom_rest');

function pageBanner($args = NULL) {
  // php logic will live here
  if(!$args['title']) {
    $args['title'] = get_the_title();
  }

  if(!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if(!$args['photo']) {
    if(get_field('page_banner_background_image')) {
      $args['photo'] = get_field('page_banner_background_image')['sizes'] ['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/media/img/frontbanner.jpg');
    }
  }

  ?>
    <div class="container-fluid banner">
      <div class="row banner__container" style="background-image: linear-gradient(
        to right bottom,
        rgba(126,213,111, 0.8),
        rgba(40,180,133, 0.8)),
        url(<?php echo $args['photo']; ?>);">
       <div class="banner__container__logo-box">
            <img src="<?php echo get_theme_file_uri('media//img/logo-white.png') ?>" alt="Logo" class="banner__container__logo-box__logo">
        </div>
        <div class="col-12 banner__container__text-box">
            <h1 class="heading-primary">
                <span class="heading-primary--main"><?php echo $args['title']; ?></span>
                <span class="heading-primary--sub"><?php echo $args['subtitle']; ?></span>
            </h1>
        </div>
      </div>
    </div>
<?php 
}

function ex_files() {
    wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyCZ0BQMj9jdo7LxG2sBQHgU2zw8TLJn0Zs', NULL, '1.0', true);
    //wp_enqueue_script('ex-js', get_theme_file_uri('/js/all.js'), NULL, microtime(), true);
    wp_enqueue_script('all', get_template_directory_uri() . '/js/all.js', array ('jquery' ), null, microtime(), true);
    
    wp_enqueue_script('popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js');
    
    wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
    
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i|Lato:100,300,400,700,900');
    
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    //wp_enqueue_style('ex_styles', get_stylesheet_uri());
    wp_enqueue_style('bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', false, microtime(), 'all');
    
    wp_localize_script('all', 'exData', array(
    'root_url'  => get_site_url(),
    'nonce'     =>  wp_create_nonce('wp_rest')
    ));
    
    // Register Custom Navigation Walker
    require_once('inc/class-wp-bootstrap-navwalker.php');
    
}

add_action('wp_enqueue_scripts', 'ex_files');

function ex_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));
    add_image_size('personLandscape', 400, 260, true);
    add_image_size('personPortrait', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'ex_features');

function ex_menus() {
    register_nav_menus( array(
    	'primary'      => __('Primary Menu', 'ex'),
        'footer'       => __('Footer Menu', 'ex'),
        'footer2'       => __('Footer Menu 2', 'ex'),
        'footer3'       => __('Footer Menu 3', 'ex'),
	));
}

add_action('init', 'ex_menus');

function bootstrap_nav() {
    wp_nav_menu(array(
        'theme_location'    => 'primary',
        'depth'             => 2,
        'container'         => 'div',
        'container_class'   => 'collapse navbar-collapse navbar-ex__links',
        'container_id'      => 'navbar',
        'menu_class'        => 'navbar-nav navbar-ex__links__ul',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker())
    );
}

function bootstrap_footer() {
    wp_nav_menu(array(
        'theme_location'    => 'footer',
        'depth'             => 2,
        'container'         => false,
        'menu_class'        => 'navbar-nav navbar-ex__links__ul',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker())
    );
}

function bootstrap_footer2() {
    wp_nav_menu(array(
        'theme_location'    => 'footer2',
        'depth'             => 2,
        'container'         => false,
        'menu_class'        => 'navbar-nav navbar-ex__links__ul',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker())
    );
}

function bootstrap_footer3() {
    wp_nav_menu(array(
        'theme_location'    => 'footer3',
        'depth'             => 2,
        'container'         => false,
        'menu_class'        => 'navbar-nav navbar-ex__links__ul',
        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
        'walker'            => new WP_Bootstrap_Navwalker())
    );
}

function ex_widgets_init() {
	register_sidebar( array(
		'name'          => __('Sidebar', 'ex'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your sidebar.', 'ex'),
		'before_widget' => '<section id="%1$s" class="sidebar__widget-area__widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="sidebar__widget-area__widget__title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __('Footer 1', 'ex'),
		'id'            => 'sidebar-2',
		'description'   => __('Add widgets here to appear in your footer.', 'ex'),
		'before_widget' => '<section id="%1$s" class="sidebar__widget-area__widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="sidebar__widget-area__widget__title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __('Footer 2', 'ex'),
		'id'            => 'sidebar-3',
		'description'   => __('Add widgets here to appear in your footer.', 'ex'),
		'before_widget' => '<section id="%1$s" class="sidebar__widget-area__widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="sidebar__widget-area__widget__title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ex_widgets_init' );

function ex_adjust_queries($query) {
    if(!is_admin() AND is_post_type_archive('campus') AND $query->is_main_query()) {
    $query->set('posts_per_page', -1);
    }

  if(!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
    $query->set('orderby', 'title');
    $query->set('order', 'ASC');
    $query->set('posts_per_page', -1);
  }

 if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
     $today = date('Ymd');
     $query->set('meta_key', 'event_date');
     $query->set('orderby', 'meta_value_num');
     $query->set('order', 'ASC');
     $query->set('meta_query', array(
                array(
                    'key'       =>  'event_date',
                    'compare'   =>  '>=',
                    'value'     =>  $today,
                    'type'      => 'numeric'
                )
            ));
 }   
}

add_action('pre_get_posts', 'ex_adjust_queries');

// Removing Archive: in front of title
add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});

function exMapKey($api) {
  $api['key'] = 'AIzaSyCZ0BQMj9jdo7LxG2sBQHgU2zw8TLJn0Zs';
  return $api;
}

add_filter('acf/fields/google_map/api', 'exMapKey');

// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontEnd');

function redirectSubsToFrontEnd() {
    $ourCurrentUser = wp_get_current_user();
    
    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
        wp_redirect(site_url('/'));
        exit;
    }
}


add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar() {
    $ourCurrentUser = wp_get_current_user();
    
    if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber') {
        show_admin_bar(false);
    }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl() {
    return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS() {
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', false, microtime(), 'all');
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
}

add_filter('login_headertitle', 'ourLoginTitle');

function ourLoginTitle() {
  // return 'Hello <strong class="my-class">There</strong>';
  return get_bloginfo('name');
}

// force note posts to be private
add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

function makeNotePrivate($data, $postarr) {
  if($data['post_type'] == 'note') {
    if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID']) {
      die("You have reached youre note limit.");
    }

    $data['post_content'] = sanitize_textarea_field($data['post_content']);
    $data['post_title'] = sanitize_text_field($data['post_title']);
  }

  if($data['post_type'] == 'note' AND $data['post_status'] != 'trash') {
    $data['post_status'] = "private";
  }
  return $data;
}