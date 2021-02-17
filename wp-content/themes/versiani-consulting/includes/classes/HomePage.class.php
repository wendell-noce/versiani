<?php 
    class HomePage {
        
        function get_about_us(){
            return $about = [
                'title' => get_field('about_sec_title'),
                'subtitle' => get_field('about_section_subtitle'),
                'description' => get_field('about_section_description'),
                'image' => get_field('about_image'),
                'cta' => get_field('about_cta')
            ];
        }

        function get_services(){
            $args = array(
                'post_type'   				=> array( 'servico' ),
                'post_status' 				=> array( 'publish' ),
                'order'       	 			=> 'ASC',
                'orderby'                   => 'menu_order',
            );
            
            // The Query
            $query = new WP_Query( $args );
            return $query;
        }

        function get_posts(){
            $args = array(
                'post_type'   				=> array( 'post' ),
                'post_status' 				=> array( 'publish' ),
                'order'       	 			=> 'DESC',
                'posts_per_page'            => 4
            );
            
            // The Query
            $query = new WP_Query( $args );
            return $query;
        }

        function get_contatc_data(){
            return $data = [
                'image'     => get_field('contact_background_image'),
                'title'     => get_field('contact_title'),
                'desc'      => get_field('contact_description'),
                'link'      => get_field('contact_cta'),
                'cli_title' => get_field('customers_title'),
                'clientes'  => get_field('contact_ustomers')
            ];
        }
    }
?>