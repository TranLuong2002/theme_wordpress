<?php
/**
 * Theme Customizer Settings
 */
function dev_theme_customize_register($wp_customize) {
    require_once get_template_directory() . '/inc/customizer/hero-banner.php';
    require_once get_template_directory() . '/inc/customizer/news-section.php';
}
add_action('customize_register', 'dev_theme_customize_register');