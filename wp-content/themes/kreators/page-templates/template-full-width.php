<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * @package kreators
 */

get_header();
?>

<main id="primary" class="kr-main kr-main-full-width" role="main">
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <article id="page-<?php the_ID(); ?>" <?php post_class('kr-page-content'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <div class="kr-page-hero">
                    <div class="kr-page-hero-image">
                        <?php the_post_thumbnail('full'); ?>
                    </div>
                    <div class="kr-page-hero-overlay">
                        <div class="kr-container">
                            <h1 class="kr-page-hero-title"><?php the_title(); ?></h1>
                        </div>
                    </div>
                </div>
            <?php else : ?>
                <div class="kr-breadcrumbs">
                    <div class="kr-container">
                        <?php kreators_breadcrumbs(); ?>
                        <h1 class="kr-breadcrumbs-title"><?php the_title(); ?></h1>
                    </div>
                </div>
            <?php endif; ?>

            <div class="kr-container">
                <div class="kr-page-full-content">
                    <?php the_content(); ?>

                    <?php
                    wp_link_pages(array(
                        'before'      => '<div class="kr-page-links"><span class="kr-page-links-title">' . esc_html__('Pages:', 'kreators') . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    ));
                    ?>
                </div>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
