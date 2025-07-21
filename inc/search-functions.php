<?php
// inc/search-functions.php
if (!defined('ABSPATH')) exit;

// Highlight search terms
function highlight_search_terms($content, $search_query) {
    if (empty($search_query)) {
        return $content;
    }
    
    $terms = explode(' ', $search_query);
    foreach ($terms as $term) {
        if (strlen($term) > 2) {
            $content = preg_replace('/(' . preg_quote($term, '/') . ')/i', '<mark>$1</mark>', $content);
        }
    }
    
    return $content;
}

// Calculate relevance score
function calculate_relevance_score($post_id, $search_query) {
    $post = get_post($post_id);
    $score = 0;
    
    if (stripos($post->post_title, $search_query) !== false) {
        $score += 10;
    }
    
    if (stripos($post->post_content, $search_query) !== false) {
        $score += 5;
    }
    
    return $score;
}

// Improve search query
function improve_search_functionality($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', array('post', 'page'));
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'improve_search_functionality');