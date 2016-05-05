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

    <div id="home-slider" class="orbit" role="region" aria-label="<?php _e( 'Home Slider', THEME_ID ); ?>" data-orbit>
        
        <ul class="orbit-container">
            
            <button class="orbit-previous"><span class="show-for-sr"><?php _e( 'Previous', THEME_ID ); ?></span>&#9664;&#xFE0E;</button>
            <button class="orbit-next"><span class="show-for-sr"><?php _e( 'Next', THEME_ID ); ?></span>&#9654;&#xFE0E;</button>
            
            <?php
            
            $first = true;
            $index = 0;
            $indicators = ''; // Only doing this loop once
            
            while ( have_rows( 'soma_slides' ) ) : the_row();
                
                $photo = get_sub_field( 'photo' );
                $url = get_sub_field( 'button_link' );
            
            ?>
            
            <li class="<?php echo ( $first === true ) ? 'is-active ' : ''; ?>orbit-slide">
                
                <div class="row">
                    
                    <?php if ( ( $index % 2 ) > 0 ) : ?>

                        <div class="small-6 columns image">
                            <div class="vertical-align">
                                <?php echo wp_get_attachment_image( $photo, 'medium' ); ?>
                            </div>
                        </div>

                    <?php endif; ?>

                        <div class="small-6 columns text">
                            <div class="vertical-align">
                                <<?php echo get_sub_field( 'descriptor_size' ); ?>><?php echo get_sub_field( 'descriptor' ); ?></<?php echo get_sub_field( 'descriptor_size' ); ?>>
                                <a href="<?php echo $url; ?>" class="secondary button"><?php echo get_sub_field( 'button_text' ); ?></a>
                            </div>
                        </div>

                    <?php if ( ( $index % 2 ) == 0 ) : ?>

                        <div class="small-6 columns image">
                            <div class="vertical-align">
                                <?php echo wp_get_attachment_image( $photo, 'medium' ); ?>
                            </div>
                        </div>

                    <?php endif; ?>
                    
                </div>
                
            </li>
            
            <?php
            
                $indicators .= '<button ' . ( ( $first === true ) ? 'class="is-active" ' : '' ) . 'data-slide="' . $index . '"><span class="show-for-sr">' . sprintf( __( 'Slide %d', THEME_ID ), $index + 1 ) . '</span>' . ( ( $first === true ) ? '<span class="show-for-sr">' . __( 'Current Slide', THEME_ID ) . '</span>' : '' ) . '</button>';
            
                $first = false;
                $index++;
            
            endwhile; ?>
            
        </ul>
        
        <nav class="orbit-bullets">
            <?php echo $indicators; ?>
        </nav>
        
    </div>

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

            <?php echo wp_get_attachment_image( get_theme_mod( 'soma_accents_image', 1 ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>
            
        </div>
        
        <?php echo apply_filters( 'the_content', get_theme_mod( 'soma_accents_text', '' ) ); ?>
        
        <div class="text-center">
            <a class="secondary button" href="<?php echo get_theme_mod( 'soma_accents_link', '#' ); ?>"><?php echo get_theme_mod( 'soma_accents_button', 'Accents & Classes' ); ?></a>
        </div>

    </div>

    <div class="small-12 medium-6 columns">
        
        <div class="text-center">

            <?php echo wp_get_attachment_image( get_theme_mod( 'soma_gallery_image', 1 ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>
            
        </div>
        
        <?php echo apply_filters( 'the_content', get_theme_mod( 'soma_gallery_text', '' ) ); ?>
        
        <div class="text-center">
            <a class="secondary button" href="<?php echo get_theme_mod( 'soma_gallery_link', '#' ); ?>"><?php echo get_theme_mod( 'soma_gallery_button', 'Gallery' ); ?></a>
        </div>

    </div>

</section>

<section id="events" class="row">
    
    <?php dynamic_sidebar( 'events-sidebar' ); ?>

</section>

<?php
get_footer();