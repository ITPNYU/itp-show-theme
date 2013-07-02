<?php
/*
Template Name: Poster list
*/
	
	$catName = 'Projects';
	$filteredPosts = get_posts('orderby=title&order=ASC&numberposts=500');
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

        <title></title>
        
        <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

<style type="text/css" media="screen">
td,th {
        border-bottom: 1px solid #ccc;
	padding:5px;
	text-align:left;
}
.msg { color:#ff0000;}
</style>
</head>
<body>
<h1> links to poster and webpage for each project</h1>
<? echo count($filteredPosts); ?> projects found
	<div id="content">
	<table>
	<tr>
	<th>project title</th>
	<th style='text-align:right'>links to:</th>
	<th>poster</th>
	<th>pdf of poster</th>
	<th>webpage</th>
	<th>edit&nbsp;project</th>
	<th>missing</th>
	</tr>
	<? 
	
	foreach($filteredPosts as $filteredItem => $post) {
	
	setup_postdata($post);
//echo "count " . $PC++ . 'proj? '.is_project().' ' . the_title().'<br>';
	if (is_project()) {
//echo "here<br>";
	$msg ='';
			
	$postCategories = wp_get_object_terms($post->ID,'category');
	
	$students = get_post_parent_category_children('Students', $postCategories); //list the categories that are children of Students
	if (!isset($students)) $msg .='No associated people. ';
	switch (count($students)) {
		case 0:
		case 1:
		case 2:
		   $br=0;
		   break;
		case 3:
		case 4:
		   $br=2;
		   break;
		default:
		  $br=3;
		   break;
	}
		

	$classes = get_post_parent_category_children('Related Classes', $postCategories); // project classes
	if (!isset($classes)) $msg .='No associated classes. ';

	$pitch = stripslashes(getProjectMeta('pitch'));

        $space = 25 - floor(strlen($pitch) / 100) * 5;
	if (strlen($pitch) < 50) $just='center';
	else $just = 'justify';

	if (count($students) > 6) $space -= 10;

	if (strlen($pitch) < 1) $msg .='No tagline/pitch. ';

	$use_xl='n';
	$img = getProjectMeta('image');
	if (!($img))  {
		$space += 30;
		$msg .= 'No image. ';
        } else {
		$path = explode('/',$img);
		$path [count($path)-1] = 'xl_'.$path[count($path)-1];
 		$img_xl = implode('/',$path);

//echo $img_xl . " img path<br>";

		$imglocal_xl = '/var/www/html/'.str_replace('http://itp.nyu.edu/shows/spring2013','/shows',$img_xl);
//echo $imglocal_xl . " img xl<br>";
//echo file_exists($imglocal_xl) . " img exist<br>";
		if (file_exists($imglocal_xl)) {
			$use_xl='y';
			$space -= 5;
		}
	}

	 $words = explode(' ',get_the_title());
	if (count($words) > 6) {
		$titlespl = floor(count($words)/2);
	} else
	 $titlespl=0;
	?>
	
		<tr class="row">
			<td colspan=2 class="cell title">
				<? the_title(); ?>
			</td>
			<td class="cell title">
				<a target='poster'
			 href="<? bloginfo('url') ?>/poster/?poster=<? the_ID(); ?>&alignpitch=<?= $just; ?>&xlimg=<?= $use_xl;  ?>&pitchfont=0&studfont=0&studspl=<?= $br; ?>&titlespl=<?$titlespl; ?>&space=<?= $space;  ?>">
				poster
				</a>
			</td>
			<td class="cell title">
				<a target='poster'
			 href="/makepdf/?url=<? bloginfo('url') ?>/poster/?poster=<? the_ID(); ?>">
			 <!-- &alignpitch=<?= $just; ?>&xlimg=<?= $use_xl;  ?>&pitchfont=0&studfont=0&studspl=<?= $br; ?>&titlespl=<?$titlespl; ?>&space=<?= $space;  ?> -->
				pdf
				</a>
			</td>
			<td class="cell title">
				<a target='project'
			 href="<? the_permalink();  ?>">
				webpage
				</a>
			</td>
			<td class="cell title">
				<a target='project'
			 href="<?= get_post_meta($post->ID, 'externalITPURL', true); ?>">
				edit project
				</a>
			</td>
			</td>
			<td class="msg">
				<? echo $msg ?>

			</td>
		</tr>
	

	   <?
	   	}
	
	}
	
	?>
	</table>
	</div>
	
	</div><!-- end content div -->	  

</body>
</html>
