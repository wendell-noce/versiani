<?php
/**
 * Faq Page Class
 * 
 * Class for handling the Faq page data
 * 
 * @package tri
 */

class FaqPage {
	private $questions;

	function get_title(){
		return get_the_title();
	}

	function get_questions(){
		$this->questions = get_field('perguntas' , get_the_ID());
		return $this->questions;
	}
}