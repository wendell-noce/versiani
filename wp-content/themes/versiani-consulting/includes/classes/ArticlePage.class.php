<?php 
    class ArticlePage {
        private $article_header;
        private $querySidebar;
        
        function get_article_header(){  
            $categories = get_the_category();
            $color = get_field('cor', 'category_' . $categories[0]->term_id);
            
            $this->article_header = [
                'title'     => get_the_title(),
                'category'  => $categories[0]->name,
                'excerpt'   => get_the_excerpt(),
                'cat_color' => $color,
                'cat_url'   => get_category_link($categories[0]->term_id),
                'autor'     => get_the_author_meta( 'display_name' ),
                'date'      => get_the_date('j \d\e F \d\e Y à\s\ H:i')
            ];
            return $this->article_header;
        } 

        // Publications list
        function get_posts_views_count() {
            // WP_Query arguments
            $args = array(
                'post_type'   				=> array( 'post' ),
                'post_status' 				=> array( 'publish' ),
                'orderby'     				=> 'meta_value_num',
                'meta_key'    				=> 'post_views_count',
                'order'       	 			=> 'DESC',
                'ignore_sticky_posts'       => 1,
                'posts_per_page' 			=> '4',
            );

            // The Query
            $query_trending = new WP_Query( $args );
            $this->querySidebar = $query_trending;
        
            return $this->querySidebar;
        }
        
        function get_category_color() {
            $categories = get_the_category( get_the_ID() );
            return get_field('cor', 'category_'. $categories[0]->term_id);
        }
    }
?>