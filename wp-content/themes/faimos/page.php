<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package faimos
 */

get_header(); 

global $faimos_redux;

$page_slider              = get_post_meta( get_the_ID(), 'select_revslider_shortcode', true );
$page_sidebar             = get_post_meta( get_the_ID(), 'select_page_sidebar',        true );
$breadcrumbs_on_off       = get_post_meta( get_the_ID(), 'breadcrumbs_on_off',         true );
$page_spacing             = get_post_meta( get_the_ID(), 'page_spacing',               true );
?>

    <?php if ($breadcrumbs_on_off == 'yes') { ?>
    <!-- Breadcrumbs -->
    <div class="faimos-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12 text-center">
                        <ol class="breadcrumb">
                            <?php faimos_breadcrumb(); ?>
                        </ol>
                    </div>
                    <div class="col-md-12 text-center">
                        <h1><?php the_title(); ?></h1>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php } 
    elseif ($breadcrumbs_on_off == 'no') { 

    }
    else { ?>
    <!-- Breadcrumbs -->
    <div class="faimos-breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ol class="breadcrumb">
                        <?php faimos_breadcrumb(); ?>
                    </ol>
                    <div class="col-md-12">
                        <h1><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- Revolution slider -->
    <?php 
    if (!empty($page_slider)) {
        echo '<div class="faimos_header_slider">';
        echo do_shortcode('[rev_slider '.esc_html($page_slider).']');
        echo '</div>';
    }
    ?>


    <!-- Page content -->
    <div id="primary" class="<?php echo esc_attr($page_spacing); ?> content-area no-sidebar">
        <div class="container">
            <main id="main" class="col-md_12 site-main main-content">
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part( 'content', 'page' ); ?>

                    <?php
                        // If comments are open or we have at least one comment, load up the comment template
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>

                <?php endwhile; // end of the loop. ?>
            </main>
        </div>
    </div>

<?php get_footer(); ?>