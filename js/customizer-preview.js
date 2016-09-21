/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var customize = wp.customize;

	customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	customize( 'display_blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title' ).toggle( to );
		} );
	} );

	customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).css( 'color', to );
		} );
	} );

	customize( 'header_textcolor_hover', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' )
				.on( 'mouseenter', function() {
					$( this ).css( 'color', to );
				} )
				.on( 'mouseout', function() {
					$( this ).css( 'color', customize( 'header_textcolor' ).get() );
				} );
		} );
	} );

	$( document.body ).on( 'click', '.customizer-edit', function(){
		customize.preview.send( 'preview-edit', $( this ).data( 'control' ) );
	});

} )( jQuery );
