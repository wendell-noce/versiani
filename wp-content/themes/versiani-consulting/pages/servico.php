<?php
/**
 * Servico Page
 * 
 * Template for the Servico page
 * 
 * @package vec
 */

the_post();
?>

<div id="servico-page" class="page-content">

	<main id="main">
		<!-- Page Header -->
		<?php Utils::get_template( 'components/page-header', array(
			'title'   => get_the_title(),
			'desc'    => get_the_excerpt(),
			'img_url' => get_the_post_thumbnail_url()
		) ); ?>

		<!-- Sobre -->
		<section class="sobre py-lg-10 position-relative">
			<div class="sec-title px-4 px-lg-0">
				<h2> <?= get_field('des_section_title'); ?> <hr class="barra"> </h2>
			</div>

			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class="col-12 col-lg-5 offset-lg-1">
						<div class="content pr-6">
							<h2> <?= get_field('service_title'); ?> </h2>
							<p> <?= get_field('service_desc'); ?> </p>
						</div>
					</div>
					<div class='col-12 col-lg-6 px-0'>
						<div class="image">
							<img src="<?php $image = get_field('service_image'); echo $image['url']; ?>" alt="" class="w-100">
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Como Funciona -->
		<section class="como-funciona  pt-6 py-lg-10 position-relative bg-primary">
			<div class="sec-title px-4 px-lg-0">
				<h2> <?= get_field('how_section_title'); ?> <hr class="barra"> </h2>
				
			</div>

			<div class='container-fluid'>
				<div class='row justify-content-center'>
					<div class='col-12 col-lg-10'>
						<div class="row justify-content-stretch">
							<?php
								// check if the repeater field has rows of data
								if( have_rows('how_cards') ):

									// loop through the rows of data
									$barra = ['25','50','75','100'];
									$c = 0;
									while ( have_rows('how_cards') ) : the_row(); ?>
										<div class="col-12 col-lg-6  mb-6">
											<!-- Card 1 -->
											<div class="card align-items-end d-md-flex justify-content-stretch pt-6 pl-6 h-100">
												<div class="text pr-5">
													<div class="index"> <span> 0<?= $c+1; ?> </span> </div>
													<div class="desc pt-8 position-relative">
														<p> <?= get_sub_field('how_cards_description'); ?> </p>

														<div class="box-loader">
															<div class="inner-loader d-block w-<?= $barra[$c]; ?>"></div>
														</div>
													</div>

												</div>

												<!-- Thumb -->
												<div class="image">
													<img src="<?php $image = get_sub_field('how_cards_image'); echo $image['url']; ?>" alt="" class="w-100">
												</div>
											</div>
										</div>
									<?php
									$c++;
                                	endwhile;
                            	endif;
                        	?>							
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Beneficios -->
		<section class="beneficios py-8">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class="col-12 col-lg-5 px-0">
						<div class="image">
							<img src="<?php $image = get_field('benefits_image'); echo $image['url']; ?>" alt="Diferenciais" class="w-100">
						</div>
					</div>
					<div class="col-12 col-lg-2 px-0">
						<div class="content bg-white py-6 px-5 mb-6 mb-lg-0">
							<h2> <?= get_field('benefits_section_title'); ?> </h2>
							<p> <?= get_field('benefits_desc'); ?> </p>
						</div>
					</div>
					<div class="col-12 col-lg-5">
						<div class="list">
							<ul class="list-unstyled mb-0 d-flex flex-wrap">
								<?php
									// check if the repeater field has rows of data
									if( have_rows('benefits_cards') ):

										// loop through the rows of data										
										while ( have_rows('benefits_cards') ) : the_row(); ?>
											<li>
												<div class="image mb-4"> 
													<img src="<?= get_sub_field('benefits_card_image'); ?>" alt="Icon">
												</div>
												<p> <?= get_sub_field('benefits_card_description'); ?> </p>
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

		<!-- outros -->
		<?php if( get_field('footer_banner_active') ): ?>
			<section class="banner py-7" data-style data-background-image="url(<?= get_field('footer_banner_image'); ?>)">
				<div class='container'>
					<div class='row'>
						<div class='col-12 text-right'>
							<div class="content p-6 d-inline-block">
								<h1 class="text-white text-uppercase"> <?= get_field('footer_banner_title'); ?> </h1>
								<p class="text-white"> <?= get_field('footer_banner_description'); ?> </p>
							</div>
						</div>
						
					</div>
				</div>
			</section>
		<?php endif; ?>
		
		<section class="contato py-10 bg-primary">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-5 offset-lg-1'>
						<h2 class="mb-0 text-white h1">
							<?= get_field('form_service_title'); ?>
						</h2>
					</div>

					<!-- form -->
					<div class="col-12 col-lg-4 offset-lg-1">
						<?php 							
							Utils::get_template( 'components/form', array(
							'id_form' => get_field('contatc_form_id')
						) ); ?>
					</div>
				</div>
			</div>
		</section>
	</main>

</div>