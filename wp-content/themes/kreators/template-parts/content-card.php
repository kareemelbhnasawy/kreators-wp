<?php
/**
 * Template part for displaying posts as cards
 *
 * @package kreators
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('kr-card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="kr-card-image">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('kreators-card', array('loading' => 'lazy')); ?>
            </a>
            <?php
            $categories = get_the_category();
            if (!empty($categories)) :
            ?>
                <span class="kr-card-badge"><?php echo esc_html($categories[0]->name); ?></span>
            <?php endif; ?>
            <button class="kr-card-favorite" aria-label="<?php esc_attr_e('Add to favorites', 'kreators'); ?>">
                <?php kreators_icon('heart'); ?>
            </button>
        </div>
    <?php endif; ?>

    <div class="kr-card-content">
        <!-- Meta -->
        <div class="kr-card-meta">
            <span class="kr-card-meta-item">
                <?php kreators_icon('calendar'); ?>
                <?php echo esc_html(get_the_date('M j, Y')); ?>
            </span>
            <span class="kr-card-meta-item">
                <?php kreators_icon('clock'); ?>
                <?php echo esc_html(kreators_reading_time()); ?>
            </span>
        </div>

        <!-- Title -->
        <h3 class="kr-card-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <!-- Excerpt -->
        <div class="kr-card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <!-- Footer -->
        <div class="kr-card-footer">
            <div class="kr-card-author">
                <?php echo get_avatar(get_the_author_meta('ID'), 36, '', '', array('class' => 'kr-card-author-avatar')); ?>
                <div class="kr-card-author-info">
                    <span class="kr-card-author-name"><?php the_author(); ?></span>
                    <span class="kr-card-author-date"><?php echo esc_html(get_the_date('M j')); ?></span>
                </div>
            </div>
            <a href="<?php the_permalink(); ?>" class="kr-card-link">
                <?php esc_html_e('Read More', 'kreators'); ?>
                <?php kreators_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</article>
