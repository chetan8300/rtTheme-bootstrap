<?php

function rttheme_get_default_options() {
    $options = array(
        'rttheme_logo' => '',
        'facebook_username' => '',
        'twitter_username' => '',
    );
    return $options;
}


function rttheme_options_init() {
    $rttheme_options = get_option( 'theme_rttheme_options' );
 
    // Are our options saved in the DB?
    if ( false === $rttheme_options ) {
        // If not, we'll save our default options
        $rttheme_options = rttheme_get_default_options();
        add_option( 'theme_rttheme_options', $rttheme_options );
    }
 
    // In other case we don't need to update the DB
}
 
// Initialize Theme options
add_action( 'after_setup_theme', 'rttheme_options_init' );


// Add "rtTheme Options" link to the "Appearance" menu
function rttheme_menu_options() {
    // add_theme_page( $page_title, $menu_title, $capability, $menu_slug, $function);
    add_theme_page('rtTheme Options', 'rtTheme Options', 'edit_theme_options', 'rttheme-settings', 'rttheme_admin_options_page');
}
// Load the Admin Options page
add_action('admin_menu', 'rttheme_menu_options');
 
function rttheme_admin_options_page() {
    ?>
        <!-- 'wrap','submit','icon32','button-primary' and 'button-secondary' are classes
        for a good WP Admin Panel viewing and are predefined by WP CSS -->
 
        <div class="wrap">
  
            <h2><?php _e( 'rtTheme Options', 'rttheme' ); ?></h2>
 
            <!-- If we have any error by submiting the form, they will appear here -->
            <?php settings_errors( 'rttheme-settings-errors' ); ?>
            
            <?php
            
                if(isset($_POST['save_yes'])){
                    update_option('rttheme_logo', esc_attr($_POST['rttheme_logo']));
                    update_option('facebook_username', esc_attr($_POST['facebook_username']));
                    update_option('twitter_customer_key', esc_attr($_POST['twitter_customer_key']));
                    update_option('twitter_customer_secret', esc_attr($_POST['twitter_customer_secret']));
                    update_option('twitter_access_token', esc_attr($_POST['twitter_access_token']));
                    update_option('twitter_access_token_secret', esc_attr($_POST['twitter_access_token_secret']));
                    update_option('twitter_username', esc_attr($_POST['twitter_username']));
                    update_option('page_id_show', esc_attr($_POST['page-dropdown']));
                }
                
            ?>            
            
            <form id="form-rttheme-options" method="post" enctype="multipart/form-data">
                <input type="hidden" name='save_yes' value="yes" />
                <?php
                    settings_fields('theme_rttheme_options');
                    do_settings_sections('rttheme');
                ?>
 
                <p class="submit">
                    <input name="submit" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'rttheme'); ?>" />
                    <input name="reset" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'rttheme'); ?>" />
                </p>
 
            </form>
 
        </div>
    <?php
}


function rttheme_options_settings_init() {
    
    // Add a form section for the Logo
    add_settings_section('rttheme_settings_header', __( 'Theme Panel', 'rttheme' ), 'rttheme_settings_header_text', 'rttheme');
 
    // Add Logo uploader
    add_settings_field('rttheme_setting_logo',  __( 'Logo', 'rttheme' ), 'rttheme_setting_logo', 'rttheme', 'rttheme_settings_header');
    
    // Add Current Image Preview
    add_settings_field('rttheme_setting_logo_preview',  __( 'Logo Preview', 'rttheme' ), 'rttheme_setting_logo_preview', 'rttheme', 'rttheme_settings_header');
    
    // Add Images in Main Slider
    add_settings_field("rttheme_main_slider", __( 'Main Slider Settings', 'rttheme' ), "rttheme_main_slider", "rttheme", "rttheme_settings_header");
    
    // Option to show Page's Content On the right side of Slider - This will show dropdown list of page
    add_settings_field("rttheme_page_dropdown", __( 'Select Any Page', 'rttheme' ), "rttheme_page_dropdown", "rttheme", "rttheme_settings_header");
    
    // Add Images in YouTube Slider
    add_settings_field("rttheme_youtube_slider", __( 'YouTube Slider Settings', 'rttheme' ), "rttheme_youtube_slider", "rttheme", "rttheme_settings_header");
    
    // Username Settings for Facebook
    add_settings_field("facebook_username", __( 'Facebook Username: ', 'rttheme' ), "rttheme_facebook_username", "rttheme", "rttheme_settings_header");
    
    // Username Settings for Twitter
    add_settings_field("twitter_username", __( 'Twitter: ', 'rttheme' ), "rttheme_twitter_username", "rttheme", "rttheme_settings_header");
    
}
add_action( 'admin_init', 'rttheme_options_settings_init' );
 
function rttheme_settings_header_text() {
    ?>
        <p><?php _e( 'Manage Options for rtTheme.', 'rttheme' ); ?></p>
    <?php
}

function rttheme_setting_logo() {
    
    ?>
        <input type="text" id="logo_url" name="rttheme_logo" value="<?php echo esc_url( get_option('rttheme_logo') ); ?>"  placeholder="Choose Logo" size=40 />
        <input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'rttheme' ); ?>"/>
        <span class="description"><?php _e('Upload an image for the banner.', 'rttheme' ); ?></span>
    <?php
}


function rttheme_setting_logo_preview() {
    ?>
    <div id="upload_logo_preview" style="min-height: 100px;">
        <img style="max-width :100%;" src="<?php echo esc_url( get_option('rttheme_logo') ); ?>" />
    </div>
    <?php
}

function rttheme_options_validate( $input ) {
    $default_options = rttheme_get_default_options();
    $valid_input = $default_options;

    $submit = ! empty($input['submit']) ? true : false;
    $reset = ! empty($input['reset']) ? true : false;

    if ( $submit ) {
        if ( get_option('rttheme_logo') != $input['rttheme_logo'] && get_option('rttheme_logo') != '' ) {
            delete_image( get_option('rttheme_logo') );
        }

        $valid_input['rttheme_logo'] = $input['rttheme_logo'];
    }
    elseif ( $reset ) {
        delete_image( get_options['rttheme_logo'] );
        $valid_input['rttheme_logo'] = $default_options['rttheme_logo'];
    }
    return $valid_input;
}


function rttheme_main_slider() {
    echo '<input id="add" type="button" class="button" name="add" value="Add"/>';
}

function rttheme_page_dropdown() {
    $pages = wp_list_pluck( get_pages(), 'post_title', 'ID' );
    
    ?>
        <select name="page-dropdown">
            <option value="<?php get_option('page_id_show');?>" selected disabled="disabled"><?php echo esc_attr(__('Select page')); ?></option> 
                <?php
                $pages = get_pages();
                    foreach ($pages as $page) {
                        $option = '<option value="' . $page->ID . '">';
                        $option .= $page->post_title;
                        $option .= '</option>';
                        echo $option;
                    }
                ?>
            </select>
    <?php
}

function rttheme_youtube_slider() {
    ?>
        
        <label for="yts1">1.</label>
        <input type="text" name="yts1" id="yts1" size=40 placeholder="YouTube Slider Image 1">
        <br>
        <label for="yts2">2.</label>
        <input type="text" name="yts2" id="yts2" size=40 placeholder="YouTube Slider Image 2">
        <br>
        <label for="yts3">3.</label>
        <input type="text" name="yts3" id="yts3" size=40 placeholder="YouTube Slider Image 3">
        <br>
        <label for="yts4">4.</label>
        <input type="text" name="yts4" id="yts4" size=40 placeholder="YouTube Slider Image 4">
        <br>
        <label for="yts5">5.</label>
        <input type="text" name="yts5" id="yts5" size=40 placeholder="YouTube Slider Image 5">
        <br>
        <label for="yts6">6.</label>
        <input type="text" name="yts6" id="yts6" size=40 placeholder="YouTube Slider Image 6">
        <br>
        <label for="yts7">7.</label>
        <input type="text" name="yts7" id="yts7" size=40 placeholder="YouTube Slider Image 7">
        <br>
        <label for="yts8">8.</label>
        <input type="text" name="yts8" id="yts8" size=40 placeholder="YouTube Slider Image 8">
        
    <?php
}

function rttheme_facebook_username() {
    echo "<input type='text' name='facebook_username' id='facebook_username' value='".get_option('facebook_username')."' placeholder='Enter Facebook Page Username to show FB Like Box' size=50>";
}

function rttheme_twitter_username() {
    echo "<label>Twitter Customer Key: &nbsp;</label>";
    echo "<input type='text' name='twitter_customer_key' id='twitter_customer_key' value='".get_option('twitter_customer_key')."' placeholder='Enter Twitter App Customer Key' size=50><br>";
    echo "<label>Twitter Customer Secret: &nbsp;</label>";
    echo "<input type='text' name='twitter_customer_secret' id='twitter_customer_secret' value='".get_option('twitter_customer_secret')."' placeholder='Enter Twitter Customer Secret' size=50><br>";
    echo "<label>Twitter Access Token: &nbsp;<label>";
    echo "<input type='text' name='twitter_access_token' id='twitter_access_token' value='".get_option('twitter_access_token')."' placeholder='Enter Twitter Access Token' size=50><br>";
    echo "<label>Twitter Access Token Secret: &nbsp;</label>";
    echo "<input type='text' name='twitter_access_token_secret' id='twitter_access_token_secret' value='".get_option('twitter_access_token_secret')."' placeholder='Enter Twitter Access Token Secret' size=50><br>";
    echo "<label>Twitter Username: &nbsp;</label>";
    echo "<input type='text' name='twitter_username' id='twitter_username' value='".get_option('twitter_username')."' placeholder='Enter Twitter Username to show Tweets' size=50>";
}


function rttheme_options_enqueue_scripts() {
    wp_register_script( 'rttheme-media-upload', get_template_directory_uri() .'/theme-options/js/rttheme-media-upload.js', array('jquery','media-upload','thickbox') );
 
    if ( 'appearance_page_rttheme-settings' == get_current_screen() -> id ) {
        wp_enqueue_script('jquery');
 
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
 
        wp_enqueue_script('media-upload');
        wp_enqueue_script('rttheme-media-upload');
 
    }
 
}
add_action('admin_enqueue_scripts', 'rttheme_options_enqueue_scripts');



function rttheme_options_setup() {
    global $pagenow;
 
    if ( 'media-upload.php' == $pagenow || 'async-upload.php' == $pagenow ) {
        // Now we'll replace the 'Insert into Post Button' inside Thickbox
        add_filter( 'gettext', 'replace_thickbox_text'  , 1, 3 );
    }
}
add_action( 'admin_init', 'rttheme_options_setup' );
 
function replace_thickbox_text($translated_text, $text, $domain) {
    if ('Insert into Post' == $text) {
        $referer = strpos( wp_get_referer(), 'rttheme-settings' );
        if ( $referer != '' ) {
            return __('I want this to be my logo!', 'rttheme' );
        }
    }
    return $translated_text;
}