<?php
/**
 * Template Name: About The Artists
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

<section id="page-<?php the_ID(); ?>" <?php body_class( array( 'page-content', 'gallery' ) ); ?>>
    <div class="row">
        <div class="small-12 medium-9 columns">

            <?php if ( has_post_thumbnail() ) : ?>
            <div class="page-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
            <?php endif; ?>
            
            <h1 class="page-title"><?php the_title(); ?></h1>

            <div class="page-copy">
                <?php the_content(); ?>
                
                <?php
                    $url = get_field( 'about_button_link' );
                    // If the user forgot a protocol, we need to add it
                    $has_http = preg_match_all( '/(http)?(s)?(:)?(\/\/)/', $url, $matches );
                    if ( $has_http == 0 ) {
                        $url = '//' . $url;
                    }
                ?>
                
                <a class="button" href="<?php echo $url; ?>"><?php the_field( 'about_button_text' ); ?></a>
            </div>
            
        </div>
        
        <div class="small-12 medium-3 columns sidebar">

            <?php dynamic_sidebar( 'main-sidebar' ); ?>

        </div>

    </div>
</section>

<?php
get_footer();