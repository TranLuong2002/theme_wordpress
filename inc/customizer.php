<?php
// inc/customizer.php
if (!defined('ABSPATH')) exit;

function theme_customize_register($wp_customize) {
    // Hero Banner Section
    $wp_customize->add_section('hero_banner_section', array(
        'title' => 'Hero Banner',
        'priority' => 30,
    ));

    $wp_customize->add_setting('hero_banner_bg', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_banner_bg', array(
        'label' => 'Banner Background Image',
        'section' => 'hero_banner_section',
    )));

    // About Section
    $wp_customize->add_section('about_section', array(
        'title' => 'About Section',
        'priority' => 31,
    ));
    
    // ... rest of customizer code
}
add_action('customize_register', 'theme_customize_register');