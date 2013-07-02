<?
/*
Template Name: Show Poster
*/


	$spacer = isset($_REQUEST['space']) ? $_REQUEST['space'] : 20;
	$br = $_REQUEST['studspl'];
  
   $stf = isset($_REQUEST['studfont']) ? $_REQUEST['studfont'] : 0;
  $titlespl = isset($_REQUEST['titlespl']) ? $_REQUEST['titlespl'] : 0;
  $pf = isset($_REQUEST['pitchfont']) ? $_REQUEST['pitchfont'] : 0;

  $just = isset($_REQUEST['alignpitch']) ? $_REQUEST['alignpitch'] : 'justify';
  if ($just != 'justify' &&
     $just != 'left' &&
     $just != 'right' &&
     $just != 'center') $just = 'justify';

  $p = $_REQUEST['poster'];
  if (!$p) $p = 1;
  $post = get_post($p);
  $students = get_post_parent_category_children('Students', $postCategories); //list the categories that are children of Students
  $instructors = get_post_parent_category_children('Instructors', $postCategories); //project instructors
  $classes = get_post_parent_category_children('Related Classes', $postCategories); // project classes
  $pitch = stripslashes(getProjectMeta('pitch'));
  $url = getProjectMeta('externalURL');
  $img = getProjectMeta('image');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->
	<style type="text/css" media="print,screen">

	@page {
	size: 8.5in 11in;  /* width height */
	margin-left: .5in;
		margin-right: .5in;
		margin-top: .5in;
		margin-bottom: .5in;
	 }

	body{
		margin:0;
		padding: 0;
		font-family: Helvetica;
		font-size: 12pt;
		font-weight:normal;
		background-color: #fff;
		color: #000;
		text-align: center;
	}

	#wrapper {
		padding:0;
			margin:0;
		width: 6.5in;
		height: 10.5in;
		margin-top: 0;
		margin-left: auto;
		margin-right: auto;
		border:2px solid #3a4ea2;
	/*	border-top:1px solid #000;*/
	}


	.header1 {
	float:left;
	width:50%;
	  font-size: 30px;
	  font-weight: bold;
	  letter-spacing: -.25px;
	  line-height: 38px;
	  text-align:center;
	  color: #3a4ea2;
	  margin:0;
	  padding: 10px 0px 0px 0px;
	}

	#img1 {
	/*float:left;*/
	max-width: 100%;
	}
	#img2 {
	float:right;
	}
	#content {
			clear: both;

		margin:0;
		padding:0;
		width: 100%;
		height: 100%;
		vertical-align: text-bottom;
	}

	#content div {
		width: 95%;
		vertical-align: text-bottom;
		margin: auto;
		 border:1px solid #fff;
	}

	#content div p {
		padding:0;
			margin:0;
		vertical-align: text-bottom;
		margin-bottom: 2pt;
	}

	#title	{
		 font-size: 30pt;
		color:#000;
	} /* TITLE   */


	#names	{
		font-size: 18pt;
		font-weight: bold;
		color:#3a4ea2;
		line-height: 30pt;
	} /* NAMES   */
	#names_sm	{
		font-size: 16pt;
		font-weight: bold;
		color:#e32f4a;
		line-height: 18pt;
	} /* NAMES small   */

	#projectimg img {
		padding: 5pt;
		border:1pt solid #ccc;
	}

	#pitch_wrap {
		width: 100%;
	}
	#pitch	{
		padding:0;
			margin:0;
		width: 90%;
		margin-left: auto;
		margin-right: auto;
		font-size: 15pt;
		text-align: center;
	} /* PITCH   */

	#class	{
		font-size: 12pt;
	} /* CLASSES */

	#url {
			color:#3a4ea2;
		font-size: 14pt;
	} /* URL     */

	#spacer {
		width: 100%;
		margin:0;
		padding: 0;
		height: <?= $spacer ?>pt;
	} /* space btwn divs     */


	@media print {
	#wrapper {
	height: 100% !important;
	}

}

	</style>

</head>
<body>
<div id='wrapper'>
<div id='header'>
	<img id='img1' src="<?php bloginfo('template_url');?>/images/posterHeadWhite.jpg" />
</div>
<div id='content'>
	<div id='spacer'>&nbsp;</div>
	<div id='title'>
		<p><?php $words = explode(' ',get_the_title()); 
		$ccount = 0;
		foreach($words as $w) {
			$ccount++;
			echo $w;
			if ($ccount != count($words)) echo ' ';
			if ($titlespl >0)
				if (fmod($ccount,$titlespl) == 0) echo '<br>';
		}
			
			
		?></p>
	</div>
<? if (isset($students)) { ?>
<div id='spacer'>&nbsp;</div>
<div id='<?php if (count($students) < 9) echo 'names'; else echo 'names_sm';?>'>
	<p><?
		$ccount = 0;
			foreach($students as $s) {
				$ccount++;
				echo $s->name;
				if ($ccount != count($students)) echo ', ';
				if (fmod($ccount,$br) == 0) echo '<br>';
			}
	?></p>
</div>
<? }
if ($img) {
?>
<div id='spacer'>&nbsp;</div>
<div id='projectimg'>
	<img src="<?= getProjectMeta('image'); ?>"/>
</div>
<? }
   if ($pitch) {
?>
<div id='spacer'>&nbsp;</div>
<div id='pitch_wrap'>
<div id='pitch'>
	<p><?
		echo stripslashes(getProjectMeta('pitch'));
	?></p>
</div>
</div>
<? }
// errors if there are no classes
if (isset($classes)) { ?>
<div id='spacer'>&nbsp;</div>
<div  id='class'>
	<p><?
		foreach($classes as $class) {
			$theClasses[] = $class->name;
		}
		if (count($theClasses)>1)
			echo 'Classes - ';
		else
			echo 'Class - ';
		echo implode(", ",$theClasses);
	?></p>
</div>
<? } ?>
<div id='spacer'>&nbsp;</div>
<div id='url'>
	<p>
	<? if ($url) { ?>
		<?= getProjectMeta('externalURL');?><br />
	<? } else { ?>
		<?= get_bloginfo('url'); ?>/<?=$post->post_name?>
	<? } ?>
	<br>
</div>
</div><!-- end of content -->
</div><!-- end of wrapper -->
</body>
</html>
