<?php

require_once get_template_directory().'/lib/twitteroauth/twitteroauth.php';

class WP_Widget_Fetch_Twitter_Tweets extends WP_Widget {

	/**
	 * Sets up a new Twitter Tweets widget instance.
	 *
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => 'widget_latest_tweets',
			'description' => __( 'Latest Tweets from Twitter.' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'latest-tweets', __( 'Latest Tweets' ), $widget_ops );
		$this->alt_option_name = 'widget_latest_tweets';
	}

        public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Tweets' );

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		?>

		<?php echo $args['before_widget']; ?>

		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} 
                
                if(isset($instance['username'])==false) {
                    $instance['username'] = 'rtcamp';
                }
                
                $twitter_customer_key           = 'add you twitter customer key'; //add you twitter customer key
                $twitter_customer_secret        = 'add you twitter customer secret key'; //add you twitter customer secret key
                $twitter_access_token           = 'add twitter access token'; //add twitter access token
                $twitter_access_token_secret    = 'add twitter access token secret'; //add twitter access token secret

                $connection = new TwitterOAuth($twitter_customer_key, $twitter_customer_secret, $twitter_access_token, $twitter_access_token_secret);
                $x=0;
                $my_tweets = $connection->get('statuses/user_timeline', array('screen_name' => $instance["username"], 'count' => 25));

                    for($p=0;$p<25;$p++){
                        //function 9preg_replace) to convert text url into links.
                        $string= preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<br><a target="blank" rel="nofollow" href="$1" target="_blank">$1</a>', $my_tweets[$p]->text);
                        if(!preg_match("/@(\w+)/", $string)){
                            $tweets[$x]=$string;
                            $x++;
                        }
                    }

                if(isset($my_tweets->errors))
                {           
                    echo 'Error :'. $my_tweets->errors[0]->code. ' - '. $my_tweets->errors[0]->message;
                }else{
                    echo '<ul class="list-group">';
                    for($u=0,$x=0;$u<$instance['number'];$u++,$x++){    
                        echo '<li class="list-group-item text-style-tweets list-unstyled">'.$tweets[$x].'</li>';
                    }
                   echo '</ul>';
                }

                echo $args['after_widget']; 
                
                ?>
                
		<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

	}

        

	/**
	 * Handles updating the settings for the current Twitter Tweets widget instance.
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
                $instance['username'] = sanitize_text_field( $new_instance['username'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Outputs the settings form for the Twitter Tweets widget.
	 *
	 * @access public
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
                $username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : 'rtcamp';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
                
                <p><label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Twitter Username:' ); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" placeholder="rtcamp"/></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of Tweets to show:' ); ?></label>
		<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

<?php
	}
}