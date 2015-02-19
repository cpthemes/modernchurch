<?php

/*

-----------------------------
Table of Contents
-----------------------------
1. Required Files for Plugins
2. Theme Features
3. Theme Options
4. Queue Scripts
5. Style Functions

*/

// 1. Required Files for Plugins
require_once get_template_directory() . '/includes/admin/plugins/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/includes/admin/plugins/cpt-plugins.php';


// 2. Theme Features
// -- 2a. Allow Featured Images
add_theme_support( 'post-thumbnails' );

// -- 2b. Widgets
require_once get_template_directory() . '/includes/admin/widgets/register-widgets.php';

// -- 2c. Menu Locations
require_once get_template_directory() . '/includes/admin/menus/menu-locations.php';

// -- 2d. Theme Setup
if ( ! function_exists( 'cpt_theme_setup' ) ) :
    function cpt_theme_setup() {

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         */
         add_theme_support( 'post-thumbnails' );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
        ) );

        /*
         * Enable support for Post Formats.
         * See http://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'image', 'video'
        ) );
    }
endif; // cpt_theme_setup
add_action( 'after_setup_theme', 'cpt_theme_setup' );

// -- 2e. Meta Setup
if ( ! function_exists( 'cpt_theme_posted_on' ) ) {
    function cpt_theme_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() )
        );

        $posted_on = sprintf(
            _x( '%s', 'post date', 'cpt_theme' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        $byline = sprintf(
            _x( 'By %s', 'post author', 'cpt_theme' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span><span class="comments">'.get_comments_number().'</span>';

    }
}


// 3. Theme Options
require get_template_directory() . '/includes/admin/theme-options/admin-init.php';


// 4. Queue Scripts
if ( ! function_exists( 'cpthemes_header_scripts' ) ) {

	add_action('wp_enqueue_scripts', 'cpthemes_header_scripts');

	function cpthemes_header_scripts() {

		if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

		    wp_register_script('plugins', get_template_directory_uri() . '/includes/front/js/plugins.min.js', array('jquery'), '1.0.0', true); // Plugins
		    wp_enqueue_script('plugins'); // Enqueue it!

		    wp_register_script('main', get_template_directory_uri() . '/includes/front/js/main.min.js', array('jquery'), '1.0.0', true); // Main
		    wp_enqueue_script('main'); // Enqueue it!

		}

	} // END cpthemes_header_scripts()

} // ENDIF


// 5. Style Functions

// -- 5a. Customize the first paragraph
function first_paragraph($content){
    return preg_replace('/<p([^>]+)?>/', '<p$1 class="intro">', $content, 1);
}
add_filter('the_content', 'first_paragraph');


// -- 5b. Customize the search form
function style_search_form($form) {
    $form = '<form method="get" id="searchform" action="' . get_option('home') . '/" >
            <label for="s">' . __('') . '</label>
            <div>';
    if (is_search()) {
        $form .='<input type="text" value="' . esc_attr(apply_filters('the_search_query', get_search_query())) . '" name="s" id="s" />';
    } else {
        $form .='<input type="text" value="Search" name="s" id="s"  onfocus="if(this.value==this.defaultValue)this.value=\'\';" onblur="if(this.value==\'\')this.value=this.defaultValue;"/>';
    }
    $form .= '<input type="submit" id="searchsubmit" value="'.esc_attr(__('Go')).'" />
            </div>
            </form>';
    return $form;
}
add_filter('get_search_form', 'style_search_form');


// -- 5c. Customize the Excerpt
function new_excerpt_more( $more ) {
    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('... Read More', 'cpt_theme') . '</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

function custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




?>