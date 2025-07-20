<?php get_header(); ?>

<main class="site-main">
    <div class="container">
        <?php if (have_posts()): ?>
            <?php while (have_posts()): the_post(); ?>
                <?php get_template_part('template-parts/content'); ?>
            <?php endwhile; ?>

            <?php the_posts_pagination(); ?>
        <?php else: ?>
            <p><?php _e('No posts found.', 'luong dev'); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>