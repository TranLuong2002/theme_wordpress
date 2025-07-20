<?php
if (!defined('ABSPATH')) exit;

// Include các file functions khác
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/custom-functions.php';

// Định nghĩa constants
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// Enqueue scripts và styles
function your_theme_scripts() {
    wp_enqueue_style('your-theme-style', get_stylesheet_uri());
    wp_enqueue_style('main-style', THEME_URI . '/assets/css/main.css');
    wp_enqueue_script('main-js', THEME_URI . '/assets/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'your_theme_scripts');

function theme_customize_register($wp_customize) {
    // Add Hero Banner Section
    $wp_customize->add_section('hero_banner_section', array(
        'title' => 'Hero Banner',
        'priority' => 30,
    ));

    // Add Background Image Setting
    $wp_customize->add_setting('hero_banner_bg', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_banner_bg', array(
        'label' => 'Banner Background Image',
        'section' => 'hero_banner_section',
    )));

    // Add Title Setting
    $wp_customize->add_setting('hero_banner_title', array(
        'default' => 'Welcome',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('hero_banner_title', array(
        'label' => 'Banner Title',
        'section' => 'hero_banner_section',
        'type' => 'text'
    ));

    // Add Description Setting
    $wp_customize->add_setting('hero_banner_desc', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field'
    ));

    $wp_customize->add_control('hero_banner_desc', array(
        'label' => 'Banner Description',
        'section' => 'hero_banner_section',
        'type' => 'textarea'
    ));

    // Add Button Text Setting
    $wp_customize->add_setting('hero_button_text', array(
        'default' => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('hero_button_text', array(
        'label' => 'Button Text',
        'section' => 'hero_banner_section',
        'type' => 'text'
    ));

    // Add Button URL Setting
    $wp_customize->add_setting('hero_button_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control('hero_button_url', array(
        'label' => 'Button URL',
        'section' => 'hero_banner_section',
        'type' => 'url'
    ));
}
add_action('customize_register', 'theme_customize_register');

function theme_about_section_customize($wp_customize) {
    // Add About Section
    $wp_customize->add_section('about_section', array(
        'title' => 'About Section',
        'priority' => 31,
    ));

    // Add About Content Setting
    $wp_customize->add_setting('about_content', array(
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ));

    $wp_customize->add_control('about_content', array(
        'label' => 'About Content',
        'section' => 'about_section',
        'type' => 'textarea',
    ));

    // Add About Image Setting
    $wp_customize->add_setting('about_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image', array(
        'label' => 'About Image',
        'section' => 'about_section',
    )));
}
add_action('customize_register', 'theme_about_section_customize');

function register_footer_menus() {
    register_nav_menus(array(
        'footer_about' => 'Footer About Menu',
        'footer_services' => 'Footer Services Menu'
    ));
}
add_action('init', 'register_footer_menus');