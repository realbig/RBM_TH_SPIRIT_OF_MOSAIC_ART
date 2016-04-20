jQuery( function( $ ) {

    $( document ).ready( function() {

        $( '.color-overlay' ).each( function( index, element ) {
            
            if ( $( element ).data( 'overlay_color' ) !== '' ) {

                // Ensures we have a Selector specific to this particular Overlay. Used when we add our CSS Rules
                var selector = $( element ).getSelector() + ':before'.toLowerCase();

                // Grab RGB values as an Object
                var rgb = $( element ).data( 'overlay_color' ).hexToRGB( 'object' );

                // Convert alpha to a percentage
                var alpha = $( element ).data( 'overlay_opacity' ) * .01;

                // Create CSS String
                var rgba = 'rgba( ' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ', ' + alpha + ' )';

                $( selector ).addRule( {
                    'background-color': $( element ).data( 'overlay_color' ).hexToRGB(),
                } );

                // We set this separately so that we're still supporting super old stuff with a solid color above
                $( selector ).addRule( {
                    'background-color': rgba,
                } );
                
            }

        } );

    } );

} );