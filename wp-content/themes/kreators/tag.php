<?php
/**
 * The template for displaying tag archive pages
 *
 * @package kreators
 */

get_header();
?>

<!-- Breadcrumbs -->
<div class="kr-breadcrumbs">
    <div class="kr-container">
        <?php kreators_breadcrumbs(); ?>
        <div class="kr-breadcrumbs-header">
            <span class="kr-breadcrumbs-icon kr-tag-icon">
                <?php kreators_icon('tag'); ?>
            </span>
            <div>
                <h1 class="kr-breadcrumbs-title"><?php single_tag_title(); ?></h1>
                <?php if (tag_description()) : ?>
                    <p class="kr-breadcrumbs-subtitle"><?php echo tag_description(); ?></p>
                <?php else : ?>
                    <p class="kr-breadcrumbs-subtitle">
                        <?php
                        $count = $GLOBALS['wp_query']->found_posts;
                        printf(
                            esc_html(_n('%s post tagged', '%s posts tagged', $count, 'kreators')),
                            number_format_i18n($count)
                        );
                        ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
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
