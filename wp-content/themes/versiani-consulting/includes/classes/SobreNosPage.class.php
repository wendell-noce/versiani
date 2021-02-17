<?php
/**
 * Sobre Nos Page Class
 * 
 * Class for handling the Sobre Nos page data
 * 
 * @package tri
 */

class SobreNosPage {
	function __construct() {

	}

	function get_title(){
		return get_the_title();
	}

	function get_content(){
		return the_content();
	}

	function get_page_header(){
		return $data = [
			'title' => get_field('page_header_title'),
			'image' => get_field('page_header_image'),
			'desc'  => get_field('page_header_description')
		];
	}

	function get_about(){
		return $data = [
			'title' => get_field('section_title'),
			'image' => get_field('section_image'),
			'desc'  => get_field('section_description')
		];
	}

	function get_ceo(){
		return $data = [
			'image' => get_field('curriculum_image'),
			'name'  => get_field('curriculum_name'),
			'cargo' => get_field('curriculum_cargo'),
			'desc'  => get_field('curriculum_description')
		];
	}

	function get_customers(){
		return $data = [
			'desc' => get_field('customers_description'),
			'ids'  => get_field('select_customers')
		];
	}

	function get_contact(){
		return $data = [
			'image' => get_field('contact_background_image'),
			'title' => get_field('contact_title'),
			'link'  => get_field('contact_link'),
			'desc'  => get_field('contact_description')
		];
	}
}