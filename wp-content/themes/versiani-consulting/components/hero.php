<?php
/**
 * Hero
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_hero pt-5 position-relative">
    <?php Utils::get_template( 'components/languages', array() ); ?>
    
    <div class='container'>
        <div class='row'>
            <div class='col-12'>
                <!-- Slider main container -->
                <div class="swiper-container hero-container">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <?php 
                            // check if the repeater field has rows of data
                            if( have_rows('hero_slider') ):
                                $c = 1;
                                // loop through the rows of data
                                while ( have_rows('hero_slider') ) : the_row(); ?>
                                    <!-- Slides -->
                                    <div class="swiper-slide">
                                        <div class="slide py-3 position-relative">
                                            <div class="index text-right"> <p class="mb-0"> 0<?= $c; ?> </p> </div>
                                            <div class="title"> 
                                                <hr class="barra">
                                                <h2> <?= get_sub_field('hero_title'); ?> </h2>
                                                <p> <?= get_sub_field('hero_description'); ?>  </p>
                                                
                                                <?php $link = get_sub_field('hero_cta_label'); ?>
                                                <a href="<?= $link['url']; ?>" class="link d-flex">
                                                    <span class="txt"> <?= $link['title']; ?> </span>
                                                    <span class="ico"> <i class="icon-right"></i> </span>
                                                </a>
                                            </div>

                                            <?php $image = get_sub_field('hero_image'); ?>
                                            <div class="image text-right">
                                                <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $c++;
                                endwhile;
                            endif;
                        ?>                        
                    </div>
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</div>