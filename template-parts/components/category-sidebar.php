<!-- Category Sidebar -->
<div class="sidebar-widget">
    <h3>Danh mục khác</h3>
    <ul class="category-list">
        <?php
        $categories = get_categories(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 10,
            'exclude' => get_queried_object_id()
        ));
        
        foreach ($categories as $category):
        ?>
            <li class="category-item">
                <a href="<?php echo get_category_link($category->term_id); ?>">
                    <span class="category-name"><?php echo $category->name; ?></span>
                    <span class="category-count">(<?php echo $category->count; ?>)</span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Popular Posts in Category -->
<div class="sidebar-widget">
    <h3>Bài viết phổ biến</h3>
    <div class="popular-posts">
        <?php
        $current_category = get_queried_object_id();
        $popular_posts = new WP_Query(array(
            'cat' => $current_category,
            'posts_per_page' => 5,
            'meta_key' => 'post_views_count',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
        ));
        
        if ($popular_posts->have_posts()):
            while ($popular_posts->have_posts()): $popular_posts->the_post();
        ?>
                <div class="popular-post-item">
                    <?php if (has_post_thumbnail()): ?>
                        <div class="popular-post-thumb">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('thumbnail'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="popular-post-content">
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <span class="popular-post-date"><?php echo get_the_date('d/m/Y'); ?></span>
                        <span class="popular-post-views">
                            <i class="fas fa-eye"></i> <?php echo get_post_views(get_the_ID()); ?>
                        </span>
                    </div>
                </div>
        <?php 
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</div>

<!-- Recent Posts -->
<div class="sidebar-widget">
    <h3>Bài viết mới nhất</h3>
    <div class="recent-posts">
        <?php
        $recent_posts = new WP_Query(array(
            'posts_per_page' => 5,
            'orderby' => 'date',
            'order' => 'DESC',
            'post__not_in' => array(get_the_ID())
        ));
        
        if ($recent_posts->have_posts()):
            while ($recent_posts->have_posts()): $recent_posts->the_post();
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

<!-- Tag Cloud -->
<div class="sidebar-widget">
    <h3>Tags</h3>
    <div class="tag-cloud">
        <?php
        $tags = get_tags(array(
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 20
        ));
        
        foreach ($tags as $tag):
        ?>
            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-item">
                <?php echo $tag->name; ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>