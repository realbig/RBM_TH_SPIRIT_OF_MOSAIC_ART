jQuery( document ).ready( function( $ ) {
    
    if ( $( '.em-calendar' ).length > 0 ) {
    
        $( '.em-calendar' ).attr( 'height', ( $( '.em-calendar' )[0].clientWidth - 50 ) );
        
    }
    
} );