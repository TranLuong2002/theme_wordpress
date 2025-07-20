<!-- News Section -->
    <section class="news-section">
        <div class="container">
            <h2 class="section-title">Tin tức mới nhất</h2>
            <div class="news-grid">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'orderby' => 'date',
                    'order' => 'DESC'
                );
                $news_query = new WP_Query($args);

                if ($news_query->have_posts()):
                    while ($news_query->have_posts()):
                        $news_query->the_post();
                        get_template_part('template-parts/content/content', 'news');
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>