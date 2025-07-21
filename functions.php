<?php
// functions.php - File chính (core)
if (!defined('ABSPATH')) exit;

// Định nghĩa constants
define('THEME_URI', get_template_directory_uri());
define('THEME_PATH', get_template_directory());
define('THEME_VERSION', '1.0.0');

// Include các file functions khác
require_once get_template_directory() . '/inc/theme-setup.php';
require_once get_template_directory() . '/inc/custom-functions.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/enqueue-scripts.php';
require_once get_template_directory() . '/inc/post-functions.php';
require_once get_template_directory() . '/inc/search-functions.php';
require_once get_template_directory() . '/inc/category-functions.php';

// Chỉ để những function cực kỳ cơ bản
if (!function_exists('theme_setup')) {
    function theme_setup() {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
    }
    add_action('after_setup_theme', 'theme_setup');
}