<?php
/**
 * Front Page template
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

<?php if ( have_rows( 'soma_slides' ) ) : ?>

    <section id="home-slider" class="realbig-slider-container">
        <div class="realbig-slider">

            <div class="inner">

                <?php
                    $first = true;
                    $index = 0;
                    while ( have_rows( 'soma_slides' ) ) : the_row();
                
                        $photo = get_sub_field( 'photo' );
                        $url = get_sub_field( 'button_link' );
                        // If the user forgot a protocol, we need to add it
                        $has_http = preg_match_all( '/(http)?(s)?(:)?(\/\/)/', $url, $matches );
                        if ( $has_http == 0 ) {
                            $url = '//' . $url;
                        }
                
                        ?>

                        <div class="slide<?php echo ( ( $first === true ) ? ' active' : '' ); ?>">

                            <?php if ( ( $index % 2 ) > 0 ) : ?>

                            <div class="small-6 columns image" style="background-image: url( '<?php echo $photo['sizes']['medium']; ?> '); background-color: <?php echo get_sub_field( 'photo_background' ); ?>">
                            </div>

                            <?php endif; ?>

                            <div class="small-6 columns text">
                                <<?php echo get_sub_field( 'descriptor_size' ); ?>><?php echo get_sub_field( 'descriptor' ); ?></<?php echo get_sub_field( 'descriptor_size' ); ?>>
                                <a href="<?php echo $url; ?>" class="button"><?php echo get_sub_field( 'button_text' ); ?></a>
                            </div>

                            <?php if ( ( $index % 2 ) == 0 ) : ?>

                            <div class="small-6 columns image" style="background-image: url( '<?php echo $photo['sizes']['medium']; ?> '); background-color: <?php echo get_sub_field( 'photo_background' ); ?>">
                            </div>

                            <?php endif; ?>

                        </div>

                    <?php
                        $first = false;
                        $index++;
                
                    endwhile;
                ?>

            </div>

            <div class="arrow arrow-left"></div>
            <div class="arrow arrow-right"></div>

            <ul class="indicators"></ul>

        </div>
    </section>

<?php endif; ?>

<section id="page-<?php the_ID(); ?>" <?php body_class( array( 'page-content' ) ); ?>>
    <div class="row">
        <div class="small-12 columns">

            <div class="page-copy">
                <?php the_content(); ?>
            </div>
            
        </div>

    </div>
</section>

<section id="classes-gallery" class="row">
        
    <div class="small-12 medium-6 columns">
        
        <div class="text-center">

            <?php echo wp_get_attachment_image( get_theme_mod( 'soma_classes_image', 1 ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>
            
        </div>
        
        <?php echo apply_filters( 'the_content', get_theme_mod( 'soma_classes_text', '' ) ); ?>
        
        <div class="text-center">
            <a class="button" href="<?php echo get_theme_mod( 'soma_classes_link', '#' ); ?>"><?php echo get_theme_mod( 'soma_classes_button', 'Accents & Classes' ); ?></a>
        </div>

    </div>

    <div class="small-12 medium-6 columns">
        
        <div class="text-center">

            <?php echo wp_get_attachment_image( get_theme_mod( 'soma_gallery_image', 1 ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>
            
        </div>
        
        <?php echo apply_filters( 'the_content', get_theme_mod( 'soma_gallery_text', '' ) ); ?>
        
        <div class="text-center">
            <a class="button" href="<?php echo get_theme_mod( 'soma_gallery_link', '#' ); ?>"><?php echo get_theme_mod( 'soma_gallery_button', 'Gallery' ); ?></a>
        </div>

    </div>

</section>

<section id="events" class="row">
    
    <?php dynamic_sidebar( 'events-sidebar' ); ?>

</section>

<?php
get_footer();