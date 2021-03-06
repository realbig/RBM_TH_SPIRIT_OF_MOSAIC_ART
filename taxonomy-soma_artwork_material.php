<?php
/**
 * Artwork Material Taxonomy index page.
 *
 * @since 0.1.0
 * @package spirit-of-mosaic-art
 *
 * @global WP_Query $wp_query
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

get_header();

global $wp_query;
$term = $wp_query->get_queried_object();

?>

<section id="soma_artwork-index" class="page-content">
    <div class="row">

        <?php if ( have_posts() ) : ?>
        <div class="small-12 medium-9 columns">
            
            <h1>Artwork in the <?php echo $term->name; ?> Category</h1>
            
            <?php while ( have_posts() ) :
            the_post();
        
                ?>
        
                <article <?php post_class( array( 'media-object', 'stack-for-small' ) ); ?>>
                    
                    <?php get_template_part( 'partials/soma_artwork', 'loop-single' ); ?>
                    
                </article>
        
            <?php endwhile; ?>
            
            <div class="pagination">
                <?php echo paginate_links( array( 
                    'current' => get_query_var( 'paged' ),
                ) ); ?>
            </div>
            
        </div>
        <?php else : ?>

        <div class="small-12 medium-9 columns">
            Nothing found.
        </div>

        <?php endif; ?>

        <div class="small-12 medium-3 columns sidebar">

            <?php dynamic_sidebar( 'main-sidebar' ); ?>

        </div>

        </div>
        </section>

    <?php
    get_footer();