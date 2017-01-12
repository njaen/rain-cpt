<?php
function cpt_brands(){
	//Now the product cpt labels and args
	$labels = array(
		'name'                => _x( 'Brands', 'Post Type General Name', 'rain' ),
		'singular_name'       => _x( 'Brand', 'Post Type Singular Name', 'rain' ),
		'menu_name'           => __( 'Brands', 'rain' ),
		'parent_item_colon'   => __( 'Parent Brand', 'rain' ),
		'all_items'           => __( 'All Brands', 'rain' ),
		'view_item'           => __( 'View Brand', 'rain' ),
		'add_new_item'        => __( 'Add New Brand', 'rain' ),
		'add_new'             => __( 'Add New', 'rain' ),
		'edit_item'           => __( 'Edit Brand', 'rain' ),
		'update_item'         => __( 'Update Brand', 'rain' ),
		'search_items'        => __( 'Search Brand', 'rain' ),
		'not_found'           => __( 'Not Found', 'rain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rain' ),
	);
		
	$args = array(
		'label'               => __( 'brands', 'rain' ),
		'description'         => __( 'Brand items', 'rain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions'),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'			  => 'dashicons-tag',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	// registering products post type
	register_post_type('brands', $args);
}