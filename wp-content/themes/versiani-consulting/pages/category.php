<?php
/**
 * Category Page
 * 
 * Template for the Category page
 * 
 * @package tri
 */

the_post();
$categoryPage = new CategoryPage();

$query = $categoryPage->get_posts();

?>

<div id="category-page" class="page-content">

	<main id="main">
		<section class="banner py-7" data-style data-background-image="url(<?= Utils::get_image_asset( 'img-bg-servicos.png' ); ?>)">
			<div class='container'>
				<div class='row'>
					<div class='col-12 col-md-6 col-lg-6'>
						<div class="content p-6">
							<h1 class="text-white"> <?= $categoryPage->get_category_name(); ?></h1>
						</div>
					</div>					
				</div>
			</div>
		</section>

		<section class="conteudo py-8">
			<div class='container'>
				<div class='row'>
					<!-- posts -->
					<div class='col-12 col-lg-8'>
						<div class="row">
						<?php 
							
							if ( $query->have_posts() ) :
								while ( $query->have_posts() ) : $query->the_post(); ?>
									<div class="col-12 col-lg-6">
										<?php Utils::get_template( 'components/post-card', array() ); ?>
									</div>
								<?php	
								endwhile;
							endif;
						?>
						</div>
					
					</div>
					<!-- Sidebar -->
					<div class='col-12 col-lg-4'>
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</section>
		
	</main>

</div>