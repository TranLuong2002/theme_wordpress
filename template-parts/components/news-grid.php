
<!-- News Section -->
<section class="news-section">
    <div class="container">
        <h2 class="section-title">Tin tức mới nhất</h2>
        <div class="news-grid">
            <?php
            // Get current page number - sử dụng custom parameter để tránh conflict
            $current_page = isset($_GET['news_page']) ? (int)$_GET['news_page'] : 1;
            
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'paged' => $current_page
            );
            $news_query = new WP_Query($args);

            if ($news_query->have_posts()):
                while ($news_query->have_posts()):
                    $news_query->the_post();
                    get_template_part('template-parts/content/content', 'news');
                endwhile;
            else:
                echo '<p class="no-posts">Không có bài viết nào.</p>';
            endif;
            ?>
        </div>

        <!-- Pagination -->
        <?php if ($news_query->max_num_pages > 1): ?>
            <div class="news-pagination">
                <?php
                // Custom pagination for news section
                $total_pages = $news_query->max_num_pages;
                $current_url = remove_query_arg('news_page');
                
                echo '<ul class="pagination-list">';
                
                // Previous button
                if ($current_page > 1) {
                    $prev_page = $current_page - 1;
                    $prev_url = $prev_page == 1 ? $current_url : add_query_arg('news_page', $prev_page, $current_url);
                    echo '<li class="page-item">
                        <a href="' . esc_url($prev_url) . '" class="prev">
                            <i class="fas fa-chevron-left"></i> Trước
                        </a>
                    </li>';
                }
                
                // Page numbers
                for ($i = 1; $i <= $total_pages; $i++) {
                    $page_url = $i == 1 ? $current_url : add_query_arg('news_page', $i, $current_url);
                    
                    if ($i == $current_page) {
                        echo '<li class="page-item active">
                            <span>' . $i . '</span>
                        </li>';
                    } else {
                        echo '<li class="page-item">
                            <a href="' . esc_url($page_url) . '">' . $i . '</a>
                        </li>';
                    }
                }
                
                // Next button
                if ($current_page < $total_pages) {
                    $next_page = $current_page + 1;
                    $next_url = add_query_arg('news_page', $next_page, $current_url);
                    echo '<li class="page-item">
                        <a href="' . esc_url($next_url) . '" class="next">
                            Tiếp <i class="fas fa-chevron-right"></i>
                        </a>
                    </li>';
                }
                
                echo '</ul>';
                ?>
            </div>
        <?php endif; ?>

        <?php wp_reset_postdata(); ?>
    </div>
</section>