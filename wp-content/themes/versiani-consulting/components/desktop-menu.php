<?php

/**
 * Desktop menu
 *
 * Menu desktop
 *
 * @package tri
 * @param string $logo_tag -> Tag for logo
 *
 */
?>
<div class="_desktop-menu d-none d-lg-block pt-4 pb-6">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-2">
                <!-- LOGO -->
                <?php Utils::get_template( 'components/logo' , array(
					'is_h1'=> true,
					'image_logo' => "logo.svg" 
				)); ?>
			</div>
			
			<div class="col-lg-7">
				<div class="navigation">
					
					<?php if (has_nav_menu('main-menu')) : ?>
						<nav class="site-navigation" role="navigation">
							<?php
								wp_nav_menu(array(
									'theme_location'    => 'main-menu',
									'menu_class'        => 'main-menu list-unstyled d-flex justify-content-around mb-0 text-uppercase',
									'container'         => false
								));
							?>
						</nav>
					<?php else : ?>
						No main menu found.
					<?php endif; ?>
				</div>
			</div>

			<div class="col-lg-3">
				<div class="tel">
					<span class="d-flex undecorated-link">
						<span class="ico px-2"> <i class="icon-phone"></i> </span>
						<span class="tel-number px-3"> <?= get_field('options_phone', 'option'); ?> </span>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>