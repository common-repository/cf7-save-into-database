<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0
 * @package           cf7nxt
 *
 * @wordpress-plugin
 * Plugin Name:       CF7NXT Lite - Contact Form 7 Save Into Database
 * Plugin URI:        http://witoni.com
 * Description:       This plugin enables you to store contact enquiry into database.
 * Version:           1.0
 * Author:            Witoni Softwares
 * Author URI:        http://witoni.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cf7-save-into-database
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CF7NXT_VERSION', '1.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cf7nxt-activator.php
 */
function activate_cf7nxt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7nxt-activator.php';
	CF7NXT_Activator::cf7nxt_table();
    CF7NXT_Activator::cf7nxt_upload();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cf7nxt-deactivator.php
 */
function deactivate_cf7nxt() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cf7nxt-deactivator.php';
	CF7NXT_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cf7nxt' );
register_deactivation_hook( __FILE__, 'deactivate_cf7nxt' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cf7nxt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
function run_cf7nxt() {

	$plugin = new cf7nxt();
	$plugin->run();

}
run_cf7nxt();
