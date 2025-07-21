<?php
// inc/category-functions.php
if (!defined('ABSPATH')) exit;

// Category sort functionality
function handle_category_sorting($query) {
    if (!is_admin() && $query->is_main_query() && is_category()) {
        $sort = isset($_GET['sort']) ? sanitize_text_field($_GET['sort']) : 'date_desc';
        
        switch ($sort) {
            case 'date_asc':
                $query->set('orderby', 'date');
                $query->set('order', 'ASC');
                break;
                
            case 'title_asc':
                $query->set('orderby', 'title');
                $query->set('order', 'ASC');
                break;
                
            case 'title_desc':
                $query->set('orderby', 'title');
                $query->set('order', 'DESC');
                break;
                
            case 'comment_count':
                $query->set('orderby', 'comment_count');
                $query->set('order', 'DESC');
                break;
                
            case 'date_desc':
            default:
                $query->set('orderby', 'date');
                $query->set('order', 'DESC');
                break;
        }
    }
}
add_action('pre_get_posts', 'handle_category_sorting');

// Get related categories
function get_related_categories($current_cat_id, $limit = 5) {
    return get_categories(array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => $limit,
        'exclude' => $current_cat_id
    ));
}

// Get popular posts in category
function get_popular_posts_in_category($cat_id, $limit = 5) {
    return new WP_Query(array(
        'cat' => $cat_id,
        'posts_per_page' => $limit,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC'
    ));
}