<?php get_header(); ?>
<div class="container">
  <h2>Available Properties</h2>
  <div class="property-grid">
    <?php if(have_posts()): while(have_posts()): the_post(); get_template_part('template-parts/content','property'); endwhile; the_posts_pagination(); else: echo '<p>No properties found.</p>'; endif; ?>
  </div>
</div>
<?php get_footer(); ?>