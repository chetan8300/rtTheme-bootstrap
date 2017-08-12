<?php


class WP_Widget_Stay_In_Touch extends WP_Widget {

	
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_stay_in_touch',
			'description' => __( 'Social Links' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'social-links', __( 'Social Links' ), $widget_ops );
		$this->alt_option_name = 'widget_stay_in_touch';
	}

        public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Social Links' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		?>

		<?php echo $args['before_widget']; ?>

		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
              
                echo '<div class="list-group">';
                    if(isset($instance['facebook'])) {
                        echo '<a target="_blank" href="https://www.facebook.com/'.$instance['facebook'].'" class="list-group-item"><i class="fa fa-facebook-official"></i> Facebook</a>';
                    }
                    if(isset($instance['instagram'])) {
                        echo '<a target="_blank" href="https://www.instagram.com/'.$instance['instagram'].'" class="list-group-item"><i class="fa fa-instagram"></i> Instagram</a>';
                    }
                    if(isset($instance['twitter'])) {
                        echo '<a target="_blank" href="https://www.twitter.com/'.$instance['twitter'].'" class="list-group-item"><i class="fa fa-twitter"></i> Twitter</a>';
                    }
                    if(isset($instance['google_plus'])) {
                        echo '<a target="_blank" href="https://plus.google.com/+'.$instance['google_plus'].'" class="list-group-item"><i class="fa fa-google-plus-official"></i> Google Plus</a>';
                    }
                echo '</div></div>';

                ?>
                
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

	}

        

	/**
	 * Handles updating the settings for the current Social Links widget instance.
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
                $instance['facebook'] = sanitize_text_field( $new_instance['facebook'] );
                $instance['twitter'] = sanitize_text_field( $new_instance['twitter'] );
                $instance['google_plus'] = sanitize_text_field( $new_instance['google_plus'] );
                $instance['instagram'] = sanitize_text_field( $new_instance['instagram'] );
		return $instance;
	}

	/**
	 * Outputs the settings form for the Social Links widget.
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $facebook = isset( $instance['fb_page_name'] ) ? esc_attr( $instance['facebook'] ) : '';
                $twitter = isset( $instance['fb_page_name'] ) ? esc_attr( $instance['twitter'] ) : '';
                $google_plus = isset( $instance['fb_page_name'] ) ? esc_attr( $instance['google_plus'] ) : '';
                $instagram = isset( $instance['fb_page_name'] ) ? esc_attr( $instance['instagram'] ) : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
                
                <p><label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Username:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo $facebook; ?>" placeholder="facebook username"/></p>
                
                <p><label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Username:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo $twitter; ?>" placeholder="twitter username"/></p>
                
                <p><label for="<?php echo $this->get_field_id( 'instagram' ); ?>"><?php _e( 'Instagram Username:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'instagram' ); ?>" name="<?php echo $this->get_field_name( 'instagram' ); ?>" type="text" value="<?php echo $instagram; ?>" placeholder="instagram username"/></p>
                
                <p><label for="<?php echo $this->get_field_id( 'google_plus' ); ?>"><?php _e( 'Google Plus Username:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'google_plus' ); ?>" name="<?php echo $this->get_field_name( 'google_plus' ); ?>" type="text" value="<?php echo $google_plus; ?>" placeholder="google plus username"/></p>

<?php
	}
}