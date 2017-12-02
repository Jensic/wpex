<?php

function ex_files() {
  //wp_enqueue_script('ex-js', get_theme_file_uri('/js/all.js'), NULL, microtime(), true);
    wp_enqueue_script( 'all', get_template_directory_uri() . '/js/all.js', array ( 'jquery' ), 1.1, true);
    
  //wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    
  //wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    
  //wp_enqueue_style('ex_styles', get_stylesheet_uri());
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', false, '1.0', 'all');
    
}

add_action('wp_enqueue_scripts', 'ex_files');

function ex_features() {
  add_theme_support('title-tag');
}

add_action('after_setup_theme', 'ex_features');