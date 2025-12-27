<?php
/**
 * @package faimos
 */
?>
<?php 
global $faimos_redux;

$master_class = 'col-md-12 col-sm-12 col-xs-12';
$type_class = 'grid-one-column';
$image_size = 'grid-one-column';
if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
        $type_class = 'grid-view';
        if ( faimos_redux('blog-grid-columns') == 1 ) {
            $master_class = 'col-md-12';
            $type_class .= ' grid-one-column';
            $image_size = 'faimos_cat_pic500x500';
        }elseif ( faimos_redux('blog-grid-columns') == 2 ) {
            $master_class = 'col-md-6';
            $type_class .= ' grid-two-columns';
            $image_size = 'faimos_post_pic700x450';
        }elseif ( faimos_redux('blog-grid-columns') == 3 ) {
            $master_class = 'col-md-4';
            $type_class .= ' grid-three-columns';
            $image_size = 'faimos_post_pic700x450';
        }elseif ( faimos_redux('blog-grid-columns') == 4 ) {
            $master_class = 'col-md-3';
            $type_class .= ' grid-four-columns';
            $image_size = 'faimos_700x600';
        }

    }

$thumbnail_class = 'full-width-part';
$post_details_class = 'full-width-part';

$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $image_size );
?>

<?php if (class_exists( 'ReduxFrameworkPlugin' ) ) { ?>
<article id="post-<?php the_ID(); ?>"  <?php post_class('single-post grid-view '.esc_attr($master_class).' '.esc_attr($type_class)); ?>> 
    <div class="post-wrapper">   
        <?php if($thumbnail_src) { ?>
        <div class="<?php echo esc_attr($thumbnail_class); ?> post-thumbnail">
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="relative">
                <?php if($thumbnail_src) { 
                    echo '<img src="'. esc_url($thumbnail_src[0]) . '" alt="'.esc_attr(the_title_attribute('echo=0')).'" />';
                } ?>
            </a>
        </div>
        <?php } ?>

        <div class="<?php echo esc_attr($post_details_class); ?> post-details">
            <div class="article-detail-meta post-date">
                <?php echo esc_html(get_the_date()); ?>
            </div>

            <h3 class="post-name row">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="relative">
                    <?php if (is_sticky()) { ?>
                        <i class="fa fa-bolt" aria-hidden="true"></i>
                    <?php } ?>
                    <?php the_title() ?>
                </a>
            </h3>
            
            <div class="post-excerpt row">
            <?php
                /* translators: %s: Name of current post */
                the_excerpt();
            ?>
            <div class="clearfix"></div>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'faimos' ),
                    'after'  => '</div>',
                ) );
            ?>
            <div class="clearfix"></div>
            <p class="read-more-holder">
                <a href="<?php echo esc_url(get_the_permalink()); ?>" class="more-link">
                    <?php echo esc_html__( 'Read More', 'faimos' ); ?>
                </a>
            </p>
            
            </div>
        </div>
    </div>
</article>
<?php }else{ ?>
<article id="post-<?php the_ID(); ?>"  <?php post_class('single-post grid-view '.esc_attr($master_class).' '.esc_attr($type_class)); ?>>  
  <div class="post-wrapper">   
    <?php if($thumbnail_src) { ?>
    <div class="<?php echo esc_attr($thumbnail_class); ?> post-thumbnail">
        <a href="<?php echo esc_url(get_the_permalink()); ?>" class="relative">
            <?php if($thumbnail_src) { 
                echo '<img src="'. esc_url($thumbnail_src[0]) . '" alt="'.esc_attr(the_title_attribute('echo=0')).'" />';
            } ?>
        </a>
    </div>
    <?php } ?>

    <div class="<?php echo esc_attr($post_details_class); ?> post-details">
        <div class="article-detail-meta post-date">
            <?php echo esc_html(get_the_date()); ?>
        </div>

        <h3 class="post-name row">
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="relative">
                <?php if (is_sticky()) { ?>
                    <i class="fa fa-bolt" aria-hidden="true"></i>
                <?php } ?>
                <?php the_title() ?>
            </a>
        </h3>
        
        <div class="post-excerpt row">
        <?php
            /* translators: %s: Name of current post */
            the_excerpt();
        ?>
        <div class="clearfix"></div>
        <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'faimos' ),
                'after'  => '</div>',
            ) );
        ?>
        <div class="clearfix"></div>
        <p class="read-more-holder">
            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="more-link">
                <?php echo esc_html__( 'Read More', 'faimos' ); ?>
            </a>
        </p>
        
        </div>
    </div>
  </div>
</article>
<?php } ?>