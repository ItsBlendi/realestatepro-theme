<?php
/* Template Name: Properties Page */
get_header(); ?>
<div class="container">
  <h2>Find Your Property</h2>
  <form class="property-search-form" method="get" action="<?php echo esc_url(get_permalink()); ?>">
    <div class="filter-row">
      <input type="text" id="search-location-archive" name="location" placeholder="City" value="<?php echo esc_attr($_GET['location'] ?? ''); ?>">
      <select name="type"><option value="">All Types</option><option value="house" <?php selected($_GET['type'] ?? '', 'house'); ?>>House</option><option value="apartment" <?php selected($_GET['type'] ?? '', 'apartment'); ?>>Apartment</option><option value="land" <?php selected($_GET['type'] ?? '', 'land'); ?>>Land</option></select>
      <input type="number" name="min_price" placeholder="Min Price (€)" value="<?php echo esc_attr($_GET['min_price'] ?? ''); ?>">
      <input type="number" name="max_price" placeholder="Max Price (€)" value="<?php echo esc_attr($_GET['max_price'] ?? ''); ?>">
      <button type="submit">Search</button>
    </div>
  </form>

  <hr>
  <div class="property-grid">
    <?php
    $city = sanitize_text_field($_GET['location'] ?? '');
    $type = sanitize_text_field($_GET['type'] ?? '');
    $min_price = intval($_GET['min_price'] ?? 0);
    $max_price = intval($_GET['max_price'] ?? 0);

    $meta_query = array('relation'=>'AND');
    if($city) $meta_query[] = array('key'=>'_city','value'=>$city,'compare'=>'LIKE');
    if($type) $meta_query[] = array('key'=>'_type','value'=>$type,'compare'=>'=');
    if($min_price || $max_price){
      $price_query = array('key'=>'_price','type'=>'NUMERIC');
      if($min_price && $max_price){ $price_query['value']=array($min_price,$max_price); $price_query['compare']='BETWEEN'; }
      elseif($min_price){ $price_query['value']=$min_price; $price_query['compare']='>='; }
      elseif($max_price){ $price_query['value']=$max_price; $price_query['compare']='<='; }
      $meta_query[] = $price_query;
    }

    $args = array('post_type'=>'property','posts_per_page'=>9,'meta_query'=>$meta_query);
    $q = new WP_Query($args);
    if($q->have_posts()): while($q->have_posts()): $q->the_post(); get_template_part('template-parts/content','property'); endwhile; echo '<div class="pagination">'; the_posts_pagination(); echo '</div>'; else: echo '<p>No properties found for your criteria.</p>'; endif; wp_reset_postdata();
    ?>
  </div>
</div>
<?php get_footer(); ?>