<?php
/**
 * Template part for displaying a message when no posts are found
 *
 * @package kreators
 */
?>

<section class="kr-no-results">
    <div class="kr-card" style="text-align: center; padding: var(--kr-space-12);">
        <h2 class="kr-card-title"><?php esc_html_e('Nothing Found', 'kreators'); ?></h2>

        <?php if (is_home() && current_user_can('publish_posts')) : ?>
            <p class="kr-card-excerpt">
                <?php
                printf(
                    wp_kses(
                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kreators'),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                        )
                    ),
                    esc_url(admin_url('post-new.php'))
                );
                ?>
            </p>
        <?php elseif (is_search()) : ?>
            <p class="kr-card-excerpt">
                <?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kreators'); ?>
            </p>
            <div style="max-width: 400px; margin: var(--kr-space-6) auto 0;">
                <?php get_search_form(); ?>
            </div>
        <?php else : ?>
            <p class="kr-card-excerpt">
                <?php esc_html_e("It seems we can't find what you're looking for. Perhaps searching can help.", 'kreators'); ?>
            </p>
            <div style="max-width: 400px; margin: var(--kr-space-6) auto 0;">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
