<?php
/**
 * The template for displaying category archive pages
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
            <?php single_cat_title(); ?>
        </h1>
        <?php
        $category_description = category_description();
        if ($category_description) :
        ?>
            <p class="kr-breadcrumbs-subtitle"><?php echo wp_kses_post($category_description); ?></p>
        <?php else : ?>
            <p class="kr-breadcrumbs-subtitle">
                <?php
                printf(
                    esc_html__('Browsing all posts in %s', 'kreators'),
                    single_cat_title('', false)
                );
                ?>
            </p>
        <?php endif; ?>
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
