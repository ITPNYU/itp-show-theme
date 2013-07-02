<?php get_header(); ?>

<?php get_sidebar(); ?>
                        <div id="content">
<img src="<?= bloginfo('template_directory'); ?>/images/topImg.jpg" />
							
			<style>.projects { font-weight:strong; }</style>	
	<?
	
	$query = mysql_real_escape_string($_REQUEST['s']);
	$query = str_replace("+"," ",$query); //remove +'s replace with ' ' <spaces>
	//$queryDoubleSpace = str_replace(" ","  ",$query); //double space query for Student Categories with 2 spaces between first last name. Errror on RSS feed from projects db. 

	
	if (isset($query) && $query != '') {
	
		//search post table
		$postSQL = "SELECT ID as post_id FROM $wpdb->posts WHERE (post_content LIKE '%$query%') or (post_title LIKE '%$query%')";
		$thePosts = $wpdb->get_results($postSQL);
		//echo $postSQL." = p<br>";
		//search taxonomy
		$termSQL = "SELECT name, term_id FROM $wpdb->terms WHERE (name LIKE '%$query%')"; //get term_ids from table terms with names like the query
		$theTerms = $wpdb->get_results($termSQL); 
		//echo $termSQL." = t<br>";

		//organize all the post_ids that were queried
		$posts = array();
		$post_ids = array();
		$object_ids = array();

		if (isset($thePosts)) {
			foreach($thePosts as $p) {
				$post_ids[] = $p->post_id;
			}
		}
		
		//organize all the term/object associations into an array called term_ids
		if (isset($theTerms)) {
		
			foreach($theTerms as $tid) {
				$term_ids[] = $tid->term_id;
			}
			
			$object_ids = get_objects_in_term($term_ids,'category'); //wp taxonomy function to get posts associated with a term	
		}
		
		//merge the two post_ids and object_ids into one array
		// this array will hold post ids !!

		if ((count($post_ids) > 0) &&
		    (count($object_ids) > 0))
			$posts = array_merge($post_ids, $object_ids);
		else if (count($post_ids) > 0)
			$posts = $post_ids;
		else if (count($object_ids) > 0)
			$posts = $object_ids;
		
		//get post information for all these posts
		if (isset($posts) && (count($posts) > 0)) {
			$posts = array_unique($posts);		
			rewind_posts();
			?>

			<form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
				<div>
					<input type="text" name="s" id="s" size="15" value="<?= $query; ?>" /> &nbsp;
					<input type="submit" value="<?php _e('Search'); ?>" />
				</div>
			</form>
			
			<hr class="hrblack" />			
			
			<table border=0 cellpadding=0 cellspacing=0>
				<tr id="headerrow">
					<th>
						<b>Title</b>
					</th>
					
					<th>
						Students
					</th>
					
					<th>
						Instructors
					</th>
					
					<th>
						Courses
					</th>
				</tr>
		
			<?
			foreach($posts as $p) {
				$post = get_post($p);
				
				if (is_project()) {
									
					$postCategories = wp_get_object_terms($post->ID,'category');
					
					$students = get_post_parent_category_children('Students', $postCategories); //list the categories that are children of Students
					$instructors = get_post_parent_category_children('Instructors', $postCategories); //project instructors
					$classes = get_post_parent_category_children('Related Classes', $postCategories); // project classes
				
					?>
					
						<tr class="row">
							<!-- title -->
							<td class="cell title" >
								<a href="<? the_permalink(); ?>">
								<? the_title(); ?>
								</a>
							</td>
							
							<!-- students column -->
							<td class="cell students">
								<? 
								
									foreach($students as $cat) {
										echo $cat->cat_name . "<br>";
									}
								?>
							</td>
							
							<!-- instructors column -->
							<td class="cell instructors">
								
								<? 
								
								foreach($instructors as $cat) {
										echo $cat->cat_name . "<br>";
									}
								
								?>
							</td>
							
							<!-- classes column -->
							<td class="cell related-classes">
								<? 
								
								
								foreach($classes as $cat) {
										echo $cat->cat_name . "<br>";
									}
								
								?>
							</td>
						</tr>
					

				   <?
					}
				
				
			} //end of foreach
			?>
			
			</table>
			<?
		} else {
		
		?>
		<h2>Sorry, no results were found for that search.</h2>
	   <form id="searchform" method="get" action="<?php bloginfo('home'); ?>">
		<div>
			<input type="text" name="s" id="s" size="15" /> &nbsp;
			<input type="submit" value="<?php _e('Search'); ?>" />
		</div>
		</form>
	
		<?
		
		}
		
		
		

	} 
	
	?>

</div> <!-- end column1inner -->      
</div> <!-- content  -->      
	



<?php get_footer(); ?>
