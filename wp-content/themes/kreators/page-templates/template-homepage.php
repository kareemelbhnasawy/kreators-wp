<?php
/**
 * Template Name: Homepage
 * Template Post Type: page
 *
 * A custom homepage template with hero section, featured posts, and more.
 *
 * @package kreators
 */

get_header();
?>

<!-- Hero Section -->
<section class="kr-hero">
    <div class="kr-hero-bg">
        <div class="kr-hero-gradient"></div>
        <div class="kr-hero-pattern"></div>
    </div>
    <div class="kr-container">
        <div class="kr-hero-content">
            <span class="kr-hero-badge">
                <?php kreators_icon('star'); ?>
                <?php esc_html_e('Discover Amazing Creators', 'kreators'); ?>
            </span>
            <h1 class="kr-hero-title">
                <?php esc_html_e('Connect with Top', 'kreators'); ?>
                <span class="kr-hero-highlight"><?php esc_html_e('Influencers', 'kreators'); ?></span>
                <?php esc_html_e('& Creators', 'kreators'); ?>
            </h1>
            <p class="kr-hero-subtitle">
                <?php esc_html_e('The ultimate marketplace to find, collaborate, and grow with the most talented content creators and influencers worldwide.', 'kreators'); ?>
            </p>
            <div class="kr-hero-actions">
                <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop')) ?: '#'); ?>" class="kr-btn kr-btn-primary kr-btn-lg">
                    <?php esc_html_e('Explore Creators', 'kreators'); ?>
                    <?php kreators_icon('arrow-right'); ?>
                </a>
                <a href="#how-it-works" class="kr-btn kr-btn-secondary kr-btn-lg">
                    <?php esc_html_e('How It Works', 'kreators'); ?>
                </a>
            </div>
            <div class="kr-hero-stats">
                <div class="kr-hero-stat">
                    <span class="kr-hero-stat-value">10K+</span>
                    <span class="kr-hero-stat-label"><?php esc_html_e('Creators', 'kreators'); ?></span>
                </div>
                <div class="kr-hero-stat">
                    <span class="kr-hero-stat-value">5M+</span>
                    <span class="kr-hero-stat-label"><?php esc_html_e('Followers', 'kreators'); ?></span>
                </div>
                <div class="kr-hero-stat">
                    <span class="kr-hero-stat-value">2K+</span>
                    <span class="kr-hero-stat-label"><?php esc_html_e('Brands', 'kreators'); ?></span>
                </div>
            </div>
        </div>
        <div class="kr-hero-visual">
            <div class="kr-hero-cards">
                <div class="kr-hero-card kr-hero-card-1">
                    <img src="<?php echo esc_url(KREATORS_URI . '/assets/images/creator-1.jpg'); ?>" alt="">
                </div>
                <div class="kr-hero-card kr-hero-card-2">
                    <img src="<?php echo esc_url(KREATORS_URI . '/assets/images/creator-2.jpg'); ?>" alt="">
                </div>
                <div class="kr-hero-card kr-hero-card-3">
                    <img src="<?php echo esc_url(KREATORS_URI . '/assets/images/creator-3.jpg'); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="kr-section kr-section-categories">
    <div class="kr-container">
        <div class="kr-section-header kr-text-center">
            <span class="kr-section-badge"><?php esc_html_e('Browse', 'kreators'); ?></span>
            <h2 class="kr-section-title"><?php esc_html_e('Popular Categories', 'kreators'); ?></h2>
            <p class="kr-section-subtitle"><?php esc_html_e('Find creators that match your brand\'s niche and audience.', 'kreators'); ?></p>
        </div>
        <div class="kr-categories-grid">
            <?php
            $categories = get_categories(array(
                'orderby' => 'count',
                'order'   => 'DESC',
                'number'  => 8,
                'hide_empty' => true,
            ));
            
            $category_icons = array(
                'lifestyle' => 'heart',
                'fashion' => 'shopping-bag',
                'beauty' => 'star',
                'fitness' => 'activity',
                'food' => 'coffee',
                'travel' => 'map-pin',
                'tech' => 'smartphone',
                'gaming' => 'monitor',
                'business' => 'briefcase',
                'music' => 'music',
            );
            
            foreach ($categories as $category) :
                $icon = 'folder';
                foreach ($category_icons as $key => $value) {
                    if (stripos($category->name, $key) !== false) {
                        $icon = $value;
                        break;
                    }
                }
            ?>
                <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" class="kr-category-card">
                    <div class="kr-category-icon">
                        <?php kreators_icon($icon); ?>
                    </div>
                    <h3 class="kr-category-name"><?php echo esc_html($category->name); ?></h3>
                    <span class="kr-category-count">
                        <?php 
                        printf(
                            esc_html(_n('%s creator', '%s creators', $category->count, 'kreators')),
                            number_format_i18n($category->count)
                        );
                        ?>
                    </span>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Featured Posts Section -->
<section class="kr-section kr-section-featured">
    <div class="kr-container">
        <div class="kr-section-header">
            <div>
                <span class="kr-section-badge"><?php esc_html_e('Featured', 'kreators'); ?></span>
                <h2 class="kr-section-title"><?php esc_html_e('Trending Creators', 'kreators'); ?></h2>
            </div>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" class="kr-btn kr-btn-secondary">
                <?php esc_html_e('View All', 'kreators'); ?>
                <?php kreators_icon('arrow-right'); ?>
            </a>
        </div>
        <div class="kr-posts-grid">
            <?php
            $featured_posts = new WP_Query(array(
                'posts_per_page' => 6,
                'post_status'    => 'publish',
                'ignore_sticky_posts' => true,
            ));
            
            if ($featured_posts->have_posts()) :
                while ($featured_posts->have_posts()) : $featured_posts->the_post();
                    get_template_part('template-parts/content', 'card');
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" class="kr-section kr-section-how-it-works">
    <div class="kr-container">
        <div class="kr-section-header kr-text-center">
            <span class="kr-section-badge"><?php esc_html_e('Simple Steps', 'kreators'); ?></span>
            <h2 class="kr-section-title"><?php esc_html_e('How It Works', 'kreators'); ?></h2>
            <p class="kr-section-subtitle"><?php esc_html_e('Getting started is easy. Find your perfect creator match in just a few steps.', 'kreators'); ?></p>
        </div>
        <div class="kr-steps-grid">
            <div class="kr-step">
                <div class="kr-step-number">1</div>
                <div class="kr-step-icon">
                    <?php kreators_icon('search'); ?>
                </div>
                <h3 class="kr-step-title"><?php esc_html_e('Browse Creators', 'kreators'); ?></h3>
                <p class="kr-step-desc"><?php esc_html_e('Search through our curated list of verified creators and influencers.', 'kreators'); ?></p>
            </div>
            <div class="kr-step">
                <div class="kr-step-number">2</div>
                <div class="kr-step-icon">
                    <?php kreators_icon('message-circle'); ?>
                </div>
                <h3 class="kr-step-title"><?php esc_html_e('Connect & Chat', 'kreators'); ?></h3>
                <p class="kr-step-desc"><?php esc_html_e('Reach out directly to discuss your campaign requirements and goals.', 'kreators'); ?></p>
            </div>
            <div class="kr-step">
                <div class="kr-step-number">3</div>
                <div class="kr-step-icon">
                    <?php kreators_icon('check-circle'); ?>
                </div>
                <h3 class="kr-step-title"><?php esc_html_e('Collaborate', 'kreators'); ?></h3>
                <p class="kr-step-desc"><?php esc_html_e('Work together to create amazing content that resonates with your audience.', 'kreators'); ?></p>
            </div>
            <div class="kr-step">
                <div class="kr-step-number">4</div>
                <div class="kr-step-icon">
                    <?php kreators_icon('trending-up'); ?>
                </div>
                <h3 class="kr-step-title"><?php esc_html_e('Grow Together', 'kreators'); ?></h3>
                <p class="kr-step-desc"><?php esc_html_e('Track results and build long-lasting partnerships that drive growth.', 'kreators'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="kr-section kr-section-cta">
    <div class="kr-container">
        <div class="kr-cta-card">
            <div class="kr-cta-content">
                <h2 class="kr-cta-title"><?php esc_html_e('Ready to Start Creating?', 'kreators'); ?></h2>
                <p class="kr-cta-subtitle"><?php esc_html_e('Join thousands of brands and creators who are already growing together.', 'kreators'); ?></p>
                <div class="kr-cta-buttons">
                    <a href="<?php echo esc_url(wp_registration_url()); ?>" class="kr-btn kr-btn-white kr-btn-lg">
                        <?php esc_html_e('Get Started Free', 'kreators'); ?>
                    </a>
                    <a href="#" class="kr-btn kr-btn-outline-white kr-btn-lg">
                        <?php esc_html_e('Learn More', 'kreators'); ?>
                    </a>
                </div>
            </div>
            <div class="kr-cta-visual">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="kr-cta-blob">
                    <path fill="rgba(255,255,255,0.1)" d="M44.7,-76.4C58.8,-69.2,71.8,-58.3,79.6,-44.6C87.5,-30.9,90.2,-15.4,89.1,-0.7C87.9,14.1,82.8,28.1,74.6,40.2C66.3,52.3,54.9,62.4,42,69.3C29.1,76.2,14.6,79.8,-0.4,80.5C-15.4,81.2,-30.8,78.9,-43.8,72C-56.8,65.1,-67.4,53.6,-75.2,40.2C-83,26.8,-88,13.4,-87.7,0.2C-87.4,-13.1,-81.8,-26.1,-73.8,-37.4C-65.8,-48.7,-55.4,-58.2,-43.3,-66.5C-31.2,-74.8,-17.3,-81.9,-0.8,-80.5C15.6,-79.1,30.6,-69.3,44.7,-76.4Z" transform="translate(100 100)" />
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- Page Content (if any) -->
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php if (get_the_content()) : ?>
            <section class="kr-section kr-section-content">
                <div class="kr-container">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php
get_footer();
