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
                    ?>

                        <?php 
                            $photo = get_sub_field( 'photo' );
                            $url = get_sub_field( 'button_link' );
                            // If the user forgot a protocol, we need to add it
                            $has_http = preg_match_all( '/(http)?(s)?(:)?(\/\/)/', $url, $matches );
                            if ( $has_http == 0 ) {
                                $url = '//' . $url;
                            }
                            $image_alignment = array(
                                'top-left' => '0% 0%',
                                'top-center' => '50% 0%',
                                'top-right' => '100% 0%',
                                'center-left' => '0% 50%',
                                'center-center' => '50% 50%',
                                'center-right' => '100% 50%',
                                'bottom-left' => '0% 100%',
                                'bottom-center' => '50% 100%',
                                'bottom-right' => '100% 100%',
                            );
                        ?>

                        <div class="slide<?php echo ( ( $first === true ) ? ' active' : '' ); ?>">

                            <?php if ( ( $index % 2 ) > 0 ) : ?>

                            <div class="small-6 columns image" style="background-image: url( '<?php echo $photo['sizes']['medium']; ?> '); background-position: <?php echo $image_alignment[ get_sub_field( 'image_alignment' ) ]; ?>">
                            </div>

                            <?php endif; ?>

                            <div class="small-6 columns text">
                                <<?php echo get_sub_field( 'descriptor_size' ); ?>><?php echo get_sub_field( 'descriptor' ); ?></<?php echo get_sub_field( 'descriptor_size' ); ?>>
                                <a href="<?php echo $url; ?>" class="button"><?php echo get_sub_field( 'button_text' ); ?></a>
                            </div>

                            <?php if ( ( $index % 2 ) == 0 ) : ?>

                            <div class="small-6 columns image" style="background-image: url( '<?php echo $photo['sizes']['medium']; ?> '); background-position: <?php echo $image_alignment[ get_sub_field( 'image_alignment' ) ]; ?>">
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


    </div>

    <div class="small-12 medium-6 columns">
        
        <div class="text-center">

            <?php echo wp_get_attachment_image( get_theme_mod( 'soma_gallery_image', 1 ), 'medium', false, array( 'class' => 'thumbnail' ) ); ?>
            
        </div>


    </div>

</section>

<?php
get_footer();