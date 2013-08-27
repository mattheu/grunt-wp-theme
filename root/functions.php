<?php
/**
 * {%= title %} functions and definitions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * @package {%= title %}
 * @since 0.1.0
 */
/**
 * Check whether currently running a live or dev environment.
 *
 * Uses value of HM_DEV.
 */
function {%= prefix %}_is_dev() {

	return apply_filters( '{%= prefix %}_is_dev', defined( 'HM_DEV' ) && true === HM_DEV );

}

/**
 * Get the theme version.
 * Return version defined in style.css
 *
 * @return string version.
 * @since 0.1.0
 */
function {%= prefix %}_get_theme_version() {

	//  wp_get_theme since WordPress 3.4.0
	if ( function_exists( 'wp_get_theme' ) ) {
		$theme = wp_get_theme( basename( get_bloginfo( 'stylesheet_directory' ) ) );
		$version = $theme->version;
	} else {
		$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );
		$version = $theme['Version'];
	}

	return apply_filters( '{%= prefix %}_get_theme_version', $version );

}

/**
 * Enqueue scripts and styles for front-end.
 *
 * @since 0.1.0
 */
function {%= prefix %}_scripts_styles() {

	$version = {%= prefix %}_get_theme_version();
	$postfix = ( {%= prefix %}_is_dev() ) ? '' : '.min';

	wp_enqueue_script( '{%= prefix %}-theme', get_template_directory_uri() . "/assets/js/theme{$postfix}.js", array(), $version, true );

	wp_enqueue_style( '{%= prefix %}-theme', get_template_directory_uri() . "/assets/css/theme{$postfix}.css", array(), $version );

	// Livereload. To use, run 'grunt watch'.
	if ( {%= prefix %}_is_dev() ) {
		wp_enqueue_script( '{%= prefix %}-livereload', home_url() . ':35729/livereload.js' ); // When running grunt watch inside vagrant.
		// wp_enqueue_script( '{%= prefix %}-livereload', 'http://localhost:35729/livereload.js' ); // When running grunt watch on your machine.
	}

}
add_action( 'wp_enqueue_scripts', '{%= prefix %}_scripts_styles' );

/**
 * Add humans.txt to the <head> element.
 */
function {%= prefix %}_header_meta() {

	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';

	echo apply_filters( '{%= prefix %}_humans', $humans );

}
add_action( 'wp_head', '{%= prefix %}_header_meta' );