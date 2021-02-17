<?php
/**
 * Contato Page Class
 * 
 * Class for handling the Contato page data
 * 
 * @package vec
 */

class ContatoPage {
	function get_page_header(){
		return $data = [
			'title' => get_field('contact_header_title'),
			'image' => get_field('contact_header_image'),
			'desc'  => get_field('contact_header_description')
		];
	}

	function get_form(){
		return $data = [
			'title'      => get_field('form_title'),
			'sec_desc'   => get_field('form_description'),
			'form_desc'  => get_field('form_box_description')
		];
	}

	function get_address(){
		return $data = [
			'title'     => get_field('address_title'),
			'link'      => get_field('google_maps_link'),
			'embed_map' => get_field('google_map')
		];
	}
}