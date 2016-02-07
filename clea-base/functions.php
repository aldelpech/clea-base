<?php
/**
 * The functions file is used to initialize everything in the theme.  It controls how the theme is loaded and 
 * sets up the supported features, default actions, and default filters.  If making customizations, users 
 * should create a child theme and make changes to its functions.php file (not this one).  Friends don't let 
 * friends modify parent theme files. ;)
 *
 * Child themes should do their setup on the 'after_setup_theme' hook with a priority of 11 if they want to
 * override parent theme features.  Use a priority of 9 if wanting to run before the parent theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License as published by the Free Software Foundation; either version 2 of the License, 
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write 
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    1.1.1
 * @since      0.1.0
 * @author     Anne-Laure Delpech <ald.kerity@gmail.com>  & Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2012 - 2013, Justin Tadlock & Anne-Laure Delpech
 * @link       http://themehybrid.com/themes/unique
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Load the core theme framework. */
require_once( trailingslashit( get_template_directory() ) . 'library/hybrid.php' );
new Hybrid();

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'clea_base_theme_setup' );



/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function clea_base_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Load clea_base theme includes. */
	require_once( trailingslashit( THEME_DIR ) . 'inc/media.php' );

	/* load clea-base theme includes */
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-custom-fonts.php' );
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-customize.php' );
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-custom-header.php' );
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-custom-colors.php' );
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-encode-email.php' );	
	require_once( trailingslashit( THEME_DIR ) . 'inc/ald-enqueue.php' );	
	
	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'primary', 'secondary', 'subsidiary' ) );
	// add_theme_support( 'hybrid-core-widgets' ); 
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-scripts', array( 'comment-reply' ) );
	add_theme_support( 'hybrid-core-styles', array( '25px', 'gallery', 'parent', 'style' ) );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	add_theme_support( 'hybrid-core-media-grabber' );

	/* Add theme support for framework extensions. */
	add_theme_support( 
		'theme-layouts', 
		array( '1c', '2c-l', '2c-r', '3c-l', '3c-r', '3c-c' ),
		array( 'default' => '2c-l', 'customizer' => true )
	);

	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );

	/* Add theme support for WordPress features. */
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );

	/* Add support for a custom header image (logo). */
	add_theme_support(
		'custom-header',
		array(
			'width'       => 1080,
			'height'      => 200,
			'flex-height' => true,
			'flex-width'  => false,
			'header-text' => false
		)
	);

	/* Add support for a custom background. */
	add_theme_support( 
		'custom-background',
		array(
			'default-color'    => 'f1f1f1',
			'default-image'    => trailingslashit( get_template_directory_uri() ) . 'images/bg.png',
			'wp-head-callback' => 'clea_base_custom_background_callback'
		)
	);

	/* Add support for the Whistles plugin. */
	add_theme_support( 'whistles', array( 'styles' => true ) );

	/* Embed width/height defaults. */
	add_filter( 'embed_defaults', 'clea_base_embed_defaults' );

	/* add color choices in WordPress theme customizer */
	/* chun_register_color is set in ald-custom-colors.php */
	add_theme_support( 'color-palette', array( 'callback' => 'chun_register_colors' ) );
	
	
	/* auto-add some settings meta boxes for you. 
	* Hybrid Core has a built-in meta box for “Footer settings” and an “About Theme Name” box. 
	*/
	add_theme_support( 'hybrid-core-theme-settings', array( 'footer' ) );
	
	/* Custom editor stylesheet. */
	add_editor_style( '//fonts.googleapis.com/css?family=Bangers' );	
	
	/* Set content width. */
	hybrid_set_content_width( 620 );

	/* Filter the sidebar widgets. */
	add_filter( 'sidebars_widgets', 'clea_base_disable_sidebars' ); 
	add_action( 'template_redirect', 'clea_base_theme_layout' );

	/* Add classes to the comments pagination. */
	add_filter( 'previous_comments_link_attributes', 'clea_base_previous_comments_link_attributes' );
	add_filter( 'next_comments_link_attributes', 'clea_base_next_comments_link_attributes' );

	/* Filters the image/gallery post format archive galleries. */
	add_filter( "{$prefix}_post_format_archive_gallery_columns", 'clea_base_archive_gallery_columns' );

	/* Register additional widgets. */
	add_action( 'widgets_init', 'clea_base_register_widgets' ); 

	/* Custom search form template. */
	add_filter( 'get_search_form', 'clea_base_search_form' );
	
	// remove the original WP filter, which trims all excerpts to 55 words and 0 html tags
	// remove_filter('get_the_excerpt', 'wp_trim_excerpt');

	// trim excerpt but don't trim html tags
	// add_filter('get_the_excerpt', 'clea_base_custom_wp_trim_excerpt');

	// change pagination parameters
	add_filter( 'loop_pagination_args', 'clea_base_pagination_args' );
	
}

/**
 * Loads extra widget files and registers the widgets.
 * 
 * @since  0.1.0
 * @access public
 * @return void
 */
function clea_base_register_widgets() {

	/* Load and register the most-commented posts widget. */
	require_once( trailingslashit( THEME_DIR ) . 'inc/widget-most-commented.php' );
	register_widget( 'Unique_Widget_Most_Commented' );

}

/**
 * Sets the number of columns to show on image and gallery post format archives pages based on the 
 * layout that is currently being used.
 *
 * @since 0.1.0
 * @access public
 * @param int $columns Number of gallery columns to display.
 * @return int $columns
 */
function clea_base_archive_gallery_columns( $columns ) {

	/* Only run the code if the theme supports the 'theme-layouts' feature. */
	if ( current_theme_supports( 'theme-layouts' ) ) {

		/* Get the current theme layout. */
		$layout = theme_layouts_get_layout();

		if ( 'layout-1c' == $layout )
			$columns = 4;

		elseif ( in_array( $layout, array( 'layout-3c-l', 'layout-3c-r', 'layout-3c-c' ) ) )
			$columns = 2;
	}

	return $columns;
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 * @access public
 * @return void
 */
function clea_base_theme_layout() {

	if ( !is_active_sidebar( 'primary' ) && !is_active_sidebar( 'secondary' ) )
		add_filter( 'theme_mod_theme_layout', 'clea_base_theme_layout_one_column' );

	elseif ( is_attachment() && wp_attachment_is_image() && 'default' == get_post_layout( get_queried_object_id() ) )
		add_filter( 'theme_mod_theme_layout', 'clea_base_theme_layout_one_column' );

	elseif ( is_page_template( 'page/page-template-magazine.php' ) )
		add_filter( 'theme_mod_theme_layout', 'clea_base_theme_layout_one_column' );
}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1.0
 * @access public
 * @param string $layout The layout of the current page.
 * @return string
 */
function clea_base_theme_layout_one_column( $layout ) {
	return '1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 * @access public
 * @param array $sidebars_widgets A multidimensional array of sidebars and widgets.
 * @return array $sidebars_widgets
 */
function clea_base_disable_sidebars( $sidebars_widgets ) {

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
			$sidebars_widgets['secondary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Overwrites the default widths for embeds.  This is especially useful for making sure videos properly
 * expand the full width on video pages.  This function overwrites what the $content_width variable handles
 * with context-based widths.
 *
 * @since 0.1.0
 * @access public
 * @param array $args Default embed arguments.
 * @return array
 */
function clea_base_embed_defaults( $args ) {

	$args['width'] = 620;

	if ( current_theme_supports( 'theme-layouts' ) ) {

		$layout = theme_layouts_get_layout();

		if ( 'layout-3c-l' == $layout || 'layout-3c-r' == $layout || 'layout-3c-c' == $layout )
			$args['width'] = 500;
		elseif ( 'layout-1c' == $layout )
			$args['width'] = 980;
	}

	return $args;
}

/**
 * Adds 'class="prev" to the previous comments link.
 *
 * @since 0.1.0
 * @access public
 * @param string $attributes The previous comments link attributes.
 * @return string
 */
function clea_base_previous_comments_link_attributes( $attributes ) {
	return $attributes . ' class="prev"';
}

/**
 * Adds 'class="next" to the next comments link.
 *
 * @since 0.1.0
 * @access public
 * @param string $attributes The next comments link attributes.
 * @return string
 */
function clea_base_next_comments_link_attributes( $attributes ) {
	return $attributes . ' class="next"';
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @access public
 * @link http://core.trac.wordpress.org/ticket/16919
 * @return void
 */
function clea_base_custom_background_callback() {

	// $background is the saved custom image or the default image.
	$background = get_background_image();

	// $color is the saved custom color or the default image.
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}

/**
 * Creates a custom search form by filtering the 'get_search_form' hook.
 *
 * @since  0.2.0
 * @access public
 * @param  string  $form
 * @return string
 */
function clea_base_search_form( $form ) {

	$value       = get_search_query() ? esc_attr( get_search_query() ) : '';
	$placeholder = esc_attr__( 'Enter search terms...', 'clea-base' );

	$form  = "\n\t\t" . '<form method="get" class="search-form" action="' . trailingslashit( home_url() ) . '">';
	$form .= "\n\t\t\t" . '<div class="search-wrap">';
	$form .= "\n\t\t\t\t" . '<input class="search-text" type="text" name="s" value="' . $value . '" placeholder="' . $placeholder . '" />';
	$form .= "\n\t\t\t\t" . '<input class="search-submit" name="submit" type="submit" value="' . esc_attr__( 'Search', 'clea-base' ) . '" />';
	$form .= "\n\t\t\t" . '</div>';
	$form .= "\n\t\t" . '</form><!-- .search-form -->';

	return $form;
}

/**
 * Adds new contact methods to the user profile screen for more modern social media sites.
 *
 * @note This function is no longer used by the theme and only exists for backwards compatibility.
 *
 * @since      0.1.0
 * @deprecated 0.3.0
 * @access     public
 * @param      array   $meta  Array of contact methods.
 * @return     array   $meta
 */
function clea_base_contact_methods( $meta ) {
	_deprecated_function( __FUNCTION__, '0.3.0' );

	/* Twitter contact method. */
	$meta['twitter'] = __( 'Twitter Username', 'clea-base' );

	/* Google+ contact method. */
	$meta['google_plus'] = __( 'Google+ URL', 'clea-base' );

	/* Facebook contact method. */
	$meta['facebook'] = __( 'Facebook URL', 'clea-base' );

	/* Return the array of contact methods. */
	return $meta;
}

/**
 * Registers shortcodes for the clea_base theme.
 *
 * @note This function is no longer used by the theme and only exists for backwards compatibility.
 *
 * @since      0.1.0
 * @deprecated 0.3.0
 * @accesss    public
 * @return     void
 */
function clea_base_register_shortcodes() {
	_deprecated_function( __FUNCTION__, '0.3.0' );

	/* Adds the [entry-mood] shortcode. */
	add_shortcode( 'entry-mood', 'clea_base_entry_mood_shortcode' );

	/* Adds the [entry-views] shortcode. */
	add_shortcode( 'entry-views', 'clea_base_entry_views_shortcode' );
}

/**
 * Returns the mood for the current post.  The mood is set by the 'mood' custom field.
 *
 * @note This function is no longer used by the theme and only exists for backwards compatibility.
 *
 * @since      0.1.0
 * @deprecated 0.3.0
 * @accesss    public
 * @param      array   $attr The shortcode arguments.
 * @return     string
 */
function clea_base_entry_mood_shortcode( $attr ) {
	_deprecated_function( __FUNCTION__, '0.3.0' );

	$attr = shortcode_atts( array( 'before' => '', 'after' => '' ), $attr );

	$mood = get_post_meta( get_the_ID(), 'mood', true );

	if ( !empty( $mood ) )
		$mood = $attr['before'] . convert_smilies( $mood ) . $attr['after'];

	return $mood;
}


function clea_base_custom_wp_trim_excerpt( $text ) {
/* see http://bacsoftwareconsulting.com/blog/index.php/wordpress-cat/how-to-preserve-html-tags-in-wordpress-excerpt-without-a-plugin/ 
*/	
	$raw_excerpt = $text;

	if ( '' == $text ) {
		//Retrieve the post content. 
		$text = get_the_content( '' );
	 
		//Delete all shortcode tags from the content. 
		$text = strip_shortcodes( $text );
	 
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );
		 
		$allowed_tags = '<p>,<a>,<em>,<strong>'; /*** MODIFY THIS. Add the allowed HTML tags separated by a comma.***/
		$text = strip_tags( $text, $allowed_tags );
		 
		$excerpt_word_count = 100; /*** MODIFY THIS. change the excerpt word count to any integer you like.***/
		$excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count ); 
		 
		$excerpt_end = ' (...) '; /*** MODIFY THIS. change the excerpt endind to '[...]'.***/
		$excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );
		 
		$words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
		if ( count($words) > $excerpt_length ) {
			array_pop( $words );
			$text = implode( ' ', $words );
			$text = $text . $excerpt_more;
		} else {
			$text = implode( ' ', $words );
		}
	}
	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );

}



function clea_base_pagination_args( $args ) {

	$args['mid_size']	= 0;
	$args['end_size']	= 1; 
	$args['prev_text']	= __( '&laquo; Previous', 'clea-base' ) ; // This is the WordPress default. 	
	$args['next_text']	= __( 'Next &raquo;', 'clea-base' ) ; // This is the WordPress default. 		

	/* 'Next &rarr;'  'Next &raquo;'  */ 
	/* '&laquo; Previous'  '&larr; Previous'  */ 


	return $args;
}



?>