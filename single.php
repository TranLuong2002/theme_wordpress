<?php get_header(); ?>

<main class="site-main">
    <?php while (have_posts()): the_post(); ?>
        
        <!-- Hero Section cho Single Post -->
        <section class="single-hero">
            <div class="container">
                <div class="breadcrumb">
                    <a href="<?php echo home_url(); ?>">Trang chủ</a>
                    <span class="separator">/</span>
                    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Tin tức</a>
                    <span class="separator">/</span>
                    <span class="current"><?php the_title(); ?></span>
                </div>
                
                <h1 class="single-title"><?php the_title(); ?></h1>
                
                <div class="post-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        <span><?php echo get_the_date('d/m/Y'); ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-user"></i>
                        <span>Bởi <?php the_author(); ?></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-folder"></i>
                        <span><?php the_category(', '); ?></span>
                    </div>
                    <?php if (get_comments_number() > 0): ?>
                        <div class="meta-item">
                            <i class="fas fa-comments"></i>
                            <span><?php comments_number('0 bình luận', '1 bình luận', '% bình luận'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Single Post Content -->
        <section class="single-content">
            <div class="container">
                <div class="content-wrapper">
                    <!-- Main Content -->
                    <div class="main-content">
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()): ?>
                            <div class="featured-image">
                                <?php the_post_thumbnail('large', array('class' => 'img-responsive')); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Post Content -->
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags -->
                        <?php if (has_tag()): ?>
                            <div class="post-tags">
                                <h4>Tags:</h4>
                                <div class="tags-list">
                                    <?php the_tags('', '', ''); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Author Box -->
                        <div class="author-box">
                            <div class="author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                            </div>
                            <div class="author-info">
                                <h4>Về tác giả: <?php the_author(); ?></h4>
                                <p><?php echo get_the_author_meta('description') ?: 'Chưa có thông tin về tác giả.'; ?></p>
                            </div>
                        </div>

                        <!-- Post Navigation -->
                        <div class="post-navigation">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>
                            
                            <?php if ($prev_post): ?>
                                <div class="nav-previous">
                                    <span class="nav-label">Bài trước</span>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                                        <?php echo $prev_post->post_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($next_post): ?>
                                <div class="nav-next">
                                    <span class="nav-label">Bài tiếp theo</span>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                                        <?php echo $next_post->post_title; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Comments -->
                        <?php
                        if (comments_open() || get_comments_number()):
                            comments_template();
                        endif;
                        ?>
                    </div>

                    <!-- Sidebar -->
                    <aside class="sidebar">
                        <?php get_template_part('template-parts/components/single-sidebar'); ?>
                    </aside>
                </div>
            </div>
        </section>

    <?php endwhile; ?>
</main>

<?php get_footer(); ?>