<?php
/**
 * enqueue necessary styles and scripts
 * fonts are enqueued with ald-custom-fonts.php 
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    1.0.0
 * Text Domain: clea-base
 */
 
/* Load stylesheets. */
add_action( 'wp_enqueue_scripts', 'clea_base_enqueue_styles', 4 );
add_action( 'wp_enqueue_scripts', 'clea_base_enqueue_scripts' );  

/**
 * Loads custom stylesheets for the theme.
 * @since  1.0.0
 * @access public
 * @return void
 */
function clea_base_enqueue_styles() {
	
	// used to display the social media icons
	wp_enqueue_style( 'font-awesome', trailingslashit( THEME_URI ) . 'css/font-awesome.min.css' );
	// specific style added to the unique style.css file
	wp_enqueue_style( 'clea-specific', trailingslashit( THEME_URI ) . 'css/clea-specific.css' );	
} 

/**
 * Registers and loads the plugin's scripts.
 * @since  0.1.0
 * @access public
 * @return void
 */

function clea_base_enqueue_scripts() {

	/* Enqueue scripts. */

}