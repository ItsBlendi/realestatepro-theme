<?php get_header(); ?>
<div class="container">
  <h1>Blog</h1>
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article>
      <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
      <p><?php echo wp_trim_words(get_the_content(), 30); ?></p>
    </article>
  <?php endwhile; the_posts_pagination(); endif; ?>
</div>
<?php get_footer(); ?>