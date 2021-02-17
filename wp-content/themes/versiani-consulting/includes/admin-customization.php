<?php
/**
 * Admin customizations
 * 
 * Add customizations to the admin panel, like styles and links
 * 
 * @package tri
 */

// Custom styles for the WordPress login screen
function admin_login_styles() {
    $login_vars = array(
        'logo-img'          => Utils::get_image_asset( 'logo.png' ),
        'logo-width'        => '94px',
        'logo-height'       => '97px',
        'padding-bottom'    => '0',
        'bg-color'          => '#EFEFEF',
		'btn-color'			=> '#263549',
		'input-radius'		=> '5px',
		'btn-radius'		=> '5px',
    );
    echo "<style type=\"text/css\">\n";
    echo Utils::get_style_file_content( "assets/css/admin/login", $login_vars );
    echo "\n</style>";
}
add_action( 'login_enqueue_scripts', 'admin_login_styles' );


// Change the Login Logo URL
function login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'login_logo_url' );


// Change the Login Logo Title
function login_logo_url_title() {
    return get_bloginfo('name');
}
add_filter( 'login_headertext', 'login_logo_url_title' );


// Add some styles to the WP admin pages
function admin_editor_styles() {
    $style_vars = array(
        'bg-color' => '#000'
    );
    echo "<style type=\"text/css\">\n";
    echo Utils::get_style_file_content( "assets/css/admin/global", $style_vars );
    echo Utils::get_style_file_content( "assets/css/admin/acf-post-fields", array() );
    echo "\n</style>";
}
add_action('admin_head', 'admin_editor_styles');


// Add a custom favicon to admin
function add_custom_favicon() {
    $favicon_url = get_stylesheet_directory_uri() . '/assets/img/admin-favicon.png';
    echo '<link rel="shortcut icon" type="image/png" href="' . $favicon_url . '" />';
}
add_action('login_head', 'add_custom_favicon');
add_action('admin_head', 'add_custom_favicon');


// Disallow .PNG upload for not Admin users
function disallow_png_upload($mime_types){
    unset($mime_types['png']); //Removing the png extension
    return $mime_types;
}
if( !current_user_can( 'administrator' ) ) {
	add_filter( 'upload_mimes', 'disallow_png_upload', 1, 1 );
}

// Remove the autocomplete from the WP login for security reasons
function remove_login_autocomplete() {
	echo '
	<script>
		document.getElementById( "user_pass" ).autocomplete = "off";
	</script>
	';
}
add_action( 'login_form', 'remove_login_autocomplete' );


// Add recommended size to the Featured Image description
function add_recommended_size_label_for_featured_image( $content, $post_id ) {
	$recommendation = '';
	switch( get_post_type( $post_id ) ) {
		case 'work':
		case 'post':
			$recommendation = '<p class="howto">'. __( 'Recommended size: <b>1506x722px</b> (.jpg)', 'admin' ) .'</p>';
			break;
		case 'resource':
			$recommendation = '<p class="howto">'. __( 'Recommended size: <b>720x960px</b> (.jpg)', 'admin' ) .'</p>';
			break;
		default:
			break;
	}
	return $recommendation . $content;
}
//add_filter( 'admin_post_thumbnail_html', 'add_recommended_size_label_for_featured_image', 10, 2 );

// Add thumbnails to the posts listing
// Add the column
function add_post_admin_thumbnail_column($columns){
    $columns['thumbnail'] = __( 'Featured Image', 'admin' );
	return $columns;
}
add_filter('manage_posts_columns', 'add_post_admin_thumbnail_column', 2);
// Grabbing post thumbnail and displaying it in the column
function add_post_thumbnail_column($columns, $id){
	switch($columns){
        case 'thumbnail':
			echo '<a href="'.get_post_permalink($id).'" class="img-wrapper">';
			echo the_post_thumbnail( 'thumbnail' );
			echo '</a>';
            break;
        default:
            break;
	}
}
add_action('manage_posts_custom_column', 'add_post_thumbnail_column', 5, 2);