<?php


add_shortcode(
    'pm_before_after_img',
    function ($atts) {
        $atts = shortcode_atts([
            'imgcont_height' => '100%',
            'button_text_before' => 'Before',
            'button_text_after' => 'After',
            'before_img'  => '',
            'after_img'  => '',
            'text_align'  => '',
            'depth' => '',
            'depth_hover' => '',
            'border_radius' => '',
            'imgcont_quality' => 'medium',


        ], $atts);
        ob_start(); ?>
    <!-- content here -->



    <div class="before-after-main">

        <div class="before-after-container" style="border-radius:<?php echo absint($atts['border_radius']); ?>px ">
            <div class="image-container" style=" height: <?php echo sanitize_text_field($atts['imgcont_height']); ?>;">

                <div class="img-sli">
                    <div class="img-sli-texts">
                        <span class="text-before"> <?php echo sanitize_text_field($atts['button_text_before']); ?></span>
                        <span class="text-after"> <?php echo sanitize_text_field($atts['button_text_after']); ?></span>
                    </div>
                </div>


                <img class="image-before slider-image"
                    src="<?php echo esc_url(wp_get_attachment_image_url($atts['before_img']), 'before_after_ratio'); ?>"
                    alt="<?php sanitize_text_field($atts['button_text_after']) ?>" />

                <img class="image-after slider-image"
                    src="<?php echo esc_url(wp_get_attachment_image_url($atts['after_img'], 'before_after_ratio')); ?>"
                    alt="<?php sanitize_text_field($atts['button_text_after']) ?>" />

            </div>

            <!-- step="10" -->
            <input type="range" min="0" max="100" value="50" aria-label="Percentage of before photo shown"
                class="slider-inp" />
            <div class="slider-line" aria-hidden="true"></div>
            <div class="slider-button" aria-hidden="true">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    viewBox="0 0 256 256">
                    <rect width="256" height="256" fill="none"></rect>
                    <line x1="128" y1="40" x2="128" y2="216" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16"></line>
                    <line x1="96" y1="128" x2="16" y2="128" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16"></line>
                    <polyline points="48 160 16 128 48 96" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16"></polyline>
                    <line x1="160" y1="128" x2="240" y2="128" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16"></line>
                    <polyline points="208 96 240 128 208 160" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="16"></polyline>
                </svg>
            </div>
        </div>
    </div>
    <!-- content here -->
<?php
        return ob_get_clean();
    }

);
