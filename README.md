#Rain Test Plugin

This is a Wordpress plugin made for the Wordpress developer position at [Rain Agency](http://rain.agency/)

This is a plugin that:

- Creates a "Products" custom post type
- Creates a "Brands" custom post type. (hierarchical)
- Creates a "Product Category" custom taxonomy, and add it to the custom post type.
- Using Advanced Custom Fields (or not), creates fields for:
  - Brand
  - Nutritional data. Should render a table like http://nutritiondata.self.com/images/help/nfl_example.png on the product detail page.
  - Product rating
  - Featured

- Defines WP JSON API that has endpoints for:
  - List of products
    - Also by brand
    - Also by category
    - Also top rated
    - Featured
  - List of brands
  - List of categories

- Defines a shortcode (or not) that prints a list of products and uses "infinite loading" + ajax (using admin-ajax.php) to load the rest of the products.

- Defines products permalinks as:
  - domain.com/brand-slug(s)/product-slug