<?php
/**
 * Posts Home
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_posts-home pb-6">
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-12 col-md-11 offset-md-1'>
                <!-- Slider main container -->
                <div class="swiper-container slider-posts">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php 
                            if ( $query->have_posts() ) :
                                while ( $query->have_posts() ) : 
                                    $query->the_post(); ?>
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="slide d-flex flex-wrap flex-lg-nowrap align-items-center">
                                            <div class="image mr-6 mb-5 mb-lg-0">
                                                <a href="<?= get_the_permalink(); ?>" class="undecorated-link">
                                                    <?php the_post_thumbnail( "SIZE_695_465"); ?>
                                                </a>
                                            </div>
                                            <div class="content">
                                                <a href="<?= get_the_permalink(); ?>" class="undecorated-link">
                                                    <h3> <?= get_the_title(); ?></h3>

                                                    <p> <?= get_the_excerpt(); ?> </p>
                                                    
                                                    <span class="btn text-uppercase transition py-2"> 
                                                    <?php 
                                                        Utils::get_template( 'components/text-traductions', array(
                                                            'en_text' => "Read more <i class='icon-right-arrow'></i>",
                                                            'fr_text' => "en savoir plus <i class='icon-right-arrow'></i>",
                                                            'pt_text' => "Saiba mais <i class='icon-right-arrow'></i>"
                                                        )); 
                                                    ?>
                                                        
                                                    </span>
                                                </a>
                                            </div>
                                        </div> 
                                    </div>
                                <?php
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>                        
                    </div>
                </div>                
            </div>    
            <!-- Add Arrows -->
            <div class="bg-white swiper-button-next"></div>
            <div class="bg-white swiper-button-prev"></div>        
        </div>
    </div>
</div>