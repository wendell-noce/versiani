<?php
/**
 * Equipe Page
 * 
 * Template for the Equipe page
 * 
 * @package tri
 */

the_post();
$pageClass = new EquipePage();
?>

<div id="equipe-page" class="page-content">

	<main id="main">
		<?php Utils::get_template( 'components/page-header', array(
			'is_page'         => true,
			'title'  		  => $pageClass->get_title(),
			'category_color'  => "#A4C84D",
			'class'           => 'col-lg-8'
		)); ?>

		<div class='container mt-6'>
			<div class='row justify-content-center'>
				<div class='col-12 col-lg-8'> 
					<div class="_the-content" data-title-color="#A4C84D">
						<?php 	
							$pageClass->get_content();
						?>
					</div>
				</div>
			</div>
		</div>

		<!-- Usuarios -->
		<div class='container mt-6'>
			<div class='row justify-content-center'>
				<div class='col-12 col-lg-8'> 
					<div class="row">
					<?php 
						$list_users = $pageClass->get_users();
						foreach ($list_users as $key => $user) {
							# code...
							$author_id    = $user->ID;
							$author_image = get_field('foto', 'user_'. $author_id );
							$userdata = get_user_meta( $user->ID ); 
							
						?>
							<div class='col-12 col-md-6'> 
								<div class="d-flex align-items-center mb-5">
									<div class="image mr-4"> <img src="<?= $author_image['url']; ?>" alt="" width="87"> </div> 
									<div class="description">
										<h3 data-style data-color="#A4C84D"> <?= $user->data->display_name; ?></h3>
										<p class="mb-0"> <?= $userdata['description'][0]; ?></p>
									</div>
								</div>
						
							</div>
							
							<?php
						}
					?>
					</div>
				</div>	
			</div>
		</div>
		
	</main>

</div>