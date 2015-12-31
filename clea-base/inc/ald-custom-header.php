<?php
/**
 * Setup the Header with social media and logo.
 * 
 * @package    clea-base
 * @subpackage Functions
 * @version    1.0.0
 * Text Domain: clea-base
 */

add_action( 'after_setup_theme', 'clea_base_header_setup', 11 );
 
function clea_base_header_setup() {

	/* Get the theme prefix. */
	$prefix = hybrid_get_prefix();
	
	/* Add social icons and search bar 
	* is done in header.php
	*/
	
	/* add a logo on the left of site name and description
	* uses an hybrid contextual header
	*/
	add_action( "{$prefix}_open_header", 'clea_base_add_logo_to_header' ); 	

}	

function clea_base_add_html_to_header() {
	/* get links from theme options */
	/* !!!! NE PAS DEPASSER 4 réseaux sociaux !!! JE NE COMPRENDS PAS POURQUOI */

	$twitter = esc_attr( hybrid_get_setting( 'twitter' ) ) ;
	$facebook = esc_attr( hybrid_get_setting( 'facebook' ) ) ; 
	$pinterest = esc_attr( hybrid_get_setting( 'pinterest' ) ) ;
	$rss = esc_attr( hybrid_get_setting( 'rss' ) ) ;
	$google = esc_attr( hybrid_get_setting( 'google+' ) ) ;
    $viadeo = esc_attr( hybrid_get_setting( 'viadeo' ) ) ;
	$linkedIn = esc_attr( hybrid_get_setting( 'linkedin' ) ) ;

	
	/* add a bar to the top of the page */
?>
	<div class="topbar">
	    <div class="top-social">
			<ul id="social">
				<?php if ( $facebook <> '' ) { ?>
					<li><a id="facebook" href="<?php echo $facebook ;?>" title="<?php echo __( 'Facebook', 'clea-base') ;?>"><i class="fa fa-facebook fa-fw"></i></a></li>
				<?php } ?>
				<?php if ( $twitter <> '' ) { ?>				
					<li><a id="twitter" href="<?php echo $twitter ;?>" title="<?php echo __( 'Twitter', 'clea-base') ;?>"><i class="fa fa-twitter fa-fw"></i></a></li>
				<?php } ?>				
				<?php if ( $pinterest <> '' ) { ?>
					<li><a id="pinterest" href="<?php echo $pinterest ;?>" title="<?php echo __( 'Pinterest', 'clea-base') ;?>"><i class="fa fa-pinterest fa-fw"></i></a></li>
				<?php } ?>
				<?php if ( $rss <> '' ) { ?>				
					<li><a id="rss" href="<?php echo $rss ;?>" title="<?php echo __( 'RSS', 'clea-base') ;?>"><i class="fa fa-rss fa-fw"></i></a></li>
				<?php } ?>		
				<?php if ( $linkedIn <> '' ) { ?>
					<li><a id="LinkedIn" href="<?php echo $linkedIn ;?>" title="<?php echo __( 'LinkedIn', 'clea-base') ;?>"><i class="fa fa-linkedin fa-fw"></i></a></li>
				<?php } ?>
				<?php if ( $viadeo <> '' ) { ?>				
					<li><a id="Viadeo" href="<?php echo $viadeo ;?>" title="<?php echo __( 'Viadeo', 'clea-base') ;?>"><i class="fa fa-bicycle fa-fw"></i></a></li>
				<?php } ?>
				</ul>
		</div>
		<div class="top-search">	 
			<form method="get" class="search-form" action="<?php echo trailingslashit( home_url() ); ?>">
				<div>
				<input class="search-text" type="text" name="s" value="<?php if ( is_search() ) echo esc_attr( get_search_query() ); else esc_attr_e( 'Rechercher...', 'clea-base' ); ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" />
				<button name="submit" type="submit" class="fa-search fa-fw"></button>
				</div>
			</form><!-- .search-form -->
		</div>  <!-- top-search -->
	</div>  <!-- .topbar -->
<?php
}

function clea_base_add_logo_to_header() {
	
	$ald_logo = '<div class="ald-unique-logo">' ;		
	$ald_logo .='<a href="' . esc_attr( get_site_url() ) ;
	$ald_logo .= '"><img class="alignnone size-medium wp-image-201" src="' ;
	$ald_logo .= esc_attr( hybrid_get_setting( 'logo_upload' ) ) ;
	$ald_logo .= '" alt="logo" width="' . esc_attr( hybrid_get_setting( 'logo_width' ) ) . '" height="' .  esc_attr( hybrid_get_setting( 'logo_height' ) ) . '" /></a></div>' ;	
	
	/* for now add an image stored in the images directory of the child theme 
	$ald_logo = '<div class="ald-unique-logo">' ;		
	$ald_logo .='<a href="' . esc_attr( hybrid_get_setting( 'logo_upload' ) ) ;
	$ald_logo .= '"><img class="alignnone size-medium wp-image-201" src="' ;
	$ald_logo .= esc_attr( hybrid_get_setting( 'logo_upload' ) ) ;
	$ald_logo .= '" alt="logo" width="' . esc_attr( hybrid_get_setting( 'logo_width' ) ) . '" height="' .  esc_attr( hybrid_get_setting( 'logo_height' ) ) . '" /></div>' ;
*/
	echo $ald_logo;
}
