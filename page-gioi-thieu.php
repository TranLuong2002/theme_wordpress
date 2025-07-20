<?php
get_header(); ?>

<main id="main" class="site-main">
    <section class="page-banner">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
        </div>
    </section>

    <section class="about-page">
        <div class="container boxed">
            <?php while (have_posts()) : the_post(); ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>