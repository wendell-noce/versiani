<?php
/**
 * Traduções estaticas
 *
 * Template for...
 *
 * @package vec
 */?>

<?php 
    if(ICL_LANGUAGE_CODE == 'en'): 
        echo $en_text;
    elseif(ICL_LANGUAGE_CODE == 'fr'): 
        echo $fr_text;
    else: 
        echo $pt_text;
    endif; 
?>
