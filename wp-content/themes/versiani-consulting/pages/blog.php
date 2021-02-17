<?php
/**
 * Blog Page
 * 
 * Template for the Blog page
 * 
 * @package vec
 */
?>

<div id="blog-page" class="page-content">

	<main id="main">
		<section class="banner py-7" data-style data-background-image="url(<?= get_the_post_thumbnail_url(); ?>)">
			<div class='container'>
				<div class='row'>
					<div class='col-12 colg-md-5 col-lg-4'>
						<div class="content p-6">
							<h1 class="text-white"> <?= get_the_title(); ?></h1>
							<p class="text-white"> <?= get_the_excerpt(); ?></p>
						</div>
					</div>
					
				</div>
			</div>
		</section>

		<section class="desc mt-6">
			<div class='container'>
				<div class='row'>
					<div class="col-12 col-md-8 col-lg-5">
						<h2> <?= get_field('page_subtitle'); ?> </h2>
						<p> <?= get_field('page_description'); ?> </p>
					</div>
				</div>
			</div>
		</section>

		<section class="conteudo">
			<div class='container'>
				<div class='row'>
					<!-- posts -->
					<div class='col-12 col-lg-8'>
						<div class="row">
						<?php 
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;							
							$args = array(
								'post_type'   	 => array( 'post' ),								
								'paged'          => $paged,		
								'nopaging'       => false,		
								'order'          => 'DESC',				
								'posts_per_page' => 8,
							);
					
							// The Query
							$query = new WP_Query( $args );							
							
							if ( $query->have_posts() ) :
								while ( $query->have_posts() ) : $query->the_post(); ?>
									<div class="col-12 col-lg-6">
										<?php Utils::get_template( 'components/post-card', array() ); ?>
									</div>
								<?php	
								endwhile;
								 ?>
								<div class="col-12">
									<div class="pagination mb-4">
										<?php post_pagination( $query->max_num_pages); ?>
									</div>
								</div>
							<?php
							
							endif;
							wp_reset_postdata();
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