<?php
/**
 * The theme's 404 page for showing not found pages.
 *
 * @since 0.3.0
 * @package spirit-of-mosaic-art
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

get_header();

the_post();
?>

<section id="page-<?php the_ID(); ?>" <?php body_class( array( 'page-content' ) ); ?>>
    <div class="row">
        <div class="small-12 medium-9 columns">
            
            <h1 class="page-title"><?php echo __( '404 - Page Not Found', THEME_ID ); ?></h1>

            <div class="page-copy">
                <?php echo __( 'Sorry, but this page doesn\'t seem to be here!', THEME_ID ); ?>
            </div>
            
        </div>
        
        <div class="small-12 medium-3 columns sidebar">

            <?php dynamic_sidebar( 'main-sidebar' ); ?>

        </div>

    </div>
</section>

<?php
get_footer();