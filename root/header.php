<?php

/**
 * The template for displaying the header.
 *
 * @package {%= title %}
 * @since 0.1.0
 */

?><!DOCTYPE html>
<!--[if IE 7 ]><html <?php language_attributes(); ?> class="no-js oldie ie7"><![endif]-->
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="no-js oldie ie8"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<head>

 	<!-- no-js or js Helper class to help prevent FOUC -->
	<script type="text/javascript">(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php bloginfo('name'); ?> <?php wp_title( '|' ); ?></title>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>