<?php 
    /*
        *Create taxonomy for posts types
    */
    // function create_tax_type_post(){
    //     register_taxonomy(
    //         'type_post',
    //         'post',
    //         array(
    //             'label' => __('Tipo de artigo'),
    //             'rewrite' => array('slug' => 'categoria'),
    //             'hierarchical' => true
    //         )
    //     );
    // }
    // add_action('init', 'create_tax_type_post');

    function post_type_servicos() {

        $labels = array(
            'name'                  => _x( 'Services', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Service', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Services', 'text_domain' ),
            'name_admin_bar'        => __( 'Services', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'View All', 'text_domain' ),
            'add_new_item'          => __( 'Add novo Service', 'text_domain' ),
            'add_new'               => __( 'Add', 'text_domain' ),
            'new_item'              => __( 'Add', 'text_domain' ),
            'edit_item'             => __( 'Edit', 'text_domain' ),
            'update_item'           => __( 'Update', 'text_domain' ),
            'view_item'             => __( 'Ver', 'text_domain' ),
            'view_items'            => __( 'Ver', 'text_domain' ),
            'search_items'          => __( 'Find', 'text_domain' ),
            'not_found'             => __( 'Not Found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Draft', 'text_domain' ),
            'featured_image'        => __( 'Feature Image', 'text_domain' ),
            'set_featured_image'    => __( 'Insert the image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Services', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail', 'excerpt' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-hammer',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'servico', $args );
    
    }
    add_action( 'init', 'post_type_servicos', 0 );

    function post_type_clientes() {

        $labels = array(
            'name'                  => _x( 'Customers', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'Customer', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'Customers', 'text_domain' ),
            'name_admin_bar'        => __( 'Customers', 'text_domain' ),
            'archives'              => __( 'Item Archives', 'text_domain' ),
            'attributes'            => __( 'Item Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
            'all_items'             => __( 'Ver todos os Customers', 'text_domain' ),
            'add_new_item'          => __( 'Adicionar novo Customer', 'text_domain' ),
            'add_new'               => __( 'Adicionar', 'text_domain' ),
            'new_item'              => __( 'Adicionar', 'text_domain' ),
            'edit_item'             => __( 'Editar', 'text_domain' ),
            'update_item'           => __( 'Atualizar', 'text_domain' ),
            'view_item'             => __( 'Ver', 'text_domain' ),
            'view_items'            => __( 'Ver', 'text_domain' ),
            'search_items'          => __( 'Procurar', 'text_domain' ),
            'not_found'             => __( 'Não existe', 'text_domain' ),
            'not_found_in_trash'    => __( 'Lixeira vazia', 'text_domain' ),
            'featured_image'        => __( 'Imagem destacada', 'text_domain' ),
            'set_featured_image'    => __( 'Insira a imagem destacada', 'text_domain' ),
            'remove_featured_image' => __( 'Remover imagem', 'text_domain' ),
            'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
            'items_list'            => __( 'Items list', 'text_domain' ),
            'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Customers', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title' ),
            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-businessman',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'customer', $args );
    
    }
    add_action( 'init', 'post_type_clientes', 0 );
?>