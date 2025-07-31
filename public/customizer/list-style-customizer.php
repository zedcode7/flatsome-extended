<?php

if (! defined('WPINC')) {
    die;
}



// Add a section inside the panel
$wp_customize->add_section('fx_list_style_section', array(
    'title' => __('List Style Color', 'flatsome-extended'),
    'panel' => 'flatsome_extend_customizer',
));

// Add a setting
$wp_customize->add_setting('list_style_color', array(
    'default'           => '#20d864',
    'sanitize_callback' => 'sanitize_text_field',
));
$wp_customize->add_setting('list_style_color_dark', array(
    'default'           => '#20d864',
    'sanitize_callback' => 'sanitize_text_field',
));

// Add a control linked to the setting
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'list_style_color', array(
    'label'   => __('List icons color', 'flatsome-extended'),
    'section' => 'fx_list_style_section',
    'settings' => 'list_style_color',
)));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'list_style_color_dark', array(
    'label'   => __('List icons color on dark background', 'flatsome-extended'),
    'section' => 'fx_list_style_section',
    'settings' => 'list_style_color_dark',
)));


function fx_list_style_dynamic_css()
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
add_action('wp_enqueue_scripts', 'fx_list_style_dynamic_css');
