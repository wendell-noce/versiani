<?php

/**
 * Footer
 *
 * The website footer section
 *
 * @package Versiani
 */
?>

<footer class="_footer py-9">
	<div class="container-fluid">
		<div class="row">
			<div class="col-12 col-md-6 col-lg-1">
				<div class="logo text-center d-none d-md-block">
					<?php Utils::get_template( 'components/logo' , array(
						'is_h1'=> false,
						'image_logo' => "logo.svg" 
					)); ?>
				</div>
			</div>
			<div class="col-12 col-md-6 col-lg-3">
				<div class="newsletter pl-lg-5">
					<h4> NEWSLETTER </h4>
					<?php $news = get_field('newsletter', 'option') ?>
					<p> 
						<strong> <?= $news['newsletter_subtitle']; ?> </strong> <br>
						<?= $news['newsletter_description']; ?>
					</p>
				
					<?php 							
							Utils::get_template( 'components/form', array(
								'id_form' =>$news['newsletter_input']
						) ); ?>
				</div>
			</div>

			<div class="col-12 col-md-4 col-lg-8 pb-md-6 mt-5 mt-md-0 position-relative">
				<?php
					wp_nav_menu(array(
						'theme_location'    => 'footer-menu',
						'menu_class'        => 'footer-menu list-unstyled d-md-flex justify-content-between mb-0',
						'container'         => false
					));
				?>

				<div class="privacy">
					<?php $privacy = get_field('privacy_policy', 'option') ?>
					<a href="<?= $privacy['url']; ?>"> <?= $privacy['title']; ?> </a>
				</div>

				<div class="friday mt-5 ml-2 mt-lg-0 ml-lg-0">
					<p>
						<a href="https://www.fridaydigital.com.br/" target="_blank">
							Developed by <img src="<?= Utils::get_image_asset( 'logo-friday.jpg' ); ?>" alt="Friday" width="57">
						</a>
					</p>
				</div>
			</div>
		</div>
	</div>
</footer>