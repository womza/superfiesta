<?php
/*
Plugin Name: Tuscany Post Types
Plugin URI: #
Description: Add Custom Post Types for this theme
Version: 1.0
Author: AvaThemes
Author URI: http://themeforest.net/user/AVAThemes
*/

add_action( 'init', 'hipsterific_testimonials_posttype', 0 );
function hipsterific_testimonials_posttype() {

	$labels = array(
		'name'                => _x( 'Testimonials', 'Post Type General Name', 'tuscany' ),
		'singular_name'       => _x( 'Testimonial', 'Post Type Singular Name', 'tuscany' ),
		'menu_name'           => __( 'Testimonials', 'tuscany' ),
		'parent_item_colon'   => __( 'Parent Testimonial:', 'tuscany' ),
		'all_items'           => __( 'All Testimonials', 'tuscany' ),
		'view_item'           => __( 'View Testimonials', 'tuscany' ),
		'add_new_item'        => __( 'Add New Testimonial', 'tuscany' ),
		'add_new'             => __( 'Add New', 'tuscany' ),
		'edit_item'           => __( 'Edit Testimonial', 'tuscany' ),
		'update_item'         => __( 'Update Testimonial', 'tuscany' ),
		'search_items'        => __( 'Search Testimonial', 'tuscany' ),
		'not_found'           => __( 'Not found', 'tuscany' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'tuscany' ),
	);
	$args = array(
		'label'               => __( 'testimonials', 'tuscany' ),
		'description'         => __( 'Testimonials Post Type', 'tuscany' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-quote',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'testimonials', $args );
}

add_action( 'init', 'tuscany_team_posttype', 0 );
function tuscany_team_posttype() {

	$labels = array(
		'name'                => _x( 'Members', 'Post Type General Name', 'tuscany' ),
		'singular_name'       => _x( 'Member', 'Post Type Singular Name', 'tuscany' ),
		'menu_name'           => __( 'Team', 'tuscany' ),
		'parent_item_colon'   => __( 'Parent Member:', 'tuscany' ),
		'all_items'           => __( 'All Members', 'tuscany' ),
		'view_item'           => __( 'View Member', 'tuscany' ),
		'add_new_item'        => __( 'Add New Member', 'tuscany' ),
		'add_new'             => __( 'Add New', 'tuscany' ),
		'edit_item'           => __( 'Edit Member', 'tuscany' ),
		'update_item'         => __( 'Update Member', 'tuscany' ),
		'search_items'        => __( 'Search Member', 'tuscany' ),
		'not_found'           => __( 'Not found', 'tuscany' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'tuscany' ),
	);
	$args = array(
		'label'               => __( 'our-team', 'tuscany' ),
		'description'         => __( 'Team Members', 'tuscany' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'our-team', $args );
}

add_action( 'init', 'tuscany_events_posttype', 0 );
function tuscany_events_posttype() {

	$labels = array(

		'name'                => _x( 'Events', 'Post Type General Name', 'hipster' ),

		'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'hipster' ),

		'menu_name'           => __( 'Events', 'hipster' ),

		'parent_item_colon'   => __( 'Parent Event:', 'hipster' ),

		'all_items'           => __( 'All Events', 'hipster' ),

		'view_item'           => __( 'View Event', 'hipster' ),

		'add_new_item'        => __( 'Add New Event', 'hipster' ),

		'add_new'             => __( 'Add Event', 'hipster' ),

		'edit_item'           => __( 'Edit Event', 'hipster' ),

		'update_item'         => __( 'Update Event', 'hipster' ),

		'search_items'        => __( 'Search Event', 'hipster' ),

		'not_found'           => __( 'Not found', 'hipster' ),

		'not_found_in_trash'  => __( 'Not found in Trash', 'hipster' ),

	);

	$args = array(

		'label'               => __( 'our-events', 'hipster' ),

		'description'         => __( 'Events Post Type', 'hipster' ),

		'labels'              => $labels,

		'supports'            => array( 'title', 'excerpt', 'thumbnail', 'editor' ),

		'hierarchical'        => false,

		'public'              => true,

		'show_ui'             => true,

		'show_in_menu'        => true,

		'show_in_nav_menus'   => true,

		'show_in_admin_bar'   => true,

		'menu_position'       => 5,

		'menu_icon'           => 'dashicons-calendar-alt',

		'can_export'          => true,

		'has_archive'         => true,

		'exclude_from_search' => true,

		'publicly_queryable'  => true,

		'capability_type'     => 'page',

	);

	register_post_type( 'our-events', $args );
}

add_action( 'init', 'tuscany_gallery_posttype', 0 );
function tuscany_gallery_posttype() {

	$labels = array(
		'name'                => _x( 'Galleries', 'Post Type General Name', 'tuscany' ),
		'singular_name'       => _x( 'Gallery', 'Post Type Singular Name', 'tuscany' ),
		'menu_name'           => __( 'Galleries', 'tuscany' ),
		'parent_item_colon'   => __( 'Parent Gallery:', 'tuscany' ),
		'all_items'           => __( 'All Galleries', 'tuscany' ),
		'view_item'           => __( 'View Gallery', 'tuscany' ),
		'add_new_item'        => __( 'Add New Gallery', 'tuscany' ),
		'add_new'             => __( 'Add New', 'tuscany' ),
		'edit_item'           => __( 'Edit Gallery', 'tuscany' ),
		'update_item'         => __( 'Update Gallery', 'tuscany' ),
		'search_items'        => __( 'Search Gallery', 'tuscany' ),
		'not_found'           => __( 'Not found', 'tuscany' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'tuscany' ),
	);
	$args = array(
		'label'               => __( 'our-gallery', 'tuscany' ),
		'description'         => __( 'Galleries', 'tuscany' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'our-gallery', $args );
}