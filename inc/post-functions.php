<?php
// inc/post-functions.php
if (!defined('ABSPATH')) exit;

// Post views functions
function get_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return '0';
    }
    return $count;
}

function set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

function track_post_views() {
    if (is_single()) {
        global $post;
        set_post_views($post->ID);
    }
}
add_action('wp_head', 'track_post_views');

// Excerpt functions
function custom_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length');

function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// Comments callback
function custom_comment($comment, $args, $depth) {
    $tag = ($args['style'] === 'div') ? 'div' : 'li';
    ?>
    <<?php echo $tag; ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">
    
    <div class="comment-body">
        <div class="comment-author">
            <?php echo get_avatar($comment, 50); ?>
            <div class="comment-meta">
                <h4><?php echo get_comment_author_link(); ?></h4>
                <time><?php echo get_comment_date('d/m/Y H:i'); ?></time>
            </div>
        </div>
        
        <div class="comment-content">
            <?php comment_text(); ?>
        </div>
        
        <div class="comment-reply">
            <?php comment_reply_link(array_merge($args, array(
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            ))); ?>
        </div>
    </div>
    <?php
}