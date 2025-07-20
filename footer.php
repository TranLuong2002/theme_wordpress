<footer class="site-footer">
    <div class="container">
        <div class="footer-widgets">
            <!-- Logo & Contact -->
            <div class="footer-widget">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <h3 class="site-title"><?php bloginfo('name'); ?></h3>
                <?php endif; ?>

                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> 123 Street, City, Country</p>
                    <p><i class="fas fa-phone"></i> +1 234 567 890</p>
                    <p><i class="fas fa-envelope"></i> info@example.com</p>
                </div>

                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>

            <!-- About Menu -->
            <div class="footer-widget">
                <h3>About Us</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_about',
                    'menu_class' => 'footer-menu'
                ));
                ?>
            </div>

            <!-- Services Menu -->
            <div class="footer-widget">
                <h3>Our Services</h3>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer_services',
                    'menu_class' => 'footer-menu'
                ));
                ?>
            </div>

            <!-- Newsletter -->
            <div class="footer-widget">
                <h3>Contact Us</h3>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit" class="btn-submit">Send</button>
                </form>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>