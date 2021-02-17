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
		<!-- Page Header -->
		<?php Utils::get_template( 'components/page-header', array(
			'description'     => 'Categoria',
			'title'  		  => $categoryPage->get_category_name(),
			'category_color'  => $categoryPage->get_category_color()
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
										$image = $categoryPage->get_post_thumbnail();
										Utils::get_template( 'components/post-card', array( 
											'type'           => 'post-list',
											'category'       => $categoryPage->get_category_name(),
											'category_color' => $categoryPage->get_category_color(),
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