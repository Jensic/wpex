<?php

function ex_files() {
    //wp_enqueue_script('ex-js', get_theme_file_uri('/js/all.js'), NULL, microtime(), true);
    wp_enqueue_script('all', get_template_directory_uri() . '/js/all.js', array ('jquery' ), null, microtime(), true);
    
    wp_enqueue_script('popper_js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js');
    
    wp_enqueue_script('bootstrap_js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js');
    
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i|Lato:100,300,400,700,900');
    
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
    //wp_enqueue_style('ex_styles', get_stylesheet_uri());
    wp_enqueue_style('bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', false, microtime(), 'all');
    
    // Register Custom Navigation Walker
    require_once('inc/class-wp-bootstrap-navwalker.php');
    
}

add_action('wp_enqueue_scripts', 'ex_files');

function ex_features() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));
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










