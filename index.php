<?php get_header();?>
<?php get_sidebar(); ?>

<?php
  // UNCOMMENT THE FOLLOWING LINE TO REDIRECT TO THE PROJECTS PAGE.
 // header('Location: http://itp.nyu.edu/shows/spring2013/category/projects');
?>


<div id="content">
  <div id="image_layer">
  	<img id="postcard-image" src="<?php echo get_option('show_postcard') ?>" alt="ITP Show Postcard Image" />
  </div>
  <div id="content">
    <h1>
      <?php echo get_option('show_announcement'); ?>
    </h1>
  </div>
</div>

<?php get_footer(); ?>