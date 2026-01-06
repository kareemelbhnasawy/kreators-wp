<?php
/**
 * The template for displaying search results pages
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
            printf(
                esc_html__('Search Results for: %s', 'kreators'),
                '<span>' . get_search_query() . '</span>'
            );
            ?>
        </h1>
        <p class="kr-breadcrumbs-subtitle">
            <?php
            global $wp_query;
            $found = $wp_query->found_posts;
            printf(
                esc_html(_n('%s result found', '%s results found', $found, 'kreators')),
                number_format_i18n($found)
            );
            ?>
        </p>
    </div>
</div>

<!-- Main Content -->
<main id="primary" class="kr-main" role="main">
    <div class="kr-container">
        <div class="kr-content-wrapper">
            <!-- Posts Grid -->
            <div class="kr-content">
                <!-- Search Again Box -->
                <div class="kr-widget kr-mb-8">
                    <form role="search" method="get" class="kr-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="kr-search-input" placeholder="<?php esc_attr_e('Search again...', 'kreators'); ?>" value="<?php echo get_search_query(); ?>" name="s">
                        <button type="submit" class="kr-search-btn">
                            <?php kreators_icon('search'); ?>
                            <span class="btn-text"><?php esc_html_e('Search', 'kreators'); ?></span>
                        </button>
                    </form>
                </div>

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
