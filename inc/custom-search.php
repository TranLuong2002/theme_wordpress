<?php
// Highlight search terms in content
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

// Calculate relevance score for search results
function calculate_relevance_score($post_id, $search_query) {
    $post = get_post($post_id);
    $score = 0;
    
    // Title matches = higher score
    if (stripos($post->post_title, $search_query) !== false) {
        $score += 10;
    }
    
    // Content matches = medium score
    if (stripos($post->post_content, $search_query) !== false) {
        $score += 5;
    }
    
    // Excerpt matches = lower score
    if (stripos($post->post_excerpt, $search_query) !== false) {
        $score += 3;
    }
    
    // Recent posts = bonus score
    $days_old = (time() - strtotime($post->post_date)) / (60 * 60 * 24);
    if ($days_old < 30) {
        $score += 2;
    }
    
    return $score;
}

// Improve search query
function improve_search_functionality($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        // Include pages in search
        $query->set('post_type', array('post', 'page'));
        
        // Increase posts per page
        $query->set('posts_per_page', 12);
        
        // Order by relevance (we'll sort this later)
        $query->set('orderby', 'relevance');
    }
}
add_action('pre_get_posts', 'improve_search_functionality');

// Custom orderby relevance
function search_orderby_relevance($orderby, $query) {
    if ($query->is_search() && $query->get('orderby') === 'relevance') {
        global $wpdb;
        $search_term = $query->get('s');
        
        $orderby = "
            CASE 
                WHEN {$wpdb->posts}.post_title LIKE '%{$search_term}%' THEN 1
                WHEN {$wpdb->posts}.post_content LIKE '%{$search_term}%' THEN 2
                ELSE 3
            END,
            {$wpdb->posts}.post_date DESC
        ";
    }
    return $orderby;
}
add_filter('posts_orderby', 'search_orderby_relevance', 10, 2);

// Add search result count to title
function search_page_title($title) {
    if (is_search()) {
        global $wp_query;
        $search_count = $wp_query->found_posts;
        $search_query = get_search_query();
        
        $title = sprintf('Tìm kiếm "%s" - %d kết quả | %s', 
            $search_query, 
            $search_count, 
            get_bloginfo('name')
        );
    }
    return $title;
}
add_filter('wp_title', 'search_page_title');
add_filter('document_title_parts', function($title) {
    if (is_search()) {
        global $wp_query;
        $title['title'] = sprintf('Tìm kiếm "%s" - %d kết quả', 
            get_search_query(), 
            $wp_query->found_posts
        );
    }
    return $title;
});


