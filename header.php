<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>

	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats please -->

	<style type="text/css" media="screen">
    @import url("http://itp.nyu.edu/itp/main.css"); <?php //TODO ?>
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		@import url( <?php bloginfo('template_url');
		  echo "/body_style.css"; ?>);
	</style>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
</head>
<body>

<div id="container">
	<div style='position:absolute;top:0;left:0;background-color:#000;width:100%;'>
	<?php //TODO include 'includes/top-bar.php'; ?>
	</div>

<div class="header">
	<div class="header1"></div>
	<div class="header2">
		<br>
	</div>
</div>

<!-- end header -->

