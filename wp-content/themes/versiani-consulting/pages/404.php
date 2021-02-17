<?php
/**
 * 404 Page
 * 
 * Template for the 404 page
 * 
 * @package tri
 */

the_post();
$NotFoundPage = new NotFoundPage();
$query = $NotFoundPage->get_posts_views_count();
?>

<div id="404-page" class="page-content">

	<main id="main">
		<div class='container'>
			<div class='row align-items-center'>
				<div class='col-12 col-lg-4 offset-lg-2'> 
					<div class="page-header text-center text-lg-left">
						<h1 class="mb-7"> 404 </h1>
						<h2 class="ml-lg-5"> ops! esta página <br> não existe mais. </h2>
					</div>
				</div>

				<div class="col-12 col-lg-5">
					<div class="categories text-center">
						<p> Que tal escolher uma das nossas <br> categorias para continuar sua leitura? </p>
						<ul class="list-unstyled d-flex justify-content-center align-items-center flex-wrap">
						<?php 
							$args=array(
								'orderby' => 'name',
								'order' => 'ASC'
								);
							$categories=get_categories($args);
							for ($i=0; $i <= 6; $i++) { ?>
								<li><a href="<?= get_category_link( $categories[$i]->term_id ); ?>" data-style data-background-color="<?= get_field('cor', 'category_' . $categories[$i]->term_id); ?>" class="undecorated-link text-white pb-2 px-1 mb-2 mx-2"> <?= $categories[$i]->name; ?> </a></li>
							<?php }
						?>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<!-- Most reads -->
		<div class='container'>
			<div class='row'>
				<div class="col-12">
					<hr class="my-4 my-lg-7">
					<h3 class="mb-6"> MAIS LIDOS </h3>
				</div>

				<?php 
					$count = 0;
					// The Loop
					if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post(); 
							$count ++;
							$image      = Utils::get_image_data(get_post_thumbnail_id(), 'SIZE_318_175');
							$categories = get_the_category();
							$color      = get_field('cor', 'category_' . $categories[0]->term_id); ?>
							
							<div class="col-12 col-md-4">
								<?php 
									Utils::get_template( 'components/post-card', array( 
										'type'           => 'sidebar',
										'category'       => $categories[0]->name,
										'category_color' => $color,
										'title'          => get_the_title(),
										'content'        => get_the_excerpt(),
										'url_post'       => get_the_permalink(),
										'image_src'      => $image['image_src'][0],
										'image_alt'      => $image['image_alt'],
										'image_width'    => $image['image_width'],
										'image_height'   => $image['image_height']
									));
								?>
							</div>
						<?php	
						endwhile;
					endif;
					
					// Restore original Post Data
					wp_reset_postdata();
				?>
			</div>
		</div>
	</main>

</div>