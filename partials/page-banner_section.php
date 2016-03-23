<?php
/**
 * Shows a half/half section with text and an Image, set via ACF.
 *
 * @since   0.1.0
 * @package spirit-of-mosaic-art
 *
 * @global WP_Query $wp_query
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {

    die;

}

?>

<section id="banner-section">
    
    <div class="row">
    
        <div class="media-object stack-for-small">

            <div class="media-object-section">

                <?php echo wp_get_attachment_image( get_field( 'banner_section_image' ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>

            </div>

            <div class="media-object-section">

                <?php echo apply_filters( 'the_content', get_field( 'banner_section_content' ) ); ?>

            </div>

        </div>
        
    </div>

</section>