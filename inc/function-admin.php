<?php
/* Theme Options Page for rtTheme-Bootstrap */

function rttheme_add_admin_page() {
    // Generate Admin Page
    add_menu_page('rtTheme Theme Options', 'rtTheme-Bootstrap', 'manage_options', 'admin_rttheme', 'rttheme_bootstrap_create_page');
    
    // Generate Admin Sub Page
    add_submenu_page( 'admin_rttheme', 'rtTheme Theme Options', 'General', 'manage_options', 'admin_rttheme', 'rttheme_bootstrap_create_page' );
    
//    add_submenu_page( 'admin_rttheme', 'rtTheme Theme Options', 'Front Page Slider', 'manage_options', 'admin_rttheme_slider', 'rttheme_bootstrap_create_page' );
//    
//    add_submenu_page( 'admin_rttheme', 'rtTheme Theme Options', 'YouTube Links', 'manage_options', 'admin_rttheme_youtube', 'rttheme_bootstrap_create_page' );
//    
//    add_submenu_page( 'admin_rttheme', 'rtTheme Theme Options', 'Social', 'manage_options', 'admin_rttheme_social', 'rttheme_bootstrap_create_page' );
//    
    add_submenu_page( 'admin_rttheme', 'rtTheme CSS Options', 'Custom CSS', 'manage_options', 'admin_rttheme_css', 'rttheme_bootstrap_settings_page' );
    
    // Acticate custom settings
    add_action( 'admin_init', 'rttheme_custom_settings' );
}
    
add_action( 'admin_menu', 'rttheme_add_admin_page' );

function rttheme_custom_settings() {
    register_setting( 'rttheme-settings-group', 'logo_url' );
    add_settings_section( 'rttheme-general-options', 'Theme Options', 'rttheme_theme_options', 'admin_rttheme' );
    add_settings_field( 'logo-url', 'Logo URL', 'rttheme_logo_url', 'admin_rttheme', 'rttheme-theme-options' );
}

function rttheme_theme_options() {
    echo "Customize General Data";
}

function rttheme_logo_url() {
    $logoURL = esc_attr( get_option('logo_url') );
    echo "<input type='text' name='logo_url' value='' size=50 placeholder='Select Logo'>";
}

function rttheme_bootstrap_create_page() {
    require_once get_template_directory(). '/inc/templates/rttheme-admin.php';
}

function rttheme_bootstrap_settings_page() {
    echo '<h1>rtTheme Custom CSS</h1>';
}


