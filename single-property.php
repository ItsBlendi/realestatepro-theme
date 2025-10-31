<?php get_header(); ?>
<div class="container">
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article class="single-property">
      <h1><?php the_title(); ?></h1>
      <?php if(has_post_thumbnail()) the_post_thumbnail('large'); ?>
      <div class="property-details">
        <p><strong>Price:</strong> €<?php echo esc_html(get_post_meta(get_the_ID(),'_price',true)); ?></p>
        <p><strong>Location:</strong> <?php echo esc_html(get_post_meta(get_the_ID(),'_city',true)); ?></p>
        <p><strong>Bedrooms:</strong> <?php echo esc_html(get_post_meta(get_the_ID(),'_bedrooms',true)); ?></p>
        <p><strong>Bathrooms:</strong> <?php echo esc_html(get_post_meta(get_the_ID(),'_bathrooms',true)); ?></p>
      </div>
      <div class="property-description"><?php the_content(); ?></div>

      <?php $lat = get_post_meta(get_the_ID(),'latitude',true); $lng = get_post_meta(get_the_ID(),'longitude',true); ?>
      <?php if($lat && $lng): ?>
        <div id="property-map" data-lat="<?php echo esc_attr($lat); ?>" data-lng="<?php echo esc_attr($lng); ?>" style="height:400px;width:100%;margin-top:20px;"></div>
      <?php endif; ?>

    </article>
  <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>