<?php
/**
 * Category Page Class
 * 
 * Class for handling the Category page data
 * 
 * @package tri
 */

class CategoryPage {
	private $is_tax;
	private $category;
	private $id;
	private $name;

	function __construct() {
		
		$this->is_tax = get_query_var( 'taxonomy' ) != "" ? true : false;

		if( !$this->is_tax ) {
			$this->category = get_the_category(); 
			
			$this->id   = $this->category[0]->term_id;
			$this->name = $this->category[0]->name;
		} else {
			$this->category = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') ); 

			$this->id   = $this->category->id;
			$this->name = $this->category->name;
		}
	}

	function get_category_name(){
		return $this->name;
	}

	function get_category_color() {
		$term = get_queried_object();
		return get_field('cor', $term);
	}

	function get_post_thumbnail(){
		$image = Utils::get_image_data(get_post_thumbnail_id(), 'SIZE_318_175');
		return $image;
	}

	function get_posts() {
		# code...
		$args = array(
			'post_type'   	 => array( 'post' ),
			'post_status' 	 => array( 'publish' ),
			'cat'    	     => $this->id,
			'order'       	 => 'DESC',
			'posts_per_page' => -1,
		);

		// The Query
		$query = new WP_Query( $args );
		return $query;
	}
}