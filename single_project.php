<div class="post" id="post-<?php the_ID(); ?>">
	<?
		$student_category_id = get_cat_ID('Students');
		$instructors_id = get_cat_ID('Instructors');
		$classes_id = get_cat_ID('Related Classes');
		$categories = get_the_category();
	?>

	<h2 class="project-title"><?php the_title(); ?></h2>
	<h3 class="project-author">
	<?
		foreach($categories as $category) {
			if($category->parent == $student_category_id) {
				echo $category->name . "<br>";
			}
		}
	?>
	</h3>


	<div class="project-content"><?php the_content(); ?></div>


			<h3 class="projectPitch">
			<?=   stripslashes(getProjectMeta('pitch')) ?>
			</h3>

			<h3 class="projectURL">
			<a href="<?= getProjectMeta('externalURL');?> "><?= getProjectMeta('externalURL');?></a>
			</h3>

			<div>
				<div id="projectImage">
					<? if (getProjectMeta('image')) { ?>
					<img src="<?= getProjectMeta('image'); ?>" />
					<? } ?>
				</div>

				<div id="meta_right">
						<div id="classes">
							<b>Classes</b>
							<br>
							<?
							foreach($classes as $class) {
								$theClasses[] = $class->name;
							}

							echo implode(",",$theClasses);
							?>

						</div>


					<br><br>
						<?
							$keywords = stripslashes(getProjectMeta('keywords'));
							if (!empty($keywords)) {

						?>
							<div id="keywords">
								<b>Keywords</b>
								<br>
								<?= $keywords; ?>
							</div>
						<? } ?>
				</div>
			</div>
		</div>



		<div class="storycontent">

			<?
			echo stripslashes($post->post_content);

			       	$extra_meta = array(
                                "personal-statement" => "Personal Statement",
                                "background" => "Background",
                                "audience" =>   "Audience",
                                "user-scenario" =>  "User Scenario",
                                "technical-system" =>  "Implementation",
                                "conclusion" => "Conclusion",
                                "project-references" => "References"
                              );

			foreach ($extra_meta as $extra  => $emTitle) {
				$em = getProjectMeta($extra);
				if ($em) {
					echo "<br /><br /><b>" . $emTitle . "</b><br />";
					echo stripslashes($em);
				}
			}

			?>

		</div>
	</div> <!-- end post -->