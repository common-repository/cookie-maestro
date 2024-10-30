<?php
// Must check that the user has the required capability
if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}

// Variables for the field and option names
$opt_name = 'cookie_maestro_key';
$hidden_field_name = 'cm_submit_schortcodehidden';
$data_field_name = 'cookie_maestro_key';

// Read in existing option value from database
$opt_val = get_option($opt_name);

// See if the user has posted us some information
// If they did, this hidden field will be set to 'Y'
$saved = false;
if (isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y') {
    // Read their posted value
    $opt_val = $_POST[$data_field_name];

    // Save the posted value in the database
    update_option($opt_name, $opt_val);

    // Put a "settings saved" message on the screen
    $saved = true;
}
?>

<?php if ( $saved ): ?><div class="updated"><p><strong><?php _e('Cookie Maestro key saved. From now on Cookie Maestro is installed on your website!', 'cookie-maestro'); ?></strong></p></div><?php endif; ?>

<div class="wrap">
    <h2>Cookie Maestro</h2>

    <p>Here you can easily install your personal Cookie Maestro installation at your website. Just enter your Cookie Maestro key below and save settings. Don't know where to find your Cookie Maestro key?</p>
    <p>Go to your <a href="https://www.cookiemaestro.nl/domains" target="_blank">Cookie Maestro dashboard</a>, choose your domain and navigate to 'Installation'. You will find your key under WordPress installation.</p>

    <form name="form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

        <p><?php _e("Cookie Maestro key:", 'cookie-maestro'); ?>
            <input type="text" name="<?php echo $data_field_name; ?>" value="<?php echo $opt_val; ?>" size="90">
        </p>
        <hr/>

        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>"/>
        </p>

    </form>

    <h3>Cookie Declaration</h3>

    <p>To show your personal cookie declaration, please use this shortcode. Place this shortcode on your Privacy Policy page to let Cookie Maestro add your Cookie Declaration:</p>
    <p><pre>[cookie-maestro-declaration]</pre></p>
</div>
