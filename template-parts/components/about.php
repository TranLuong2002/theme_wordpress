<section class="about-section">
    <div class="container">
        <h2 class="section-title">Về chúng tôi</h2>
        <div class="about-content">
            <?php if (get_theme_mod('about_content')): ?>
                <div class="about-text">
                    <?php echo wp_kses_post(get_theme_mod('about_content')); ?>
                </div>
            <?php endif; ?>
            
            <?php if (get_theme_mod('about_image')): ?>
                <div class="about-image">
                    <img src="<?php echo esc_url(get_theme_mod('about_image')); ?>" alt="About Us">
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>