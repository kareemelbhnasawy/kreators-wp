<?php
/**
 * The template for displaying all single posts
 *
 * @package kreators
 */

get_header();
?>

<!-- Breadcrumbs -->
<div class="kr-breadcrumbs">
    <div class="kr-container">
        <?php kreators_breadcrumbs(); ?>
        <h1 class="kr-breadcrumbs-title"><?php the_title(); ?></h1>
        <div class="kr-breadcrumbs-meta">
            <span><?php kreators_posted_on(); ?></span>
            <span>•</span>
            <span><?php echo esc_html(kreators_reading_time()); ?></span>
            <span>•</span>
            <span><?php kreators_posted_by(); ?></span>
        </div>
    </div>
</div>

<!-- Main Content -->
<main id="primary" class="kr-main" role="main">
    <div class="kr-container">
        <div class="kr-content-wrapper">
            <!-- Post Content -->
            <div class="kr-content">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('kr-single-post'); ?>>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="kr-single-post-image">
                                <?php the_post_thumbnail('kreators-single', array('loading' => 'lazy')); ?>
                            </div>
                        <?php endif; ?>

                        <div class="kr-single-post-content">
                            <?php
                            the_content();

                            wp_link_pages(array(
                                'before' => '<div class="page-links">' . esc_html__('Pages:', 'kreators'),
                                'after'  => '</div>',
                            ));
                            ?>

                            <!-- Tags -->
                            <?php
                            $tags = get_the_tags();
                            if ($tags) :
                            ?>
                                <div class="kr-single-post-tags">
                                    <?php foreach ($tags as $tag) : ?>
                                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" class="kr-widget-tag">
                                            #<?php echo esc_html($tag->name); ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Share -->
                            <div class="kr-single-post-share">
                                <span class="kr-single-post-share-title"><?php esc_html_e('Share:', 'kreators'); ?></span>
                                <div class="kr-single-post-share-links">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink()); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on Facebook', 'kreators'); ?>">
                                        <?php kreators_icon('facebook'); ?>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url(get_the_permalink()); ?>&text=<?php echo esc_attr(get_the_title()); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on Twitter', 'kreators'); ?>">
                                        <?php kreators_icon('twitter'); ?>
                                    </a>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo esc_url(get_the_permalink()); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Share on LinkedIn', 'kreators'); ?>">
                                        <?php kreators_icon('linkedin'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Author Box -->
                        <div class="kr-author-box">
                            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'kr-author-avatar')); ?>
                            <div class="kr-author-info">
                                <h4 class="kr-author-name"><?php the_author(); ?></h4>
                                <p class="kr-author-bio">
                                    <?php echo esc_html(get_the_author_meta('description')); ?>
                                </p>
                            </div>
                        </div>
                    </article>

                    <!-- Post Navigation -->
                    <nav class="kr-post-navigation">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        <div class="kr-post-nav-grid" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: var(--kr-space-6); margin-top: var(--kr-space-8);">
                            <?php if ($prev_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="kr-card" style="text-decoration: none;">
                                    <div class="kr-card-content">
                                        <span style="font-size: var(--kr-font-size-sm); color: var(--kr-gray-500);"><?php esc_html_e('← Previous Post', 'kreators'); ?></span>
                                        <h4 class="kr-card-title" style="margin-top: var(--kr-space-2);"><?php echo esc_html($prev_post->post_title); ?></h4>
                                    </div>
                                </a>
                            <?php else : ?>
                                <div></div>
                            <?php endif; ?>

                            <?php if ($next_post) : ?>
                                <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="kr-card" style="text-decoration: none; text-align: right;">
                                    <div class="kr-card-content">
                                        <span style="font-size: var(--kr-font-size-sm); color: var(--kr-gray-500);"><?php esc_html_e('Next Post →', 'kreators'); ?></span>
                                        <h4 class="kr-card-title" style="margin-top: var(--kr-space-2);"><?php echo esc_html($next_post->post_title); ?></h4>
                                    </div>
                                </a>
                            <?php endif; ?>
                        </div>
                    </nav>

                    <!-- Comments -->
                    <?php
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile;
                ?>
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
