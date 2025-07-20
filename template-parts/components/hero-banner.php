<?php
/**
 * Hero Banner Component
 */
?>
<section class="hero-banner" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
    url('<?php echo esc_url(get_theme_mod('hero_banner_bg')); ?>');">
    <div class="container">
        <div class="hero-content">
            <?php if (get_theme_mod('hero_banner_title')): ?>
                <h1><?php echo esc_html(get_theme_mod('hero_banner_title')); ?></h1>
            <?php endif; ?>

            <?php if (get_theme_mod('hero_banner_desc')): ?>
                <p><?php echo esc_html(get_theme_mod('hero_banner_desc')); ?></p>
            <?php endif; ?>

            <?php if (get_theme_mod('hero_button_text') && get_theme_mod('hero_button_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('hero_button_url')); ?>" class="hero-button">
                    <?php echo esc_html(get_theme_mod('hero_button_text')); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>