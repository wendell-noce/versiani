<?php

function set_template_name() {
	global $template_name;

	if( is_front_page() || is_home() ) { // Home
		$template_name = 'home';
	}
	
	elseif( is_singular('post') ) { // Article
		$template_name = 'article';
	}

	elseif( is_singular('servico') ) { // Article
		$template_name = 'servico';
	}

	elseif( is_category() ) { // Category
		$template_name = 'category';
	}
	
	elseif( is_tax('tag') ) { // Tags
		$template_name = 'tag';
	}

	elseif ( is_tax() ) {
		$template_name = 'category';
	}
	
	elseif( is_page() ) {
		$page_template_slug = get_page_template_slug();
		
		switch ($page_template_slug){
			case 'template-contato.php':
				$template_name = 'contato';
			break;
			case 'template-blog.php':
				$template_name = 'blog';
			break;
			case 'template-faq.php':
				$template_name = 'faq';
			break;
			case 'template-sobre-nos.php':
				$template_name = 'sobre-nos';
			break;
			case 'template-template-padro.php':
				$template_name = 'template-padro';
			break;
			default:
				$template_name = 'page';
			break;
		}
	}
	
	elseif( is_search() ) { // Search
		$template_name = 'search';
	}
	
	elseif( is_404() ) { // 404
		$template_name = '404';
	}
}
add_action( 'wp_enqueue_scripts', 'set_template_name' );

function hide_page_editor() {
    if ( is_admin() ) {
        $post_id = 0;
        if(isset($_GET['post'])) $post_id = $_GET['post'];
        $template_file = get_post_meta($post_id, '_wp_page_template', TRUE);
        if ($template_file == 'front-page.php' || $template_file == 'template-faq.php' || $template_file == 'template-contact.php' || $template_file == 'template-conteudos.php' || $template_file == 'template-about-us.php') {
            remove_post_type_support('page', 'editor');
        }
    }
}
add_action( 'admin_init', 'hide_page_editor' );

?>