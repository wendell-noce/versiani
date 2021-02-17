<?php
/**
 * Sobre Nos Page
 * 
 * Template for the Sobre Nos page
 * 
 * @package tri
 */

the_post();
$pageClass = new SobreNosPage();
?>

<div id="sobre-nos-page" class="page-content">

	<main id="main">
		<!-- Page Header -->
		<?php 
			$pageHeader = $pageClass->get_page_header();			
			Utils::get_template( 'components/page-header', array(
				'title'   => $pageHeader['title'],
				'desc'    => $pageHeader['desc'],
				'img_url' => $pageHeader['image']['url']
			)); 
		?>

		<?php $aboutUs = $pageClass->get_about(); ?>
		<section class="sobre py-8">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-6 px-0'>
						<div class="image">
							<!-- image -->
							<img src="<?= $aboutUs['image']['url']; ?>" alt="Quem Somos">	
						</div>
					</div>

					<div class="col-12 col-lg-5 px-0">
						<!-- content -->
						<div class="box-content py-5 px-7 bg-white">
							<h2> <?= $aboutUs['title']; ?> </h2>
							<p><?= $aboutUs['desc']; ?></p>
						</div>

						<div class="missoes mt-6">
							<ul class="list-unstyled mb-0 d-flex flex-wrap">
								<?php 
									if( have_rows('versiani_cards') ):

										// loop through the rows of data
										while ( have_rows('versiani_cards') ) : the_row(); ?>
											<li>
												<h3> <?= get_sub_field('versiani_card_title'); ?> </h3>
												<p> <?= get_sub_field('versiani_card_description'); ?> </p>
											</li>
										<?php
										endwhile;
									endif;
								?>								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Diferenciais -->
		<section class="diferenciais bg-primary py-8">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class="col-12 col-lg-5 px-0">
						<div class="image d-none d-lg-block">
							<img src="<?= Utils::get_image_asset( 'img-deferenciais.png' ); ?>" alt="Diferenciais" class="w-100">
						</div>
					</div>
					<div class="col-12 col-lg-2 px-0">
						<div class="content bg-white py-6 px-5">
							<h2> <?= get_field('differentials_title'); ?> </h2>
						</div>
					</div>
					<div class="col-12 col-lg-5">
						<div class="list">
							<ul class="list-unstyled mb-0 d-flex flex-wrap">
								<?php 
									if( have_rows('differentials_cards') ):

										// loop through the rows of data
										while ( have_rows('differentials_cards') ) : the_row(); ?>
											<li>
												<div class="ico rounded text-center mb-4"> 
													<i class="icon-check"></i>
												</div>
												<p> <?= get_sub_field('differentials_description'); ?> </p>
											</li>
										<?php
										endwhile;
									endif;
								?>	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- CEO -->
		<?php $ceo = $pageClass->get_ceo(); ?>
		<section class="curriculo py-8">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-5 offset-lg-1'>
						<div class="image  mb-4 mb-lg-0">
							<img src="<?= $ceo['image']['url']; ?>" alt="CEO">
						</div>
					</div>
					<div class="col-12 col-lg-5">
						<div class="content">
							<h3 class="name mb-0"> <?= $ceo['name']; ?> </h3>
							<h3 class="text-uppercase"><strong> <?= $ceo['cargo']; ?> </strong> </h3>
							<hr class="ml-0 barra">

							<p> <?= $ceo['desc']; ?> </p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Clientes -->
		<?php $customers = $pageClass->get_customers(); ?>
		<section class="clientes py-10 d-none">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-4'>
						<div class="image text-center">
							<img src="<?= Utils::get_image_asset( 'img-clientes.png' ); ?>" alt="Principais clientes">	
						</div>
					</div>
					<div class='col-12 col-lg-4'>
						<div class="content text-content text-lg-left">
							<p> <?= $customers['desc']; ?> </p>
						</div>
					</div>
					<div class='col-12 col-lg-4'>
						<div class="d-flex justify-content-center">
							<?php Utils::get_template( 'components/carousel-clientes', array(
								'clientes' => $customers['ids']
							) ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Contato -->
		<?php $contact = $pageClass->get_contact(); ?>
		<section class="contato py-10" data-style data-background-image="url(<?= $contact['image']['url']; ?>)">
			<div class='container'>
				<div class='row justify-content-center'>
					<div class='col-10 col-mb-8 col-lg-7'>
						<div class="content pt-8 pb-6 px-5 text-center">
							<a href="<?= $contact['link']['url']; ?>" class="btn btn-blue rounded mb-5 d-inline-block text-uppercase">
								<?= $contact['title']; ?>
							</a>

							<p>
								<?= $contact['desc']; ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

</div>