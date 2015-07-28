<?php
/**
 * Setup the colors with customizer and create a style sheet
 * See https://github.com/justintadlock/chun/blob/master/functions.php lines 483 - 
 * uses the class Color_Palette set up in color-palette.php (in themes/unique/library/extensions) 
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    1.0.0
 * @textdomain clea-base
 */
 
/**
 * Registers colors for the Color Palette extension.
 *
 * @since  0.1.0
 * @access public
 * @param  object  $color_palette
 * @return void
 */
 
function chun_register_colors( $color_palette ) {
	/* Add custom colors. */
	$color_palette->add_color(
		array( 'id' => 'primary', 'label' => __( 'Primary Color', 'clea-base' ), 'default' => 'cb5700' )
	);
	$color_palette->add_color(
		array( 'id' => 'secondary', 'label' => __( 'Secondary Color', 'clea-base' ), 'default' => '050505' )
	);
	$color_palette->add_color(
		array( 'id' => 'tertiary', 'label' => __( 'Third Color', 'clea-base' ), 'default' => '00393e' )
	);
	$color_palette->add_color(
		array( 'id' => 'dark_font', 'label' => __( 'dark font Color', 'clea-base' ), 'default' => '00666f' )
	);
	/* group elements with same rule sets */
	
	/* css elements with Primary color as text color and secondary for backgound */
	$bkg2_col1 = ".page-template-magazine .flexslider .entry-summary p, #menu-primary li a:hover, #menu-primary li:hover >a, #menu-primary li.current-menu-item >a, #menu-primary li li a, #menu-secondary li:hover > a, #menu-subsidiary, #menu-subsidiary li a, #menu-subsidiary li a:hover,  #menu-subsidiary li.current-menu-item a,  #menu-subsidiary li a:hover,  #menu-subsidiary li.current-menu-item a, .topbar ul#social li a,  .flex-control-paging li a,  .flex-direction-nav a:focus,  #menu-subsidiary li.current-menu-item a,  . #site-title a,  .entry-title,   .loop-title,  #menu-primary li a" ;

	/* css elements with Primary color as background and secondary for text color */
	$bkg1_col2 = ".page-template-magazine .flexslider .entry-summary p,  #menu-secondary, #menu-secondary li a, .menu .search-form input[type=" . '"text"' . "], li.comment .comment-reply-link,  #menu-primary li li a:hover,  #menu-primary li li:hover > a, .page-template-magazine .flexslider .slide-caption" ;



	
	/* Add rule sets for colors. */
	$color_palette->add_rule_set(
		'primary',
		array(
			'color'               => $bkg2_col1 . ', #footer .footer-content p a',
			'background-color'    => $bkg1_col2 . ', ul#social li a, #menu-secondary ul ul, #container > div.topbar > div.top-search > form > div > button', 
			'border-top-color'    => 'body',
			'border-bottom-color' => 'body, .breaadcrumb-trail a:hover, .sticky.hentry, .loop-meta, .page-template-portfolio .hentry.page',
			'border-left-color'   => 'pre'
		)
	);
	$color_palette->add_rule_set(
		'secondary',
		array(
			'color'               => $bkg1_col2 . ', #menu-portfolio li.current-cat a, #menu-portfolio li.current-menu-item a, .page-numbers.current, #menu-primary li a:hover, #menu-primary li:hover > a, #menu-primary li.current-menu-item > a, #footer a' . ', ul#social li a, #menu-secondary ul ul, #container > div.topbar > div.top-search > form > div > button',
			'background-color'    => $bkg2_col1
		)
	);
 
	$color_palette->add_rule_set(
		'tertiary',
		array(
			'background-color' => '#footer'
		)
	);
	$color_palette->add_rule_set(
		'dark_font',
		array(
			'color'               => 'body, a, pre, code, .breadcrumb-trail a, .format-link .entry-title a .meta-nav, #respond label .required, #sidebar-header',
			'background-color'    => '#menu-secondary li.current-menu-item >a, #menu-secondary li a:hover'
		)
	);
}
/**
 * Filters the 'color_palette_preview_js_ignore' hook with some selectors that should be ignored on the 
 * live preview because they don't need to be overwritten.
 *
 * @since  0.1.0
 * @access public
 * @param  string  $selectors
 * @param  string  $color_id
 * @param  string  $property
 * @return string
 */
function chun_cp_preview_js_ignore( $selectors, $color_id, $property ) {
	if ( 'color' === $property && 'primary' === $color_id )
		$selectors = '#site-title a, .menu a, .entry-title a';
	elseif ( 'color' === $property && 'tertiary' === $color_id )
		$selectors = '#menu-primary li .sub-menu li a, #menu-primary li.current-menu-item li a, #menu-primary li li.current-menu-item > a';
	return $selectors;
}