<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/zedcode7/flatsome-extended
 * @since             1.0.0
 * @package           Flatsome_Extended
 *
 * @wordpress-plugin
 * Plugin Name:       Flatsom extended
 * Plugin URI:        https://github.com/zedcode7/flatsome-extended
 * Description:       Some Extra feature and solution for flatsome theme and ux-builder
 * Version:           1.0.0
 * Author:            Zunaed Abrar
 * Author URI:        https://github.com/zedcode7/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       flatsome-extended
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}




/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FLATSOME_EXTENDED_VERSION', '1.0.0');



/*  */

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-flatsome-extended-activator.php
 */
function activate_flatsome_extended()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-flatsome-extended-activator.php';
	Flatsome_Extended_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-flatsome-extended-deactivator.php
 */
function deactivate_flatsome_extended()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-flatsome-extended-deactivator.php';
	Flatsome_Extended_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_flatsome_extended');
register_deactivation_hook(__FILE__, 'deactivate_flatsome_extended');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-flatsome-extended.php';



add_action('init', 'run_plugin_only_for_flatsome');


function  run_plugin_only_for_flatsome()
{


	$theme = wp_get_theme();

	if (
		$theme->get('Name') === 'Flatsome' ||
		$theme->get('Template') === 'flatsome'
	) {
		function run_flatsome_extended()
		{

			$plugin = new Flatsome_Extended();
			$plugin->run();
		}
		run_flatsome_extended();
	} else {

		add_action('admin_notices', function () {
			echo '<div class="notice notice-error"><p>This plugin requires Flatsome or a child theme based on Flatsome.</p></div>';
		});

		deactivate_plugins(plugin_basename(__FILE__));
	}
}



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
