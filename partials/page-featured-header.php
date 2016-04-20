<?php
/**
 * Shows the Featured Image as a Hero with Overlay Color controls set via ACF
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

if ( has_post_thumbnail() ) :
    $hero_image_background = wp_get_attachment_image_src( get_theme_mod( 'soma_hero_background', 1 ) , 'hero-image' );
?>

    <section class="hero-image" style="background-image: url( '<?php echo $hero_image_background[0];?>' ); height: <?php echo $hero_image_background[2]; ?>px;">
        
        <div class="color-overlay" data-overlay_color="<?php the_field( 'hero_background_overlay_color' ); ?>" data-overlay_opacity="<?php the_field( 'hero_background_overlay_opacity' ); ?>"></div>
        
        <?php the_post_thumbnail( 'medium' ); ?>
        
    </section>

<?php endif;