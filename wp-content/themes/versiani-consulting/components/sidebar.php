<?php
/**
 * Sidebar
 * 
 * Template for Sidebar
 * 
 * @package tri
 */
?>

<div class="_sidebar">
    <div class="categorias bg-primary py-8 px-7">
        <div class="list-markets">
            <?= do_shortcode("[wpml_language_selector_widget]"); ?> 
        </div>

        <h3 class="text-white text-uppercase">         
        <?php if(ICL_LANGUAGE_CODE == 'en'): ?>
            categories
        <?php elseif(ICL_LANGUAGE_CODE == 'fr'): ?>
            catégories
        <?php else: ?>
            CATEGORIAS
        <?php endif; ?>
        </h3>

        <ul class="list-unstyled list-categories">
            <?php 
                $categories = get_categories();
                foreach($categories as $category) : ?>
                    <li>
                        <a href="<?= get_category_link( $category->term_id ); ?>" class="text-uppercase text-white undecorated-link">
                            <hr class="barra ml-0 mb-2" data-style data-background-color="<?= get_field('category_color', 'category_'. $category->term_id); ?>">
                            <?= $category->name; ?>
                        </a>
                    </li>
                <?php 
                endforeach;
            ?>
        </ul>

        <h3 class="text-white mt-8">
            <?php if(ICL_LANGUAGE_CODE == 'en'): ?>
                MOST READ POSTS
            <?php elseif(ICL_LANGUAGE_CODE == 'fr'): ?>
                LES POSTES LES PLUS LUS
            <?php else: ?>
                POSTS MAIS LIDOS
            <?php endif; ?>
          </h3>
        
        <?php 
            $args = array(
                'post_type'   				=> array( 'post' ),
                'post_status' 				=> array( 'publish' ),
                'orderby'     				=> 'meta_value_num',
                'meta_key'    				=> 'post_views_count',
                'order'       	 			=> 'DESC',
                'ignore_sticky_posts'       => 1,
                'posts_per_page' 			=> 4,
            );

            // The Query
            $query = new WP_Query( $args ); ?>

        <ol class="mais-lidos pl-4 mt-6">
            <?php 
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post(); ?>
                        <li>
                            <a href="<?= get_the_permalink(); ?>" class="undecorated-link text-uppercase text-white">
                                <?= get_the_title(); ?>
                            </a>
                        </li>
                    <?php	
                    endwhile;
                endif;
            ?>            
        </ol>

        <div class="search mt-6 mb-4">
            <form class="search-form d-flex flex-wrap justify-content-around align-items-center" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="px-3 w-100" name="s" placeholder="Buscar" required>
                <button type="submit" class="btn-send px-3 transition mr-2"> <i class="icon-search"></i> </button>
            </form>
        </div>
    </div>

    <div class="consultor py-8 px-4 px-md-7 mt-6 mt-lg-10 mb-4">
        <h3> <?= get_field('sidebar_title', 'option'); ?> </h3>
        <p> <?= get_field('sidebar_description', 'option'); ?> </p>

        <p>
            <i class="icon-phone"></i> <?= get_field('options_phone', 'option'); ?> <br>
            <i class="icon-mail"></i> <?= get_field('contact_mail', 'option'); ?>
        </p>
    </div>
    
</div>