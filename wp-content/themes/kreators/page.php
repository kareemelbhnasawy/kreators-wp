<?php
/**
 * The template for displaying all pages
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
    </div>
</div>

<!-- Main Content -->
<main id="primary" class="kr-main" role="main">
    <div class="kr-container">
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
                </div>

                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
