<?php
/**
 * Sidebar Home
 * 
 * Add the component description here...
 * 
 * @package tri
 */
?>

<div class="_sidebar-home">
    <div class="assine pt-5 px-4">
        <h2> GOSTOU DO NOSSO CONTEÚDO? </h2>
        <div class="image text-right">
            <a href="#">
                <img src="<?= Utils::get_image_asset( 'assine.svg' ); ?>" alt="Assine" width="154">
            </a>
        </div>
    </div>

    <div class="colunistas mt-7 pt-5 px-4">
        <h2 class="mb-5"> COLUNISTAS </h2>

        <ul class="list-unstyled mb-0">
            <?php foreach($users as $user): ?> 
                <?php 
                    $author_id    = $user['selecione_o_editor']->data->ID;
                    $author_image = get_field('foto', 'user_'. $author_id );
                    $userdata = get_user_meta( $author_id );
                ?>
                <li class="mb-5">
                    <div class="d-flex align-items-center">
                        <div class="image mr-3">
                            <img src="<?= $author_image['url']; ?>" alt="<?= $user['selecione_o_editor']->data->display_name; ?>" width="72">
                        </div>
                        <div class="content">
                            <h3> <?= $user['selecione_o_editor']->data->display_name; ?> </h3>
                            <p class="mb-0"> <?= $userdata['description'][0]; ?></p>
                        </div>
                    </div>
                </li>    
            <?php endforeach; ?>
        </ul>    
    </div>

    <div class="category-posts mt-7">
        <h2> <?= $cat->name; ?> </h2>

        <div class="post-lists mt-6">
            <?php 
                $args = array(
                    'post_type'   	 => array( 'post' ),
                    'post_status' 	 => array( 'publish' ),
                    'order'       	 => 'DESC',
                    'posts_per_page' => 5,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'type_post',
                            'field' => 'slug',
                            'terms' => $cat->slug
                        )
                    )
                );
                $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post(); ?>
                        <div class="_post">
                            <?php 
                                $image = get_post_thumbnail();
                                Utils::get_template( 'components/post-card', array( 
                                    'type'           => 'side-home',
                                    'category'       => get_category_name(),
                                    'category_color' => get_category_color(),
                                    'title'          => get_the_title(),
                                    'content'        => get_the_excerpt(),
                                    'url_post'       => get_the_permalink(),
                                    'image_src'      => $image['image_src'][0],
                                    'image_alt'      => $image['image_alt'],
                                    'image_width'    => $image['image_width'],
                                    'image_height'   => $image['image_height'],
                                    'link_label'     => "DESCOBRIR"
                                ));
                            ?>
                        </div>
                    <?php
                    endwhile;
                endif;

                function get_category_name(){
                    $category = get_the_category();
                    return $category[0]->name;
                }
            
                function get_category_color() {
                    $term = get_the_category();
                    //Utils::showme( $term );
                    return get_field('cor', $term[0]);
                }
            
                function get_post_thumbnail(){
                    $image = Utils::get_image_data(get_post_thumbnail_id(), 'SIZE_318_175');
                    return $image;
                }
            ?>
        </div>
    </div>
</div>