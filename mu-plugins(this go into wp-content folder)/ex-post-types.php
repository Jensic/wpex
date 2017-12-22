<?php
function ex_post_types () {
	// Around Post Type
	register_post_type('around', array(
		'capability_type'	=>	'around',
		'map_meta_cap'		=>	true,
		'supports'    => array('title', 'editor', 'excerpt'),
		'rewrite'     =>  array('slug'  =>  'arounds'),
		'has_archive' =>  true,
		'public'      =>  true,
		'labels'      =>  array(
			'name'          =>  'Around',
			'add_new_item'  =>  'Add New Around',
			'edit_item'     =>  'Edit Around',
			'all_items'     =>  'All Arounds',
			'singular_name' =>  'Around'
		),
		'menu_icon' =>  'dashicons-location-alt'
	));
	
	// Event Post Type
	register_post_type('event', array(
		'capability_type'	=> 'event',
		'map_meta_cap'		=>	true,
		'supports'    	=> array('title', 'editor', 'excerpt', 'thumbnail'),
		'rewrite'     	=>  array('slug'  =>  'events'),
		'has_archive'	=>  true,
		'public'      	=>  true,
		'labels'      	=>  array(
			'name'          =>  'Events',
			'add_new_item'  =>  'Add New Event',
			'edit_item'     =>  'Edit Event',
			'all_items'     =>  'All Events',
			'singular_name' =>  'Event'
		),
		'menu_icon' =>  'dashicons-calendar'
	));
  
	//Company
	register_post_type('company', array(
		'supports'    => array('title', 'editor', 'thumbnail'),
		'rewrite'     =>  array('slug'  =>  'companies'),
		'has_archive' =>  true,
		'public'      =>  true,
		'labels'      =>  array(
			'name'          =>  'Companies',
			'add_new_item'  =>  'Add New Company',
			'edit_item'     =>  'Edit Company',
			'all_items'     =>  'All Companies',
			'singular_name' =>  'Company'
		),
		'menu_icon' =>  'dashicons-awards'
	));
  
    // Person Post Type
    register_post_type('person', array(
		'show_in_rest'	=>	true,
		'supports'    => array('title', 'editor', 'thumbnail'),
		'public'      =>  true,
		'labels'      =>  array(
			'name'          =>  'Persons',
			'add_new_item'  =>  'Add New Person',
			'edit_item'     =>  'Edit Person',
			'all_items'     =>  'All Persons',
			'singular_name' =>  'Person'
		),
		'menu_icon' =>  'dashicons-welcome-learn-more'
	  ));
	  
	     // Note Post Type
		register_post_type('note', array(
		'capability_type'	=>	'note',
		'map_meta_cap'		=>	true,
		'show_in_rest'		=>	true,
		'supports'    		=> array('title', 'editor'),
		'public'      		=>  false,
		'show_ui'			=> true,
		'labels'      		=>  array(
			'name'          =>  'Notes',
			'add_new_item'  =>  'Add New note',
			'edit_item'     =>  'Edit Note',
			'all_items'     =>  'All Notes',
			'singular_name' =>  'Note'
		),
		'menu_icon' =>  'dashicons-welcome-write-blog'
	  ));
	  
		// Like Post Type
		register_post_type('like', array(
		'supports'    		=> array('title'),
		'public'      		=>  false,
		'show_ui'			=> true,
		'labels'      		=>  array(
			'name'          =>  'Likes',
			'add_new_item'  =>  'Add New Like',
			'edit_item'     =>  'Edit Like',
			'all_items'     =>  'All Likes',
			'singular_name' =>  'Like'
		),
		'menu_icon' =>  'dashicons-heart'
	  ));
}
add_action('init', 'ex_post_types');
