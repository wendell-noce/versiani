<?php
/**
 * Header template
 * 
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * 
 * @package tri
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-180750891-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-180750891-1');
	</script>
	
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Color for the Android Chrome title bar -->
	<meta name="theme-color" content="#A6C7EA">
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php
		// Favicons
		Utils::get_template( 'includes/favicons', array( 'path' => get_template_directory_uri() . '/assets/img/favicons' ) );
		
		wp_head();
	?>
	
</head>

<body <?php body_class(); ?>>


<div id="page">
	<!-- HEADER -->
	<?php Utils::get_template( 'components/header' ); ?>

	<div id="content">