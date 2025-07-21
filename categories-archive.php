<?php get_header(); ?>

<main class="site-main">
    <!-- Categories Archive Header -->
    <section class="categories-archive-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo home_url(); ?>">Trang chủ</a>
                <span class="separator">/</span>
                <span class="current">Tất cả danh mục</span>
            </div>

            <h1 class="page-title">Tất cả danh mục bài viết</h1>
            <p class="page-description">Khám phá các chủ đề khác nhau qua danh mục bài viết của chúng tôi</p>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="categories-content">
        <div class="container">
            <div class="categories-grid">
                <?php
                // Get all categories
                $categories = get_categories(array(
                    'orderby' => 'count',
                    'order' => 'DESC',
                    'hide_empty' => true,
                    'exclude' => array() // Exclude 'Uncategorized'
                ));

                if (!empty($categories)):
                    foreach ($categories as $category):
                        // Get category thumbnail (if using category meta)
                        $category_image = get_term_meta($category->term_id, 'category_image', true);
                        if (empty($category_image)) {
                            // Fallback: get latest post image from this category
                            $latest_post = get_posts(array(
                                'category' => $category->term_id,
                                'numberposts' => 1
                            ));
                            if (!empty($latest_post) && has_post_thumbnail($latest_post[0]->ID)) {
                                $category_image = get_the_post_thumbnail_url($latest_post[0]->ID, 'medium');
                            }
                        }
                ?>
                        <div class="category-card">
                            <div class="category-image">
                                <?php if ($category_image): ?>
                                    <a href="<?php echo get_category_link($category->term_id); ?>">
                                        <img src="<?php echo esc_url($category_image); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo get_category_link($category->term_id); ?>" class="category-placeholder">
                                        <i class="fas fa-folder"></i>
                                    </a>
                                <?php endif; ?>
                                
                                <!-- Post Count Badge -->
                                <span class="post-count-badge"><?php echo $category->count; ?></span>
                            </div>

                            <div class="category-info">
                                <h3 class="category-name">
                                    <a href="<?php echo get_category_link($category->term_id); ?>">
                                        <?php echo $category->name; ?>
                                    </a>
                                </h3>

                                <?php if ($category->description): ?>
                                    <p class="category-description">
                                        <?php echo wp_trim_words($category->description, 15); ?>
                                    </p>
                                <?php endif; ?>

                                <div class="category-meta">
                                    <span class="post-count">
                                        <i class="fas fa-file-alt"></i>
                                        <?php printf('%d bài viết', $category->count); ?>
                                    </span>

                                    <!-- Latest post date -->
                                    <?php
                                    $latest_post = get_posts(array(
                                        'category' => $category->term_id,
                                        'numberposts' => 1
                                    ));
                                    if (!empty($latest_post)):
                                    ?>
                                        <span class="last-updated">
                                            <i class="fas fa-clock"></i>
                                            <?php echo human_time_diff(strtotime($latest_post[0]->post_date), current_time('timestamp')) . ' trước'; ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <!-- Recent posts preview -->
                                <div class="recent-posts-preview">
                                    <?php
                                    $recent_posts = get_posts(array(
                                        'category' => $category->term_id,
                                        'numberposts' => 3
                                    ));
                                    
                                    if (!empty($recent_posts)):
                                    ?>
                                        <h4>Bài viết mới nhất:</h4>
                                        <ul>
                                            <?php foreach ($recent_posts as $post): ?>
                                                <li>
                                                    <a href="<?php echo get_permalink($post->ID); ?>">
                                                        <?php echo wp_trim_words($post->post_title, 8); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>

                                <a href="<?php echo get_category_link($category->term_id); ?>" class="view-category">
                                    Xem tất cả <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                <?php 
                    endforeach;
                else:
                ?>
                    <div class="no-categories">
                        <h3>Chưa có danh mục nào</h3>
                        <p>Hiện tại chưa có danh mục bài viết nào được tạo.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Categories Stats -->
            <div class="categories-stats">
                <div class="stats-grid">
                    <div class="stat-item">
                        <div class="stat-number"><?php echo count($categories); ?></div>
                        <div class="stat-label">Danh mục</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php 
                            $total_posts = array_sum(array_column($categories, 'count'));
                            echo $total_posts;
                            ?>
                        </div>
                        <div class="stat-label">Bài viết</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php 
                            $most_popular = !empty($categories) ? $categories[0]->count : 0;
                            echo $most_popular;
                            ?>
                        </div>
                        <div class="stat-label">Danh mục phổ biến nhất</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>