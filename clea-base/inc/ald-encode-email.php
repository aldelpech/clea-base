<?php
/**
 * a function to encode email address so that they are not readable by a robot
 * 
 * shortcode will be [email]john.dow@mysite.com[/email]
 * source http://codex.wordpress.org/Function_Reference/antispambot
 * @parem array $atts 	shortcodes attributes. Not used
 * @param string $mail 	the shortcode content. Should be an email address
 *
 * @package    uniqueimpact1
 * @subpackage Functions
 * @version    1.0.0
 * Text Domain: unique-impact1
 */


	function al_email_encode_function( $atts, $mail = null ){
		if( ! is_email( $mail ) ) {
			return;
		}
		
		return '<span class="top-email"><i class="fa fa-envelope"></i> <a href="mailto:' . $mail . '?Subject=[' . get_bloginfo( 'name' ) . '] Bonjour target="blank>' . $mail .'</a> </span> <i class="fa fa-lock"></i>' ; 
		
	}
	
	add_shortcode( 'email', 'al_email_encode_function' );
	
	// will allow shortcode to be inserted in widgets also
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );
	
/* to add shortcode in a php command
* echo do_shortcode( '[email]' . $text_to_be_wrapped_in_shortcode . '[/email]' );
*/