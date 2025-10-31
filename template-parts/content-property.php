<article class="property-card">
  <a href="<?php the_permalink(); ?>">
    <?php if(has_post_thumbnail()) the_post_thumbnail('medium'); else echo '<img src="' . get_template_directory_uri() . '/assets/images/placeholder.jpg" alt="placeholder">'; ?>
    <h3><?php the_title(); ?></h3>
  </a>
  <div class="property-details">
    <p><strong>€<?php echo esc_html(get_post_meta(get_the_ID(),'_price',true)); ?></strong></p>
    <p><?php echo esc_html(get_post_meta(get_the_ID(),'_city',true)); ?></p>
  </div>
</article>