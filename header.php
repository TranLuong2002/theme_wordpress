<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
        <div class="container">
            <div class="header-wrapper">
                <div class="site-branding">
                    <?php if (has_custom_logo()): ?>
                        <?php the_custom_logo(); ?>
                    <?php else: ?>
                        <h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a></h1>
                    <?php endif; ?>
                </div>

                <nav class="main-navigation">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'primary-menu'
                    )); ?>
                </nav>

                <div class="header-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </header>