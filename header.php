<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package customizer-js
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href="https://fonts.googleapis.com/css?family=Secular+One" rel="stylesheet">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'cjs' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php
			if ( get_theme_mod( 'display_blogname', true ) ) :
				if ( is_front_page() && is_home() ) : ?>

				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					<?php if ( is_customize_preview() ) : ?>
					<button class="customizer-edit" data-control='{ "name":"blogname" } ''><?php esc_html_e( 'Edit Text', 'cjs' ); ?></button>
					<button class="customizer-edit" data-control='{ "name":"header_textcolor", "color": true } ''><?php esc_html_e( 'Edit Color', 'cjs' ); ?></button>
					<?php endif; ?>
				</h1>

				<?php else : ?>

					<div class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
						<?php if ( is_customize_preview() ) : ?>
						<button class="customizer-edit" data-control='{ "name":"blogname" } ''><?php esc_html_e( 'Edit Text', 'cjs' ); ?></button>
						<button class="customizer-edit" data-control='{ "name":"header_textcolor", "color": true } ''><?php esc_html_e( 'Edit Color', 'cjs' ); ?></button>
						<?php endif; ?>
					</div>

				<?php
				endif;
			endif;
			?>
		</div><!-- .site-branding -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">

	<?php
