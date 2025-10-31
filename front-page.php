<?php get_header(); ?>
<section class="hero">
  <div class="container">
    <h1>Find Your Dream Home</h1>
    <form class="search-form" method="get" action="<?php echo site_url('/properties'); ?>">
      <input type="text" id="search-location" name="location" placeholder="City or Location" value="<?php echo esc_attr($_GET['location'] ?? ''); ?>">
      <input type="number" name="min_price" placeholder="Min Price (€)" value="<?php echo esc_attr($_GET['min_price'] ?? ''); ?>">
      <input type="number" name="max_price" placeholder="Max Price (€)" value="<?php echo esc_attr($_GET['max_price'] ?? ''); ?>">
      <select name="type"><option value="">All Types</option><option value="house">House</option><option value="apartment">Apartment</option><option value="land">Land</option></select>
      <button type="submit">Search</button>
    </form>
  </div>
</section>

<section class="featured-properties container">
  <h2>Featured Properties</h2>
  <div class="property-grid">
    <?php
      $featured = new WP_Query(array('post_type'=>'property','posts_per_page'=>6,'meta_key'=>'_featured','meta_value'=>'1'));
      if($featured->have_posts()): while($featured->have_posts()): $featured->the_post(); get_template_part('template-parts/content','property'); endwhile; wp_reset_postdata(); else: echo '<p>No featured properties yet.</p>'; endif;
    ?>
  </div>
</section>

<?php get_footer(); ?>