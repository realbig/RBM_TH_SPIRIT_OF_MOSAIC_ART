<?php
/**
 * Post index page.
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
?>

<section id="post-index">

        <?php
        if ( have_posts() ) : 
            while ( have_posts() ) :
                the_post();
                ?>
    <div class="blog-loop">
        <div class="row">
            <div class="small-12 columns">
                <article <?php post_class(); ?>>

                    <?php get_template_part( 'partials/' . get_post_type(), 'loop-single' ); ?>

                </article>
            </div>
        </div>
    </div>
                
                <?php
            endwhile;
        else:
        ?>

    <div class="row">
        <div class="small-12 columns">
            Nothing found.
        </div>
    </div>

        <?php endif; ?>
        
    <div class="row">
        <div class="pagination">
            <?php 
            $post_type_object = get_post_type_object( get_post_type() );
            $plural_label = $post_type_object->labels->name;
            echo paginate_links( array(
                'current' => ( get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ),
                'prev_text' => sprintf( __( '&laquo; View Older %s', THEME_ID ), $plural_label ),
                'next_text' => sprintf( __( 'View Newer %s &raquo;', THEME_ID ), $plural_label ),
            ) );
            ?>
        </div>    
    </div>
    
</section>

<?php
get_footer();