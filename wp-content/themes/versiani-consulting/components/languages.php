<?php
/**
 * Languages
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_languages text-center d-none d-lg-block">
    <div class="linkedin">
        <div class="list">
            <?= do_shortcode("[wpml_language_selector_widget]"); ?> 
        </div>
        
        <hr class="barra">
        
        <div class="tetx">
            <?php $linkdein = get_field('linkedin', 'option'); ?>
            <p class=""> 
                <a href="<?= $linkdein['linkedin_url']; ?>" class=" mt-3 undecorated-link">
                    <i class="icon-linkedin"></i>
                </a>  
                <?= $linkdein['linkedin_text']; ?>
            </p>
        </div>
    </div>    
</div>