<?php
/**
 * Enqueues
 * 
 * Enqueue scripts and styles
 * 
 * For more info: https://developer.wordpress.org/reference/functions/wp_enqueue_script/, https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * 
 * @package tri
 */

function tri_enqueues() {

	// Replace jQuery for a newer version
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/libs/jquery-3.5.1.min.js', array(), null, true);

	// Remove Gutemberg styles
	wp_dequeue_style( 'wp-block-library' );

	// Remove unnecessary scripts
	wp_deregister_script( 'wp-embed' );

	// Scripts and Styles
	// The file version is based on the its last modified time, making sure the browser get the new file only when it has changed
	// $template_name is defined at the template-manager.php file 
	global $template_name; 
	if ( isset( $template_name ) ) {
		// Theme scripts & styles
		$css_path = "/assets/css/dist/{$template_name}.dist.css";
		$js_path = "/assets/js/dist/{$template_name}.dist.js";
		wp_enqueue_style( 'tri-style', get_template_directory_uri() . $css_path, array(), filemtime( get_template_directory($css_path) ) );
		wp_enqueue_script( 'tri-scripts', get_template_directory_uri() . $js_path . "#defer", array('jquery'), filemtime( get_template_directory($js_path) ), true );
	} else {
		echo 'Template not set';
	}
}
add_action( 'wp_enqueue_scripts', 'tri_enqueues' );