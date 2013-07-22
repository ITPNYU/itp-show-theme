<?php get_header(); ?>
<?php get_sidebar(); ?>

<?
	// This section of PHP appears to be accessing the Projects DB directly
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

<div id="content">
	<img id="banner-image" src="<?php echo get_option('show_banner_image') ?>" alt="ITP Show Banner Image" />
	<h2><?php echo get_option('show_time'); ?></h2>

	<?php if (have_posts()) : ?>
	<table>
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

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>

				</div>

</div><!-- end content div -->

<?php get_footer(); ?>