<?php
add_shortcode( 'products_list', 'print_products' );
function cpt_products(){
	//Creating taxomony ""
	cpta_product_category();

	//Now the product cpt labels and args
	$labels = array(
		'name'                => _x( 'Products', 'Post Type General Name', 'rain' ),
		'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'rain' ),
		'menu_name'           => __( 'Products', 'rain' ),
		'parent_item_colon'   => __( 'Parent Product', 'rain' ),
		'all_items'           => __( 'All Products', 'rain' ),
		'view_item'           => __( 'View Product', 'rain' ),
		'add_new_item'        => __( 'Add New Product', 'rain' ),
		'add_new'             => __( 'Add New', 'rain' ),
		'edit_item'           => __( 'Edit Product', 'rain' ),
		'update_item'         => __( 'Update Product', 'rain' ),
		'search_items'        => __( 'Search Products', 'rain' ),
		'not_found'           => __( 'Not Found', 'rain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'rain' ),
	);
		
	$args = array(
		'label'               => __( 'products', 'rain' ),
		'description'         => __( 'Products items', 'rain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions'),
		'taxonomies'          => array( 'Product Category' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'			  => 'dashicons-screenoptions',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
    'rewrite' => array(
      'slug' => 'products/%brand-slug%',
      'with_front' => true
    )
	);
	// registering products post type
	register_post_type('products', $args);
	acf_cpt_products();
}

function cpta_product_category(){
//creating Product Categories taxonomy
  $labels = array(
    'name' => _x( 'Product Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Product Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Product Categories' ),
    'all_items' => __( 'All Product Categories' ),
    'parent_item' => __( 'Parent Product Category' ),
    'parent_item_colon' => __( 'Parent Product Category:' ),
    'edit_item' => __( 'Edit Product Category' ), 
    'update_item' => __( 'Update Product Category' ),
    'add_new_item' => __( 'Add New Product Category' ),
    'new_item_name' => __( 'New Product Category Name' ),
    'menu_name' => __( 'Product Categories' ),
  ); 	

  register_taxonomy('product_category',array('products'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'product_category' ),
  ));

}

function acf_cpt_products(){
	//Creating advanced custom fields for products post type
	// first we create groups.. 1 for // Nutritional Fields Group Data and another for the Nutritional data
	//General Data Group
	acf_add_local_field_group( 
		array (
			'key' => 'product_data',
			'title' => 'Product Data',
			'fields' => array (
				array (
					'key' => 'product_brand',
					'label' => 'Brand',
					'name' => 'product_brand',
					'type' => 'post_object',
					'prefix' => '',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
					'post_type' => array('brands'),
					'allow_null' => 0,
					'multiple' => 0,
					'return_format' => 'id'
				),
				array (
					'key' => 'product_rating',
					'label' => 'Product rating',
					'name' => 'product_rating',
					'type' => 'number',
					'prefix' => '',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 0,
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
					'min' => 0,
					'max' => 5,
					'step' => 1
				),
				array (
					'key' => 'product_featured',
					'label' => 'Featured',
					'name' => 'product_featured',
					'type' => 'true_false',
					'prefix' => '',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				)
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'products',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
		)
	);
	// Nutritional Fields Group
	acf_add_local_field_group(array(
		'key' => 'nutritional_data',
		'title' => 'Nutritions Facts',
		'location' => array (
					array (
						array (
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'products',
						),
					),
				),
		'menu_order' => 1,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => ''
	));
	// Adding fields for nutritional group
	$nutritional_fields = array(
		'serving_size',
        'calories',
        'calories_fat',
        'total_fat',
        'total_fat_percent',
        'satured_fat',
        'satured_fat_percent',
        'trans_fat',
        'cholesterol',
        'cholesterol_percent',
        'sodium',
        'sodium_percent',
        'carbohydrate',
        'carbohydrate_percent',
        'fiber',
        'fiber_percent',
        'sugars',
        'protein',
        'vitamina',
        'vitaminc',
        'calcium',
        'iron'
	);
	foreach($nutritional_fields as $key){
		acf_add_local_field(array(
			'key' => $key,
			'label' => ucfirst(str_replace("_", " ", $key)),
			'name' => $key,
			'type' => 'number',
			'parent' => 'nutritional_data'
		));
	}
}

function print_products($offset = 0){
	 $args = array(
        'post_type' => 'products',
        'post_status' => 'publish',
        'posts_per_page'=> 1,
        'orderby'=>'title',
        'order'=>'ASC',
        'offset' => $offset
    );

    $products = new WP_Query( $args );

     $output    = '<h1>Products</h1>';

    if( $products->have_posts() ) :

     $output    .= '<div id="products-list-container" class="product-list single"><ul>';

      while( $products->have_posts() ) : $products->the_post();
      	$the_ID = $products->post->ID;
         $output .= '<li><h2>'.get_the_title($the_ID)."</h2>";
         $output .= '<ul><strong><u>Product Info:</u></strong>';
         $output .= '<li><strong>Brand:</strong> '.get_field("product_brand", $the_ID).'</li>';
         $output .= '<li><strong>Rating:</strong> '.get_field("product_rating", $the_ID).'</li>';
         $output .= '<li><strong>Fetured:</strong> '.((get_field("product_featured", $the_ID))?'Yes':'No').'</li>';
         $output .= '<li><br>';
         $output .= '<section class="performance-facts">
  <header class="performance-facts__header">
    <h1 class="performance-facts__title">Nutrition Facts</h1>
    <p>Serving Size '.get_field("serving_size", $the_ID).'g</p>
  </header>
  <table class="performance-facts__table">
    <thead>
      <tr>
        <th colspan="3" class="small-info">
          Amount Per Serving
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th colspan="2">
          <b>Calories</b>
          '.get_field("calories", $the_ID).'
        </th>
        <td>
          Calories from Fat
          '.get_field("calories_fat", $the_ID).'
        </td>
      </tr>
      <tr class="thick-row">
        <td colspan="3" class="small-info">
          <b>% Daily Value*</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Total Fat</b>
          '.get_field("total_fat", $the_ID).'g
        </th>
        <td>
          <b>'.get_field("total_fat_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Saturated Fat
          '.get_field("satured_fat", $the_ID).'g
        </th>
        <td>
          <b>'.get_field("satured_fat_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Trans Fat
          '.get_field("trans_fat", $the_ID).'g
        </th>
        <td>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Cholesterol</b>
          '.get_field("cholesterol", $the_ID).'mg
        </th>
        <td>
          <b>'.get_field("cholesterol_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Sodium</b>
          '.get_field("sodium", $the_ID).'mg
        </th>
        <td>
          <b>'.get_field("sodium_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <th colspan="2">
          <b>Total Carbohydrate</b>
          '.get_field("carbohydrate", $the_ID).'g
        </th>
        <td>
          <b>'.get_field("carbohydrate_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Dietary Fiber
          '.get_field("fiber", $the_ID).'g
        </th>
        <td>
          <b>'.get_field("fiber_percent", $the_ID).'%</b>
        </td>
      </tr>
      <tr>
        <td class="blank-cell">
        </td>
        <th>
          Sugars
          '.get_field("sugars", $the_ID).'g
        </th>
        <td>
        </td>
      </tr>
      <tr class="thick-end">
        <th colspan="2">
          <b>Protein</b>
          '.get_field("protein", $the_ID).'g
        </th>
        <td>
        </td>
      </tr>
    </tbody>
  </table>
  
  <table class="performance-facts__table--grid">
    <tbody>
      <tr>
        <td colspan="2">
          Vitamin A
          '.get_field("vitamina", $the_ID).'%
        </td>
        <td>
          Vitamin C
          '.get_field("vitaminc", $the_ID).'%
        </td>
      </tr>
      <tr class="thin-end">
        <td colspan="2">
          Calcium
          '.get_field("calcium", $the_ID).'%
        </td>
        <td>
          Iron
          '.get_field("iron", $the_ID).'%
        </td>
      </tr>
    </tbody>
  </table>
  
  <p class="small-info">* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</p>
  
  
</section>';
         $output .= '</li></lu></li>';

      endwhile;

     $output .= '</ul></div>';
     $output .= '<div id="loading">
                 <hr style="width:100%;">
                  <img src="'.plugins_url('images/loading.gif', __FILE__) . '" alt="Loading more products ..." />
                </div>';

    else : 

        $output .= '<span id="no-more-products">There is currently no products to retrieve!</span>';

    endif;

    wp_reset_postdata();// more appropriate here

    return $output;
}

add_filter('single_template', 'product_template');
function product_template($single) {
    global $wp_query, $post;
    if ($post->post_type == "products"){
        if(file_exists(plugin_dir_path(__FILE__)  . 'views/product-single.php'))
            return plugin_dir_path(__FILE__)  . 'views/product-single.php';
    }
    return $single;

}


function filter_post_type_link( $link, $post ) {
  if ( $post->post_type == 'products' ) {
    if($brand_ID =get_field("product_brand", $post->ID)){
      $$brand = get_post($brand_ID); 
      $link = str_replace( '%brand-slug%', $brand->post_name, $link );
    }
    else{
      $link = str_replace( '%brand-slug%', 'no-brand', $link );
    }
  }
  return $link;
}
add_filter( 'post_type_link', 'filter_post_type_link', 10, 2 );

function add_rewrite_rules( $rules ) {
  add_rewrite_rule('products/no-brand/?([^/]*)','index.php?products=$matches[2]');
  add_rewrite_rule('products/?([^/]*)//?([^/]*)','index.php?products=$matches[2]');
}
add_filter( 'rewrite_rules_array', 'add_rewrite_rules' );