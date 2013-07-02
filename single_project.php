
<div class="post" id="post-<?php the_ID(); ?>">
		<?
			$students = get_post_parent_category_children('Students', $postCategories); //list the categories that are children of Students
			$instructors = get_post_parent_category_children('Instructors', $postCategories); //project instructors
			$classes = get_post_parent_category_children('Related Classes', $postCategories); // project classes
		?>
		<div class="projectMeta">
<!-- 		<img src="<?php bloginfo('template_directory'); ?>/topImg.jpg" /> -->
			<h3 class="projectAuthor">
			<?
				if (isset($students)) {
					foreach($students as $s) {
						echo $s->name . "<br>";
						
					}
				}
			?>
			</h3>
	
			<h3 class="projectTitle"><?php the_title(); ?></h3>
	
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
		
		
		
		<div style="clear:both;"></div>
		<div class="storycontent">	
		<!--<div class="entry">-->
		
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
