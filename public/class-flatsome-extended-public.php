<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/zedcode7/
 * @since      1.0.0
 *
 * @package    Flatsome_Extended
 * @subpackage Flatsome_Extended/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Flatsome_Extended
 * @subpackage Flatsome_Extended/public
 * @author     Zunaed Abrar <jnmzunaed@gmail.com>
 */
class Flatsome_Extended_Public
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flatsome_Extended_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flatsome_Extended_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/flatsome-extended-public.css', array(), time(), 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Flatsome_Extended_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Flatsome_Extended_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/flatsome-extended-public.js', array('jquery'), time(), false);
		wp_enqueue_script($this->plugin_name . '-before-after', plugin_dir_url(__FILE__) . 'js/flatsome-extended-before-after.js', array(), time(), true);
	}


	public	function fx_list_style_dynamic_css()
	{
		$listicon_color = get_theme_mod('list_style_color');
		$listicon_color_dark = get_theme_mod('list_style_color_dark');

		$custom_css = "

        ul li.bullet-arrow:before,
        ul li.bullet-checkmark:before,
        ul li.bullet-star:before {
            color: {$listicon_color} !important;
        }

        .col-inner.dark ul li.bullet-arrow:before,
        .col-inner.dark ul li.bullet-checkmark:before,
        .col-inner.dark ul li.bullet-star:before {
            color: {$listicon_color_dark} !important;
        }
    ";

		wp_add_inline_style('flatsome-extended', $custom_css);
	}




	public	function flatsome_extent_enqueue_ux_builder_styles()
	{
		wp_enqueue_style(
			'flatsome-extended-public-style',
			plugin_dir_url(__FILE__) . 'css/flatsome-extended-public.css',
			array(),
			'1.0.0'
		);
	}
}
