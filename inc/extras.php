<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package customizer-js
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
add_filter( 'body_class', function( $classes ) {

	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
} );

/**
 * Prevent posts to render in any page.
 */
add_action( 'pre_get_posts', function( $query ) {

	if ( $query->is_main_query() && ! is_admin() ) {
		$query->set( 'post_type', 'not_post' );
		return;
	}

}, 10 );