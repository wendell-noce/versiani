<?php
/**
 * Search Page Class
 * 
 * Class for handling the Search page data
 * 
 * @package tri
 */

class SearchPage {
	private $searchValue;
	private $category;

	function __construct() {
		$this->searchValue = get_search_query();
	}

	function get_search_value(){
		return $this->searchValue;
	}

	function get_category_infos(){
		$this->category = get_the_category();
		$data = [
			"name"  => $this->category[0]->name,
			"color" => get_field('cor', 'category_' . $this->category[0]->term_id)
		];
		return $data;
	}

	function get_post_thumbnail(){
		$image = Utils::get_image_data(get_post_thumbnail_id(), 'SIZE_318_175');
		return $image;
	}

	function get_posts() {
		$args = array(
			'post_type'   	 => array( 'post' ),
			'post_status' 	 => array( 'publish' ),
			's'              => $this->searchValue,
			'order'       	 => 'DESC',
			'posts_per_page' => -1,
		);

		// The Query
		$query = new WP_Query( $args );
		return $query;
	}
}