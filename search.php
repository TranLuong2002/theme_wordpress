<?php get_header(); ?>

<main class="site-main">
    <!-- Search Header -->
    <section class="search-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo home_url(); ?>">Trang chủ</a>
                <span class="separator">/</span>
                <span class="current">Kết quả tìm kiếm</span>
            </div>

            <h1 class="page-title">
                <?php
                $search_query = get_search_query();
                $search_count = $wp_query->found_posts;

                if ($search_count > 0) {
                    printf('Tìm thấy %d kết quả cho: "%s"', $search_count, $search_query);
                } else {
                    printf('Không tìm thấy kết quả cho: "%s"', $search_query);
                }
                ?>
            </h1>

            <!-- Search form lại -->
            <div class="search-form-wrapper">
                <?php get_search_form(); ?>
            </div>
        </div>
    </section>

    <!-- Search Results -->
    <section class="search-results">
        <div class="container">
            <?php if (have_posts()): ?>

                <!-- Results Filter -->
                <div class="search-filters">
                    <div class="results-info">
                        <span class="results-count"><?php echo $search_count; ?> kết quả</span>
                        <span class="search-time">
                            <?php
                            global $wp_query;
                            printf('(%s giây)', number_format(timer_stop(), 3));
                            ?>
                        </span>
                    </div>

                    <div class="sort-options">
                        <label>Sắp xếp theo:</label>
                        <select id="search-sort" onchange="sortResults(this.value)">
                            <option value="relevance">Liên quan nhất</option>
                            <option value="date_desc">Mới nhất</option>
                            <option value="date_asc">Cũ nhất</option>
                            <option value="title">Tiêu đề A-Z</option>
                        </select>
                    </div>
                </div>

                <div class="search-results-grid">
                    <?php while (have_posts()): the_post(); ?>
                        <article class="search-result-item"
                            data-post-type="<?php echo get_post_type(); ?>"
                            data-date="<?php echo get_the_date('Y-m-d'); ?>"
                            data-title="<?php echo esc_attr(get_the_title()); ?>"
                            data-relevance="<?php echo calculate_relevance_score(get_the_ID(), $search_query); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>

                                    <!-- Post Type Badge -->
                                    <span class="post-type-badge">
                                        <?php
                                        $post_type_obj = get_post_type_object(get_post_type());
                                        echo $post_type_obj->labels->singular_name;
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="result-content">
                                <h2 class="result-title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        // Highlight search terms in title
                                        $title = get_the_title();
                                        $highlighted_title = highlight_search_terms($title, $search_query);
                                        echo $highlighted_title;
                                        ?>
                                    </a>
                                </h2>

                                <div class="result-meta">
                                    <span class="post-date">
                                        <i class="fas fa-calendar"></i>
                                        <?php echo get_the_date('d/m/Y'); ?>
                                    </span>

                                    <?php if (get_post_type() === 'post'): ?>
                                        <span class="post-author">
                                            <i class="fas fa-user"></i>
                                            <?php the_author(); ?>
                                        </span>

                                        <span class="post-category">
                                            <i class="fas fa-folder"></i>
                                            <?php the_category(', '); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="result-excerpt">
                                    <?php
                                    // Get excerpt and highlight search terms
                                    $excerpt = wp_trim_words(get_the_excerpt(), 25);
                                    $highlighted_excerpt = highlight_search_terms($excerpt, $search_query);
                                    echo $highlighted_excerpt;
                                    ?>
                                </div>

                                <div class="result-footer">
                                    <a href="<?php the_permalink(); ?>" class="read-more">
                                        Xem chi tiết <i class="fas fa-arrow-right"></i>
                                    </a>

                                    <!-- Relevance Score (for debugging) -->
                                    <?php if (WP_DEBUG && current_user_can('administrator')): ?>
                                        <span class="relevance-score">
                                            Score: <?php echo calculate_relevance_score(get_the_ID(), $search_query); ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Load More Button -->
                <div class="load-more-wrapper" style="display: none;">
                    <button id="load-more-results" class="btn-load-more">
                        Xem thêm kết quả
                    </button>
                </div>

                <!-- Pagination -->
                <div class="search-pagination">
                    <?php
                    the_posts_pagination(array(
                        'prev_text' => '<i class="fas fa-chevron-left"></i> Trước',
                        'next_text' => 'Tiếp <i class="fas fa-chevron-right"></i>',
                        'before_page_number' => '<span class="screen-reader-text">Trang </span>',
                    ));
                    ?>
                </div>

            <?php else: ?>

                <!-- No Results -->
                <div class="no-results">
                    <div class="no-results-icon">
                        <i class="fas fa-search"></i>
                    </div>

                    <h2>Không tìm thấy kết quả</h2>
                    <p>Không có bài viết nào phù hợp với từ khóa "<strong><?php echo esc_html($search_query); ?></strong>"</p>

                    <!-- Search Tips -->
                    <div class="search-tips">
                        <h3>Gợi ý tìm kiếm:</h3>
                        <ul>
                            <li>Kiểm tra chính tả của từ khóa</li>
                            <li>Thử sử dụng từ khóa ngắn gọn hơn</li>
                            <li>Sử dụng từ đồng nghĩa</li>
                            <li>Loại bỏ các từ không cần thiết</li>
                        </ul>
                    </div>

                    <!-- Search Again -->
                    <div class="search-again">
                        <h3>Tìm kiếm khác:</h3>
                        <?php get_search_form(); ?>
                    </div>

                    <!-- Suggested Posts -->
                    <div class="suggested-posts">
                        <h3>Bài viết gợi ý:</h3>
                        <div class="suggested-grid">
                            <?php
                            $suggested = new WP_Query(array(
                                'posts_per_page' => 6,
                                'orderby' => 'comment_count',
                                'order' => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key' => 'featured_post',
                                        'value' => '1',
                                        'compare' => '='
                                    )
                                )
                            ));

                            if ($suggested->have_posts()):
                                while ($suggested->have_posts()): $suggested->the_post();
                            ?>
                                    <div class="suggested-item">
                                        <?php if (has_post_thumbnail()): ?>
                                            <div class="suggested-thumb">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="suggested-content">
                                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                            <span class="suggested-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>