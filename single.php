<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="content">
	<img id="banner-image" src="<?php echo get_option('show_banner_image') ?>" alt="ITP Show Banner Image" />
	<h2><?php echo get_option('show_time'); ?></h2>

  <p><a href="<?php bloginfo('siteurl');?>/category/projects/">Back to Projects List</a></p>

	<?php while (have_posts()) : the_post();
		// display project post template
		include (TEMPLATEPATH . '/single_project.php');
	endwhile; ?>
</div>

<?php get_footer(); ?>