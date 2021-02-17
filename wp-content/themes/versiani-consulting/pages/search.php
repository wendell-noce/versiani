<?php
/**
 * Search Page
 * 
 * Template for the Search page
 * 
 * @package tri
 */

the_post();
$searchPage = new SearchPage();
$query      = $searchPage->get_posts();
?>

<div id="search-page" class="page-content">

	<main id="main">
		<!-- Page Header -->
		<?php Utils::get_template( 'components/page-header', array(
			'description'     => 'Resultados da busca por',
			'title'  		  => $searchPage->get_search_value(),
			'category_color'  => "#F54653"
		)); ?>

		<!-- Posts listing -->
		<div class="post-list mt-7">
			<div class='container'>
				<div class='row'>
					<?php 
						if ( $query->have_posts() ) :
							while ( $query->have_posts() ) : $query->the_post(); ?>
								<div class="col-12 col-lg-4">
									<?php 
										
										$image = $searchPage->get_post_thumbnail();
										$category = $searchPage->get_category_infos();
										
										Utils::get_template( 'components/post-card', array( 
											'type'           => 'post-list',
											'category'       => $category['name'],
											'category_color' => $category['color'],
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
					?>
				</div>
			</div>
		</div>
	</main>

</div>