<?php 
	class Filter{
        private $args = array(); 
        private $response;

	 	public function __construct( ){
            
	 		if ( isset( $_POST['post_type'] ) ) {
                $this->args = [
                    'post_type' => $_POST['post_type'],
                    'posts_per_page' => 10,
                ];
            }

            if( isset($_POST['taxonomy']) && $_POST['taxonomy'] != "" ) {
                $this->args = [
                    'post_type' => $_POST['post_type'],
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => $_POST['taxonomy'],
                            'field'    => 'slug', 
                            'terms'    => $_POST['terms']
                        )
                    )
                ];  
            }

            if( $_POST['is_search'] != 'false' ) {
                $this->args = [
                    'post_type' => $_POST['post_type'],
                    'posts_per_page' => -1,
                    's' => $_POST['search']
                ];
            }
            
            if( isset($_POST['is_ajax']) && $_POST['is_ajax'] )
            $this->load_posts();			
     	}

		public function load_posts(){
            $query = new WP_Query( $this->args );
            if( $_POST['post_type'] == 'event' ){
                $response = Utils::get_template( 'components/events/ajax-card-event' , array( 'query' => $query) );
            }else {
                $response = Utils::get_template( 'components/ajax-card-publication' , array( 'query' => $query ) );
            }
			exit;
        }
    }
?>
