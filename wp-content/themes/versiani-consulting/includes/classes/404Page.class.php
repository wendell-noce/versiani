<?php
/**
 * 404 Page Class
 * 
 * Class for handling the 404 page data
 * 
 * @package tri
 */

class NotFoundPage {
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
}