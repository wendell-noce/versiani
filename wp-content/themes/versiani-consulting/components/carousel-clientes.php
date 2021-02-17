<?php
/**
 * Carousel Clientes
 * 
 * Add the component description here...
 * 
 * @package vec
 */

 
 $ids = [];
 foreach ($clientes as $key => $value) {
     # code...
    array_push($ids, $value['the_client']);
 }
 
 $args = array(
    'post_type'   	=> array( 'customer' ),
    'post_status' 	=> array( 'publish' ),
    'order'       	=> 'DESC',
    'post__in'      => $ids
);

// The Query
$query = new WP_Query( $args );
?>

<div class="_carousel-clientes clientes">
    <!-- Slider main container -->
    <div class="swiper-container slider-clientes">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <?php 
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : 
                        $query->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="image d-flex align-items-center justify-content-center">
                                <?php $image = get_field('cliente_logo'); ?>
                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>"> 
                            </div>
                        </div>
                    <?php
                    endwhile;
                endif;
                wp_reset_postdata();
            ?>            
        </div>
    </div>

    <!-- Add Arrows -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>   
</div>