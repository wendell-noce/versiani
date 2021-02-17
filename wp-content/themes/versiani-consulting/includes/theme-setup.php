<?php
/**
 * Theme setup
 * 
 * Main configurations for the theme
 * 
 * For more info: https://developer.wordpress.org/themes/basics/theme-functions/
 * 
 * @package tri
 */

if ( !function_exists( 'pln_setup' ) ) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ete_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		// By adding theme support, we declare that this theme does not use a hard-coded <title> tag, and expect WordPress to provide it for us.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails and add custom sizes
		require get_template_directory() . '/includes/image-sizes.php';

		// This theme uses wp_nav_menu() in the Header and Footer.
		register_nav_menus( array(
			'main-menu'   => esc_html__( 'Main Menu', 'admin' ),
			'mobile-menu' => esc_html__( 'Mobile Menu', 'admin' ),
			'social-menu' => esc_html__( 'Social Menu', 'admin' ),
			'footer-menu' => esc_html__( 'Footer Menu', 'admin' )
		) );

		// Switch default core markup for search form, gallery and image captions to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'gallery',
			'caption',
		) );
	}
	add_action( 'after_setup_theme', 'ete_setup' );
	
	// Remove the Comments option from the WP menu
	function remove_comments_from_menu() {
		remove_menu_page( 'edit-comments.php' );
	}
	add_action( 'admin_menu', 'remove_comments_from_menu' );
}

// Remove pages from the search
function exclude_pages_from_search() {
	global $wp_post_types;
	$wp_post_types['page']->exclude_from_search = true;
}
add_action( 'init', 'exclude_pages_from_search', 99 );

//Functions ACF Options Page
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> __( 'General Settings' ),
		'menu_title'	=> __( 'Theme Options' ),
		'menu_slug' 	=> __( 'theme-options' ),
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

if ( ! function_exists( 'post_pagination' ) ) :
function post_pagination( $max_pages = 0 ) {
	global $wp_query;
	$pager = 999999999; // need an unlikely integer
		
		echo paginate_links( array(
			'base' => str_replace( $pager, '%#%', esc_url( get_pagenum_link( $pager ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => ($wp_query->max_num_pages <= 0) ? $max_pages : $wp_query->max_num_pages
		) );
}
endif;

// Displaying Excerpts for Pages
add_post_type_support( 'page', 'excerpt' );


class Custom_Navigation extends Walker_Nav_Menu
	{
		public function start_el( &$output, $item, $depth = 0, $args = NULL, $id = 0 )
		{
			$output     .= '<li>';
	
			$attributes  = '';
			if ( ! empty ( $item->url ) )
				$attributes .= ' href="' . esc_url( $item->url ) .'"';
	
			$description = empty ( $item->description )
				? '<p>Please add a description!</p>'
				: wpautop( $item->description );
	
			$title       = apply_filters( 'the_title', $item->title, $item->ID );
			// $item_output = "<a $attributes> $title </a> <div class='submenu-box'><div class='box-icon'> <i class='". $item->classes[0]."'></i> </div> <div class='box-description'> $description </div> </div>";
			$item_output =  "<a class='submenu-link' $attributes> $title </a>";  
			$item_output .= "<div class='submenu-box'> <a $attributes class='link-box'> ";
			$item_output .=	"<div class='box-icon'><i class=". $item->classes[0] ."></i></div>";
			$item_output .=	"<div class='box-description'>$description </div>";								 
			$item_output .=	"</a> </div>";
	
			// Since $output is called by reference we don't need to return anything.
			$output .= apply_filters(
				'walker_nav_menu_start_el'
				,   $item_output
				,   $item
				,   $depth
				,   $args
			);
		}
	}
?>