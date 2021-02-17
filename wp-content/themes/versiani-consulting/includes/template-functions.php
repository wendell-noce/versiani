<?php
/**
 * Template functions
 * 
 * Functions which enhance the theme by hooking into WordPress
 * 
 * @package tri
 */

/**
 * Adds custom classes to the array of body classes.
 * @param array $classes Classes for the body element.
 */
function add_classes_to_body( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( !is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'add_classes_to_body' );

// Add a pingback url auto-discovery header for single posts, pages, or attachments.
function add_pingback_url_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'add_pingback_url_header' );

/**
 * Extend WordPress search to include custom fields
 *
 * https://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {    
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() ) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="px-lg-8 px-4 py-4">
            <div class="author vcard">
                <p> <?= get_comment_author(); ?> </p>
            </div>
       
            <?php comment_text(); ?>

            <div class="comment-meta commentmetadata">
                <p>
                    <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()); ?>
                    <?php edit_comment_link("<small> Editar </small>",'  ',''); ?> </small>
                </p>
            </div>
        </div>
    </li>
 <?php } 
 
    /*
    * Set post views count using post meta
    */

    function chr_setPostViews($postID) {
        $countKey = 'post_views_count';
        $count = get_post_meta($postID, $countKey, true);
        
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $countKey);
        add_post_meta($postID, $countKey, '0');
        return 'Nenhuma Visualização';
        }elseif( is_single($postID) ){
        $count++;
            update_post_meta($postID, $countKey, $count);
        }

        return $count . ' Visualização(ões)';
    }

    /**
     * Add a new column in the wp-admin posts list
     */
    function chr_posts_column_views( $defaults ) {
        $defaults['post_views'] = __( 'Visualização(ões)' );
        return $defaults;
    }

    /**
     * Display the number of views for each posts
     */
    function chr_posts_custom_column_views( $column_name, $id ) {
        if ( $column_name === 'post_views' ) {
            echo chr_setPostViews( get_the_ID() );
        }
    }

    add_filter( 'manage_posts_columns', 'chr_posts_column_views' );
    add_action( 'manage_posts_custom_column', 'chr_posts_custom_column_views', 5, 2 );

    add_action('admin_head','fc_remove_profile_image');
    function fc_remove_profile_image(){
    echo '<script>
            jQuery(document).ready(function(){

                jQuery("tr.user-profile-picture").remove();

            });
        </script>';
    }

    /**
 * Use radio inputs instead of checkboxes for term checklists in specified taxonomies.
 *
 * @param   array   $args
 * @return  array
 */
function wpse_139269_term_radio_checklist( $args ) {
    if ( ! empty( $args['taxonomy'] ) && $args['taxonomy'] === 'type_post' /* <== Change to your required taxonomy */ ) {
        if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) { // Don't override 3rd party walkers.
            if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
                /**
                 * Custom walker for switching checkbox inputs to radio.
                 *
                 * @see Walker_Category_Checklist
                 */
                class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
                    function walk( $elements, $max_depth, ...$args ) {
                        $output = parent::walk( $elements, $max_depth, ...$args );
                        $output = str_replace(
                            array( 'type="checkbox"', "type='checkbox'" ),
                            array( 'type="radio"', "type='radio'" ),
                            $output
                        );

                        return $output;
                    }
                }
            }

            $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
        }
    }

    return $args;
}

add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );

function prefix_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<p class="menu-item-description">' . $item->description . '</p>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'prefix_nav_description', 10, 4 );
function replace_nl_placeholder_nav_menu_description( $description ) {
    return str_replace('%NL% ', "\n", $description);
}
add_filter('nav_menu_description', 'replace_nl_placeholder_nav_menu_description');

function replace_nl_with_placeholder_nav_menu_description( $post_id ) {
    if ( 'nav_menu_item' !== get_post_type($post_id) ) return;

    remove_action( 'save_post', 'replace_nl_with_placeholder_nav_menu_description' );

    wp_update_post( array(
        'ID' => $post_id,
        'post_content' => str_replace("\n", '%NL% ', get_post_field('post_content', $post_id, 'raw'))
    ) );

    add_action( 'save_post', 'replace_nl_with_placeholder_nav_menu_description' );
}
add_action( 'save_post', 'replace_nl_with_placeholder_nav_menu_description' );
 ?>