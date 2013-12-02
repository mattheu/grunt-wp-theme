<?php

/**
 * The main template file
 *
 * @package {%= title %}
 * @since 0.1.0
 */

get_header();

?>

<?php while ( have_posts() ) : ?>
	
	<?php 

	the_post();

	$template = ( 'post' === get_post_type() ) ? get_post_format() : get_post_type(); 
	
	get_template_part( 'parts/index/single', $template ); 

	?>

<?php endwhile; ?>

<?php get_footer(); ?>