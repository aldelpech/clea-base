<?php
/**
 * in the theme customizer allow uploading of favicon and logo and size settings
 * in the theme customizer, setup the social links and address section
 * in the theme customizer, setup the specific contents (only the checkboxes)
 * in the theme settings page, textareas to fill front page
 * !!! use another name for the setting so that it's not in the same database field
 * try with {$prefix}_front_page_settings[value_name]  --> it works ! 
 * 
 * Also a test to echo the fields
 * see result with a page using the 'test-page-template.php' template
 *
 * @package    clea-base
 * @subpackage Functions
 * @version    1.0.0
 * Text Domain: clea-base
 */

/* Load custom control classes. */
add_action( 'customize_register', 'clea_base_load_customize_controls', 1 );

/* Register 'logo et favicon' custom sections, settings, and controls. */
add_action( 'customize_register', 'clea_base_custom_logo' );

/* Register 'social links' custom sections, settings, and controls. */
add_action( 'customize_register', 'clea_base_custom_social' );

/* Register 'address' custom sections, settings, and controls. */
add_action( 'customize_register', 'clea_base_custom_address' );

/**
 * Loads framework-specific customize control classes.  Customize control classes extend the WordPress 
 * WP_Customize_Control class to create unique classes that can be used within the framework.
 *
 * @since 1.4.0
 * @access private
 */
function clea_base_load_customize_controls() {

	/* Loads the textarea customize control class. */
	require_once( trailingslashit( HYBRID_CLASSES ) . 'customize-control-textarea.php' );
}


/**
* load custom settings for logo and favicon uploading
**/
function clea_base_custom_logo( $wp_customize ) {
	
	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();
	// echo "<p>prefixe : " . $prefix . "</p><br/>" ; will print "prefixe : unique"
	
	$ald_description = __( 'charger le logo et le favicon du site', 'clea-base' );	
	
		/* Add the test textarea section. */
		$wp_customize->add_section(
			'unique-impact-1-logo-upload',
			array(
				'title'      	=> esc_html__( 'Logo & Favicon', 'clea-base' ),
				'priority'   	=> 35,
				'capability' 	=> 'edit_theme_options',
				'description'	=> $ald_description
			)
		);

	/**
	 * logo  Upload
	 * source http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-practicing-ii--wp-27486
	 */

	 $wp_customize->add_setting(
		"{$prefix}_theme_settings[logo_upload]",
	array(
		'type'  			=> 'option',
		'sanitize_callback' => 'clea_base_logo_sanitize', 
	));
	 
	// see http://themefoundation.com/wordpress-theme-customizer/
	$wp_customize->add_control( 
		new WP_Customize_Image_Control(
			$wp_customize, "{$prefix}_theme_settings[logo_upload]", 
			array(
				'label'    => __('Charger un logo', 'clea-base'),
				'section'  => 'unique-impact-1-logo-upload',
			) 
		) 
	);
	
	/** 
	* demander logo width en px
	**/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[logo_width]", 
		array(
			'type'  	=> 'option',
			'default' => __('Largeur du logo (en px)', 'clea-base'),
			'sanitize_callback' => 'clea_base_logo_sanitize',
		)
	);
	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[logo_width]",
    array(
        'label' => __('largeur du logo (px)', 'clea-base'),
        'section' => 'unique-impact-1-logo-upload',
        'type' => 'text',
    )
	);

		/** 
	* demander logo height en px
	**/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[logo_height]", 
		array(
			'type'  	=> 'option',
			'default' => __('Hauteur du logo (en px)', 'clea-base'),
			'sanitize_callback' => 'clea_base_logo_sanitize',
		)
	);
	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[logo_height]",
    array(
        'label' => __('Hauteur du logo (px)', 'clea-base'),
        'section' => 'unique-impact-1-logo-upload',
        'type' => 'text',
    )
	);

	/**
	 * favicon  Upload
	 */
	$wp_customize->add_setting(
		"{$prefix}_theme_settings[favicon_upload]",
	array(
		'type'  	=> 'option',
		'sanitize_callback' => 'clea_base_logo_sanitize', 
	));
	 
	// see http://themefoundation.com/wordpress-theme-customizer/
	$wp_customize->add_control( 
		new WP_Customize_Image_Control(
			$wp_customize, "{$prefix}_theme_settings[favicon_upload]", 
			array(
				'label'    => __('Charger un favicon', 'clea-base'),
				'section'  => 'unique-impact-1-logo-upload',
			) 
		) 
	);	
	
	
}

/**
 * Sanitizes "logo and favicon" section.
 *
 * @since 0.4.0
 * @param mixed $setting The current setting passed to sanitize.
 * @param object $object The setting object passed via WP_Customize_Setting.
 * @return mixed $setting
 */
function clea_base_logo_sanitize( $setting, $object ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* ALL settings of the Logo & Favicon and section
	{$prefix}_theme_settings[logo_upload]
	{$prefix}_theme_settings[logo_width]
	{$prefix}_theme_settings[logo_height]
	{$prefix}_theme_settings[favicon_upload]
	*/
	
	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	
	if ( "{$prefix}_theme_settings[logo_upload]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	
	if ( "{$prefix}_theme_settings[logo_width]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = absint( $setting ) ; // returns a non negative integer
	
	if ( "{$prefix}_theme_settings[logo_height]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = absint( $setting ) ; // returns a non negative integer
	
	if ( "{$prefix}_theme_settings[favicon_upload]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	/* Return the sanitized setting and apply filters. */
	return apply_filters( "{$prefix}_customize_sanitize", $setting, $object );
}


/**
* load custom settings for social links
**/
function clea_base_custom_social( $wp_customize ) {
	
	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();
	
	$ald_description = __( 'charger les liens vers les réseaux sociaux du site', 'clea-base' );	
	
		/* Add the test textarea section. */
		$wp_customize->add_section(
			'unique-impact-1-social',
			array(
				'title'      	=> esc_html__( 'Réseaux sociaux', 'clea-base' ),
				'priority'   	=> 200,
				'capability' 	=> 'edit_theme_options',
				'description'	=> $ald_description
			)
		);

	/** demander Facebook **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[facebook]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[facebook]",
    array(
        'label' => __('url Facebook', 'clea-base'),
        'section' => 'unique-impact-1-social',
        'type' => 'text',
    )
	);	


	/** demander Twitter **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[twitter]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[twitter]",
    array(
        'label' => __('url Twitter', 'clea-base'),
        'section' => 'unique-impact-1-social',
        'type' => 'text',
    )
	);		

	/** demander Pinterest **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[pinterest]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[pinterest]",
		array(
			'label' => __('url Pinterest', 'clea-base'),
			'section' => 'unique-impact-1-social',
			'type' => 'text',
		)
	);		


	/** demander RSS **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[rss]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[rss]",
		array(
			'label' => __('url RSS', 'clea-base'),
			'section' => 'unique-impact-1-social',
			'type' => 'text',
		)
	);	

	/** demander Google + **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[google+]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[google+]",
		array(
			'label' => __('url Google +', 'clea-base'),
			'section' => 'unique-impact-1-social',
			'type' => 'text',
		)
	);	

	/** demander LinkedIn **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[linkedin]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[linkedin]",
		array(
			'label' => __('url LinkedIn', 'clea-base'),
			'section' => 'unique-impact-1-social',
			'type' => 'text',
		)
	);	

	/** demander Viadeo **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[viadeo]", 
		array(
			'type'  	=> 'option',
			'default' => '',
			'sanitize_callback' => 'clea_base_social_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[viadeo]",
		array(
			'label' => __('url Viadeo', 'clea-base'),
			'section' => 'unique-impact-1-social',
			'type' => 'text',
		)
	);	
	
}

/**
 * Sanitizes "social media" section.
 *
 * @since 0.4.0
 * @param mixed $setting The current setting passed to sanitize.
 * @param object $object The setting object passed via WP_Customize_Setting.
 * @return mixed $setting
 */
function clea_base_social_sanitize( $setting, $object ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* ALL settings of the Logo & Favicon and section
	{$prefix}_theme_settings[facebook]
	{$prefix}_theme_settings[twitter]
	{$prefix}_theme_settings[pinterest]
	{$prefix}_theme_settings[rss]
	{$prefix}_theme_settings[google+]
	{$prefix}_theme_settings[linkedin]
	{$prefix}_theme_settings[viadeo]
	*/
	
	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	
	if ( "{$prefix}_theme_settings[facebook]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	if ( "{$prefix}_theme_settings[twitter]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );	
	if ( "{$prefix}_theme_settings[pinterest]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	if ( "{$prefix}_theme_settings[rss]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );	
	if ( "{$prefix}_theme_settings[google+]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	if ( "{$prefix}_theme_settings[linkedin]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	if ( "{$prefix}_theme_settings[viadeo]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	
	/* Return the sanitized setting and apply filters. */
	return apply_filters( "{$prefix}_customize_sanitize", $setting, $object );
}


/**
* load custom settings for address in header
**/
function clea_base_custom_address( $wp_customize ) {
	
	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();
	
	$ald_description = __( "Les coordonnées qui apparaissent dans l'en-tête, à droite" );	
	
		/* Add the test textarea section. */
		$wp_customize->add_section(
			'unique-impact-1-address',
			array(
				'title'      	=> esc_html__( 'Coordonnées', 'clea-base' ),
				'priority'   	=> 200,
				'capability' 	=> 'edit_theme_options',
				'description'	=> $ald_description
			)
		);

	/** demander Adresse **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[adresse]", 
		array(
			'type'  	=> 'option',
			'default' => 'Adresse 22222 ville',
			'sanitize_callback' => 'clea_base_address_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[adresse]",
		array(
			'label' => __('Adresse en une ligne', 'clea-base'),
			'section' => 'unique-impact-1-address',
			'type' => 'text',
		)
	);	

		
	/** demander Téléphone **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[telephone]", 
		array(
			'type'  	=> 'option',
			'default' => '00 00 00 00',
			'sanitize_callback' => 'clea_base_address_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[telephone]",
		array(
			'label' => __('Téléphone', 'clea-base'),
			'section' => 'unique-impact-1-address',
			'type' => 'text',
		)
	);	
	
		
	/** demander Adresse **/
	$wp_customize->add_setting( 
		"{$prefix}_theme_settings[mail]", 
		array(
			'type'  	=> 'option',
			'default' => 'nnn.gggggg@test.com',
			'sanitize_callback' => 'clea_base_address_sanitize',
		)
	);	

	$wp_customize->add_control(
    "{$prefix}_theme_settings[mail]",
		array(
			'label' => __('E-mail (sera crypté)', 'clea-base'),
			'section' => 'unique-impact-1-address',
			'type' => 'text',
		)
	);		
}

/**
 * Sanitizes "address" section.
 *
 * @since 0.4.0
 * @param mixed $setting The current setting passed to sanitize.
 * @param object $object The setting object passed via WP_Customize_Setting.
 * @return mixed $setting
 */
function clea_base_address_sanitize( $setting, $object ) {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();

	/* ALL settings of the Logo & Favicon and section
		{$prefix}_theme_settings[adresse]
		{$prefix}_theme_settings[telephone]
		{$prefix}_theme_settings[mail]	
	*/
	
	/* Make sure we kill evil scripts from users without the 'unfiltered_html' cap. */
	
	if ( "{$prefix}_theme_settings[adresse]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );
	if ( "{$prefix}_theme_settings[telephone]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );	
	if ( "{$prefix}_theme_settings[mail]" == $object->id && !current_user_can( 'unfiltered_html' )  )
		$setting = stripslashes( wp_filter_post_kses( addslashes( $setting ) ) );

	
	/* Return the sanitized setting and apply filters. */
	return apply_filters( "{$prefix}_customize_sanitize", $setting, $object );
}