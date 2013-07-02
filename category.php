<?php get_header(); ?>

<?php get_sidebar(); ?>

<?

?>
			<div id="content">
				<img src="<?php header_image(); ?>" alt="itp show banner image"/>
				<h2><?php echo get_option('show_time'); ?></h2>

	<?

			$catID = get_query_var('cat');
			$catName = get_the_category_by_ID($catID); //get name of current category


			$students_catID = get_cat_ID('Students');
			$instructors_catID = get_cat_ID('Instructors');
			$classes_catID = get_cat_ID('Related Classes');

			$children_of_cat = get_term_children($catID, 'category');

			if ($catName != 'Projects') {

				// CATEGORY BEING DISPLAYED is one of the following.
				// Students, Instructors, Related Classes
				// (NOT Projects, see else)

				$sql = "SELECT tt.term_id, t.name, object_id ";
				$sql .= "FROM $wpdb->terms t, $wpdb->term_taxonomy tt, $wpdb->term_relationships tr ";
				$sql .= "WHERE tt.parent = $catID ";
				$sql .= "AND t.term_id = tt.term_id ";
				$sql .= "AND tr.term_taxonomy_id = tt.term_taxonomy_id ";
				$sql .= "ORDER BY t.name";
//echo $sql."<br>";
				$thePosts = $wpdb->get_results($sql);

				foreach($thePosts as $p) {
					$tempPost = get_post($p->object_id);
					$tempPost->filteredItem = $p->name;
					$filteredPosts[] = $tempPost;
				}

				$filteredByTitle = false;

			} else {

				//when category requested is Projects
				//just request the posts as normal
				$filteredPosts = get_posts('orderby=post_title&order=ASC&numberposts=500');

			}
			?>

			<?

			//add css for selected column shading
			echo "<style>";
			echo "." . strtolower($catName) . " { font-weight:strong; }";
			echo "</style>";

			?>


			 <?php if (have_posts()) : ?>
				 <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				 <?php /* If this is a category archive */ if (is_category()) { ?>
				 <h4><?php  single_cat_title(); ?></h4>
				 <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
				 <h4>Archive for <?php the_time('F jS, Y'); ?></h4>
				 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
				 <h4>Archive for <?php the_time('F, Y'); ?></h4>
				 <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
				 <h4>Archive for <?php the_time('Y'); ?></h4>
				 <?php /* If this is a search */ } elseif (is_search()) { ?>
				 <h4>Search Results</h4>
				 <?php /* If this is an author archive */ } elseif (is_author()) { ?>
				 <h4>Author Archive</h4>
				 <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
				 <h4>Blog Archives</h4>
				 <?php } ?>






				<hr class="hrsingle" />

				<div class="post">
				<?
					// look up a static page in DB where title=category name, return ID
					// get content with get_post, otherwise leave it blank
					$pageid = $wpdb->get_var("select ID from $wpdb->posts where post_title='$catName' and post_type='page'");
					$categoryPage = get_post($pageid);

				if (isset($pageid)) {  ?>
					<p><?= nl2br($categoryPage->post_content); ?></p>
					<hr class="hrblack" />
				<? } ?>
				<table border=0 cellpadding=0 cellspacing=0>
					<tr id="headerrow">
						<th <? if ( $catName =='Projects') echo 'class="highlight"'; ?>>
							<a href="<?= bloginfo('url');?>/category/projects">Title</a>
						</th>

						<th <? if ( $catName =='Students') echo 'class="highlight"'; ?>>
							<a href="<?= bloginfo('url');?>/category/students">Students</a>
						</th>

						<th <? if ( $catName =='Instructors') echo 'class="highlight"'; ?>>
							<a href="<?= bloginfo('url');?>/category/instructors">Instructors</a>
						</th>

						<th <? if ( $catName =='Related Classes') echo 'class="highlight"'; ?>>
							<a href="<?= bloginfo('url');?>/category/related-classes">Courses</a>
						</th>
					</tr>
				<?

				foreach($filteredPosts as $filteredItem => $post) {

					setup_postdata($post);

					if (is_project()) {

						$postCategories = wp_get_object_terms($post->ID,'category');

						$students = get_post_parent_category_children('Students', $postCategories); //list the categories that are children of Students
						$instructors = get_post_parent_category_children('Instructors', $postCategories); //project instructors
						$classes = get_post_parent_category_children('Related Classes', $postCategories); // project classes

						?>

							<tr class="row">
								<!-- title -->
								<td class="cell title">
									<a href="<? the_permalink(); ?>">
									<? the_title(); ?>
									</a>
								</td>

								<!-- students column -->
								<td class="cell students">
									<?
									if ($catID == $students_catID) {
										echo $post->filteredItem;
									} else {
										foreach($students as $cat) {
											echo $cat->cat_name . "<br>";
										}
									}
									?>
								</td>

								<!-- instructors column -->
								<td class="cell instructors">

									<?
									if ($catID == $instructors_catID) {
										echo $post->filteredItem;
									} else {

									foreach($instructors as $cat) {
											echo $cat->cat_name . "<br>";
										}
									}
									?>
								</td>

								<!-- classes column -->
								<td class="cell related-classes">
									<?
									if ($catID == $classes_catID) {
										echo $post->filteredItem;
									} else {

									foreach($classes as $cat) {
											echo $cat->cat_name . "<br>";
										}
									}
									?>
								</td>
							</tr>


					   <?
					   		}

				}

				?>
					</table>
				</div>

				<div class="navigation">
					<!--<?php posts_nav_link(' &#124; ', '&laquo; PREVIOUS PAGE', 'NEXT PAGE &raquo;'); ?>-->
				</div>

			<?php else : ?>

				<h2 class="center">Not Found</h2>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>

			<?php endif; ?>

	</div><!-- end content div -->

<?php get_footer(); ?>
