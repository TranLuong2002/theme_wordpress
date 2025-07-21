<?php get_header(); ?>

<main class="site-main">
    <!-- Category Header -->
    <section class="category-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="<?php echo home_url(); ?>">Trang chủ</a>
                <span class="separator">/</span>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Tin tức</a>
                <span class="separator">/</span>
                <span class="current"><?php single_cat_title(); ?></span>
            </div>

            <div class="category-info">
                <h1 class="category-title"><?php single_cat_title(); ?></h1>
                
                <?php 
                $category_description = category_description();
                if (!empty($category_description)): 
                ?>
                    <div class="category-description">
                        <?php echo $category_description; ?>
                    </div>
                <?php endif; ?>
                
                <div class="category-meta">
                    <span class="post-count">
                        <i class="fas fa-file-alt"></i>
                        <?php 
                        $category = get_queried_object();
                        printf('%d bài viết', $category->count);
                        ?>
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Content -->
    <section class="category-content">
        <div class="container">
            <div class="content-wrapper">
                <!-- Main Content -->
                <div class="main-content">
                    
                    <!-- Category Filter/Sort -->
                    <div class="category-filters">
                        <div class="filter-left">
                            <span class="results-info">
                                Hiển thị 
                                <?php 
                                global $wp_query;
                                $paged = max(1, get_query_var('paged'));
                                $per_page = get_option('posts_per_page');
                                $start = ($paged - 1) * $per_page + 1;
                                $end = min($paged * $per_page, $wp_query->found_posts);
                                printf('%d-%d của %d bài viết', $start, $end, $wp_query->found_posts);
                                ?>
                            </span>
                        </div>
                        
                        <div class="filter-right">
                            <div class="view-toggle">
                                <button class="view-btn grid-view active" data-view="grid">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="view-btn list-view" data-view="list">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                            
                            <div class="sort-options">
                                <select id="category-sort" onchange="sortCategoryPosts(this.value)">
                                    <option value="date_desc">Mới nhất</option>
                                    <option value="date_asc">Cũ nhất</option>
                                    <option value="title_asc">Tiêu đề A-Z</option>
                                    <option value="title_desc">Tiêu đề Z-A</option>
                                    <option value="comment_count">Nhiều bình luận nhất</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Grid/List -->
                    <?php if (have_posts()): ?>
                        <div class="category-posts-grid" id="posts-container">
                            <?php while (have_posts()): the_post(); ?>
                                <article class="category-post-item">
                                    <?php if (has_post_thumbnail()): ?>
                                        <div class="post-thumbnail">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('news-thumbnail'); ?>
                                            </a>
                                            
                                            <!-- Post Date Badge -->
                                            <div class="post-date-badge">
                                                <span class="day"><?php echo get_the_date('d'); ?></span>
                                                <span class="month"><?php echo get_the_date('M'); ?></span>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <div class="post-content">
                                        <div class="post-meta">
                                            <span class="post-author">
                                                <i class="fas fa-user"></i>
                                                <?php the_author(); ?>
                                            </span>
                                            <span class="post-comments">
                                                <i class="fas fa-comments"></i>
                                                <?php comments_number('0', '1', '%'); ?>
                                            </span>
                                            <span class="post-views">
                                                <i class="fas fa-eye"></i>
                                                <?php echo get_post_views(get_the_ID()); ?>
                                            </span>
                                        </div>

                                        <h2 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>

                                        <div class="post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>

                                        <div class="post-footer">
                                            <a href="<?php the_permalink(); ?>" class="read-more">
                                                Đọc thêm <i class="fas fa-arrow-right"></i>
                                            </a>
                                            
                                            <!-- Post Tags -->
                                            <?php if (has_tag()): ?>
                                                <div class="post-tags">
                                                    <?php the_tags('', '', ''); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="category-pagination">
                            <?php 
                            the_posts_pagination(array(
                                'prev_text' => '<i class="fas fa-chevron-left"></i> Trước',
                                'next_text' => 'Tiếp <i class="fas fa-chevron-right"></i>',
                                'before_page_number' => '<span class="screen-reader-text">Trang </span>',
                            )); 
                            ?>
                        </div>

                    <?php else: ?>
                        <!-- No Posts -->
                        <div class="no-posts">
                            <div class="no-posts-icon">
                                <i class="fas fa-folder-open"></i>
                            </div>
                            <h3>Chưa có bài viết nào</h3>
                            <p>Danh mục này hiện chưa có bài viết nào.</p>
                            <a href="<?php echo home_url(); ?>" class="back-home">
                                <i class="fas fa-home"></i> Về trang chủ
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <aside class="sidebar">
                    <?php get_template_part('template-parts/components/category-sidebar'); ?>
                </aside>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>