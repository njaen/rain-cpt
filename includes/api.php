<?php 

add_action( 'rest_api_init', 'define_routes');

function define_routes(){
	register_rest_route('rain-ctp/v1', '/products/', array('methods'=>array('GET'), 'callback'=>'products_detail'));
	register_rest_route('rain-ctp/v1', '/products/brands/', array('methods'=>array('GET'), 'callback'=>'products_by_brand'));
	register_rest_route('rain-ctp/v1', '/products/category/', array('methods'=>array('GET'), 'callback'=>'products_by_category'));
	register_rest_route('rain-ctp/v1', '/products/rated/', array('methods'=>array('GET'), 'callback'=>'products_by_rating'));
	register_rest_route('rain-ctp/v1', '/products/featured/', array('methods'=>array('GET'), 'callback'=>'featured_products'));
	register_rest_route('rain-ctp/v1', '/brands/', array('methods'=>array('GET'), 'callback'=>'brands_detail'));
	register_rest_route('rain-ctp/v1', '/categories/', array('methods'=>array('GET'), 'callback'=>'categories_detail'));
}

function products_detail(){
	$data = array();
	$args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page'=> -1,
        'orderby'=>'title',
        'order'=>'ASC'
    );
	$the_query = new WP_Query($args);
	 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $the_Term = wp_get_post_terms($the_ID, 'product_category')[0];
	        $the_Category = get_term( $the_Term->term_id, 'product_category'); 
	 		$data[] = array("Product ID"=>$the_ID, "Product Name"=>get_the_title(), "Category"=>$the_Category->name, 
	 			"Brand"=>get_field("product_brand", $the_ID));
	    }
    wp_reset_query();
    return $data;
}

function products_by_brand(){
	$data = array();
	$args = array(
        'post_type' => 'brands',
        'post_status' => 'publish',
        'posts_per_page'=> -1,
        'orderby'=>'title',
        'order'=>'ASC'
    );
    $products_args = array(
		        'post_type' => 'products',
		        'post_status' => 'publish',
		        'posts_per_page'=> -1,
		        'meta_key' => 'brand',
				'meta_value'	=> '',
		        'orderby'=>'title',
		        'order'=>'ASC'
		    );
	$the_query = new WP_Query($args);
	 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $the_Brand = get_the_title();
	        $products_args['meta_value'] = $the_ID;
	        $the_products = new WP_Query($products_args);
	        $products = array();
	         while ($the_products->have_posts()) {
	         	$the_products->the_post();
		        $the_product_ID = get_the_ID();
		        $the_Term = wp_get_post_terms($the_product_ID, 'product_category')[0];
		        $the_Category = get_term( $the_Term->term_id, 'product_category'); 
	         	$products[] = array("Product ID"=>$the_product_ID, "Product Name"=>get_the_title(), "Category"=>$the_Category->name);
	         }
	          $data[] = array("Brand ID"=>$the_ID, "Brand Name"=>$the_Brand, "Products"=>$products);
	    }
    wp_reset_query();
    return $data;
}

function products_by_category(){
	$data = array();
	$categories = get_terms( array(
	    'taxonomy' => 'product_category',
	    'hide_empty' => false,
	));
	foreach($categories as $category){
		$products = array();
		$args = array(
	        'post_type' => 'products',
	        'post_status' => 'publish',
	        'posts_per_page'=> -1,
	        'orderby'=>'title',
	        'order'=>'ASC',
	        'tax_query' => array(
		        'taxonomy' => 'product_category',
		        'field' => 'name',
		        'terms' => $category->name
		    )
   		 );
		$the_query = new WP_Query($args);
		 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $the_Term = wp_get_post_terms($the_ID, 'product_category')[0];
	 		$products[] = array("Product ID"=>$the_ID, "Product Name"=>get_the_title(), 
	 			"Brand"=>get_field("product_brand", $the_ID));
	    }
    	wp_reset_query();
		$data[] = array("Product Category ID"=>$category->term_id, "Product Category Name"=>$category->name, "Products"=>$products);
	}
    return $data;
}

function products_by_rating(){
	$data = array();
	$args = array(
		        'post_type' => 'products',
		        'post_status' => 'publish',
		        'posts_per_page'=> -1,
		        'meta_key' => 'product_rating',
				'meta_value'	=> '',
		        'orderby'=>'title',
		        'order'=>'ASC'
		    );
	$ratings = get_meta_values( 'product_rating', 'products' );
	foreach($ratings as $rating){
		$products = array();
		$rgs['meta_value'] = $rating;
		$the_query = new WP_Query($args);
		 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $the_Term = wp_get_post_terms($the_ID, 'product_category')[0];
	 		$products[] = array("Product ID"=>$the_ID, "Product Name"=>get_the_title(), 
	 			"Brand"=>get_field("product_brand", $the_ID));
	    }
    	wp_reset_query();
		$data[] = array("Rating"=>$rating, "Products"=>$products);
	}
    return $data;
}

function featured_products(){
	$data = array();
	$args = array(
		        'post_type' => 'products',
		        'post_status' => 'publish',
		        'posts_per_page'=> -1,
		        'meta_key' => 'product_featured',
				'meta_value'	=> true,
		        'orderby'=>'title',
		        'order'=>'ASC'
		    );

		$products = array();
		$the_query = new WP_Query($args);
		 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $the_Term = wp_get_post_terms($the_ID, 'product_category')[0];
	 		$products[] = array("Product ID"=>$the_ID, "Product Name"=>get_the_title(), 
	 			"Brand"=>get_field("product_brand", $the_ID));
	    }
    	wp_reset_query();
		$data[] = array("Featured Products"=>$products);
    return $data;
}

function brands_detail(){
	$data = array();
	$args = array(
        'post_type' => 'brands',
        'post_status' => 'publish',
        'posts_per_page'=> -1,
        'orderby'=>'title',
        'order'=>'ASC'
    );
	$the_query = new WP_Query($args);
	 while ($the_query->have_posts()) {
	        $the_query->the_post();
	        $the_ID = get_the_ID();
	        $data[] = array("Brand ID"=>$the_ID, "Brand Name"=>get_the_title(),);
	    }
    wp_reset_query();
    return $data;
}

function categories_detail(){
	$data = array();
	$categories = get_terms( array(
	    'taxonomy' => 'product_category',
	    'hide_empty' => false,
	));
	foreach($categories as $category){
		$data[] = array("Product Category ID"=>$category->term_id, "Product Category Name"=>$category->name);
	}
    return $data;
}


