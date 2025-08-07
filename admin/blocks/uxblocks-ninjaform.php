<?php



if (!defined('ABSPATH')) exit;



// Register UX Builder block
add_action('ux_builder_setup', 'nfux_register_block');
function nfux_register_block()
{
    add_ux_builder_shortcode('nfux_form_block', array(
        'name' => __('Ninja Form Block', 'flatsome-extended'),
        'category' => __('Flatsome Extend', 'flatsome-extended'),
        'thumbnail' => plugin_dir_url(__FILE__) . 'thumbnails/ninja_form.png', // Optional
        'render_callback' => 'nfux_render_block',
        'options' => array(
            'block_id' => array(
                'type' => 'textfield',
                'default' => 'nfux-' . substr(md5(uniqid()), 0, 6),
                'class' => 'hide-in-menu',
            ),
            'form_id' => array(
                'type' => 'select',
                'heading' => __('Select Ninja Form', 'flatsome-extended'),
                'full_width' => true,
                'options' => nfux_get_forms(),
            ),
            'form_bg' => array(
                'type' => 'colorpicker',
                'heading' => __('Form Background', 'flatsome-extended'),
                'default' => '',
                'alpha' => true,
                'format' => 'rgb',
                'position' => 'bottom right',

            ),
            'form_padding' => array(
                'type' => 'margins',
                'heading' => 'Padding',
                'full_width' => true,
                'responsive' => true,
                'min' => 0,
                'max' => 200,
                'step' => 1,
            ),
            'input_bg' => array(
                'type' => 'colorpicker',
                'heading' => __('input Background', 'flatsome-extended'),
                'default' => '',
                'format' => 'rgb',

            ),
            'input_radius' => array(
                'type' => 'slider',
                'heading' => 'Input Radius',
                'default' => '',
                'max' => 100,
                'min' => 1,

            ),
            'placeholder_color' => array(
                'type' => 'colorpicker',
                'heading' => __('Placeholder text color', 'flatsome-extended'),
                'default' => '',
                'format' => 'rgb',

            ),
            'Button_setting' => array(
                'type' => 'group',
                'heading' => __('Button Style', 'flatsome-extended'),
                'options' => array(
                    'submitbutton_bg' => array(
                        'type' => 'colorpicker',
                        'heading' => __('button Background', 'flatsome-extended'),
                        'default' => '',
                        'alpha' => true,
                        'format' => 'rgb',
                        'position' => 'bottom right',

                    ),
                    'submitbutton_text' => array(
                        'type' => 'colorpicker',
                        'heading' => __('button Text Color', 'flatsome-extended'),
                        'default' => '',
                        'alpha' => true,
                        'format' => 'rgb',

                    ),
                    'submitbutton_radius' => array(
                        'type' => 'slider',
                        'heading' => 'Button Radius',
                        'default' => '',
                        'max' => 100,
                        'min' => 1,


                    ),
                    'submitbutton_width' => array(
                        'type' => 'slider',
                        'heading' => 'Button width (%)',
                        'default' => 'auto',
                        'max' => 100,
                        'min' => 1,
                        'unit'    => '%',

                    ),
                    'submitbutton_padding' => array(
                        'type' => 'margins',
                        'heading' => 'Padding',
                        'full_width' => true,
                        'responsive' => true,
                        'min' => 0,
                        'max' => 200,
                        'step' => 1,

                    ),

                )
            ),

        ),
    ));
}

// Register WordPress shortcode so [nfux_form_block] works
add_shortcode('nfux_form_block', 'nfux_render_block');

// Helper: Get forms for dropdown
function nfux_get_forms()
{
    $forms = [];

    if (!class_exists('Ninja_Forms')) return $forms;

    $list = Ninja_Forms()->form()->get_forms();

    foreach ($list as $form) {
        if (!is_object($form)) continue;
        $id = $form->get_id();
        $title = $form->get_setting('title') ?: 'Form #' . $id;
        $forms[$id] = esc_html($title);
    }

    return $forms;
}













// Render the form (frontend and preview)
function nfux_render_block($atts)
{
    $atts = shortcode_atts([
        'form_id' => '',
        'submitbutton_bg' => '',
        'submitbutton_text' => '',
        'placeholder_color' => '',
        'input_radius' => '',
        'input_bg' => '',
        'form_bg' => '',
        'form_padding' => '',
        'submitbutton_bg' => '',
        'block_id' => 'nfux-' . substr(md5(uniqid()), 0, 6),
        'submitbutton_radius' => '',
        'submitbutton_width' => '',
        'submitbutton_padding' => '',

    ], $atts);

    // Sanitize values
    $block_id = sanitize_html_class($atts['block_id']);
    $form_id = intval($atts['form_id']);
    $form_bg = esc_attr($atts['form_bg']);
    $form_padding = esc_attr($atts['form_padding']);
    $input_bg = esc_attr($atts['input_bg']);
    $input_radius = is_numeric($atts['input_radius']) ? floatval($atts['input_radius']) . 'px' : '';
    $placeholder_color = esc_attr($atts['placeholder_color']);
    $submit_bg = esc_attr($atts['submitbutton_bg']);
    $submit_text = esc_attr($atts['submitbutton_text']);
    $submit_radius = is_numeric($atts['submitbutton_radius']) ? floatval($atts['submitbutton_radius']) . 'px' : '';
    $submit_width = is_numeric($atts['submitbutton_width']) ? floatval($atts['submitbutton_width']) . '%' : '';
    $submit_padding = esc_attr($atts['submitbutton_padding']);
    $class = 'ninjablock-' . $block_id;

    //block layout

    $style = "<style>";
    if ($form_bg) {
        $style .= ".$class { background-color: $form_bg !important; }";
    }
    if ($form_padding) {
        $style .= ".$class { padding: $form_padding !important; }";
    }

    if ($input_bg || $input_radius) {
        $style .= ".$class .nf-field-element input:not([type='submit']), .$class .nf-field-element textarea {";
        if ($input_bg) {
            $style .= "background-color: $input_bg;";
        }
        if ($input_radius) {
            $style .= "border-radius: $input_radius;";
        }
        $style .= "}";
    }

    if ($placeholder_color) {
        $style .= ".$class ::placeholder { color: $placeholder_color; }";
    }

    if ($submit_bg || $submit_text || $submit_radius || $submit_width || $submit_padding) {
        $style .= ".$class .nf-form-content input[type='submit'] {";
        if ($submit_bg) {
            $style .= "background-color: $submit_bg;";
        }
        if ($submit_text) {
            $style .= "color: $submit_text;";
        }
        if ($submit_radius) {
            $style .= "border-radius: $submit_radius;";
        }
        if ($submit_width) {
            $style .= "width: $submit_width;";
        }
        if ($submit_padding) {
            $style .= "padding: $submit_padding;";
        }
        $style .= "}";
    }

    $style .= "</style>";

    $form_shortcode = '[ninja_form id="' . $form_id . '"]';





    if (!is_uxbuilder_active()) {
        return $style . '<div class="' . esc_attr($class) . '">' . do_shortcode($form_shortcode) . '</div>';
    } else {
        if (esc_attr($form_id)) {
            echo  $style; ?>

            <div class="<?php echo esc_attr($class) ?>" style="padding:<?php echo esc_attr($form_padding);  ?>; border:1px dashed #aaa;">

                <h5 style="display:inline;">style it here as example for frontend <strong><?php echo '[ninja_form id="' . esc_attr($form_id) . '"]'  ?> </strong> </h5> <br>
                <p>Note: <small>Save before adding another form block</small></p>
                <div class="form-style nf-field-element nf-form-content">
                    <label for="">Label example </label>
                    <input type="text" placeholder="Placeholder example">
                    <input type="submit">
                </div>
            </div>
        <?php } else { ?>

            <div style="padding: 20px; border:1px dashed #aaa;">
                <p> Select a form to edit </p>
            </div>
        <?php
        }

        ?>




<?php
    }
}

function is_uxbuilder_active()
{
    // 1. Flatsome constant (not defined in your case, but kept for safety)
    if (defined('UXBUILDER_IS_ACTIVE') && UXBUILDER_IS_ACTIVE) {
        return true;
    }

    // 2. URL param on editor page
    if (isset($_GET['app']) && $_GET['app'] === 'uxbuilder') {
        return true;
    }

    // 3. Referer contains uxb_iframe=1 (your case!)
    if (!empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'uxb_iframe=1') !== false) {
        return true;
    }

    return false;
}
add_action('admin_enqueue_scripts', function () {
    echo '<style>.option-name-block_id { display: none !important; }</style>';
});
