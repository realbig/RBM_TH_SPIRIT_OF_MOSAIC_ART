<?php
/**
 * The theme's header file that appears on EVERY page.
 *
 * @since   0.1.0
 * @package spirit-of-mosaic-art
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

// Start a session to preserve bucket data
if ( ! isset( $_SESSION ) ) {
    session_start();
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

        <!--[if lt IE 9]>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/vendor/js/html5.js"></script>
<![endif]-->

        <?php wp_head(); ?>

    </head>

    <body <?php body_class( 'off-canvas-wrapper' ); ?>>

        <div id="wrapper" class = "off-canvass-wrapper-inner" data-off-canvas-wrapper>

            <div class="off-canvas position-left nav-menu" id="offCanvasLeft" data-off-canvas>

                <?php
                wp_nav_menu( array(
                    'container' => false,
                    'menu' => __( 'Primary Menu', THEME_ID ),
                    'menu_class' => 'menu',
                    'theme_location' => 'primary-nav',
                    'items_wrap'      => '<ul id="%1$s" class="vertical %2$s">%3$s</ul>',
                    'fallback_cb' => false,
                    'walker' => new Foundation_Nav_Walker(),
                ) );
                ?>

            </div>

            <div class="off-canvas-content" data-off-canvas-content>

                <header id="site-header">
                    
                    <div class="top-bar show-for-small-only">
                        
                        <div class="top-bar-left show-for-small-only">

                            <button class="menu-icon" type="button" data-open="offCanvasLeft"></button>

                        </div>
                    
                    </div>
                    
                    <div class="row header-information">
                        
                        <div class="small-12 medium-5 medium-centered columns">
                    
                            <div class="row">
                            
                                <div class="small-12 medium-6 columns logo-container text-right">
                                    <a href="<?php bloginfo( 'url' ); ?>" title = "<?php bloginfo( 'name' ); ?> - Home">
                                        <?php echo wp_get_attachment_image( get_theme_mod( 'soma_logo_image', 1 ), 'header-logo', false, array( 'class' => 'header-logo thumbnail' ) ); ?>
                                    </a>
                                </div>
                                
                                <div class="small-12 medium-6 columns site-title-container">
                                    <h2 class="site-title">
                                        <a href="<?php bloginfo( 'url' ); ?>" title = "<?php bloginfo( 'name' ); ?> - Home">
                                            <?php bloginfo( 'name' ); ?>
                                        </a>
                                    </h2>
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="small-12 columns text-center">
                                    <h5><?php echo get_phone_number_link( get_theme_mod( 'soma_phone_number', '(517) 867-5309' ), '', true ); ?></h5>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="top-bar hide-for-small-only">

                        <div class="top-bar-section nav-menu">
                            <?php
                            wp_nav_menu( array(
                                'container' => false,
                                'menu' => __( 'Primary Menu', THEME_ID ),
                                'menu_class' => 'dropdown menu',
                                'theme_location' => 'primary-nav',
                                'items_wrap'      => '<ul id="%1$s" class="%2$s" data-dropdown-menu>%3$s</ul>',
                                'fallback_cb' => false,
                                'walker' => new Foundation_Nav_Walker(),
                            ) );
                            ?>
                        </div>

                    </div>

                </header>

                <section id="site-content">