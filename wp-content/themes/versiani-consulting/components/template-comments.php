<?php
/**
 * Template Comments
 * 
 * Add the component description here...
 * 
 * @package tri
 */
?>

<div class="_template-comments comments mt-10">

    <?php if ( comments_open() ) : ?>
        <div class="comments-form px-4 px-lg-8 pb-4">
            <img src="<?= Utils::get_image_asset('comente.svg'); ?>" alt="Planeta Notícia" class="title-img" width="182">
            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <fieldset>
                    
                    <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" placeholder="Seu nome" />

                    <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" placeholder="Seu email" />

                    <textarea name="comment" id="comment" placeholder="Escreva seu comentário"></textarea>
                    
                    <div class="text-right">
                        <input type="submit" class="commentsubmit transition" value="Enviar" />
                    </div>

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </fieldset>
            </form>
            <p class="cancel"><?php cancel_comment_reply_link('Cancelar Resposta'); ?></p>
        </div>
    <?php endif; ?>

    <?php if ( have_comments() ) : ?>
        <ul class="comments-list list-unstyled mt-5">
            <?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>
        </ul>
        <?php if ($wp_query->max_num_pages > 1) : ?>
            <div class="pagination">
                <ul>
                    <li class="older"><?php previous_comments_link('Anteriores'); ?></li>
                    <li class="newer"><?php next_comments_link('Novos'); ?></li>
                    </ul>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    

</div>