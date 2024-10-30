<?php
/*
Plugin Name: Cookie Maestro
Plugin URI: https://www.cookiemaestro.nl
Description: Eenvoudige installatie van Cookie Maestro
Version: 1.1.1
Author: Denver Sessink <denver@dsinternet.nl>
Author URI: https://www.dsinternet.nl
*/

$cm_plugin_version = '1.1.1';

/**
 * Cookie Maestro Admin Page
 */
function cookie_maestro_admin_page()
{
    add_menu_page('Cookie Maestro', 'Cookie Maestro', 'manage_options', dirname(__FILE__) . '/templates/settings.php', '', 'dashicons-vault');
}

add_action('admin_menu', 'cookie_maestro_admin_page');

/**
 * Cookie Maestro front-end installation
 */
function insert_cookie_maestro_frontend()
{
    $cookie_maestro_key = get_option('cookie_maestro_key');
    if (trim($cookie_maestro_key) != "") {
        wp_register_script('cookie-maestro-js-latest', 'https://www.cookiemaestro.nl/cookiemaestro-js-latest?client=' . $cookie_maestro_key, array(), '1.1.1');
        wp_enqueue_script('cookie-maestro-js-latest');
    }
}

add_action('wp_enqueue_scripts', 'insert_cookie_maestro_frontend');

/**
 * Cookie Maestro – Cookie Declaration shortcode
 *
 * @param        $atts
 * @param string $content
 *
 * @return string
 */
function cookie_maestro_declaration($atts, $content = "")
{
    return '<div id="cookiemaestro-cookie-listing"></div>';
}

add_shortcode('cookie-maestro-declaration', 'cookie_maestro_declaration');
