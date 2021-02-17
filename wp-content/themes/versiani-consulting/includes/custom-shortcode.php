<?php 
    function tooltip_shortcode( $atts ) {
        extract( shortcode_atts(
                array(
                    'texto'   => 'Title',
                    'tooltip' => 'Descrição'
                ),
                $atts
        ));
        return '<span class="content-tooltip" tooltip="'.$tooltip.'">'.$texto.'</span>';
 }

   add_shortcode('tooltip', 'tooltip_shortcode');
?>