<?php
/**
 * this is a template ! 
 *
 * Template Name: Test pour afficher un élément du theme customizer

 * 

 * @package UniqueChild1

 * 
 */

get_header(); // Loads the header.php template. ?>

	<div id="content" class="hfeed">

		<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		<H2>Test police de caractères</h2>
		<div id="lipsum">
			<p>Nam faucibus tortor nunc, vel imperdiet felis placerat nec. Nam eleifend posuere urna, eget auctor ante lacinia interdum. Pellentesque sed mi facilisis, semper metus quis, bibendum massa. Aenean vitae ligula at felis consectetur commodo. Pellentesque porttitor purus vitae malesuada dapibus. Nam lacinia neque non lobortis interdum. Sed maximus dui nulla, nec hendrerit lectus rhoncus vel. Morbi tempor sodales purus vel scelerisque. Nullam in diam mi. Aenean rutrum consequat tellus non vehicula. Vestibulum dictum mollis velit, nec consectetur turpis facilisis eget.</p>
			<p>Pellentesque posuere metus urna, ut porta massa cursus eget. Vestibulum vel interdum urna. Sed et maximus diam, nec dignissim ipsum. Cras sollicitudin vestibulum laoreet. Duis et ligula id nibh tincidunt porttitor et id orci. Maecenas felis erat, suscipit eu nibh cursus, consequat ultrices ante. Aenean eget interdum tortor. Suspendisse aliquam tempor odio, non accumsan lectus venenatis vel. In tincidunt tincidunt orci quis pretium. Donec tempus dapibus ultricies. Proin dignissim vel velit ac eleifend.</p>
		</div>
		
		
		<!-- test_ald_1_textarea is set in the theme customizer -->
		<H2> Affichage des options de la page "theme settings" </H2>		
		<?php 
		echo '<p>unique_child_1_textarea : ' . esc_attr( hybrid_get_setting( 'unique_child_1_textarea' ) ) . '</p>'; 
		echo '<p>unique_child_1_text_input : ' . esc_attr( hybrid_get_setting( 'unique_child_1_text_input' ) ) . '</p>'; 		
	/* Validate and/or sanitize the textarea. */

		?>
		<H2> Affichage des options du theme customizer ! </H2>
		<h3> Des éléments de la section Adresse</h3>
		<hr>
		<!--
		définis dans functions/ald-customize.php comme
		{$prefix}_theme_settings[adresse]
		{$prefix}_theme_settings[telephone]
		{$prefix}_theme_settings[mail]
		-->
		<?php 
		echo '<p>adresse : ' . esc_attr( hybrid_get_setting( 'adresse' ) ) . '</p>'; 
		echo '<p>telephone : ' .  esc_attr( hybrid_get_setting( 'telephone' ) ) . '</p>'; 		
		echo '<p>mail : ' .  esc_attr( hybrid_get_setting( 'mail' ) ) . '</p>'; 		
		?>
		<hr>
		
		<h3> Des éléments de la section Réseaux sociaux</h3>
		<hr>
		<!--
		définis dans functions/ald-customize.php comme
			{$prefix}_theme_settings[facebook]
			{$prefix}_theme_settings[twitter]
			{$prefix}_theme_settings[pinterest]
			{$prefix}_theme_settings[rss]
			{$prefix}_theme_settings[google+]
			{$prefix}_theme_settings[linkedin]
			{$prefix}_theme_settings[viadeo]
		-->
		<?php 
		echo '<p>facebook : ' . esc_attr( hybrid_get_setting( 'facebook' ) ) . '</p>'; 
		echo '<p>twitter : ' .  esc_attr( hybrid_get_setting( 'twitter' ) ) . '</p>'; 		
		echo '<p>pinterest : ' .  esc_attr( hybrid_get_setting( 'pinterest' ) ) . '</p>'; 		
		echo '<p>rss : ' .  esc_attr( hybrid_get_setting( 'rss' ) ) . '</p>'; 
		echo '<p>google+ : ' .  esc_attr( hybrid_get_setting( 'google+' ) ) . '</p>'; 		
		echo '<p>linkedin : ' .  esc_attr( hybrid_get_setting( 'linkedin' ) ) . '</p>'; 
		echo '<p>viadeo : ' .  esc_attr( hybrid_get_setting( 'viadeo' ) ) . '</p>'; 
		?>
		<hr>

		<h3> Des éléments de la section Logo & Favicon</h3>
		<hr>
		<!--
		définis dans functions/ald-customize.php comme
			{$prefix}_theme_settings[logo_upload]
			{$prefix}_theme_settings[logo_width]
			{$prefix}_theme_settings[logo_height]
			{$prefix}_theme_settings[favicon_upload]
		-->
		<h4>Avec esc_attr( hybrid_get_setting( 'logo_width' ) )</h4>
		<?php 
		echo '<p>logo_upload : ' . esc_attr( hybrid_get_setting( 'logo_upload' ) ) . '</p>'; 
		echo '<p>logo_width : ' .  esc_attr( hybrid_get_setting( 'logo_width' ) ) . '</p>'; 		
		echo '<p>logo_height : ' .  esc_attr( hybrid_get_setting( 'logo_height' ) ) . '</p>'; 		
		echo '<p>favicon_upload : ' .  esc_attr( hybrid_get_setting( 'favicon_upload' ) ) . '</p>'; 
		?>
		<hr>

		<!--
		avec des termes non "hybrid"
		-->
		<h4>avec get_option( 'unique' . '_theme_settings', false ) </h4>
		<?php 
		$options = get_option( 'unique' . '_theme_settings', false );
		// see http://www.narga.net/comprehensive-guide-wordpress-theme-options-with-customization-api/
		if ( isset ($options[logo_upload])) {
			echo __( '<p>logo_upload : ', 'clea-base' ) .  $options[logo_upload] . '</p>'; 			
		} else {
			echo __( '<p>logo_upload : pas trouvé ! </p>', 'clea-base' );
		}
		if ( isset ( $options[logo_width] )) {
			echo __( '<p>logo_width : ', 'clea-base' ) .  $options[logo_width] . '</p>'; 			
		} else {
			echo __( '<p>logo_width : pas trouvé ! </p>', 'clea-base' );
		}
		?>
		<hr>	
		<p>!!! génial, non ? !!!</p>
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

<?php get_footer(); // Loads the footer.php template. ?>