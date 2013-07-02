<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="content">
	<img src="<?php header_image(); ?>" alt="itp show banner image"/>
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

	<?php
		while (have_posts()) : the_post();
			setup_postdata($post);

			$student_category_id = get_cat_ID('Students');
			$instructors_id = get_cat_id('Instructors');
			$classes_id = get_cat_id('Related Classes');
			$categories = get_the_category();
	?>
		<tr>
			<td class="cell title">
				<a href="<? the_permalink(); ?>">
				<? the_title(); ?>
				</a>
			</td>
			<td class="cell students">
				<?
				foreach($categories as $category) {
					if($category->parent == $student_category_id) {
						echo $category->name . "<br>";
					}
				}
				?>
			</td>
			<td class="cell instructors">
				<?
				foreach($categories as $category) {
					if($category->parent == $instructors_id) {
						echo $category->name . "<br>";
					}
				}
				?>
			</td>
			<td class="cell related-classes">
				<?
				foreach($categories as $category) {
					if ($category->parent == $classes_id) {
						echo $category->name . "<br>";
					}
				}
				?>
			</td>
		</tr>
	<? endwhile; ?>

	</table>

	<?php else : ?>
		<h2 class="center">Not Found</h2>
		<?php include (TEMPLATEPATH . '/searchform.php'); ?>
	<?php endif; ?>

				</div>

</div><!-- end content div -->

<?php get_footer(); ?>
