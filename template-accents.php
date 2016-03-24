<?php
/**
 * Template Name: Accents
 *
 * @since 0.1.0
 * @package spirit-of-mosaic-art
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

get_header();

the_post();
?>

<section id="page-<?php the_ID(); ?>" <?php body_class( array( 'page-content', 'accents' ) ); ?>>
    <div class="row">
        <div class="small-12 columns">

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="page-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
            <?php endif; ?>
            
            <h1 class="page-title"><?php the_title(); ?></h1>

            <div class="page-copy">
                <?php the_content(); ?>
            </div>
            
        </div>

    </div>
</section>

<?php include( locate_template( 'partials/page-banner-section.php' ) ); ?>

<section id="commissioned-artwork">
    <div class="row">
        <div class="small-12 columns">
            <?php echo do_shortcode( '[soma_artwork commissioned_only=true]' ); ?>
        </div>
    </div>
</section>

<?php
get_footer();