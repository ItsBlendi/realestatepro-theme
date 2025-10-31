<?php get_header(); ?>
<div class="container">
  <h2>Latest Posts</h2>
  <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <article <?php post_class(); ?>>
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php the_excerpt(); ?>
    </article>
  <?php endwhile; the_posts_pagination(); else: echo '<p>No posts found.</p>'; endif; ?>
</div>
<?php get_footer(); ?>