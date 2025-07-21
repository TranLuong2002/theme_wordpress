<?php
// inc/custom-functions.php
if (!defined('ABSPATH')) exit;

// Get theme option with default
function get_theme_option($option_name, $default = '') {
    return get_theme_mod($option_name, $default);
}

// Format number (views, comments, etc.)
function format_number($number) {
    if ($number >= 1000000) {
        return round($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return round($number / 1000, 1) . 'K';
    }
    return $number;
}

// Get reading time
function get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 words per minute
    
    return $reading_time;
}

// Breadcrumb function
function custom_breadcrumb() {
    if (is_home() || is_front_page()) return;
    
    echo '<nav class="breadcrumb">';
    echo '<a href="' . home_url() . '">Trang chủ</a>';
    echo '<span class="separator">/</span>';
    
    if (is_category()) {
        single_cat_title();
    } elseif (is_single()) {
        the_category(', ');
        echo '<span class="separator">/</span>';
        the_title();
    } elseif (is_page()) {
        the_title();
    } elseif (is_search()) {
        echo 'Kết quả tìm kiếm';
    }
    
    echo '</nav>';
}

// Security functions
function sanitize_html_classes($classes, $sep = ' ') {
    $return = '';
    
    if (!is_array($classes)) {
        $classes = explode($sep, $classes);
    }
    
    if (!empty($classes)) {
        foreach ($classes as $class) {
            $return .= sanitize_html_class($class) . $sep;
        }
        $return = rtrim($return, $sep);
    }
    
    return $return;
}


// Handle category archive redirect
function handle_category_archive_redirect() {
    // Check if accessing /category without specific category
    if (is_home() && $_SERVER['REQUEST_URI'] === '/category/' || 
        $_SERVER['REQUEST_URI'] === '/category') {
        
        // Redirect to a proper categories page or show all categories
        global $wp_query;
        
        // Set query vars to show categories archive
        $wp_query->is_home = false;
        $wp_query->is_category = false;
        $wp_query->is_archive = true;
        $wp_query->is_categories_archive = true;
        
        // Load appropriate template
        add_filter('template_include', 'load_categories_archive_template');
    }
}
add_action('template_redirect', 'handle_category_archive_redirect');

// Handle category base URL (/category/)
function handle_category_base_url() {
    global $wp_query;
    
    // Check if URL is exactly /category/ or /category
    $request_uri = trim($_SERVER['REQUEST_URI'], '/');
    
    if ($request_uri === 'category' || $request_uri === 'category/') {
        // Set custom query flag
        $wp_query->is_categories_archive = true;
        $wp_query->is_404 = false;
        $wp_query->is_home = false;
        
        // Load categories archive template
        add_filter('template_include', 'load_categories_archive_template');
        
        // Set page title
        add_filter('document_title_parts', function($title) {
            $title['title'] = 'Tất cả danh mục';
            return $title;
        });
    }
}
add_action('parse_request', 'handle_category_base_url');

// Load categories archive template
function load_categories_archive_template($template) {
    global $wp_query;
    
    if (isset($wp_query->is_categories_archive) && $wp_query->is_categories_archive) {
        $categories_template = locate_template('categories-archive.php');
        if ($categories_template) {
            return $categories_template;
        }
        
        // Fallback to archive template
        $archive_template = locate_template('archive.php');
        if ($archive_template) {
            return $archive_template;
        }
    }
    
    return $template;
}