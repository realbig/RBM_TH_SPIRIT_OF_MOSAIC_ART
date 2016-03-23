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
    add_image_size( 'header-logo', 200, 350 );

    // Add theme support
    require_once __DIR__ . '/includes/theme-support.php';
    
    // Add Customizer Controls
    add_action( 'customize_register', 'soma_customize_register' );

    require_once __DIR__ . '/includes/class-foundation_nav_walker.php';
    
    require_once __DIR__ . '/includes/theme-functions.php';

    // Allow shortcodes in text widget
    add_filter( 'widget_text', 'do_shortcode' );

} );

/**
 * Adds custom Customizer Controls.
 *
 * @since 0.1.0
 */
function soma_customize_register( $wp_customize ) {
    
    require_once __DIR__ . '/includes/class-text_editor_custom_control.php';
    
    // General Theme Options
    $wp_customize->add_section( 'soma_customizer_section' , array(
            'title'      => __( 'Spirit of Mosaic Art Settings', THEME_ID ),
            'priority'   => 30,
        ) 
    );
    
    $wp_customize->add_setting( 'soma_logo_image', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'soma_logo_image', array(
        'label'        => __( 'Logo Image', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_logo_image',
        'mime_type' => 'image',
    ) ) );
    
    $wp_customize->add_setting( 'soma_accents_image', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'soma_accents_image', array(
        'label'        => __( 'Accents Image', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_accents_image',
        'mime_type' => 'image',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_accents_text', array(
            'default'     => '',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'soma_accents_text', array(
        'label'        => __( 'Accents Text', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_accents_text',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_accents_button' , array(
            'default'     => 'Accents',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_accents_button', array(
        'label'        => __( 'Accents Button Text', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_accents_button',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_accents_link' , array(
            'default'     => '#',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_accents_link', array(
        'type' => 'url',
        'label'        => __( 'Accents Button Link', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_accents_link',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_gallery_image', array(
            'default'     => 1,
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'soma_gallery_image', array(
        'label'        => __( 'Gallery Image', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_gallery_image',
        'mime_type' => 'image',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_gallery_text', array(
            'default'     => '',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'soma_gallery_text', array(
        'label'        => __( 'Gallery Text', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_gallery_text',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_gallery_button' , array(
            'default'     => 'Gallery',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_gallery_button', array(
        'label'        => __( 'Gallery Button Text', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_gallery_button',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_gallery_link' , array(
            'default'     => '#',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_gallery_link', array(
        'type' => 'url',
        'label'        => __( 'Gallery Button Link', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_gallery_link',
        'active_callback' => 'is_front_page',
    ) ) );
    
    $wp_customize->add_setting( 'soma_phone_number' , array(
            'default'     => '(517) 867-5309',
            'transport'   => 'refresh',
        ) 
    );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'soma_phone_number', array(
        'label'        => __( 'Phone Number', THEME_ID ),
        'section'    => 'soma_customizer_section',
        'settings'   => 'soma_phone_number',
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
    
    // Customizer Controls
    wp_register_script(
        THEME_ID . '-customizer-controls',
        get_template_directory_uri() . '/customizer-controls.js',
        array( 'jquery', 'editor' ),
        defined( 'WP_DEBUG' ) && WP_DEBUG ? time() : THEME_VERSION,
        true
    );

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
    
    // Contact Sidebar
    register_sidebar( array(
        'name' => __( 'Contact Sidebar', THEME_ID ),
        'id' => 'contact-sidebar',
        'description' => __( 'This is the Contact sidebar.', THEME_ID ),
    ) );
    
    // Events Manager Sidebar
    register_sidebar( array(
        'name' => __( 'Events Manager Sidebar', THEME_ID ),
        'id' => 'events-sidebar',
        'description' => __( 'This is the Events Manager sidebar on the Homepage and Contact page.', THEME_ID ),
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
 * Add JavaScript for Customizer Controls
 *
 * @since 0.1.0
 * 
 */
add_action( 'customize_controls_enqueue_scripts', function() {
    
    wp_enqueue_script( THEME_ID . '-customizer-controls' );
    
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

/**
 * Creates the Artwork CPT
 *
 * @since 0.1.0
 */
add_action( 'init', 'register_cpt_soma_artwork' );
function register_cpt_soma_artwork() {
    $labels = array(
        'name' => _x( 'Artwork', THEME_ID ),
        'all_items' => __( 'All Artwork', THEME_ID ),
        'singular_name' => _x( 'Artwork', THEME_ID ),
        'add_new' => _x( 'Add New Artwork', THEME_ID ),
        'add_new_item' => _x( 'Add New Artwork', THEME_ID ),
        'edit_item' => _x( 'Edit Artwork', THEME_ID ),
        'new_item' => _x( 'New Artwork', THEME_ID ),
        'view_item' => _x( 'View Artwork', THEME_ID ),
        'search_items' => _x( 'Search Artwork', THEME_ID ),
        'not_found' => _x( 'No Artwork found', THEME_ID ),
        'not_found_in_trash' => _x( 'No Artwork found in Trash', THEME_ID ),
        'parent_item_colon' => _x( 'Parent Artwork:', THEME_ID ),
        'menu_name' => _x( 'Artwork', THEME_ID ),
        'featured_image'        => _x( 'Art', THEME_ID ),
        'remove_featured_image' => _x( 'Remove art', THEME_ID ),
        'set_featured_image'    => _x( 'Set art', THEME_ID ),
        'use_featured_image'    => _x( 'Use as art', THEME_ID ),
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-art',
        'hierarchical' => false,
        'description' => 'artwork',
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array(
            'slug' => 'artwork',
            'with_front' => false,
            'feeds' => false,
            'pages' => true
        ),
        'capability_type' => 'post',
        /*
        'capability_type' => 'artwork',
        'capabilities' => array(
            // Singular
            'edit_post'	=>	'edit_artwork',
            'read_post'	=>	'read_artwork',
            'delete_post'	=>	'delete_artwork',
            // Plural
            'edit_posts'	=>	'edit_artworks',
            'edit_others_posts'	=>	'edit_others_artworks',
            'publish_posts'	=>	'publish_artworks',
            'read_private_posts'	=>	'read_private_artworks',
            'delete_posts'	=>	'delete_artworks',
            'delete_private_posts'	=>	'delete_private_artworks',
            'delete_published_posts'	=>	'delete_published_artworks',
            'delete_others_posts'	=>	'delete_others_artworks',
            'edit_private_posts'	=>	'edit_private_artworks',
            'edit_published_posts'	=>	'edit_published_artworks',
        ),
		*/
    );
    register_post_type( 'soma_artwork', $args );
}
/**
 * Creates the Artwork Series Category
 *
 * @since 0.1.0
 */
add_action( 'init', 'register_taxonomy_soma_artwork_series' );
function register_taxonomy_soma_artwork_series() {
    $labels = array(
        'name' => _x( 'Series', THEME_ID ),
        'singular_name' => _x( 'Artwork Series', THEME_ID ),
        'search_items' => __( 'Search Series', THEME_ID ),
        'popular_items' => __( 'Popular Series', THEME_ID ),
        'all_items' => __( 'All Series', THEME_ID ),
        'parent_item' => __( 'Parent Series', THEME_ID ),
        'parent_item_colon' => __( 'Parent Series:', THEME_ID ),
        'edit_item' => __( 'Edit Series', THEME_ID ),
        'update_item' => __( 'Update Series', THEME_ID ),
        'add_new_item' => __( 'Add New Series', THEME_ID ),
        'new_item_name' => __( 'New Series Name', THEME_ID ),
        'separate_items_with_commas' => __( 'Separate Series with commas', THEME_ID ),
        'add_or_remove_items' => __( 'Add or remove Series', THEME_ID ),
        'choose_from_most_used' => __( 'Choose from the most used Series', THEME_ID ),
        'not_found' => __( 'No Series found.', THEME_ID ),
        'menu_name' => __( 'Artwork Series', THEME_ID ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'artwork-series' ),
    );
    register_taxonomy( 'soma_artwork_series', 'soma_artwork', $args );
}
/**
 * Creates the Artwork Material Category
 *
 * @since 0.1.0
 */
add_action( 'init', 'register_taxonomy_soma_artwork_material' );
function register_taxonomy_soma_artwork_material() {
    $labels = array(
        'name' => _x( 'Artwork Material', THEME_ID ),
        'singular_name' => _x( 'Artwork Material', THEME_ID ),
        'search_items' => __( 'Search Artwork Materials', THEME_ID ),
        'popular_items' => __( 'Popular Artwork Materials', THEME_ID ),
        'all_items' => __( 'All Artwork Materials', THEME_ID ),
        'parent_item' => __( 'Parent Artwork Material', THEME_ID ),
        'parent_item_colon' => __( 'Parent Artwork Material:', THEME_ID ),
        'edit_item' => __( 'Edit Artwork Material', THEME_ID ),
        'update_item' => __( 'Update Artwork Material', THEME_ID ),
        'add_new_item' => __( 'Add New Artwork Material', THEME_ID ),
        'new_item_name' => __( 'New Artwork Material Name', THEME_ID ),
        'separate_items_with_commas' => __( 'Separate Artwork Materials with commas', THEME_ID ),
        'add_or_remove_items' => __( 'Add or remove Artwork Materials', THEME_ID ),
        'choose_from_most_used' => __( 'Choose from the most used Artwork Materials', THEME_ID ),
        'not_found' => __( 'No Artwork Materials found.', THEME_ID ),
        'menu_name' => __( 'Artwork Materials', THEME_ID ),
    );
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'artwork-material' ),
    );
    register_taxonomy( 'soma_artwork_material', 'soma_artwork', $args );
}
/**
 * Creates the [soma_artwork] shortcode
 *
 * @since 0.1.0
 */
add_shortcode( 'soma_artwork', 'soma_artwork_shortcode_register' );
function soma_artwork_shortcode_register( $atts ) {
    
    if ( is_front_page() ) {
        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
    }
    else {
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; 
    }
    
    $atts = shortcode_atts(
        array( // a few default values
            'post_type' => 'soma_artwork',
            'ignore_sticky_posts' => 1,
            'suppress_filters' => false,
            'post_status' => 'publish',
            'before_item' => '<article class="media-object stack-for-small">',
            'after_item' => '</article>',
            'classes' => '', // Classes for wrapper <div>
            'posts_per_page' => 5,
            'paged' => $paged,
            'commissioned_only' => false,
        ),
        $atts,
        'soma_artwork'
    );
    
    if ( $atts['commissioned_only'] !== false ) {
       
        $atts['meta_query'] = array(
            array(
                'meta_key' => 'artwork_commissioned',
                'value' => '"true"',
                'compare' => 'LIKE',
            ),
        );
        
    }
    
    $out = '';
    $artwork = new WP_Query( $atts );
    
    $paginate_args = array(
        'current' => $paged,
        'prev_text' => __( '&laquo; View Older Artwork', THEME_ID ),
        'next_text' => __( 'View Newer Artwork &raquo;', THEME_ID ),
    );
    
    // Pagination Fix
    global $wp_query;
    $temp_query = $wp_query;
    $wp_query = NULL;
    $wp_query = $artwork;
    
    if ( $artwork->have_posts() ) : 
    
        ob_start();
    
        echo '<div id="soma_artwork-shortcode-' . get_the_id() . '"' . ( ( $atts['classes'] !== '' ) ? ' class="' . $atts['classes'] . '"' : '' ) . '>';
    
        while ( $artwork->have_posts() ) :
            $artwork->the_post();
    
                echo $atts['before_item'];
                    include( locate_template( 'partials/soma_artwork-loop-single.php' ) );
                echo $atts['after_item'];
    
        endwhile;
    
            echo '<div class="pagination">';
                echo paginate_links( $paginate_args );
            echo '</div>';
    
        echo '</div>';
        
        $out = ob_get_contents();  
        ob_end_clean();
    
        wp_reset_postdata();
    
        // Reset main query object after Pagination is done.
        $wp_query = NULL;
        $wp_query = $temp_query;
    
        return html_entity_decode( $out );
    
    else :
        
        if ( isset( $atts['commissioned_only'] ) ) {
            return __( 'No Commissioned Artwork Found', THEME_ID );
        }
    
        return __( 'No Artwork Found', THEME_ID );
    
    endif;
}

/**
 * Creates the [soma_post] shortcode
 *
 * @since 0.1.0
 */
add_shortcode( 'soma_post', 'soma_post_shortcode_register' );
function soma_post_shortcode_register( $atts ) {
    
    if ( is_front_page() ) {
        $paged = get_query_var( 'page' ) ? get_query_var( 'page' ) : 1;
    }
    else {
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; 
    }
    
    $atts = shortcode_atts(
        array( // a few default values
            'post_type' => 'post',
            'ignore_sticky_posts' => 1,
            'suppress_filters' => false,
            'post_status' => 'publish',
            'before_item' => '<article>',
            'after_item' => '</article>',
            'category' => '',
            'classes' => '', // Classes for wrapper <div>
            'posts_per_page' => 5,
            'excerpt' => true,
            'date' => false,
            'title' => '',
            'paged' => $paged,
        ),
        $atts,
        'soma_post'
    );
    
    if ( $atts['category'] !== '' ) {
        
        $atts['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'name',
                'terms' => $atts['category'],
            ),
        );
        
    }
    
    $out = '';
    $soma_post = new WP_Query( $atts );
    
    $paginate_args = array(
        'current' => $paged,
        'prev_text' => __( '&laquo; View Older Posts', THEME_ID ),
        'next_text' => __( 'View Newer Posts &raquo;', THEME_ID ),
    );

    if ( is_front_page() ) {
        $paginate_args['format'] = 'blogs/page/%#%';
    }
    
    // Pagination Fix
    global $wp_query;
    $temp_query = $wp_query;
    $wp_query = NULL;
    $wp_query = $soma_post;
    
    if ( $soma_post->have_posts() ) : 
    
        ob_start();
    
        echo '<div id="soma_post-shortcode-' . get_the_id() . '"' . ( ( $atts['classes'] !== '' ) ? ' class="' . $atts['classes'] . '"' : '' ) . '>';
    
        if ( $atts['title'] !== '' ) {
            ?>
            
            <div class="heading">
                
                <h2><?php echo $atts['title']; ?></h2>

            </div>

            <?php
        }
    
        while ( $soma_post->have_posts() ) :
            $soma_post->the_post();
    
                // Forcefully add post_class()
                if ( strpos( $atts['before_item'], 'class' ) !== false ) {
                    
                    $atts['before_item'] = preg_replace( '/class\s?=\s?"/i', 'class="' . implode( ' ', get_post_class() ) . ' ', $atts['before_item'] );
                    
                }
                else {
                    
                    $atts['before_item'] = str_replace( '>', ' class="' . implode( ' ', get_post_class() ) . '">', $atts['before_item'] );
                    
                }
    
                echo $atts['before_item'];
                    include( locate_template( 'partials/post-loop-single.php' ) );
                echo $atts['after_item'];
    
        endwhile;
    
            echo '<div class="post pagination">';
                echo paginate_links( $paginate_args );
            echo '</div>';
    
        echo '</div>';
        
        $out = ob_get_contents();  
        ob_end_clean();
    
        wp_reset_postdata();
        
        // Reset main query object after Pagination is done.
        $wp_query = NULL;
        $wp_query = $temp_query;
    
        return html_entity_decode( $out );
    
    else :
    
        if ( $atts['category'] !== '' ) {
            return sprintf( __( 'No Posts in the %s Category Found', THEME_ID ), $atts['category'] );
        }
    
        return __( 'No Posts Found', THEME_ID );
    
    endif;

}