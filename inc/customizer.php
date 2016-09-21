<?php
/**
 * tuts Theme Customizer.
 *
 * @package customizer-js
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function cjs_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogdescription' )->priority = '12';

	$wp_customize->get_setting( 'header_textcolor' )->default = '#f44336';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	$wp_customize->get_control( 'header_textcolor' )->priority = '10';

	$wp_customize->remove_control( 'blogdescription' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->remove_control( 'background_color' );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'header_textcolor_hover', array(
		'default'           => '#C62828',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_textcolor_hover', array(
		'label'    => __( 'Header Text Color: Hover', 'cjs' ),
		'section'  => 'colors',
		'priority' => '15'
	) ) );

	$wp_customize->add_setting( 'display_blogname', array(
		'transport' => 'postMessage',
	) );

	$wp_customize->add_control( 'display_blogname', array(
		'label'     => __( 'Display Site Title', 'cjs' ),
		'section'   => 'title_tagline',
		'type'      => 'checkbox',
		'priority'  => 11,
	) );
}
add_action( 'customize_register', 'cjs_customize_register' );

/**
 * [cjs_customize_control_js description]
 * @return [type] [description]
 */
function cjs_customize_control_js() {
	wp_enqueue_script( 'tuts-customizer-control', get_template_directory_uri() . '/js/customizer-control.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'cjs_customize_control_js' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function cjs_customize_preview_js() {
	wp_enqueue_script( 'tuts-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array( 'customize-preview' ), null, true );
}
add_action( 'customize_preview_init', 'cjs_customize_preview_js' );

/**
 * [cjs_header_textcolor_hover_css description]
 * @return [type] [description]
 */
function cjs_header_textcolor_hover_css() {

	$default = '#C62828';
	$color   = get_theme_mod( 'header_textcolor_hover', '#C62828' );

	// Don't do anything if the current color is the default.
	if ( $color === $default ) {
		return;
	}

	// If the rgba values are empty return early.
	if ( empty( $color ) ) {
		return;
	}

	$css = '
	';

	wp_add_inline_style( 'tuts-style', sprintf( $css, $color ) );
}
add_action( 'wp_enqueue_scripts', 'cjs_header_textcolor_hover_css', 11 );
