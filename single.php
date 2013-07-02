<?php get_header(); ?>

<?php get_sidebar(); ?>
        
<div id="content">	
 <div id="bar_layer">&nbsp;</div>
	  <?php if (have_posts()) : while (have_posts()) : the_post();  ?>
	  
		<div class="navigation_single">
				<!--<?php previous_post_link('&laquo; %link') ?> | <a href="<?php bloginfo('url'); ?>/">MAIN</a> | <?php next_post_link('%link &raquo;') ?>-->
				<!--<?php previous_post_link('%link', '&laquo; PREVIOUS ENTRY') ?> | <a href="<?php bloginfo('url'); ?>/">MAIN</a> | <?php next_post_link('%link', 'NEXT ENTRY &raquo;') ?>-->
		</div>
			
	  <?
		//determine if post is a project page or not
		
		if (is_project()) {
			// display project post template 
			include (TEMPLATEPATH . '/single_project.php'); 
			break; 
		} else {
		
			//display normal blog post 
			include (TEMPLATEPATH . '/single_standard_post.php'); 
		}
							  
	  ?>
	
	
		<?php endwhile; else: ?>
		
	<?php endif; ?>
			
</div><!-- end column1inner -->
		
      
                
  



<?php get_footer(); ?>
