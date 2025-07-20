<article class="news-item">
    <div class="news-thumbnail">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('medium'); ?>
        <?php endif; ?>
    </div>
    <div class="news-content">
        <h3 class="news-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <div class="news-meta">
            <span class="news-date"><?php echo get_the_date(); ?></span>
        </div>
        <div class="news-excerpt">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>