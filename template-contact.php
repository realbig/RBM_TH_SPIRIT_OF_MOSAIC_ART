<?php
/**
 * Template Name: Contact
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

include( locate_template( 'partials/page-featured-header.php' ) ); ?>

<section id="page-<?php the_ID(); ?>" <?php body_class( array( 'page-content', 'contact' ) ); ?>>
    <div class="row">
        <div class="small-12 medium-9 columns">
            
            <h1 class="page-title"><?php the_title(); ?></h1>

            <div class="page-copy">
                <?php the_content(); ?>
                
                <?php dynamic_sidebar( 'events-sidebar' ); ?>
            </div>
            
        </div>
        
        <div class="small-12 medium-3 columns sidebar">

            <?php dynamic_sidebar( 'contact-sidebar' ); ?>

        </div>

    </div>
</section>

<?php
get_footer();