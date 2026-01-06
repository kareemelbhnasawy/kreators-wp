<?php
/**
 * The template for displaying author archive pages
 *
 * @package kreators
 */

get_header();

// Get author info
$author_id = get_queried_object_id();
$author = get_userdata($author_id);
?>

<!-- Author Header -->
<div class="kr-author-header">
    <div class="kr-container">
        <div class="kr-author-profile">
            <div class="kr-author-avatar">
                <?php echo get_avatar($author_id, 150); ?>
                <div class="kr-author-badge" title="<?php esc_attr_e('Verified Creator', 'kreators'); ?>">
                    <?php kreators_icon('check'); ?>
                </div>
            </div>
            <div class="kr-author-info">
                <h1 class="kr-author-name"><?php echo esc_html($author->display_name); ?></h1>
                <?php if (!empty($author->user_url)) : ?>
                    <a href="<?php echo esc_url($author->user_url); ?>" class="kr-author-website" target="_blank" rel="noopener noreferrer">
                        <?php kreators_icon('link'); ?>
                        <?php echo esc_html(str_replace(array('http://', 'https://'), '', $author->user_url)); ?>
                    </a>
                <?php endif; ?>
                
                <?php if (!empty($author->description)) : ?>
                    <p class="kr-author-bio"><?php echo wp_kses_post($author->description); ?></p>
                <?php endif; ?>

                <div class="kr-author-stats">
                    <div class="kr-author-stat">
                        <span class="kr-stat-value"><?php echo count_user_posts($author_id); ?></span>
                        <span class="kr-stat-label"><?php esc_html_e('Posts', 'kreators'); ?></span>
                    </div>
                    <div class="kr-author-stat">
                        <span class="kr-stat-value">
                            <?php
                            $comments_count = get_comments(array(
                                'user_id' => $author_id,
                                'count' => true,
                            ));
                            echo intval($comments_count);
                            ?>
                        </span>
                        <span class="kr-stat-label"><?php esc_html_e('Comments', 'kreators'); ?></span>
                    </div>
                    <div class="kr-author-stat">
                        <span class="kr-stat-value">
                            <?php
                            $first_post = get_posts(array(
                                'author' => $author_id,
                                'posts_per_page' => 1,
                                'orderby' => 'date',
                                'order' => 'ASC',
                            ));
                            if (!empty($first_post)) {
                                echo human_time_diff(get_the_time('U', $first_post[0]), current_time('timestamp'));
                            } else {
                                echo '-';
                            }
                            ?>
                        </span>
                        <span class="kr-stat-label"><?php esc_html_e('Member Since', 'kreators'); ?></span>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="kr-author-social">
                    <?php
                    $social_links = array(
                        'twitter' => get_the_author_meta('twitter', $author_id),
                        'facebook' => get_the_author_meta('facebook', $author_id),
                        'instagram' => get_the_author_meta('instagram', $author_id),
                        'linkedin' => get_the_author_meta('linkedin', $author_id),
                    );
                    
                    foreach ($social_links as $platform => $url) :
                        if (!empty($url)) :
                    ?>
                        <a href="<?php echo esc_url($url); ?>" class="kr-social-link" target="_blank" rel="noopener noreferrer" title="<?php echo esc_attr(ucfirst($platform)); ?>">
                            <?php kreators_icon($platform); ?>
                        </a>
                    <?php 
                        endif;
                    endforeach;
                    ?>
                </div>
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
                <div class="kr-section-header">
                    <h2 class="kr-section-title">
                        <?php kreators_icon('file-text'); ?>
                        <?php
                        printf(
                            esc_html__('Posts by %s', 'kreators'),
                            esc_html($author->display_name)
                        );
                        ?>
                    </h2>
                    <span class="kr-section-count">
                        <?php
                        $count = $GLOBALS['wp_query']->found_posts;
                        printf(
                            esc_html(_n('%s post', '%s posts', $count, 'kreators')),
                            number_format_i18n($count)
                        );
                        ?>
                    </span>
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
