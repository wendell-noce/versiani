<?php
/**
 * Nossos Servicos
 * 
 * Add the component description here...
 * 
 * @package vec
 */
?>

<div class="_nossos-servicos">
    <div class='container-fluid'>
        <div class='row justify-content-stretch'>
            <div class='col-12 col-lg-5 px-0'>
                <div class="list position-relative pt-lg-8 pt-4 pl-lg-10 pl-2 pr-6 pb-5">
                    <div class="sec-title mb-6">
                        <h2 class="text-white"> <hr class="barra">  <?= get_field('services_section_title'); ?> </h2>
                    </div>

                    <ul class="list-unstyled mb-0 servicos pl-6">
                        <?php 
                            $cont = 1;
                            if ( $query->have_posts() ) :
                                while ( $query->have_posts() ) : 
                                    $query->the_post(); 
                                    global $post;
                                    $post_slug = $post->post_name;
                                    ?>
                                    <li class="<?= ($cont < 2) ? "active" : ""; ?>"><a class="undecorated-link" href="#<?= $post_slug; ?>" data-service="<?= $post_slug; ?>"> <?= get_the_title(); ?> </a></li>
                                <?php
                                $cont++;	
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                    </ul>
                </div>
                <div class="desc py-4 px-4 px-xl-10 px-xl-10 ">
                    <?php 
                            $cont = 1;
                            if ( $query->have_posts() ) :
                                while ( $query->have_posts() ) : 
                                    $query->the_post(); 
                                    global $post;
                                    $post_slug = $post->post_name;
                                    ?>
                                    <div class="content <?= ($cont < 2) ? "active" : ""; ?> px-xl-6 py-10" id="<?= $post_slug; ?>">
                                        <h2 class="text-white h1"> <?= get_the_title(); ?> </h2>
                                        <p> <?= get_the_excerpt(); ?></p>
                                        <a href="<?= get_the_permalink(); ?>" class="btn btn-blue py-2 px-3 text-uppercase"> 
                                            <?php 
                                                Utils::get_template( 'components/text-traductions', array(
                                                    'en_text' => "Read more <i class='icon-right-arrow ml-2'></i>",
                                                    'fr_text' => "en savoir plus <i class='icon-right-arrow ml-2'></i>",
                                                    'pt_text' => "Saiba mais <i class='icon-right-arrow ml-2'></i>"
                                                )); 
                                            ?>
                                        </a>
                                    </div>
                                <?php
                                $cont++;	
                                endwhile;
                            endif;
                            wp_reset_postdata();
                        ?>
                </div>
            </div>

            <div class="col-12 col-lg-7 px-0">
                <div class="buttons pl-5 pl-md-10">
                        <a href="#" class="d-inline-block px-5 py-2 btn btn-primary prev text-white mr-3" data-prev="0"> <i class="icon-left"></i> </a>
                        <a href="#" class="d-inline-block px-5 py-2 btn bg-white next text-primary" data-next="1"> <i class="icon-right"></i> </a>
                </div>
                <div class="box-carousel position-relative d-block">
                    <?php 
                        $cont = 0;
                        if ( $query->have_posts() ) :
                            while ( $query->have_posts() ) :
                                $query->the_post(); 
                                global $post;
                                $post_slug = $post->post_name; ?>
                                
                                <div data-index="<?= $cont; ?>" data-service="<?= $post_slug; ?>" class="carousel h-100 pb-5 pr-0 <?= $post_slug; ?> <?= ($cont < 1) ? "active" : ""; ?>">
                                    <div class="d-flex h-100 px-5 pl-md-10 pt-10">
                                        <div class="mt-10">
                                            <?php the_post_thumbnail("full"); ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    $cont++;	
                            endwhile;
                        endif;
                        wp_reset_postdata();
                    ?>
                </div> 
            </div>
        </div>
    </div>
</div>