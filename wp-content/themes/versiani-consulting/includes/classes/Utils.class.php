<?php
/**
 * Utils class
 * 
 * Utility functions to be used in the theme files
 * 
 * @package tri
 */

	class Utils {

		/**
		 * Replace the pipe char by a <br> tag
		 * @param string $text Text with pipe "|" symbols to be replaced
		 */
		public static function add_break_rows( $text = '' ){
			return str_replace( '|', '<br>', $text );
		}

		/**
		 * Prints a script to log in the console via javascript
		 * @param string $message Text message to log in the console
		 * @param string $type The message type (log, warn or error)
		 */
		public static function console_log( $message, $type ) {
			echo "
			<script>console.{$type}('{$message}');</script>
			";
		}

		/**
		 * Prints the variable, object or array content with a <pre> tag and print_r() 
		 * @param any $to_print Variable with content to be printed
		 */
		public static function showme( $to_print ) {
			echo "<pre style='font-size: 12px'>" . print_r( $to_print, true ) . "</pre>";
		}

		/**
		 * Get template, include file
		 * @param string $file string file path
		 * @param array $args Extract array parse template as variables
		 */
		public static function get_template( $file, $args = array() ){

			if ( $args && is_array( $args ) ){
				extract( $args );
			}

			$filepath = get_template_directory() . '/' . $file . '.php';

			if ( !file_exists( $filepath ) ) {
				return;
			}
			include( $filepath );
		}

		/**
		 * Returns a string with the CSS file content
		 * @param string $file CSS file path (without extension)
		 * @return array $vars Optional array with variables to be replaced. i.e. array( "heading-color" => "red" )
		 */
		public static function get_style_file_content( $file, $vars = array() ){
			$file_path = get_template_directory() . "/" . $file . ".css";
			$file_content = file_get_contents( $file_path );
			foreach( $vars as $var => $value ) {
				$file_content = str_replace( ("--".$var), $value, $file_content );
			}
			return $file_content;
		}

		/**
		 * Gets the video URL from the assets folder
		 * @param $file_name Video file name with extension
		 */
		public static function get_video_asset( $file_name ){
			return get_template_directory_uri() . "/assets/video/{$file_name}";
		}

		/**
		 * Gets the image URL from the assets folder
		 * @param $file_name Image file name with extension
		 */
		public static function get_image_asset( $file_name ){
			return get_template_directory_uri() . "/assets/img/{$file_name}";
		}

		public static function get_image_data( $image_id, $size = null ){

            if( $image_id > 0 ) :
                // Get articles infos         
                $image_meta   = wp_get_attachment_metadata($image_id);
                $image_data   = get_post($image_id);

                if (  array_key_exists( $size, $image_meta['sizes'] ) ){
                    $image_src    = wp_get_attachment_image_src( $image_id, $size );
                    $image_width  = $image_meta['sizes'][ $size ]['width'];
                    $image_height = $image_meta['sizes'][ $size ]['height'];
                } else {
                    $image_src    = $image_data->guid;
                    $image_width  = $image_meta['width'];
                    $image_height = $image_meta['height'];
                }

                // Set array with thumb infos
                $image = array(
                    'image_src'     => $image_src,
                    'image_width'   => $image_width,
                    'image_height'  => $image_height,
                    'image_alt'     => get_post_meta( $image_id, '_wp_attachment_image_alt', true),
                    'image_caption' => $image_data->post_excerpt
                );
            else: 
                $image_src = array (Utils::get_image_asset('no-featured-image.jpg'));
                $image = array(
                    'image_src'     => $image_src,
                    'image_width'   => "100%",
                    'image_height'  => "100%",
                    'image_alt'     => "AliançaPrime",
                    'image_caption' => "AliançaPrime"
                );
            endif;
            
            return $image;
		}
		
		public static function hexToRgb($hex, $alpha = false) {
			$hex      = str_replace('#', '', $hex);
			$length   = strlen($hex);
			$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
			$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
			$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
			if ( $alpha ) {
			   $rgb['a'] = $alpha;
			}
			return $rgb;
		 }
	}
?>