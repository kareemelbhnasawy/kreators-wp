<?php
/**
 * The main template file
 *
 * @package kreators
 */

get_header();
?>

<!-- Breadcrumbs -->
<div class="kr-breadcrumbs">
    <div class="kr-container">
        <?php kreators_breadcrumbs(); ?>
        <h1 class="kr-breadcrumbs-title">
            <?php
            if (is_home() && !is_front_page()) {
                single_post_title();
            } else {
                esc_html_e('Latest Posts', 'kreators');
            }
            ?>
        </h1>
        <p class="kr-breadcrumbs-subtitle"><?php esc_html_e('Discover insights, tips, and stories from our community', 'kreators'); ?></p>
    </div>
</div>

<!-- Main Content -->
<main id="primary" class="kr-main" role="main">
    <div class="kr-container">
        <div class="kr-content-wrapper">
            <!-- Posts Grid -->
            <div class="kr-content">
                <?php if (have_posts()) : ?>
                    <div class="kr-posts-grid">
                        <?php
                        while (have_posts()) :
                            the_post();
                            get_template_part('template-parts/content', 'card');
                        endwhile;
                        ?>
                    </div>

                    <?php kreators_pagination(); ?>

                <?php else : ?>
                    <?php get_template_part('template-parts/content', 'none'); ?>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <?php if (is_active_sidebar('sidebar-1')) : ?>
                <aside class="kr-sidebar" role="complementary">
                    <?php get_sidebar(); ?>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php
get_footer();
