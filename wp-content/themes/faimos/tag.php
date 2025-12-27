<?php
/**
 * The template for displaying tags results pages.
 *
 * @package faimos
 */
get_header(); 
#Redux global variable
global $faimos_redux;

$class = "col-md-12";
$sidebar = "sidebar-1";

if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    if ( $faimos_redux['faimos_blog_layout'] == 'faimos_blog_fullwidth' ) {
        $class = "col-md-12";
    }elseif ( $faimos_redux['faimos_blog_layout'] == 'faimos_blog_right_sidebar' or $faimos_redux['faimos_blog_layout'] == 'faimos_blog_left_sidebar') {
        $class = "col-md-9";
    }
    // Check if active sidebar
    $sidebar = $faimos_redux['faimos_blog_layout_sidebar'];
}else{
    $class = "col-md-9";
}
if (!is_active_sidebar( $sidebar )) {
    $class = "col-md-12";
}
?>
<!-- Breadcrumbs -->
<div class="faimos-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
               <ol class="breadcrumb">
                     <?php faimos_breadcrumb(); ?>
                </ol>
                <div class="col-md-12 text-center">
                    <h1>
                        <?php echo esc_html__( 'Tag: ', 'faimos' ); ?>
                        <span><?php echo single_tag_title( '', false ); ?></span>
                    </h1>
                </div>
            </div>         
        </div>
    </div>
</div>
<!-- Page content -->
<div class="high-padding">
    <!-- Blog content -->
    <div class="container blog-posts">
        <div class="row">
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $faimos_redux['faimos_blog_layout'] == 'faimos_blog_left_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content">
                        <?php dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <div class="<?php echo esc_attr($class); ?> main-content">
                <div class="row">
                    <?php if ( have_posts() ) : ?>
                   
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <?php
                            /**
                             * Run the loop for the search to output the results.
                             * If you want to overload this in a child theme then include a file
                             * called content-search.php and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                            ?>
                        <?php endwhile; ?>
                        <div class="faimos-pagination pagination">             
                            <?php faimos_pagination(); ?>
                        </div>
                   
                    <?php else : ?>
                        <?php get_template_part( 'content', 'none' ); ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php if (  class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
                <?php if ( $faimos_redux['faimos_blog_layout'] == 'faimos_blog_right_sidebar' && is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>
            <?php }else{ ?>
                <?php if ( is_active_sidebar( $sidebar )) { ?>
                    <div class="col-md-3 sidebar-content sidebar-content-right-side">
                        <?php  dynamic_sidebar( $sidebar ); ?>
                    </div>
                <?php } ?>                    
            <?php } ?>
            
        </div>
    </div>
</div>
<?php get_footer(); ?>