<?php

class WP_Widget_Facebook_Like_Box extends WP_Widget {

	/**
	 * Sets up a new Facebook Like Box widget instance.
	 *
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_facebook_like_box',
			'description' => __( 'Facebook Like Box For Page.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'facebook-like-box', __( 'Facebook Like Box' ), $widget_ops );
		$this->alt_option_name = 'widget_facebook_like_box';
	}

        public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Follow us on FB' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		?>

		<?php echo $args['before_widget']; ?>

		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
                
                if(isset($instance['fb_page_name'])==false) {
                    $instance['fb_page_name'] = 'facebook';
                }
				
				//Enter your facebook app id on line 48
                echo "<div class='fb-page' data-href='https://www.facebook.com/".$instance['fb_page_name']."' data-small-header='false' data-adapt-container-width='true' data-hide-cover='false' data-show-facepile='true'><blockquote cite='https://www.facebook.com/".$instance['fb_page_name']."' class='fb-xfbml-parse-ignore'><a href='https://www.facebook.com/".$instance['fb_page_name']."' >".$instance['fb_page_name']."</a></blockquote></div>
                        <div id='fb-root'></div>
                        <script>(function(d, s, id) {
                          var js, fjs = d.getElementsByTagName(s)[0];
                          if (d.getElementById(id)) return;
                          js = d.createElement(s); js.id = id;
                          js.src = '//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=your-app-id-here-without-quotes';
                          fjs.parentNode.insertBefore(js, fjs);
                        }(document, 'script', 'facebook-jssdk'));</script>";

                echo $args['after_widget']; 
                
                ?>
                
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

	}

        

	/**
	 * Handles updating the settings for the current Facebook Like Box widget instance.
	 *
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
                $instance['fb_page_name'] = sanitize_text_field( $new_instance['fb_page_name'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Facebook Like Box widget.
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $fb_page_username = isset( $instance['fb_page_name'] ) ? esc_attr( $instance['fb_page_name'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
                
                <p><label for="<?php echo $this->get_field_id( 'fb_page_name' ); ?>"><?php _e( 'Facebook Page Name:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'fb_page_name' ); ?>" name="<?php echo $this->get_field_name( 'fb_page_name' ); ?>" type="text" value="<?php echo $fb_page_username; ?>" placeholder="facebook"/></p>

<?php
	}
}