<?php
/**
 * Image Sizes (Thumbnails)
 * 
 * Enable support for Post Thumbnails and add custom sizes
 * 
 * For more info: https://developer.wordpress.org/reference/functions/add_image_size/
 * 
 * @package tri
 */

add_theme_support( 'post-thumbnails' );

// Post Thumbnails

// SQUARE
	add_image_size( 'SIZE_72_72', 72, 72, true );

// HORIZONTAL
	add_image_size( 'SIZE_318_175', 318, 175, true );
	add_image_size( 'SIZE_398_219', 398, 219, true );
	add_image_size( 'SIZE_695_465', 695, 465, true );
	add_image_size( 'SIZE_855_362', 855, 362, true );

// VERTICAL
