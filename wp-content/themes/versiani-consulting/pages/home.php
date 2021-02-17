<?php
/**
 * Pagina Inicial Page
 * 
 * Template for the Pagina Inicial page
 * 
 * @package tri
 */

the_post();
$pageClass = new HomePage();
?>

<div id="pagina-inicial-page" class="page-home home">

	<main id="main">
		<!-- hero -->
		<?php Utils::get_template( 'components/hero', array() ); ?>

		<!-- Referência -->
		<?php $about = $pageClass->get_about_us(); ?>
		<section class="home-referencia position-relative py-lg-10">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class="sec-title">
						<h2 class="text-white"> <?= $about['title']; ?> <hr class="barra">  </h2>
					</div>

					<div class="col-xl-4 offset-xl-1 col-md-6 py-6">
						<div class="box-title">
							<h2 class="text-white"> <?= $about['subtitle']; ?>  </h2>

							<p class="text-white"> <?= $about['description']; ?> </p>

							<a href="<?= $about['cta']['url']; ?>" class="btn text-uppercase transition py-2 btn-blue"> <?= $about['cta']['title']; ?>  <i class="icon-right-arrow"></i> </a>
						</div>
					</div>

					<div class="col-xl-6  offset-xl-1 text-right pr-0 col-md-6">
						<img src="<?= $about['image']['url']; ?>" alt="<?= $about['image']['alt']; ?>">
					</div>
				</div>
			</div>
		</section>

		<!-- Razoes -->
		<section class="home-razoes py-10">
			<div class='container-fluid'>
				<div class='row align-items-center'>
					<div class='col-12 col-lg-4 offset-lg-1'>
						<div class="box-title mb-5 mb-lg-0">
								<?= get_field('reasons_title'); ?>

								<p> <?= get_field('reasons_description'); ?> </p>
								<?php $cta = get_field('reasons_cta'); ?>
								<?php if( $cta['url'] != "" ): ?>
									<a href="<?= $cta['url']; ?>" class="btn btn-primary text-uppercase transition py-2"> <?= $cta['title']; ?> <i class="icon-right-arrow"></i> </a>	
								<?php endif; ?>
								
							</div>
					</div>

					<div class="col-12 col-lg-6">
						<div class="list">
							<ul class="list-unstyled mb-0">
								<?php 
									// check if the repeater field has rows of data
									if( have_rows('reasons_cards') ):

										// loop through the rows of data
										while ( have_rows('reasons_cards') ) : the_row();
											$image = get_sub_field('reasons_image'); ?>
											<li class="mb-4">
												<div class="image mb-3">
													<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
												</div>
												<div class="content">
													<h3 class="h4"> <?= get_sub_field('reasons_card_title'); ?> </h3>
													<p> <small> <?= get_sub_field('reasons_description'); ?> </small> </p>	
												</div>
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

		<!-- Serviços -->
		<section class="home-nossos-servicos" id="services">
			<?php Utils::get_template( 'components/nossos-servicos', array('query' => $pageClass->get_services()) ); ?>
		</section>

		<!-- Projetos -->
		<section class="home-desenvolvimento position-relative bg-medium">
			<div class="sec-title">
				<h2> <?php echo get_field('projects_section_title'); ?> <hr class="barra">  </h2>
			</div>
			<div class='container-fluid'>
				<div class='row justify-content-center'>
					<div class="col-12 col-lg-10">
						<div class="row">
							<?php
								// check if the repeater field has rows of data
								if( have_rows('oroject_cards') ):
									// loop through the rows of data
									$c = 1;
									$barra = 25;
									while ( have_rows('oroject_cards') ) : the_row();
										$image = get_sub_field('project_card_image'); ?>
										<!-- card  -->
										<div class='col-12 col-lg-3 col-md-6 py-md-4'>
											<div class="content bg-white py-4 px-6">
												<div class="index position-relative"> 
													<h4> 0<?= $c; ?> </h4> 
													<h3> <?= get_sub_field('project_card_title'); ?> </h3>
												</div>
												
												<p> <?= get_sub_field('project_card_description'); ?> </p>

												<div class="barra">
													<div class="step w-<?= $barra; ?>"></div>
												</div>
											</div>

											<div class="image bg-white pb-6">
											<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
											</div>
										</div>
									<?php
										$c++;
										$barra = $barra + 25;
									endwhile;
								endif;
							?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Posts -->
		<section class="home-blog position-relative py-lg-10">
			<div class="sec-title">
				<h2> 
					<?php 
						Utils::get_template( 'components/text-traductions', array(
							'en_text' => "latest blog posts",
							'fr_text' => "derniers articles de blog",
							'pt_text' => "últimos posts do blog"
						)); 
					?>
					<hr class="barra"> 
				</h2>
				
			</div>

			<?php Utils::get_template( 'components/posts-home', array( 'query' => $pageClass->get_posts() ) ); ?>
		</section>

		<!-- Contato -->
		<section class="home-contato bg-primary py-7">
			<div class='container-fluid'>
				<div class='row justify-content-stretch'>
					<div class='col-12 col-lg-7 offset-lg-1'>
						<div class="consultor position-relative">
							<?php $data = $pageClass->get_contatc_data(); ?>
							<img src="<?= $data['image']['url']; ?>" alt="<?= $data['image']['alt']; ?>" class="mb-7">
							<div class="content bg-white py-5 px-7">
								<hr class="barra ml-0">
								<h2> <?= $data['title']; ?> </h2>
								<p> <?= $data['desc']; ?> </p>
								<p> 
									<strong> <i class="icon-phone"></i> <?= get_field('options_phone', 'option'); ?></strong> <br> 
									<strong> <i class="icon-mail"></i> <?= get_field('contact_mail', 'option'); ?> </strong> <br> 
								</p>

								<a href="<?= $data['link']['url']; ?>" target="<?= ($data['link']['target'] == "_blank") ? $data['link']['target']: "_self"; ?>" class="btn text-uppercase transition py-1 px-2 btn-blue"> <?= $data['link']['title']; ?> <i class="icon-right-arrow ml-2"></i> </a>
							</div>
						</div>						
					</div>

					<div class="col-12 col-lg-4 d-none">
						<div class="carousel bg-white h-100 d-flex justify-content-center align-items-center position-relative">
							<div class="sec-title">
								<h2> <?= $data['cli_title']; ?> <hr class="barra"> </h2>
							</div>

							<?php Utils::get_template( 'components/carousel-clientes', array(
								'clientes' => $data['clientes']
							) ); ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>

</div>