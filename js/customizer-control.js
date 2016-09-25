( function( $ ) {

	wp.customize.bind( 'ready', function() {

		var customize = this;

		wp.customize.section( 'colors' ).collapse({
			duration: 0
		});

		customize( 'display_blogname', function( value ) {

			var siteTitleInput = customize.control( 'blogname' ).container.find( 'input' );
			siteTitleInput.prop( 'disabled', !value.get() );
			value.bind( function( to ) {
				siteTitleInput.prop( 'disabled', !to );
			} );

			// 1. Control Toggles
			var colorControls = [
				'header_textcolor',
				'header_textcolor_hover'
			];

			$.each( colorControls, function( index, id ) {
				customize.control( id, function( control ) {
					var toggle = function( to ) {
						control.toggle( to );
					};
					toggle( value.get() );
					value.bind( toggle );
				} );
			} );

			// 1.b
			function toggleSection( section, to ) {
				if ( to ) {
					customize.section( 'colors' ).deactivate({
						duration: 0
					});
				} else {
					customize.section( 'colors' ).activate({
						duration: 0
					});
				}
			}

			toggleSection( 'colors', !value.get() );

			value.bind( function( to ) {
				toggleSection( 'colors', !to );
			} );

			//3. Handling Colors
			customize( 'header_textcolor', function( value ) {

				function shadeColor( color, percent ) {

					var f = parseInt( color.slice( 1 ), 16 ),
						t = percent < 0 ? 0 : 255,
						p = percent < 0 ? percent * -1 : percent,

						R = f >> 16,
						G = f >> 8 & 0x00FF,
						B = f & 0x0000FF;

						return "#" + ( 0x1000000 + ( Math.round( ( t - R ) * p ) + R ) * 0x10000 + ( Math.round( ( t - G ) * p ) + G ) * 0x100 + ( Math.round( ( t - B ) * p ) + B ) ).toString( 16 ).slice( 1 );
				}

				value.bind( function( value ) {

					var color = shadeColor( value, -0.2 ); // Set the 'hover' color value.

					customize( 'header_textcolor_hover' ).set( color );

					customize
						.control( 'header_textcolor_hover' )
						.container.find( '.color-picker-hex' )
							.data( 'data-default-color', color )
								.wpColorPicker( 'defaultColor', color );
				} );
			} );

			customize.previewer.bind( 'preview-edit', function( data ) {

				var data = JSON.parse( data );
				var control = customize.control( data.name );

				control.focus( {
					completeCallback : function() {

						setTimeout( function() {
							control.container.addClass( 'shake animated' );
						}, 300 )

						if ( data.color === true ) {

							setTimeout( function() {

								var container = control.container;
								var active = container.find( '.wp-picker-active' );

								if ( active.length !== 0 ) {
									return;
								};

								container
									.find( '.color-picker-hex' )
									.wpColorPicker( 'open' );

							}, 200 );
						}
					}
				} );
			} );
		} );
} );

} )( jQuery );
