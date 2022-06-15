<?php
/**
 * Plugin Name: KSAS Classrooms
 * Plugin URI: http://krieger.jhu.edu/
 * Description: Creates a Classroom custom post type.
 * Version: 1.0
 * Author: KSAS Communications
 * Author URI: http://krieger.jhu.edu/
 * Textdomain: ksasacademic
 * License: GPLv2
 */

/** Register Custom Post Type */
function classrooms_post_type() {

	$labels = array(
		'name'                  => _x( 'Classrooms', 'Post Type General Name', 'ksasacademic' ),
		'singular_name'         => _x( 'Classroom', 'Post Type Singular Name', 'ksasacademic' ),
		'menu_name'             => __( 'Classrooms', 'ksasacademic' ),
		'name_admin_bar'        => __( 'Classroom', 'ksasacademic' ),
		'archives'              => __( 'Item Archives', 'ksasacademic' ),
		'attributes'            => __( 'Item Attributes', 'ksasacademic' ),
		'parent_item_colon'     => __( 'Parent Classroom:', 'ksasacademic' ),
		'all_items'             => __( 'All Classrooms', 'ksasacademic' ),
		'add_new_item'          => __( 'Add New Classroom', 'ksasacademic' ),
		'add_new'               => __( 'New Classroom', 'ksasacademic' ),
		'new_item'              => __( 'New Item', 'ksasacademic' ),
		'edit_item'             => __( 'Edit Classroom', 'ksasacademic' ),
		'update_item'           => __( 'Update Classroom', 'ksasacademic' ),
		'view_item'             => __( 'View Classroom', 'ksasacademic' ),
		'view_items'            => __( 'View Items', 'ksasacademic' ),
		'search_items'          => __( 'Search classrooms', 'ksasacademic' ),
		'not_found'             => __( 'No classrooms found', 'ksasacademic' ),
		'not_found_in_trash'    => __( 'No classrooms found in Trash', 'ksasacademic' ),
		'featured_image'        => __( 'Featured Image', 'ksasacademic' ),
		'set_featured_image'    => __( 'Set featured image', 'ksasacademic' ),
		'remove_featured_image' => __( 'Remove featured image', 'ksasacademic' ),
		'use_featured_image'    => __( 'Use as featured image', 'ksasacademic' ),
		'insert_into_item'      => __( 'Insert into item', 'ksasacademic' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'ksasacademic' ),
		'items_list'            => __( 'Items list', 'ksasacademic' ),
		'items_list_navigation' => __( 'Items list navigation', 'ksasacademic' ),
		'filter_items_list'     => __( 'Filter items list', 'ksasacademic' ),
	);
	$args   = array(
		'labels'              => $labels,
		'description'         => __( 'Classroom information pages.', 'ksasacademic' ),
		'supports'            => array( 'title', 'custom-fields', 'thumbnail' ),
		'taxonomies'          => array( 'classroom type' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-welcome-learn-more',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
		'rewrite'             => array( 'slug' => 'classroom' ),
		'show_in_rest'        => true,
	);
	register_post_type( 'classroom', $args );

}
add_action( 'init', 'classrooms_post_type', 0 );

// ** Custom Taxonomies */

// hook into the init action and call create_classroom_type_taxonomies when it fires.
add_action( 'init', 'create_classroom_type_hierarchical_taxonomy', 0 );

// create a custom taxonomy name it classroom_type for the posts.

function create_classroom_type_hierarchical_taxonomy() {

	// Add new taxonomy, make it hierarchical like categories.
	// first do the translations part for GUI.

	$labels = array(
		'name'              => _x( 'Classroom Type', 'taxonomy general name' ),
		'singular_name'     => _x( 'Classroom Type', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Classroom Types' ),
		'all_items'         => __( 'All Classroom Types' ),
		'parent_item'       => __( 'Parent Classroom Type' ),
		'parent_item_colon' => __( 'Parent Classroom Type:' ),
		'edit_item'         => __( 'Edit Classroom Type' ),
		'update_item'       => __( 'Update Classroom Type' ),
		'add_new_item'      => __( 'Add New Classroom Type' ),
		'new_item_name'     => __( 'New Classroom Type Name' ),
		'menu_name'         => __( 'Classroom Types' ),
	);

	// Now register the taxonomy.
	register_taxonomy(
		'classroom_type',
		array( 'classroom' ),
		array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'type' ),
		)
	);
}
