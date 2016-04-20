String.prototype.hexToRGB = function( output ) {

    if ( output == undefined ) {
        output = 'css';
    }

    var rgb = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec( this );

    if ( output.toLowerCase() == 'css' ) {
        return rgb ? 'rgb( ' + parseInt( rgb[1], 16 ) + ', ' + parseInt( rgb[2], 16 ) + ', ' + parseInt( rgb[3], 16 ) + ' )' : null;
    }
    else {
        return rgb ? {
            r: parseInt(rgb[1], 16),
            g: parseInt(rgb[2], 16),
            b: parseInt(rgb[3], 16)
        } : null;
    }

}