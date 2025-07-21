<!-- Search Widget -->
<div class="sidebar-widget">
    <h3>Tìm kiếm</h3>
    <?php get_search_form(); ?>
</div>

<!-- Recent Posts -->
<div class="sidebar-widget">
    <h3>Bài viết mới nhất</h3>
    <div class="recent-posts">
        <?php
        $recent_posts = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 5,
            'post__not_in' => array(get_the_ID())
        ));

        if ($recent_posts->have_posts()):
            while ($recent_posts->have_posts()):
                $recent_posts->the_post();
        ?>
                <div class="recent-post-item">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="recent-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="recent-post-content">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <span class="recent-post-date"><?php echo get_the_date('d/m/Y'); ?></span>
                    </div>
                </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<!-- Categories -->
<div class="sidebar-widget">
    <h3>Danh mục</h3>
    <ul class="categories-list">
        <?php wp_list_categories(array(
            'title_li' => '',
            'show_count' => true,
            'orderby'      => 'id',
        )); ?>
    </ul>
</div>

<!-- Related Posts -->
<div class="sidebar-widget">
    <h3>Bài viết liên quan</h3>
    <div class="related-posts">
        <?php
        $categories = get_the_category();
        if ($categories) {
            $category_ids = array();
            foreach ($categories as $category) {
                $category_ids[] = $category->term_id;
            }

            $related_posts = new WP_Query(array(
                'category__in' => $category_ids,
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 4,
                'orderby' => 'rand'
            ));

            if ($related_posts->have_posts()):
                while ($related_posts->have_posts()):
                    $related_posts->the_post();
        ?>
                    <div class="related-post-item">
                        <?php if (has_post_thumbnail()): ?>
                            <div class="related-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('thumbnail'); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="related-post-content">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                            <span class="related-post-date"><?php echo get_the_date('d/m/Y'); ?></span>
                        </div>
                    </div>
        <?php
                endwhile;
                wp_reset_postdata();
            endif;
        }
        ?>
    </div>
</div>