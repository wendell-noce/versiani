<?php
/**
 * Form
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_form">
    <?php if(isset( $desc)): ?>
        <p class="mb-3"> <?= $desc; ?> </p>
    <?php endif; ?>
    
    <?= do_shortcode( '[contact-form-7 id="'. $id_form .'" title="Formulário"]' )  ?>
</div>