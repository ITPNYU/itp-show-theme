<!-- there are template files for blog entries that are projects and for posts -->
<?php get_header();?>

<?php get_sidebar(); ?>

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

