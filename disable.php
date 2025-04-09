<?php
/*
Plugin Name: Disable Plugin Installation
Description: This will enable or disable the plugin installation from the wordpress admin.
Version: 1.0
Author: Brandclever
*/


// Add plugin settings page
function settings_page() {
    add_options_page('Plugin Settings', 'Plugin Settings', 'manage_options', 'custom-plugin-settings', 'custom_plugin_settings_page');
}

// Render plugin settings page
function custom_plugin_settings_page() {
    ?>
    <div class="wrap">
        <h2>Plugin Settings</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom_plugin_settings_group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Disable Plugin Installation:</th>
                    <td><input type="checkbox" name="disable_plugin_installation" <?php checked(get_option('disable_plugin_installation'), 1); ?> value="1" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Register plugin settings
function register_settings() {
    register_setting('custom_plugin_settings_group', 'disable_plugin_installation', 'intval');
}

// Initialize plugin
function initialize() {
    $disable_plugin_installation = get_option('disable_plugin_installation', false);
    if ($disable_plugin_installation) {
        define('DISALLOW_FILE_MODS', true);
    } else {
        define('DISALLOW_FILE_MODS', false);
    }
}

// Add hooks and actions
add_action('admin_menu', 'settings_page');
add_action('admin_init', 'register_settings');
add_action('init', 'initialize');