<?php
/**
 * The theme's functions file that loads on EVERY page, used for uniform functionality.
 *
 * @since   0.1.0
 * @package spirit-of-mosaic-art
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

// Make sure PHP version is correct
if ( ! version_compare( PHP_VERSION, '5.3.0', '>=' ) ) {
    wp_die( 'ERROR in Spirit of Mosaic Art theme: PHP version 5.3 or greater is required.' );
}

// Make sure no theme constants are already defined (realistically, there should be no conflicts)
if ( defined( 'THEME_VERSION' ) || defined( 'THEME_ID' ) || isset( $soma_fonts ) ) {
    wp_die( 'ERROR in Spirit of Mosaic Art theme: There is a conflicting constant. Please either find the conflict or rename the constant.' );
}

/**
 * The theme's current version (make sure to keep this up to date!)
 */
define( 'THEME_VERSION', '0.1.0' );

/**
 * The theme's ID (used in handlers).
 */
define( 'THEME_ID', 'soma_theme' );

/**
 * Fonts for the theme. Must be hosted font (Google fonts for example).
 */
$soma_fonts = array(
    'Font Awesome' => '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
);

/**
 * Setup theme properties and stuff.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {

    // Image sizes
    if ( ! empty( $soma_image_sizes ) ) {

        foreach ( $soma_image_sizes as $ID => $size ) {
            add_image_size( $ID, $size['width'], $size['height'], $size['crop'] );
        }

        add_filter( 'image_size_names_choose', '_meesdist_add_image_sizes' );
    }

    // Add theme support
    require_once __DIR__ . '/includes/theme-support.php';
    
    // Add Customizer Controls
    add_action( 'customize_register', 'soma_customize_register' );

    require_once __DIR__ . '/includes/class-foundation_nav_walker.php';

    // Allow shortcodes in text widget
    add_filter( 'widget_text', 'do_shortcode' );

} );

/**
 * Adds custom Customizer Controls.
 *
 * @since 0.1.0
 */
function soma_customize_register( $wp_customize ) {
    
    // General Theme Options
    $wp_customize->add_section( 'soma_customizer_section' , array(
            'title'      => __( 'Spirit of Mosaic Art Settings', THEME_ID ),
            'priority'   => 30,
        ) 
    );
    
    $wp_customize->add_setting( 'soma_logo_image', array(
            'default'     => 'http://placehold.it/1200x312',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'soma_logo_image', array(
        'label'        => __( 'Logo Banner', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_logo_image',
    ) ) );
    
    $wp_customize->add_setting( 'soma_footer_columns' , array(
            'default'     => 4,
            'transport'   => 'refresh',
        )
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_footer_columns', array(
        'type' => 'number',
        'label'        => __( 'Footer Number of Columns/Widget Areas', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_footer_columns',
    ) ) );
    
}

/**
 * Adds support for custom image sizes.
 *
 * @since 0.1.0
 *
 * @param $sizes array The existing image sizes.
 *
 * @return array The new image sizes.
 */
function _meesdist_add_image_sizes( $sizes ) {

    global $soma_image_sizes;

    $new_sizes = array();
    foreach ( $soma_image_sizes as $ID => $size ) {
        $new_sizes[ $ID ] = $size['title'];
    }

    return array_merge( $sizes, $new_sizes );
}

/**
 * Register theme files.
 *
 * @since 0.1.0
 */
add_action( 'init', function () {

    global $soma_fonts;

    // Theme styles
    wp_register_style(
        THEME_ID,
        get_template_directory_uri() . '/style.css',
        null,
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION
    );

    // Theme script
    wp_register_script(
        THEME_ID,
        get_template_directory_uri() . '/script.js',
        array( 'jquery' ),
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
        true
    );
    
    wp_localize_script( THEME_ID, THEME_ID . '_data', array( 'ajaxUrl' => admin_url( 'admin-ajax.php' ) ) );

    // Theme fonts
    if ( ! empty( $soma_fonts ) ) {
        foreach ( $soma_fonts as $ID => $link ) {
            wp_register_style(
                THEME_ID . "-font-$ID",
                $link
            );
        }
    }

} );

/**
 * Register sidebars.
 *
 * @since 0.1.0
 */
add_action( 'widgets_init', function () {

    // Main Sidebar
    register_sidebar( array(
        'name' => __( 'Main Sidebar', THEME_ID ),
        'id' => 'main-sidebar',
        'description' => __( 'This is the default sidebar that appears.', THEME_ID ),
    ) );
    
    // Footer
    $footer_columns = get_theme_mod( 'soma_footer_columns', 4 );
    for ( $index = 0; $index < $footer_columns; $index++ ) {
        register_sidebar(
            array(
                'name'          =>  'Footer ' . ( $index + 1 ),
                'id'            =>  'footer-' . ( $index + 1 ),
                'description'   =>  sprintf( __( 'This is Footer Widget Area %d', THEME_ID ), ( $index + 1 ) ),
                'before_widget' =>  '<aside id="%1$s" class="widget %2$s">',
                'after_widget'  =>  '</aside>',
                'before_title'  =>  '<h3 class="widget-title">',
                'after_title'   =>  '</h3>',
            )
        );
    }

} );

/**
 * Adds a favicon.
 *
 * @since 0.1.0
 */
add_action( 'wp_head', '_soma_favicon' );
add_action( 'admin_head', '_soma_favicon' );
function _soma_favicon() {

    if ( ! file_exists( get_stylesheet_directory() . '/assets/images/favicon.ico' ) ) {
        return;
    }
?>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() . '/assets/images/favicon.ico'; ?>" />
<?php
}

/**
 * Enqueue theme files.
 *
 * @since 0.1.0
 */
add_action( 'wp_enqueue_scripts', function () {

    global $soma_fonts;

    // Theme styles
    wp_enqueue_style( THEME_ID );

    // Theme script
    wp_enqueue_script( THEME_ID );

    // Theme fonts
    if ( ! empty( $soma_fonts ) ) {
        foreach ( $soma_fonts as $ID => $link ) {
            wp_enqueue_style( THEME_ID . "-font-$ID" );
        }
    }

} );

/**
 * Register nav menus.
 *
 * @since 0.1.0
 */
add_action( 'after_setup_theme', function () {

    register_nav_menu( 'primary-nav', 'Primary Menu' );

} );

/*
 * Since WP Smilies load as Images, MailChimp makes them HUGE. For RSS Feeds, let's make sure they are straight text.
 *
 * @since 0.1.0
 */
add_action( 'pre_get_posts', 'remove_wp_smilies_from_feed' );
function remove_wp_smilies_from_feed( $query ) {
    
    if ( $query->is_feed ) {
        remove_filter( 'the_content', 'convert_smilies' );
    }
    
}