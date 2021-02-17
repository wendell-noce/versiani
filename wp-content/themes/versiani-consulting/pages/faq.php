<?php
/**
 * Perguntas Frequentes Page
 * 
 * Template for the Faq page
 * 
 * @package tri
 */
$pageClass = new FaqPage();
the_post();
?>

<div id="faq-page" class="page-content">

	<main id="main">
		<?php Utils::get_template( 'components/page-header', array(
			'is_page'         => true,
			'title'  		  => $pageClass->get_title(),
			'category_color'  => "#6D58A2",
			'class'           => 'col-lg-8'
		)); ?>
		<div class='container'>
			<div class='row justify-content-center'>
				<div class='col-12 col-lg-8'> 
					<?php 
						Utils::get_template( 'components/accordion', array(
							'perguntas' => $pageClass->get_questions()
						) );
					?>	
				</div>

				<div class="col-12 col-lg-8 mt-5">
					<div class="faq-form px-4 px-lg-8 pb-4 mt-10">
						<div class="text-right">
							<img src="<?= Utils::get_image_asset('contato.svg'); ?>" alt="Planeta Notícia" class="title-img" width="182">
						</div>
						<h2> Sua pergunta não está aqui? </h2>
						<p> Escreva para a gente</p>

						<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
							<fieldset>
								
								<div class="d-flex justify-content-around">
									<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" placeholder="Seu nome" class="mr-2" />

									<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" placeholder="Seu email" class="ml-2" />
								</div>

								<textarea name="comment" id="comment" placeholder="Escreva sua pergunta"></textarea>
								
								<div class="text-right">
									<input type="submit" class="commentsubmit transition" value="Enviar" />
								</div>

								<?php comment_id_fields(); ?>
								<?php do_action('comment_form', $post->ID); ?>
							</fieldset>
						</form>
						<p class="cancel"><?php cancel_comment_reply_link('Cancelar Resposta'); ?></p>
					</div>
				</div>
			</div>
		</div>
		
	</main>

</div>