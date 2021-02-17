<?php
/**
 * Post Card
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_post-card mb-7">
    <div class="image">
        <a href="<?= get_the_permalink(); ?>" class="undecorated-link">
            <?php the_post_thumbnail('post-thumbnail', ['class' => 'transition']); ?>
        </a>
    </div>
    <div class="content pt-6 px-6 pb-6" data-style data-border-color="#528d38">
        <h2><a href="<?= get_the_permalink(); ?>" class="undecorated-link h2">  <?= get_the_title(); ?> </a> </h2>  
        <p>
            <a href="<?= get_the_permalink(); ?>" class="undecorated-link">
                <?= get_the_excerpt(); ?>
            </a>
        </p>
        <a href="<?= get_the_permalink(); ?>" class="btn btn-blue text-uppercase"> 
            <?php 
                // Utils::get_template( 'components/text-traductions', array(
                //     'en_text' => "Read more <i class='icon-right-arrow ml-2'></i>",
                //     'fr_text' => "en savoir plus <i class='icon-right-arrow ml-2'></i>",
                //     'pt_text' => "Saiba mais <i class='icon-right-arrow ml-2'></i>"
                // )); 
            ?>
        </a>
    </div>
</div>