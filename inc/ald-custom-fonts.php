<?php
/**
 * Setup the Hybrid Core Theme Fonts extention.
 * see Cafiko custom-fonts.php and http://themehybrid.com/docs/theme-fonts
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    1.0.0
 */

/**
 * Add theme support for theme fonts.
 */
add_theme_support( 'theme-fonts', array(
	'callback'   => 'clea_base_register_fonts',
	'customizer' => true
));

/**
* add fonts for the theme customizer
* source http://themehybrid.com/docs/theme-fonts and Cafiko theme**/


function clea_base_register_fonts( $theme_fonts ) {

	/* add headings css font rule */
	$theme_fonts->add_setting(
		array(
			'id'        => 'header',
			'label'     => __( 'Headers', 'clea-base' ),
			'default'   => 'pt-serif-700',
			'selectors' => 'h1, h2, h3, h4, h5, h6, caption, .main-navigation .menu-item > a, .format-status .entry-date'
		)
	);
	
	/* add body css font rule */
	/* will Notice: Uninitialized string offset: 0 in ../library/extensions/theme-fonts.php 
	if default font not listed with the same id in the register font part of this file */
	$theme_fonts->add_setting(
		array(
			'id'        => 'body',
			'label'     => __( 'Body text', 'clea-base' ),
			'default'   => 'open-sans-400',
			'selectors' => 'body',
		)
	);	

	/* register fonts */
	
	$fonts = array(
		array(
			'handle'  => 'georgia-font-stack',
			'label'   => __( 'Georgia', 'clea-base' ),
			'stack'   => 'Georgia, Cambria, "Bitstream Charter", serif',
			'weights' => array( '400', '700' )
		), 
		array(
			'handle'  => 'droid-sans',
			'label'   => __( 'Droid Sans', 'clea-base' ),
			'family'  => 'Droid Sans',
			'stack'   => 'Droid Sans',
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'pt-sans',
			'label'   => __( 'PT Sans', 'clea-base' ),
			'family'  => 'PT Sans',
			'stack'   => 'PT Sans',
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'molle',
			'label'   => __( 'Molle', 'clea-base' ),
			'family'  => 'Molle',
			'stack'   => 'Molle',
			'type'    => 'google',
			'weights' => array( '400' )
		),
		array(
			'handle'  => 'lobster',
			'label'   => __( 'Lobster', 'clea-base' ),
			'family'  => 'Lobster',
			'stack'   => 'Lobster',
			'type'    => 'google',
			'weights' => array( '400' )
		),
		array(
			'handle'  => 'raleway',
			'label'   => __( 'Raleway', 'clea-base' ),
			'family'  => 'Raleway',
			'stack'   => 'Raleway',
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'lobster-two',
			'label'   => __( 'Lobster Two', 'clea-base' ),
			'family'  => 'Lobster Two',
			'stack'   => 'Lobster Two',
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'helvetica-font-stack',
			'label'   => __( 'Helvetica', 'clea-base' ),
			'stack'   => '"Helvetica Neue", Helvetica, Arial, sans-serif',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'pt-serif',
			'label'   => __( 'PT Serif', 'clea-base' ),
			'family'  => 'PT Serif',
			'stack'   => "'PT Serif', Georgia, serif",
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),array(
			'handle' => 'muli',
			'label'  => __( 'Muli', 'clea-base' ),
			'family' => 'Muli',
			'stack'  => "Muli, sans-serif",
			'type'   => 'google',				// no need to define url for google fonts
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'segoe-font-stack',
			'label'   => __( 'Segoe UI', 'clea-base' ),
			'stack'   => '"Segoe UI", "Trebuchet MS", Verdana, sans-serif',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'roboto',
			'label'   => __( 'Roboto', 'clea-base' ),
			'family'  => 'Roboto',
			'stack'   => "'Roboto', sans-serif",
			'type'    => 'google',
			'weights' => array( '400', '700' )
		),
		array(
			'handle'  => 'open-sans',
			'label'   => __( 'Open Sans', 'clea-base' ),
			'family'  => 'Open Sans',
			'stack'   => "'Open Sans', sans-serif",
			'type'    => 'google',
			'weights' => array( '300', '400', '600', '700' )
		),
		array(
			'handle'  => 'oswald',
			'setting' => 'header',
			'label'   => __( 'Oswald', 'clea-base' ),
			'family'  => 'Oswald',
			'stack'   => "'Oswald', sans-serif",
			'type'    => 'google',
			'weights' => array( '300', '400', '700' )
		),
		array(
			'handle'  => 'handlee',
			'setting' => 'header',
			'label'   => __( 'Handlee', 'clea-base' ),
			'family'  => 'Handlee',
			'stack'   => "'Handlee', cursive",
			'type'    => 'google',
			'weights' => array( '400' )
		),
		array(
			'handle'  => 'overlock',
			'label'   => __( 'Overlock', 'clea-base' ),
			'family'  => 'Overlock',
			'stack'   => "'Overlock', cursive",
			'type'    => 'google',
			'weights' => array( '400', '700', '900' )
		),
	);

	/* Add each font and font weight. */
	foreach( $fonts as $font ) :

		foreach( $font['weights'] as $weight ) {

			$theme_fonts->add_font( array(
				'handle'  => $font['handle'] . "-{$weight}",
				'label'   => sprintf( '%s [%s]', $font['label'], clea_base_convert_font_weight( $weight ) ),
				'stack'   => $font['stack'],
				'weight'  => $weight,
				'family'  => ( isset( $font['family'] ) )  ? $font['family']  : '',
				'style'   => ( isset( $font['style'] ) )   ? $font['style']   : '',
				'setting' => ( isset( $font['setting'] ) ) ? $font['setting'] : '',
				'type'    => ( isset( $font['type'] ) )    ? $font['type']    : '',
				'uri'     => ( isset( $font['uri'] ) )     ? $font['uri']     : '',
			));

		}

	endforeach;	

}

/**
 * Convert numeric font weights to more user-friendly names.
 *
 * @since  Cakifo 1.6.0
 * @param  string  $weight Numeric font weight
 * @return string          Font weight name
 */
function clea_base_convert_font_weight( $weight ) {
	$convert = array(
		'100'     => _x( 'Ultra light', 'font weight', 'clea-base' ),
		'200'     => _x( 'Thin',        'font weight', 'clea-base' ),
		'300'     => _x( 'Light',       'font weight', 'clea-base' ),
		'400'     => _x( 'Normal',      'font weight', 'clea-base' ),
		'500'     => _x( 'Medium',      'font weight', 'clea-base' ),
		'600'     => _x( 'Semi bold',   'font weight', 'clea-base' ),
		'700'     => _x( 'Bold',        'font weight', 'clea-base' ),
		'800'     => _x( 'Extra bold',  'font weight', 'clea-base' ),
		'900'     => _x( 'Ultra bold',  'font weight', 'clea-base' ),
		'normal'  => _x( 'Normal',      'font weight', 'clea-base' ),
		'bold'    => _x( 'Bold',        'font weight', 'clea-base' ),
		'bolder'  => _x( 'Bolder',      'font weight', 'clea-base' ),
		'lighter' => _x( 'Lighter',     'font weight', 'clea-base' ),
	);

	return $convert[$weight];
}