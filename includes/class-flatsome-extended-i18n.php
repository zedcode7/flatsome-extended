<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/zedcode7/
 * @since      1.0.0
 *
 * @package    Flatsome_Extended
 * @subpackage Flatsome_Extended/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Flatsome_Extended
 * @subpackage Flatsome_Extended/includes
 * @author     Zunaed Abrar <jnmzunaed@gmail.com>
 */
class Flatsome_Extended_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'flatsome-extended',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}

	public function list_style_customize_register($wp_customize)
	{
		// Add the main panel of Flatsome extend
		$wp_customize->add_panel('flatsome_extend_customizer', array(
			'title'       => __('Flatsome Extend settings', 'flatsome-extended'),
			'description' => __('Settings grouped under Flatsome Extended plugin.', 'flatsome-extended'),
			'priority'    => 160, // Controls position in the Customizer
		));


		require_once plugin_dir_path(__FILE__) . 'customizer/list-style-customizer.php'; //get the customizere setting specialy for list style



	}
}
