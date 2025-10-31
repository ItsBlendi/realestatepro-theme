<?php
/* Template Name: Contact Page */
get_header(); ?>
<div class="container">
  <h2>Contact Us</h2>
  <form method="post" action="">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" rows="5"></textarea>
    <button type="submit">Send Message</button>
  </form>
</div>
<?php get_footer(); ?>