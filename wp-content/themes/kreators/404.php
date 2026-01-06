<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package kreators
 */

get_header();
?>

<main id="primary" class="kr-main" role="main">
    <div class="kr-container">
        <div class="kr-error-page">
            <div class="kr-error-content">
                <!-- Error Illustration -->
                <div class="kr-error-illustration">
                    <div class="kr-error-number">
                        <span class="num">4</span>
                        <span class="zero">
                            <svg viewBox="0 0 100 100">
                                <circle cx="50" cy="50" r="45" fill="none" stroke="currentColor" stroke-width="8"/>
                                <circle cx="35" cy="40" r="6" fill="currentColor"/>
                                <circle cx="65" cy="40" r="6" fill="currentColor"/>
                                <path d="M 30 70 Q 50 55 70 70" stroke="currentColor" stroke-width="5" fill="none" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <span class="num">4</span>
                    </div>
                </div>

                <!-- Error Message -->
                <h1 class="kr-error-title"><?php esc_html_e("Oops! Page Not Found", 'kreators'); ?></h1>
                <p class="kr-error-description">
                    <?php esc_html_e("The page you're looking for doesn't exist or has been moved. Don't worry, let's get you back on track!", 'kreators'); ?>
                </p>

                <!-- Quick Actions -->
                <div class="kr-error-actions">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="kr-btn kr-btn-primary">
                        <?php kreators_icon('home'); ?>
                        <?php esc_html_e('Back to Home', 'kreators'); ?>
                    </a>
                    <button type="button" class="kr-btn kr-btn-secondary" onclick="history.back()">
                        <?php kreators_icon('arrow-left'); ?>
                        <?php esc_html_e('Go Back', 'kreators'); ?>
                    </button>
                </div>

                <!-- Search Form -->
                <div class="kr-error-search">
                    <p class="kr-error-search-label"><?php esc_html_e('Or try searching:', 'kreators'); ?></p>
                    <form role="search" method="get" class="kr-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="search" class="kr-search-input" placeholder="<?php esc_attr_e('Search for something...', 'kreators'); ?>" name="s">
                        <button type="submit" class="kr-search-btn">
                            <?php kreators_icon('search'); ?>
                        </button>
                    </form>
                </div>

                <!-- Helpful Links -->
                <div class="kr-error-links">
                    <h3><?php esc_html_e('You might be interested in:', 'kreators'); ?></h3>
                    <div class="kr-error-links-grid">
                        <?php
                        // Get popular categories
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 4,
                            'hide_empty' => true,
                        ));
                        
                        if (!empty($categories)) :
                            foreach ($categories as $category) :
                        ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="kr-error-link-card">
                                <?php kreators_icon('folder'); ?>
                                <span><?php echo esc_html($category->name); ?></span>
                                <span class="count"><?php echo esc_html($category->count); ?> <?php esc_html_e('posts', 'kreators'); ?></span>
                            </a>
                        <?php 
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="kr-error-recent">
                    <h3><?php esc_html_e('Latest Posts', 'kreators'); ?></h3>
                    <div class="kr-error-posts">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'posts_per_page' => 3,
                            'post_status' => 'publish',
                            'ignore_sticky_posts' => true,
                        ));
                        
                        if ($recent_posts->have_posts()) :
                            while ($recent_posts->have_posts()) : $recent_posts->the_post();
                        ?>
                            <a href="<?php the_permalink(); ?>" class="kr-error-post">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="kr-error-post-image">
                                        <?php the_post_thumbnail('thumbnail'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="kr-error-post-content">
                                    <h4><?php the_title(); ?></h4>
                                    <span class="date"><?php echo get_the_date(); ?></span>
                                </div>
                            </a>
                        <?php 
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
