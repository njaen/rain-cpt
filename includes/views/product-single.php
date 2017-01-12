<?php
/**
 * The template for displaying all single products
 */

get_header(); ?>

   <div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">


        <?php
        // Start the loop.
        while ( have_posts() ) : the_post(); ?>
        <h2><?php single_post_title( 'Product: ' ); ?></h2>
        <?php

            $products = the_post();
            //$output = '<h1>'.single_post_title()."</h1>";
            $output= '<div id="products-list-container" class="product-list single">';

            
         $the_ID = get_the_ID();
         
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
          $output .= '</ul></div>';
          echo $output;


        // End the loop.
        endwhile;
        ?>

      </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
