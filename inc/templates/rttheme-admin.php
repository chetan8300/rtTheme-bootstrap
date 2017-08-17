<h1>rtTheme Theme Options</h1>

<form method="post">
    <?php settings_fields( 'rttheme-settings-group' ); ?>
    <?php do_settings_sections( 'admin_rttheme' ); ?>
    <?php submit_button(); ?>
</form>