<?php
/**
 * Template Padro Page
 * 
 * Template for the Template Padro page
 * 
 * @package vec
 */

the_post();
?>

<div id="template-padro-page" class="page-content">

	<main id="main">
		<?php 
			Utils::get_template( 'components/page-header', array(
				'title'   => get_the_title(),
				'desc'    => get_the_excerpt(),
				'img_url' => get_the_post_thumbnail_url()
		) ); ?>

		<section class="the_content py-10">
		<div class='container'>
			<div class='row'>
				<div class='col-12'>
					<?php the_content(); ?>
				</div>
			</div>
		</div>
		</section>
	</main>

</div>