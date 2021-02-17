<?php
/**
 * Accordion
 * 
 * Template for collapse questions
 * 
 * @package tri
 */
?>

<div class="_accordion">
    <div class="tabs">
         <?php
            foreach( $perguntas as $index => $field ) : ?>
                <div class="tab">
                    <input type="radio" id="question-<?= $index; ?>" name="perguntas">
                    <label class="tab-label h3 mb-0" for="question-<?= $index; ?>"> <?= $field['pergunta']; ?> </label>
                    <div class="tab-content">
                        <p>
                            <?= $field['resposta']; ?>
                        </p>
                    </div>
            </div>
        <?php    
            endforeach; 
        ?>
    </div>
</div>