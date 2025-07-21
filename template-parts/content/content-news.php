<div class="news-item">
    <?php if (has_post_thumbnail()): ?>
        <div class="news-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('medium'); ?>
            </a>
        </div>
    <?php endif; ?>

    <div class="news-content">
        <div class="news-meta">
            <span class="date"><?php echo get_the_date(); ?></span>
            <span class="author">Bởi <?php the_author(); ?></span>
        </div>

        <h3 class="news-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <div class="news-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="read-more">Đọc thêm</a>
    </div>
</div>