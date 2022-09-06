<?php
/**
 * The Alternate Header for our theme.
 *
 * Displays sliders and others from the header section
 *
 * @package Zozothemes
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	
	<!-- Latest IE rendering engine & Chrome Frame Meta Tags -->
	<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
	
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	
	<?php gosolar_page_loader(); ?>
<div id="zozo_wrapper" class="wrapper-class">
	<div id="section-top" class="zozo-top-anchor"></div>
	<?php gosolar_page_slider_wrapper(); ?>
	
	<div id="main" class="main-section">