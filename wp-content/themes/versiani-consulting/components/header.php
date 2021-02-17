<?php
/**
 * Header
 *
 * The website main header, including logo, and navigation
 *
 * @param boolean $is_background_dark If should use dark background, and white text & logo
 *
 * @package Versiani
 */
?>

<header class="_header w-100">
	<div class="inner-header">
		<?php
			// Mobile menu
			Utils::get_template( 'components/mobile-menu' );

			// Dedsktop menu
			Utils::get_template( 'components/desktop-menu' );
			
		?>
	</div>
</header>