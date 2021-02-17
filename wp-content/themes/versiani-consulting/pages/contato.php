<?php
/**
 * Contato Page
 * 
 * Template for the Contato page
 * 
 * @package vec
 */

the_post();
$pageClass = new ContatoPage();
?>

<div id="contato-page" class="page-content">

	<main id="main">
		<!-- Page Header -->
		<?php 
			$pageHeader = $pageClass->get_page_header();
			Utils::get_template( 'components/page-header', array(
				'title'   => $pageHeader['title'],
				'desc'    => $pageHeader['desc'],
				'img_url' => $pageHeader['image']['url'],
				'bg'      => "bg-gray"
		) ); ?>

		<!-- form -->
		<section class="form py-8 bg-primary">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-5 px-0'>
						<div class="image">
							<img src="<?= Utils::get_image_asset( 'img-form.png' ); ?>" alt="Canais de atendimento" class="w-100">
						</div>
					</div>
					<div class='col-12 col-lg-3 px-0'>
						<?php $form = $pageClass->get_form(); ?>
						<div class="content p-6">
							<h2> <?= $form['title']; ?> </h2>
							<p> <?= $form['sec_desc']; ?> </p>
							<p>
								<i class="icon-phone"></i> <?= get_field('options_phone', 'option'); ?> <br>
								<i class="icon-mail"></i> <?= get_field('contact_mail', 'option'); ?>
							</p>
						</div>
					</div>
					<div class='col-12 col-lg-3'>
						<?php Utils::get_template( 'components/form', array(
							'desc' => $form['form_desc'],
							'id_form' => get_field('form_id')
						) ); ?>
					</div>
				</div>
			</div>
		</section>

		<!-- Localizacao -->
		<div class="localizacao py-8">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-3 offset-lg-1'>
						<?php $address = $pageClass->get_address(); ?>
						<div class="content mb-5 mb-lg-0">
							<h2 class="mb-1"> <?= $address['title']; ?> </h2>
							<p class="mb-3 mb-lg-2"> 
								<i class="icon-location mr-2"></i> <?= get_field('options_addrress', 'option'); ?> <br>
							</p>
							<a href="<?= $address['link']['url']; ?>" target="_blank" class="btn btn-blue rounded"> <?= $address['link']['title']; ?> </a>
						</div>
					</div>

					<!-- mapa -->
					<div class="col-12 col-lg-8 px-0">
						<div class="mapa py-6">
						<?= $address['embed_map']; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

</div>