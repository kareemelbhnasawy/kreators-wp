<?php
/*------------------------------------------------------------------
[faimos - SHORTCODES]
Project:    faimos – Multi-Purpose WordPress Template
Author:     ModelTheme
[Table of contents]
1. Recent Tweets
2. Contact Form
4. Recent Posts
5. Featured Post with thumbnail
6. Testimonials
7. Subscribe form
8. Services style 1
9. Services style 2
10. Recent Portfolios
11. Recent testimonials
12. Skill
13. Google map
14. Pricing tables
15. Jumbotron
16. Alert
17. Progress bars
18. Custom content
19. Responsive video (YouTube)
20. Heading With Border
21. Testimonials
22. List group
23. Thumbnails custom content
24. Section heading with title and subtitle
25. Heading with bottom border
26. Portfolio square
27. Call to action
28. Blog posts
29. Social Media
30. Countdown Version 2
-------------------------------------------------------------------*/
global $faimos_redux;

include_once( 'mt-typed-text/mt-typed-text.php' ); # Typed text
include_once( 'mt-products-filter/mt-products-filters.php' ); # Typed text
include_once( 'mt-map-pins/mt-map-pins.php' );
include_once( 'mt-video/mt-video.php' );
include_once( 'mt-category-tabs/mt-category-tab.php' );
include_once( 'mt-products-banner/mt-products-banner.php' );
include_once( 'mt-mega-menu/mt-mega-menu.php' );
/*---------------------------------------------*/
/*--- 5. Featured Post with thumbnail ---*/
/*---------------------------------------------*/
function faimos_featured_post_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'      => '',
            'icon'      => '',
            'postid'    => '',
            'title'     => ''
        ), $params ) );
    $featured_post = '';
    #Content
    $content_post = get_post($postid);
    $content = $content_post->post_content;
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    #Author
    $post_author_id = get_post_field( 'post_author', $postid );
    $user_info = get_userdata($post_author_id);
    $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ),'faimos_featured_post_pic500x230' );
    $featured_post .= '<div class="latest-videos animateIn" data-animate="'.$animation.'">';
        $featured_post .= '<h3 class=""><i class="'.$icon.'"></i>'.$title.'</h3>';
        $featured_post .= '<a href="'.get_permalink( $postid ).'">';
            if($thumbnail_src) { $featured_post .= '<img class="img-responsive" src="'. $thumbnail_src[0] . '" alt="" />';
            }else{ $featured_post .= '<img class="img-responsive" src="http://placehold.it/500x230" alt="" />'; }
        $featured_post .= '</a>';
        $featured_post .= '<div class="video-title">';
            $featured_post .= '<a href="'.get_permalink( $postid ).'">'.get_the_title( $postid ).'</a>';
            $featured_post .= '<span class="post-date"><i class="fa fa-calendar"></i>'.get_the_date('', $postid ).'</span>';
            $featured_post .= '</div>';
        $featured_post .= '<div class="video-excerpt">'.faimos_excerpt_limit($content,20).'</div>';
    $featured_post .= '</div>';
    return $featured_post;
}
add_shortcode('featured_post', 'faimos_featured_post_shortcode');
/*---------------------------------------------*/
/*--- 6. Testimonials ---*/
/*---------------------------------------------*/
function faimos_testimonials_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                 =>'',
            'number'                    =>'',
            'testimonial_border_color'  =>'',
            'visible_items'             =>'',
            'testimonial_style'         =>'',
            'block_bg'                  =>'',
            'title_color'               =>'',
            'content_color'             =>''
        ), $params ) );

    $mtf  ='';
    $mtf .='<style type="text/css" scoped>
                .testimonial-img-holder .testimonial-img {
                    border-color: '.$testimonial_border_color.' !important;
                }
                .testimonial01-img-holder.style2 {
                    background: '.$block_bg.' !important;
                }
                .testimonial01-img-holder.style2 p.name-test {
                    color: '.$title_color.' !important;
                }
                .testimonial01-img-holder.style2 .content p {
                    color: '.$content_color.' !important;
                }
            </style>';

    $mtf .='<div class="vc_row">';
        $mtf .='<div data-animate="'.$animation.'" class="testimonials-container-'.$visible_items.' owl-carousel owl-theme animateIn">';
        $args_testimonials = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial',
                'post_status'      => 'publish' 
                ); 
        $testimonials = get_posts($args_testimonials);
            foreach ($testimonials as $testimonial) {
                #metaboxes
                $metabox_job_position = get_post_meta( $testimonial->ID, 'job-position', true );
                $metabox_company = get_post_meta( $testimonial->ID, 'company', true );
                $testimonial_id = $testimonial->ID;
                $content_post   = get_post($testimonial_id);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $testimonial->ID ),'faimos_post_widget_pic70x70' );
                
                $mtf.='
                <div class="wow '.$animation.' item vc_col-md-12 relative">
                    <div class="testimonial01_item">';
                    if($testimonial_style == 'style_1' or $testimonial_style == ''){            
                        $mtf.= '<div class="testimonial01-img-holder pull-left">
                                    <div class="testimonail01-content">
                                        <div class="testimonial-info-content">';
                                        $cls = '';
                                        if(!empty($thumbnail_src)) {
                                            $mtf.='<div class="testimonail01-profile-img">';                        
                                                $mtf.='<img src="'.$thumbnail_src[0].'" alt="'.$testimonial->post_title .'" />';
                                            $mtf.='</div>';
                                        } else {
                                            $cls .= 'text-center';                           
                                        }
                                     
                                        $mtf.= '<div class="testimonail01-name-position '.$cls.'">
                                                    <h2 class="name-test"><strong>'. $testimonial->post_title .'</strong></h2>
                                                    <p class="position-test">'. $metabox_job_position .'</p>
                                                </div>
                                        </div>
                                        <p>'.$content.'</p> 
                                    </div> 
                                </div>';
                    }else if($testimonial_style == 'style_2') {
                        $mtf.='<div class="testimonial01-img-holder style2">';    
                                $cls = '';
                                if($thumbnail_src) {
                                    $mtf.='<div class="testimonail01-profile-img">';                       
                                        $mtf.='<img src="'.$thumbnail_src[0].'" alt="'.$testimonial->post_title .'" />';
                                    $mtf.='</div>';
                                }
                                    $mtf.=' <div class="testimonial-info-content">
                                                <div class="content">'.$content.'</div>
                                                <p class="name-test"><strong>'. $testimonial->post_title .'</strong></p>
                                                <p class="position-test">'. $metabox_job_position .'</p>
                                            </div>  
                                </div>';
                    }
                    $mtf.='</div> 
                </div>';
            }
        $mtf .= '</div>';
    $mtf .= '</div>';
    return $mtf;
}
add_shortcode('testimonials', 'faimos_testimonials_shortcode');


/*---------------------------------------------*/
/*--- 8. Services style 1 ---*/
/*---------------------------------------------*/
function faimos_service_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon'          => '', 
            'title'         => '', 
            'description'   => '',
            'animation'     => ''
        ), $params ) );
    $service = '';
    $service .= '<div class="block-container">';
        $service .= '<div class="block-icon">';
            $service .= '<div class="block-triangle">';
                $service .= '<div>';
                    $service .= '<i class="'.$icon.'"></i>';
                $service .= '</div>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="block-title">';
            $service .= '<p>'.$title.'</p>';
        $service .= '</div>';
        $service .= '<div class="block-content">';
            $service .= '<p>'.$description.'</p>';
        $service .= '</div>';
    $service .= '</div>';
    return $service;
}
add_shortcode('service', 'faimos_service_shortcode');
/*---------------------------------------------*/
/*--- 9. Services style 2 ---*/
/*---------------------------------------------*/
function faimos_service_style2_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon'          => '', 
            'title'         => '', 
            'description'   => '',
            'animation'     => ''
        ), $params ) );
    $service = '';
    $service .= '<div class="left-block-container services2 animateIn" data-animate="'.$animation.'">';
        $service .= '<div class="block-icon vc_col-md-2">';
            $service .= '<div class="block-triangle">';
                $service .= '<div>';
                    $service .= '<i class="'.$icon.'"></i>';
                $service .= '</div>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="vc_col-md-9 vc_col-md-offset-1">';
            $service .= '<div class="block-title">';
                $service .= '<p>'.$title.'</p>';
            $service .= '</div>';
            $service .= '<div class="block-content">';
                $service .= '<p>'.$description.'</p>';
            $service .= '</div>';
        $service .= '</div>';
        $service .= '<div class="clearfix"></div>';
    $service .= '</div>';
    return $service;
}
add_shortcode('service_style2', 'faimos_service_style2_shortcode');

/*---------------------------------------------*/
/*--- 11. Recent testimonials ---*/
/*---------------------------------------------*/
function faimos_testimonials2_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'number'=>'',
            'animation'=>''
        ), $params ) );
        $args_recenposts = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'testimonial',
                'post_status'      => 'publish' 
                );
        $recentposts = get_posts($args_recenposts);
        $content  = "";
        $content .= '<div class="testimonials_slider owl-carousel owl-theme animateIn" data-animate="'.$animation.'">';
        foreach ($recentposts as $post) {
            $job_position = get_post_meta( $post->ID, 'job-position', true );
            $content .= '<div class="item">';
                $content .= '<div class="testimonial-content relative">';
                    $content .= '<span>'.get_post_field('post_content', $post->ID).'</span>';
                    $content .= '<div class="testimonial-client-details">';
                        $content .= '<div class="testimonial-name">'.$post->post_title.'</div>';
                        $content .= '<div class="testimonial-job">'.$job_position.'</div>';
                    $content .= '</div>';
                $content .= '</div>';
            $content .= '</div>';
        }
        $content .= '</div>';
        return $content;
}
add_shortcode('testimonials-style2', 'faimos_testimonials2_shortcode');
/*---------------------------------------------*/
/*--- 12. Skill ---*/
/*---------------------------------------------*/
function faimos_skills_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'icon_or_image'            => '', 
            'animation'                => '', 
            'icon'                     => '', 
            'title'                    => '',
            'skillvalue'               => '',
            'border_color'             => '',
            'bg_color'                 => '',
            'title_color'              => '',
            'skill_color_value'        => '',
            'image_skill'              => ''
        ), $params ) );

    $image_skill      = wp_get_attachment_image_src($image_skill, "linify_skill_counter_65x65");
    $image_skillsrc  = $image_skill[0];

    $skill = '';
    $skill .= '<div class="stats-block statistics col-md-12 wow '.esc_attr($animation).'">';
        $skill .= '<div class="stats-heading-img col-md-5">';
         $skill .= '<div class="stats-img">';

                if($icon_or_image == 'choosed_icon'){
                  $skill .= '<i class="'.esc_attr($icon).'"></i>';
                } elseif($icon_or_image == 'choosed_image') {
                  $skill .= '<img src="'.esc_attr($image_skillsrc).'" data-src="'.esc_attr($image_skillsrc).'" alt="">';
                }
         $skill .= '</div>';
        $skill .= '</div>';

        $skill .= '<div class="stats-content percentage col-md-7" data-perc="'.esc_attr($skillvalue).'" style="background:'.$bg_color.'">';
          $skill .= '<span class="skill-count" style="color: '.esc_attr($skill_color_value).'">'.esc_attr($skillvalue).'</span>';
            
              $skill .= '<p style="color: '.esc_attr($title_color).'">'.esc_attr($title).'</p>';
              
            $skill .= '</div>';

        

    $skill .= '</div>';
    return $skill;
}
add_shortcode('mt_skill', 'faimos_skills_shortcode');


/*---------------------------------------------*/
/*--- 14. Pricing tables ---*/
/*---------------------------------------------*/
function faimos_pricing_table_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'package_currency'  => '',
            'package_price'     => '',
            'package_name'      => '',
            'package_basis'     => '',
            'package_desc'      => '',
            'package_feature1'  => '',
            'package_feature2'  => '',
            'package_feature3'  => '',
            'package_feature4'  => '',
            'package_feature5'  => '',
            'package_feature6'  => '',
            'animation'         => '',
            'button_url'        => '',
            'recommended'       => '',
            'style_price'       => '',
            'button_text'       => ''
        ), $params ) );
    $pricing_table = '';
    $pricing_table .= '<div class="pricing-table '.$recommended.' '.$style_price.'" data-animate="'.$animation.'">';
        $pricing_table .= '<div class="table-content">';
            $pricing_table .= '<h2>'.$package_name.'</h2>';
            $pricing_table .= '<small>'.$package_currency.'</small><span class="price">'.$package_price.'</span><span class="basis">'.$package_basis.'</span>';
            if($package_desc) {
                $pricing_table .= '<p class="package_desc">'.$package_desc.'</p>';
            }
            $pricing_table .= '<ul class="text-center">';
                $pricing_table .= '<li>'.$package_feature1.'</li>';
                $pricing_table .= '<li>'.$package_feature2.'</li>';
                $pricing_table .= '<li>'.$package_feature3.'</li>';
                $pricing_table .= '<li>'.$package_feature4.'</li>';
                $pricing_table .= '<li>'.$package_feature5.'</li>';
                $pricing_table .= '<li>'.$package_feature6.'</li>';
            $pricing_table .= '</ul>';
            $pricing_table .= '<div class="button-holder text-center">';
                $pricing_table .= '<a href="'.$button_url.'" class="solid-button button">'.$button_text.'</a>';
            $pricing_table .= '</div>';
        $pricing_table .= '</div>';
    $pricing_table .= '</div>';
    return $pricing_table;
}
add_shortcode('pricing-table', 'faimos_pricing_table_shortcode');

/*---------------------------------------------*/
/*--- 16. Alert ---*/
/*---------------------------------------------*/
function faimos_alert_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'alert_style'           => '', 
            'alert_dismissible'     => '', // yes/no
            'alert_text'            => '',
            'animation'            => ''
        ), $params ) );
    $content = '';
    $content .= '<div role="alert" class="alert alert-'.$alert_style.' animateIn" data-animate="'.$animation.'">';
        if ($alert_dismissible == 'yes') {
            $content .= '<button aria-label="'.esc_attr__('Close', 'modeltheme').'" data-dismiss="alert" class="close" type="button"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>';
        }
        $content .= $alert_text;
    $content .= '</div>';
    return $content;
}
add_shortcode('alert', 'faimos_alert_shortcode');
/*---------------------------------------------*/
/*--- 17. Progress bars ---*/
/*---------------------------------------------*/
function faimos_progress_bar_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'bar_scope'  => '', // success/info/warning/danger
            'bar_style'  => '', // normal/progress-bar-striped
            'bar_label'  => '', // optional
            'bar_value'  => '',
            'animation'  => ''
        ), $params ) );
    $content = '';
    $content .= '<div class="animateIn progress" data-animate="'.$animation.'" >';
        $content .= '<div class="progress-bar progress-bar-'.$bar_scope . ' ' . $bar_style.'" role="progressbar" aria-valuenow="'.$bar_value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$bar_value.'%">';
            if(!isset($bar_label)){
                $content .= '<span class="sr-only">'.$bar_label.'</span>.';
            }else{ 
                $content .= $bar_label;
            }
        $content .= '</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('progress_bar', 'faimos_progress_bar_shortcode');
/*---------------------------------------------*/
/*--- 18. Custom content ---*/
/*---------------------------------------------*/
function faimos_panel_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'panel_style'    => '', // success/info/warning/danger
            'panel_title'    => '', 
            'panel_content'  => '',
            'animation'  => ''
        ), $params ) ); ?>
    <div class="panel animateIn panel-<?php echo esc_attr($panel_style); ?>" data-animate="<?php echo esc_attr($animation); ?>">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo esc_attr($panel_title); ?></h3>
        </div>
        <div class="panel-body">
            <?php echo $panel_content; ?>
        </div>
    </div>
    
<?php }
add_shortcode('panel', 'faimos_panel_shortcode');
/*---------------------------------------------*/
/*--- 20. Heading With Border ---*/
/*---------------------------------------------*/
function faimos_heading_with_border( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'align'       => 'left',
            'animation'   => ''
        ), $params ) );
    $content = do_shortcode($content);
    echo '<h2 data-animate="'.$animation.'" class="'.$align.'-border animateIn">'.$content.'</h2>';
}
add_shortcode('heading-border', 'faimos_heading_with_border');


/*---------------------------------------------*/
/*--- 21. Testimonials ---*/
/*---------------------------------------------*/
function faimos_clients_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'=>'',
            'number'=>''
        ), $params ) );
    $myContent = '';
    $myContent .= '<div class="clients-container owl-carousel owl-theme ">';
    $args_clients = array(
            'posts_per_page'   => $number,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'client',
            'post_status'      => 'publish' 
            ); 
    $clients = get_posts($args_clients);
        foreach ($clients as $client) {
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $client->ID ),'full' );
            
            $myContent .= '<div class="item">';
                if($thumbnail_src) { $myContent .= '<img src="'. $thumbnail_src[0] . '" alt="'. $client->post_title .'" />';
                }else{ $myContent .= '<img src="http://placehold.it/110x110" alt="'. $client->post_title .'" />'; }
            $myContent .= '</div>';
        }
    $myContent .= '</div>';
    return $myContent;
}
add_shortcode('clients', 'faimos_clients_shortcode');
/*---------------------------------------------*/
/*--- 22. List group ---*/
/*---------------------------------------------*/
function faimos_list_group_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'animation'     => ''
        ), $params ) ); 
    $content = '';
    $content .= '<a href="#" class="list-group-item '.$active.' animateIn" data-animate="'.$animation.'">';
        $content .= '<h4 class="list-group-item-heading">'.$heading.'</h4>';
        $content .= '<p class="list-group-item-text">'.$description.'</p>';
    $content .= '</a>';
    return $content;
}
add_shortcode('list_group', 'faimos_list_group_shortcode');

function faimos_btn_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'btn_text'      => '',
            'btn_url'       => '',
            'btn_size'      => '',
            'align'      => ''
        ), $params ) ); 
    $content = '';
    $content .= '<div class="'.$align.'">';
    $content .= '<a href="'.$btn_url.'" class="button-winona '.$btn_size.'">'.$btn_text.'</a>';
    $content .= '</div>';
    return $content;
}
add_shortcode('faimos_btn', 'faimos_btn_shortcode');
/*---------------------------------------------*/
/*--- 23. Thumbnails custom content ---*/
/*---------------------------------------------*/
function faimos_thumbnails_custom_content_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'image'         => '',
            'heading'       => '',
            'description'   => '',
            'active'        => '',
            'button_url'    => '',
            'button_text'   => '',
            'animation'     => ''
        ), $params ) ); 
    $thumb      = wp_get_attachment_image_src($image, "large");
    $thumb_src  = $thumb[0]; 
    $content = '';
    $content .= '<div class="thumbnail animateIn" data-animate="'.$animation.'">';
        $content .= '<img data-holder-rendered="true" src="'.$thumb_src.'" data-src="'.$thumb_src.'" alt="'.$heading.'">';
        $content .= '<div class="caption">';
            if (!empty($heading)) {
                $content .= '<h3>'.$heading.'</h3>';  
            }
            if (!empty($description)) {
                $content .= '<p>'.$description.'</p>';
            }
            if (!empty($button_text)) {
                $content .= '<p><a href="'.$button_url.'" class="btn btn-primary" role="button">'.$button_text.'</a></p>';
            }
        $content .= '</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('thumbnails_custom_content', 'faimos_thumbnails_custom_content_shortcode');
/*---------------------------------------------*/
/*--- 24. Section heading with title and subtitle ---*/
/*---------------------------------------------*/
function faimos_heading_title_subtitle_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'         => '',
            'separator'     => '',
            'subtitle'      => '',
            'disable_sep'   => '',
            'title_style'   => '',
            'title_color'   => '',
            'delimitator_color' => ''
        ), $params ) ); 

    $separator = wp_get_attachment_image_src($separator, "full");

    if ($delimitator_color) {
        $delimitator_color_value = $delimitator_color;
    }else{
        $delimitator_color_value = '#2695FF';
    }

    $content = '<div class="title-subtile-holder">';
    $content .= '<h2 class="section-title '.$title_style.' '.$title_color.'">'.$title.'</h2>';
    if (isset($separator) && !empty($separator)) {
        $content .= '<div class="section-border" style="background: url('.$separator[0].') no-repeat center center;"></div>';
    }else{
        $content .= '<div class="svg-border '.$disable_sep.'"><svg width="515" height="25" viewBox="0 0 275 15" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect y="7" width="120" height="1" fill="#CCCCCC"/>
        <rect x="155" y="7" width="120" height="1" fill="#CCCCCC"/>
        <path d="M144.443 14.6458C144.207 14.8818 143.897 15 143.588 15C143.278 15 142.968 14.8818 142.732 14.6454L137.874 9.78689C137.517 9.43023 137.43 8.90654 137.612 8.46798L136.617 7.47264L135.242 8.84723C135.517 9.2862 135.458 9.8809 135.066 10.2714C134.614 10.7245 133.888 10.7342 133.448 10.2936L130.324 7.17126C129.883 6.73028 129.893 6.00566 130.347 5.55298C130.738 5.16122 131.332 5.10231 131.771 5.37788L135.378 1.77014C135.102 1.33158 135.161 0.737682 135.553 0.346326C136.006 -0.10676 136.73 -0.116443 137.171 0.324136L140.295 3.44732C140.736 3.8879 140.726 4.61251 140.272 5.0656C139.88 5.45736 139.287 5.51586 138.849 5.2407L137.472 6.6169L138.59 7.73449C138.945 7.69334 139.314 7.80348 139.586 8.07622L144.444 12.9347C144.916 13.4071 144.916 14.1729 144.443 14.6458Z" fill="'.$delimitator_color_value.'"/>
        </svg></div>';
    }
    $content .= '<div class="section-subtitle '.$title_color.'">'.$subtitle.'</div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('heading_title_subtitle', 'faimos_heading_title_subtitle_shortcode');


/*---------------------------------------------*/
/*--- 24. Section heading with title and subtitle ---*/
/*---------------------------------------------*/
function faimos_heading_title_subtitle_shortcode_v2($params, $content) {
    extract( shortcode_atts( 
        array(
            'title'         => '',
            'separator'     => '',
            'button_link'   => '',
            'button_text'   => '',
            'subtitle'      => ''
        ), $params ) ); 

    $separator = wp_get_attachment_image_src($separator, "full");

    $content = '<div class="title-subtile-holder v2">';
        $content .= '<div class="title-content" >';
            $content .= '<h2 class="section-title text-left">'.$title.'</h2>';
            $content .= '<p class="section-subtitle text-left">'.$subtitle.'</p>';
        $content .= '</div>';
         $content .= '<a class="button title-btn " href="'.$button_link.'">'.$button_text.'</a>';
    $content .= '</div>';
    return $content;
}
add_shortcode('heading_title_subtitle_v2', 'faimos_heading_title_subtitle_shortcode_v2');

/*---------------------------------------------*/
/*--- 25. Heading with bottom border ---*/
/*---------------------------------------------*/
function faimos_heanding_bottom_border_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'    => '',
            'text_align' => ''
        ), $params ) );
    $content = '<h2 class="heading-bottom '.$text_align.'">'.$heading.'</h2>';
    return $content;
}
add_shortcode('heading_border_bottom', 'faimos_heanding_bottom_border_shortcode');
/*---------------------------------------------*/
/*--- 26. Portfolio square ---*/
/*---------------------------------------------*/
function faimos_portfolio_sqare_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'       => ''
           ), $params ) 
        );

    $args = array(
        'posts_per_page'   => $number,
        'post_type'        => 'portfolio',
        'post_status'      => 'publish',
    );
    $posts = new WP_Query( $args );
    $content = '<div class="portfolio-overlay"></div>';
    $content = '<div class="blog-posts portfolio-posts portfolio-shortcode quick-view-items">';
    foreach ( $posts->posts as $portfolio ) {
        
        $project_url = get_post_meta( $portfolio->ID, 'av-project-url', true );
        $project_skills = get_post_meta( $portfolio->ID, 'av-project-category', true );
        $excerpt = get_post_field( 'post_content', $portfolio->ID );
        $thumbnail_src      = wp_get_attachment_image_src( get_post_thumbnail_id( $portfolio->ID ), 'faimos_portfolio_pic700x450' );
        $content .= '<article id="post-'.$portfolio->ID.'" class="vc_col-md-4 single-portfolio-item faimos-item relative portfolio">';
        
        if($thumbnail_src) { 
            $content .= '<img src="'. $thumbnail_src[0] . '" alt="'.$portfolio->post_title.'" />';
        }else{ 
            $content .= '<img src="http://placehold.it/700x450" alt="'.$portfolio->post_title.'" />'; 
        }
            $content .= '<div class="item-description absolute">';
                $content .= '<div class="holder-top">';
                    $content .= '<a class="faimos-trigger" href="#"><i class="fa fa-expand"></i></a>';
                    $content .= '<a href="'.get_the_permalink($portfolio->ID).'"><i class="fa fa-plus"></i></a>';
                $content .= '</div>';
                $content .= '<div class="holder-bottom">';
                    $content .= '<h3>'.$portfolio->post_title.'</h3>';
                    $content .= '<h5>'.$project_skills.'</h5>';
                $content .= '</div>';
            $content .= '</div>';



            $content .= '<div class="faimos-quick-view portfolio-shortcode high-padding post-'.$portfolio->ID.'">';
                $content .= '<div class="faimos-slider-wrapper">';
                    $content .= '<ul class="faimos-slider">';
                        if($thumbnail_src) { 
                            $content .= '<li class="selected single-slide"><img class="portfolio-item-img" src="'. $thumbnail_src[0] . '" alt="'.$portfolio->post_title.'" /></li>';
                        }
                        if( class_exists('Dynamic_Featured_Image') ) {
                            global $dynamic_featured_image;
                            $featured_images = $dynamic_featured_image->get_featured_images($portfolio->ID);

                            $i = 0;
                            foreach ($featured_images as $row=>$innerArray) {
                                $id = $featured_images[$i]['attachment_id'];
                                $mediumSizedImage = $dynamic_featured_image->get_image_url($id,'faimos_portfolio_pic700x450'); 
                                $caption = $dynamic_featured_image->get_image_caption( $mediumSizedImage );
                                $content .= '<li class="single-slide"><img src="'.$mediumSizedImage.'" alt="'.$caption.'"></li>';
                                $i++;
                            }
                        }            
                    $content .= '</ul>';
                    $content .= '<ul class="faimos-slider-navigation">';
                        $content .= '<li><a class="faimos-next" href="#0"><i class="fa fa-angle-left"></i></a></li>';
                        $content .= '<li><a class="faimos-prev" href="#0"><i class="fa fa-angle-right"></i></a></li>';
                    $content .= '</ul>';
                $content .= '</div>';

                $content .= '<div class="faimos-item-info col-md-5">';
                    $content .= '<h2 class="heading-bottom top">'.$portfolio->post_title.'</h2>';
                    $content .= '<div class="desc">'.get_post_field('post_content', $portfolio->ID).'</div>';

                    $content .= '<div class="portfolio-details">';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Customer:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.get_the_author().'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Live demo:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.$project_url.'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Skills:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.$project_skills.'</div>';
                        $content .= '</div>';
                        $content .= '<div class="vc_row">';
                            $content .= '<div class="vc_col-md-4 portfolio_label">'.esc_attr__('Date post:', 'modeltheme').'</div>';
                            $content .= '<div class="vc_col-md-8 portfolio_label_value">'.get_the_date().'</div>';
                        $content .= '</div>';
                    $content .= '</div>';
                    $content .= '<a href="'.get_the_permalink($portfolio->ID).'" class="vc_btn vc_btn-blue">More details</a>';
                $content .= '</div>';
                $content .= '<a href="#0" class="faimos-close"><i class="fa fa-times"></i></a>';
            $content .= '</div>';
        $content .= '</article>';
    }
    $content .= '<div class="clearfix"></div>';
    $content .= '<div class="portfolio-overlay"></div>';
    $content .= '</div>';
    return $content;
}
add_shortcode('portfolio-square', 'faimos_portfolio_sqare_shortcode');
/*---------------------------------------------*/
/*--- 27. Call to action ---*/
/*---------------------------------------------*/
function faimos_call_to_action_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'heading_type'  => '',
            'subheading'    => '',
            'align'         => '',
            'button_text'   => '',
            'url'           => ''
        ), $params ) );
    $shortcode_content = '<div class="faimos_call-to-action">';
    $shortcode_content .= '<div class="vc_col-md-12">';
    $shortcode_content .= '<'.$heading_type.' class="'.$align.'">'.$heading.'</'.$heading_type.'>';
    $shortcode_content .= '<p class="'.$align.'">'.$subheading.'</p>';
    $shortcode_content .= '</div>';
    $shortcode_content .= '<div class="clearfix"></div>';
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('faimos-call-to-action', 'faimos_call_to_action_shortcode');


/*---------------------------------------------*/
/*--- 27. Call to action ---*/
/*---------------------------------------------*/
function faimos_shop_feature_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'heading'       => '',
            'subheading'    => '',
            'icon'          => ''
        ), $params ) );

    $shortcode_content = '<div class="shop_feature">';
        $shortcode_content .= '<div class="pull-left shop_feature_icon">';
            $shortcode_content .= '<i class="'.$icon.'"></i>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '<div class="pull-left shop_feature_description">';
            $shortcode_content .= '<h4>'.$heading.'</h4>';
            $shortcode_content .= '<p>'.$subheading.'</p>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('shop-feature', 'faimos_shop_feature_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Categories List ---*/
/*---------------------------------------------*/

function faimos_shop_categories_with_thumbnails_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'hide_empty'                           => ''
        ), $params ) );

    $prod_categories = get_terms( 'product_cat', array(
        'number'        => $number,
        'hide_empty'    => $hide_empty,
        'parent' => 0
    ));

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_categories list">';
        $shortcode_content .= '<div class="categories-list categories_shortcode categories_shortcode_'.$number_of_columns.' owl-carousel owl-theme">';
        foreach( $prod_categories as $prod_cat ) {
            if ( class_exists( 'WooCommerce' ) ) {
                $cat_thumb_id   = get_term_meta( $prod_cat->term_id, 'thumbnail_id', true );
            } else {
                $cat_thumb_id = '';
            }
            $cat_thumb_url  = wp_get_attachment_image_src( $cat_thumb_id, 'pic100x75' );
            $term_link      = get_term_link( $prod_cat, 'product_cat' );

            $shortcode_content .= '<div class="category item ">';
                    $shortcode_content .= '<a class="#categoryid_'.$prod_cat->term_id.'">';
                        $shortcode_content .= '<span class="cat-name">'.$prod_cat->name.'</span>';                    
                    $shortcode_content .= '</a>';    
            $shortcode_content .= '</div>';
        }
        $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="products_category">';
                foreach( $prod_categories as $prod_cat ) {
                        $shortcode_content .= '<div id="categoryid_'.$prod_cat->term_id.'" class="products_by_category '.$prod_cat->name.'">'.do_shortcode('[product_category columns="1" per_page="'.$number_of_products_by_category.'" category="'.$prod_cat->slug.'"]').'</div>';
                }
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-categories-with-thumbnails', 'faimos_shop_categories_with_thumbnails_shortcode');

/*---------------------------------------------*/
/*--- Woocommerce Products Slider ---*/
/*---------------------------------------------*/

function mt_shortcode_products($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'false',
            'order' => 'desc',
            'pagination' => 'false',
            'autoPlay' => 'true',
            'layout'  => '',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';



    // CLASSES
    $class_slider = 'mt_slider_products_'.uniqid();



    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        navigationText  : [<i class="fa fa-angle-left" aria-hidden="true"></i>,<i class="fa fa-angle-right" aria-hidden="true"></i>],
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';


        $html .= '<div class="mt_products_slider '.$class_slider.' row  ">';
        $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
         ); 
        $blogposts = get_posts($args_blogposts);
        
        foreach ($blogposts as $blogpost) {
                global $product;
                $product = wc_get_product( $blogpost->ID );

                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'faimos_portfolio_pic400x400' );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col = 'col-md-12';
                }else{
                    $post_col = 'col-md-12 no-featured-image';
                    $post_img = '';
                }
                $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'faimos_product_simple_500x600' );
                if ($thumbnail_src2) {
                    $post_img2 = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src2[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col2 = 'col-md-12';
                }else{
                    $post_col2 = 'col-md-12 no-featured-image';
                    $post_img2 = '';
                }
            $html .= '<div id="product-id-'.esc_attr($blogpost->ID).'">
                        <div class="slider-wrapper">';
                        if($layout == "vertical" || $layout == "") {

                            $html .= '<div class="col-md-12 post ">
                              <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>';
                                $vendor_id      = wcfm_get_vendor_id_by_post( $blogpost->ID );
                                if( $vendor_id ) {
                                    $html .= '<div class="overlay-vendor">';
                                        $store_name     = wcfm_get_vendor_store( absint($vendor_id) );
                                        $store_user     = wcfmmp_get_store( $vendor_id );
                                        $store_info     = $store_user->get_shop_info();
                                        $gravatar       = $store_user->get_avatar();
                                        $html .= '<div class="logo_area lft"><img src="'.esc_url($gravatar).'" alt="Logo"/></div>';
                                            $html .= '<p class="vendor_name">'.wp_kses_post($store_name).'</p> ';
                                            if( get_user_meta($vendor_id, 'wcfm_instagram_count', true) ) {
                                               $html .= '<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['instagram'], 'instagram' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_instagram_count', true).' '.esc_html__('followers','faimos').'</a></span>';
                                            }
                                        $html .= '</div>';
                                }
                              $html .= '</div>
                              <div class="woocommerce-title-metas">
                                <h3 class="archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';
                                 if($product->get_price_html()) {
                                  $html .= '<p>'.esc_html__('Price: ','modeltheme').''.$product->get_price_html().'</p>';
                                }
                    $html .= '</div>
                            </div>';
                        }else {
                            $html .= '<div class="col-md-12 post full ">
                              <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>';
                                $vendor_id      = wcfm_get_vendor_id_by_post( $blogpost->ID );
                                if( $vendor_id ) {
                                    $html .= '<div class="overlay-vendor">';
                                        $store_name     = wcfm_get_vendor_store( absint($vendor_id) );
                                        $store_user     = wcfmmp_get_store( $vendor_id );
                                        $store_info     = $store_user->get_shop_info();
                                        $gravatar       = $store_user->get_avatar();
                                        $html .= '<div class="logo_area lft"><img src="'.esc_url($gravatar).'" alt="Logo"/></div>';
                                            $html .= '<p class="vendor_name">'.wp_kses_post($store_name).'</p> ';
                                            if( get_user_meta($vendor_id, 'wcfm_instagram_count', true) ) {
                                               $html .= '<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['instagram'], 'instagram' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_instagram_count', true).' '.esc_html__('followers','faimos').'</a></span>';
                                            }
                                        $html .= '</div>';
                                }
                              $html .= '</div>
                              <div class="woocommerce-title-metas">';
                                if($product->get_price_html()) {
                                  $cat_name = get_the_term_list($blogpost->ID, 'product_cat', '', ' | ');
                                  $html .= '<p>'.$cat_name.' '.$product->get_price_html().'</p>';
                                }
                                $html .= '<h3 class="archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';

                    $html .= '</div>
                            </div>';
                        }


                            $html .= '</div>                     
                          </div>';

            }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt_products_slider', 'mt_shortcode_products');


/*---------------------------------------------*/
/*--- Woocommerce Products Styled ---*/
/*---------------------------------------------*/

function faimos_products_styled_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'category'                             => '',
            'layout'                               => '',
            'block_bg'                             => '',
            'title_color'                          => '',
            'hide_empty'                           => ''
        ), $params ) );

    $cat = get_term_by('slug', $category, 'product_cat');

    if (isset($number_of_columns)) {
        if ($number_of_columns == '' || $number_of_columns == '5') {
            $column_type = 'col-md-2';
        }elseif($number_of_columns == '4'){
            $column_type = 'col-md-3';
        }
    }else{
        $column_type = 'col-md-3';
    }
    
    $shortcode_content = '';
    $shortcode_content .='<style type="text/css">
                            .woocommerce_styled .woocommerce-title-metas {
                                background: '.$block_bg.' !important;
                            }
                            .woocommerce_styled ul.products li.product .archive-product-title a{
                                color: '.$title_color.' !important;
                            }
                        </style>';
    $shortcode_content .= '<div class="woocommerce_styled">';
        $shortcode_content .= '<div class="products_category">';
            $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-12 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('mt-products-styled', 'faimos_products_styled_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Categories Grid ---*/
/*---------------------------------------------*/

function faimos_shop_categories_with_grids( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'hide_empty'                           => ''
        ), $params ) );


    $args = array(
        'post_type'   =>  'product',
        'posts_per_page'  => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_type',
                'field'    => 'slug',
            ),
        ),
        // 'posts_per_page'  => $number,
        'orderby'     =>  'date',
        'order'       =>  'DESC'
    );

    $prods = new WP_Query( $args );


    

    $shortcode_content = '';
    $shortcode_content .= '<div class="woocommerce_categories grid">';

        $shortcode_content .= '<table id="DataTable-icondrops-active" class="table" cellspacing="0" width="100%">';
            $shortcode_content .= '<thead>';
                $shortcode_content .= '<tr>';
                    $shortcode_content .= '<th>'.esc_html__('Image','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('Title','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('SKU','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('Current Bid','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('In stock','modeltheme').'</th>';
                    $shortcode_content .= '<th>'.esc_html__('Place Bid','modeltheme').'</th>';
                $shortcode_content .= '</tr>';
            $shortcode_content .= '<thead>';
            
            $shortcode_content .= '<tbody>';
            while ($prods->have_posts()) {
                $prods->the_post();
                global $product;

                    $shortcode_content .= '<tr>';
                        $shortcode_content .= '<td class="featured-image">'.get_the_post_thumbnail( $prods->post->ID, 'faimos_pic180x75' ).'</td>';
                        $shortcode_content .= '<td class="product-title"><a href="'.get_permalink().'"</a>'.$product->get_title().'</td>';
                        $shortcode_content .= '<td>'.$product->get_sku().'</td>';
                        $shortcode_content .= '<td>'.$product->get_price_html().'</td>';
                        $shortcode_content .= '<td>'.$product->get_stock_quantity().'</td>';
                        $shortcode_content .= '<td class="add-cart"><a href="'.get_permalink().'"</a>'.esc_html__('Bid Now','modeltheme').'</td>';   
                    $shortcode_content .= '</tr>';
            }
                            
        $shortcode_content .= '<tbody>';
        $shortcode_content .= '</table>';
                       
    $shortcode_content .= '</div>';

    wp_reset_postdata();


    return $shortcode_content;
}
add_shortcode('shop-categories-with-grids', 'faimos_shop_categories_with_grids');


/*---------------------------------------------*/
/*--- Woocommerce Categories with thumbnails version 2 ---*/
/*---------------------------------------------*/
function faimos_shop_categories_with_xsthumbnails_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'                               => '',
            'number_of_products_by_category'       => '',
            'number_of_columns'                    => '',
            'button_text'                          => '',
            'products_label_text'                  => '',
            'category'                             => '',
            'overlay_color1'                       => '',
            'overlay_color2'                       => '',
            'bg_image'                             => '',
            'hide_empty'                           => '',
            'products_layout'                      => '',
            'styles'                               => '',
            'button_style'                         => '',
            'banner_pos'                           => ''
        ), $params ) );

    if (isset($bg_image) && !empty($bg_image)) {
        $bg_image = wp_get_attachment_image_src($bg_image, "full");
    }

    $category_style_bg = '';
    if (isset($bg_image) && !empty($bg_image)) {
        $category_style_bg .= 'background: url('.$bg_image[0].') no-repeat center center;';
    }else{
        $category_style_bg .= 'background: radial-gradient('.$overlay_color1.','.$overlay_color2.');';
    }

    if ($button_text) {
        $button_text_value = $button_text;
    }else{
        $button_text_value = __('View All Items', 'modeltheme');
    }

    if ($products_label_text) {
        $products_label_text_value = $products_label_text;
    }else{
        $products_label_text_value = __('Products', 'modeltheme');
    }


    $cat = get_term_by('slug', $category, 'product_cat');

    $shortcode_content = ''; 

    if (isset($products_layout)) {
        if ($products_layout == '' || $products_layout == 'image_left') {
            if( $styles == '' || $styles == "style_1") {
                $block_type = 'woocommerce_categories2';
            }elseif($styles == "style_2") {
                $block_type = 'woocommerce_simple_styled';
            }
        }elseif($products_layout == 'image_top'){
            $block_type = 'woocommerce_categories2_top';
        }
    }else{
        $block_type = 'woocommerce_categories2';
    }

    if (!isset($number_of_columns) || (isset($number_of_columns) && $number_of_columns == '')) {
        $number_of_columns = '2';
    }

    if ($cat) {
        $shortcode_content .= '<div class="'.$block_type.'">';
            $shortcode_content .= '<div class="products_category">';
                $shortcode_content .= '<div class="category item col-md-3 '.$banner_pos.'" >';
                    $shortcode_content .= '<div style="'.$category_style_bg.'" class="category-wrapper">';
                        $shortcode_content .= '<a class="#categoryid_'.$cat->term_id.'">';
                            $shortcode_content .= '<span class="cat-name">'.$category.'</span>';                    
                        $shortcode_content .= '</a>';
                        $shortcode_content .= '<br>'; 

                        $shortcode_content .= '<span class="cat-count"><strong>'.$cat->count.'</strong> '.esc_html($products_label_text_value).'</span>';
                        $shortcode_content .= '<br>';
                        $shortcode_content .= '<div class="category-button '.$button_style.'">';
                           $shortcode_content .= '<a href="'.get_term_link($cat->slug, 'product_cat').'" class="button" title="'.__('View more', 'modeltheme').'" ><span>'.$button_text_value.'</span></a>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';    
                $shortcode_content .= '</div>';
                            $shortcode_content .= '<div id="categoryid_'.$cat->term_id.'" class=" col-md-9 products_by_categories '.$cat->name.'">'.do_shortcode('[product_category columns="'.$number_of_columns.'" per_page="'.$number_of_products_by_category.'" category="'.$category.'"]').'</div>';
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
        $shortcode_content .= '<div class="clearfix"></div>';
    }

    wp_reset_postdata();

    return $shortcode_content;
}
add_shortcode('shop-categories-with-xsthumbnails', 'faimos_shop_categories_with_xsthumbnails_shortcode');


/*---------------------------------------------*/
/*--- Woocommerce Only Product Categories  ---*/
/*---------------------------------------------*/

function faimos_shortcode_categories_image($params, $content) {
    extract( shortcode_atts( 
        array(
            'category'            => '',
            'category_title'      => '',
            'layout'              => '',
            'title_color'         => '',
            'animation'           => ''
        ), $params ) );
    
    $html  = '';
    $html .='<style type="text/css">
                .products_category_vertical_shortcode_holder .heading a {
                    color: '.$title_color.' !important;
                }
            </style>';

    $term = get_term_by('slug', $category, 'product_cat');
    if ($term) {
        $img_id = get_term_meta( $term->term_id, 'thumbnail_id', true ); 
        $img_id_2 = get_term_meta( $term->term_id, 'thumbnail_id', true );
        // get the image URL
        $thumbnail_src = wp_get_attachment_image_src( $img_id, 'faimos_testimonials_pic110x110' ); 
        $thumbnail_src_2 = wp_get_attachment_image_src( $img_id_2, 'faimos_related_post_pic500x300' ); 

        $query_count = new WP_Query( array( 'product_cat' => $term->name ) );
        $count_tax = $query_count->found_posts;
        if($count_tax == 1) {
            $count_string = __(' Product in this Category', 'modeltheme');
        } else {
            $count_string = __(' Products in this Category', 'modeltheme');
        }

        if (isset($layout)) {
            if ($layout == '' || $layout == 'horizontal') {
                $block_type = 'products_category_image_shortcode_holder';
                $thumbnail_type = $thumbnail_src;
            }elseif($layout == 'vertical'){
                $block_type = 'products_category_vertical_shortcode_holder text-center';
                $thumbnail_type = $thumbnail_src_2;
            }
        }else{
            $block_type = 'products_category_image_shortcode_holder';
        }

        $html .= '<div class="products_category_image_shortcode">';
          $html .= '<div class="'.$block_type.'">';
            $html .= '<a href="'.get_term_link($term->term_id, 'product_cat').'"><img class="cat-image" alt="cat-image" src="'.$thumbnail_type[0].'"></a>';
            $html .= '<div class="listings_category_footer">';
              $html .= '<h4 class="heading"><a href="'.get_term_link($term->term_id, 'product_cat').'">'. $category .'</a></h4>';
              $html .= '<div class="description"><p>'. $count_tax . esc_attr($count_string) .'</p></div>';
            $html .= '</div>';
          $html .= '</div>';
        $html .= '</div>';
    }
    return $html;
}
add_shortcode('mt_faimos_category_image', 'faimos_shortcode_categories_image');


/*---------------------------------------------*/
/*--- Woocommerce Products Carousel ---*/
/*---------------------------------------------*/

function mt_carousel_products($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'true',
            'navigationText' => '',
            'order' => 'desc',
            'pagination' => 'true',
            'autoPlay' => 'true',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';

    // CLASSES
    $class_slider = 'mt_carousel_products_'.uniqid();

    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        navigationText  : '.$navigationText.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';

        $html .= '<div class="modeltheme_products_carousel '.$class_slider.' row  owl-carousel owl-theme">';
        $args_blogposts = array(
              'posts_per_page'   => $number,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
         ); 
        $blogposts = get_posts($args_blogposts);
        
        foreach ($blogposts as $blogpost) {
                #metaboxes

                #thumbnail
                 $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $blogpost->ID ), 'faimos_portfolio_pic400x400' );
                 $product_cause = get_post_meta( $blogpost->ID, 'product_cause', true );
                if ($thumbnail_src) {
                    $post_img = '<img class="portfolio_post_image" src="'. esc_url($thumbnail_src[0]) . '" alt="'.$blogpost->post_title.'" />';
                    $post_col = 'col-md-12';
                  }else{
                    $post_col = 'col-md-12 no-featured-image';
                    $post_img = '';
                  }
            $html .= '<div id="product-id-'.esc_attr($blogpost->ID).'">
                        <div class="col-md-12 modeltheme-slider ">
                            <div class="modeltheme-slider-wrapper"> 
                              <div class="thumbnail-and-details">
                                <a class="woo_catalog_media_images" title="'.esc_attr($blogpost->post_title).'" href="'.esc_url(get_permalink($blogpost->ID)).'"> '.$post_img.'</a>';
                                $vendor_id      = wcfm_get_vendor_id_by_post( get_the_id() );
                                if( $vendor_id ) {
                                    $html .= '<div class="overlay-vendor">';
                                        $store_name     = wcfm_get_vendor_store( absint($vendor_id) );
                                        $store_user     = wcfmmp_get_store( $vendor_id );
                                        $store_info     = $store_user->get_shop_info();
                                        $gravatar       = $store_user->get_avatar();
                                        $html .= '<div class="logo_area lft"><img src="'.esc_url($gravatar).'" alt="Logo"/></div>';
                                            $html .= '<p class="vendor_name">'.wp_kses_post($store_name).'</p> ';
                                            if( get_user_meta($vendor_id, 'wcfm_instagram_count', true) ) {
                                               $html .= '<span><a href="'.wcfmmp_generate_social_url( $store_info['social']['instagram'], 'instagram' ).'" target="_blank">'.get_user_meta($vendor_id, 'wcfm_instagram_count', true).' '.esc_html__('followers','faimos').'</a></span>';
                                            }
                                        $html .= '</div>';
                                }
                              $html .= '</div>
                              <div class="modeltheme-title-metas text-center">
                                <h3 class="modeltheme-archive-product-title">
                                  <a href="'.esc_url(get_permalink($blogpost->ID)).'" title="'. $blogpost->post_title .'">'. $blogpost->post_title .'</a>
                                </h3>';
                    $html .= '</div>
                            </div>
                        </div>                     
                    </div>';
                }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt-products-carousel', 'mt_carousel_products');


/*---------------------------------------------*/
/*--- Masonry Banners ---*/
/*---------------------------------------------*/
function faimos_shop_masonry_banners_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'default_skin_background_color'      => '',
            'dark_skin_background_color'         => '',
            'banner_1_img'                       => '',
            'banner_1_title'                     => '',
            'banner_1_count'                     => '',
            'banner_1_url'                       => '',
            'banner_2_img'                       => '',
            'banner_2_title'                     => '',
            'banner_2_count'                     => '',
            'banner_2_url'                       => '',
            'banner_3_img'                       => '',
            'banner_3_title'                     => '',
            'banner_3_count'                     => '',
            'banner_3_url'                       => '',
            'banner_4_img'                       => '',
            'banner_4_title'                     => '',
            'banner_4_count'                     => '',
            'banner_4_url'                       => '',
            'button_style'                       => ''
        ), $params ) );

    
    
    $shortcode_content = '';


    $shortcode_content .= '<div class="masonry_banners banners_column">';

        $img1 = wp_get_attachment_image_src($banner_1_img, "large");
        $img2 = wp_get_attachment_image_src($banner_2_img, "large");
        $img3 = wp_get_attachment_image_src($banner_3_img, "large");
        $img4 = wp_get_attachment_image_src($banner_4_img, "large");

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #1
            if (isset($img1) && !empty($img1)) {
                $shortcode_content .= '<div class="masonry_banner default-skin" style=" background-color: '.$default_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_1_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img1[0].'" alt="'.$banner_1_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_1_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_1_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
            #IMG #2
            if (isset($img2) && !empty($img2)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin" style="background-color: '.$dark_skin_background_color.'!important;">';
                    $shortcode_content .= '<a href="'.$banner_2_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img2[0].'" alt="'.$banner_2_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_2_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_2_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';

        $shortcode_content .= '<div class="vc_col-md-6">';
            #IMG #3
            if (isset($img3) && !empty($img3)) {
                $shortcode_content .= '<div class="masonry_banner dark-skin">';
                    $shortcode_content .= '<a href="'.$banner_3_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img3[0].'" alt="'.$banner_3_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_3_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_3_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
            #IMG #4
            if (isset($img4) && !empty($img4)) {
                $shortcode_content .= '<div class="masonry_banner default-skin">';
                    $shortcode_content .= '<a href="'.$banner_4_url.'" class="relative">';
                        $shortcode_content .= '<img src="'.$img4[0].'" alt="'.$banner_4_title.'" />';
                        $shortcode_content .= '<div class="masonry_holder">';
                            $shortcode_content .= '<h3 class="category_name">'.$banner_4_title.'</h3>';
                             $shortcode_content .= '<p class="category_count">'.$banner_4_count.'</p>';
                            $shortcode_content .= '<span class="read-more '.$button_style.'">'.esc_html__('VIEW MORE', 'modeltheme').'</span>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';
            }
        $shortcode_content .= '</div>';
    $shortcode_content .= '</div>';

    return $shortcode_content;
}
add_shortcode('shop-masonry-banners', 'faimos_shop_masonry_banners_shortcode');


/*---------------------------------------------*/
/*--- Masonry Banners ---*/
/*---------------------------------------------*/
function faimos_shop_sale_banner_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'banner_img'            => '',
            'banner_button_text'    => '',
            'banner_button_count'   => '',
            'banner_button_url'     => '',
            'color_style'           => '',
            'layout'                => ''
        ), $params ) );

    $banner = wp_get_attachment_image_src($banner_img, "large");
    if (isset($layout)) {
        if ($layout == '' || $layout == 'right-center') {
            $layout_type = 'sale_banner_holder right';
        }elseif($layout == 'center'){
            $layout_type = 'sale_banner_center';
        }elseif($layout == 'bottom'){
            $layout_type = 'sale_banner_holder';
        }
    }else{
        $layout_type = 'sale_banner_holder';
    }

    $shortcode_content = '';
    #SALE BANNER
    $shortcode_content .= '<div class="sale_banner relative">';
            $shortcode_content .= '<img src="'.$banner[0].'" alt="'.$banner_button_text.'" />';
            $shortcode_content .= '<a href="'.$banner_button_url.'">
                                    <div class="'.$layout_type.'">';
                $shortcode_content .= '<div class="masonry_holder '.$color_style.'">';
                    $shortcode_content .= '<p class="category_count">'.$banner_button_count.'</p>';
                    $shortcode_content .= '<h3 class="category_name">'.$banner_button_text.'</h3>';
                    $shortcode_content .= '<span class="read-more">'.esc_html__('Check Now', 'modeltheme').'</span>';
                $shortcode_content .= '</div>';
            $shortcode_content .= '</div></a>';
    $shortcode_content .= '</div>';
       
    return $shortcode_content;
}
add_shortcode('sale-banner', 'faimos_shop_sale_banner_shortcode');






/*---------------------------------------------*/
/*--- 28. BLOG POSTS ---*/
/*---------------------------------------------*/
function faimos_show_blog_post_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'            => '',
            'category'          => '',
            'overlay_color'     => '',
            'text_color'        => '',
            'columns'           => '',
            'layout'            => '',
            'styles'            => '',
            'block_color'       => '',
            'date_color'        => ''
           ), $params ) );
    $args_posts = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);
    $shortcode_content = '';
    $shortcode_content .='<style type="text/css">
                            .head-content.style3 {
                                background: '.$block_color.' !important;
                            }
                            .head-content.style3 p{
                                color: '.$date_color.' !important;
                            }
                        </style>';
    $shortcode_content .= '<div class="faimos_shortcode_blog vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'faimos_portfolio_pic400x400' );
        $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'faimos_portfolio_pic700x450' );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID);

        if ( $columns == 'col-md-6') {
            $column_type = 'col-md-6';
        }else{
            $column_type = 'col-md-4';
        } 

        $shortcode_content .= '<div class="'.$column_type.' post '.$layout.'">';
            if($layout == "image_left" || $layout == "") {
                
                    $shortcode_content .= '<div class="col-md-4 blog-thumbnail">';
                        $shortcode_content .= '<a href="'.$url.'" class="relative">';
                            if($thumbnail_src) { 
                                $shortcode_content .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                            }else{ 
                                $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                            }
                            $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                                $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                            $shortcode_content .= '</div>';
                        $shortcode_content .= '</a>';
                    $shortcode_content .= '</div>';

                    $shortcode_content .= '<div class="col-md-8 blog-content">';
                     $shortcode_content .= '<p class="author">';
                                    $shortcode_content .= '<span class="post-tags">
                                      '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                                    </span>';
                                $shortcode_content .= '</p>';
                        $shortcode_content .= '<div class="head-content">';
                            $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                        $shortcode_content .= '</div>';
                        $shortcode_content .= '<div class="post-excerpt">'.wp_trim_words($excerpt,25).'</div>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</div>'; 
            }else{

                if($styles == "style_1" || $styles == "") {
                  $shortcode_content .= '<div class="blog-wrapper ">';
                    $shortcode_content .= '<div class="blog-thumbnail ">';
                        $shortcode_content .= '<a href="'.$url.'" class="relative">';
                            if($thumbnail_src) { 
                                $shortcode_content .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                            }else{ 
                                $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                            }
                        $shortcode_content .= '</a>';
                    $shortcode_content .= '</div>';

                    $shortcode_content .= '<div class="blog-content">';
                        $shortcode_content .= '<div class="content-element">';
                                $shortcode_content .= '<p class="author">';
                                    $shortcode_content .= '<span class="post-tags">
                                  '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                                </span>';
                                $shortcode_content .= '</p>';
                                $shortcode_content .= '<a href="'.get_the_permalink().'">
                                                      <span class="blog_date blog_day">'.get_the_date( 'j', $post->ID).'</span>
                                                      <span class="blog_date blog_month">'.get_the_date( 'M Y', $post->ID).'</span>
                                                    </a>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '<div class="head-content">';
                            $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                    $shortcode_content .= '</div>';
                    
                        $shortcode_content .= '<div class="post-excerpt">'.wp_trim_words($excerpt,16).'</div>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</div></div>';

            } else {

                if($styles == "style_3") {
                    $style   = 'text-left';
                    $version = 'style3';
                } else {
                    $style = 'text-center';
                }

                $shortcode_content .= '<div class="col-md-12 blog-thumbnail ">';
                    $shortcode_content .= '<a href="'.$url.'" class="relative">';
                        if($thumbnail_src) { 
                            $shortcode_content .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                        }else{ 
                            $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                        }
                    $shortcode_content .= '</a>';
                $shortcode_content .= '</div>';

                $shortcode_content .= '<div class="boxed-shadow  col-md-12 blog-content">';
                
                    $shortcode_content .= '<div class="head-content '.$version.'">';
                        $shortcode_content .= '<p class="'.$style.'">'.esc_html(get_the_date()).'</p>';
                        $shortcode_content .= '<h3 class="post-name '.$style.'"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                         $shortcode_content .= '<div class="content-element '.$style.'">';
                            $shortcode_content .= '<p class="author ">';
                                $shortcode_content .= '<span class="post-tags">
                                  '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                                </span>';
                            $shortcode_content .= '</p>';
                        $shortcode_content .= '</div>';
                    $shortcode_content .= '</div>';
                   
                $shortcode_content .= '</div>';
                $shortcode_content .= '</div>';
            }
        }
    } 
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('faimos-blog-posts', 'faimos_show_blog_post_shortcode');


/*---------------------------------------------*/
/*--- 29. Social Media ---*/
/*---------------------------------------------*/
function faimos_social_icons_shortcode($params, $content) {
    extract( shortcode_atts( 
        array(
            'facebook'      => '',
            'twitter'       => '',
            'pinterest'     => '',
            'skype'         => '',
            'instagram'     => '',
            'youtube'       => '',
            'dribbble'      => '',
            'googleplus'    => '',
            'linkedin'      => '',
            'deviantart'    => '',
            'digg'          => '',
            'flickr'        => '',
            'stumbleupon'   => '',
            'tumblr'        => '',
            'vimeo'         => '',
            'animation'     => ''
        ), $params ) ); 
        $content = '';
        $content .= '<div class="sidebar-social-networks vc_social-networks widget_social_icons animateIn vc_row" data-animate="'.$animation.'">';
            $content .= '<ul class="vc_col-md-12">';
            if ( isset($facebook) && $facebook != '' ) {
                $content .= '<li><a href="'.esc_attr( $facebook ).'"><i class="fa fa-facebook"></i></a></li>';
            }
            if ( isset($twitter) && $twitter != '' ) {
                $content .= '<li><a href="'.esc_attr( $twitter ).'"><i class="fa fa-twitter"></i></a></li>';
            }
            if ( isset($pinterest) && $pinterest != '' ) {
                $content .= '<li><a href="'.esc_attr( $pinterest ).'"><i class="fa fa-pinterest"></i></a></li>';
            }
            if ( isset($youtube) && $youtube != '' ) {
                $content .= '<li><a href="'.esc_attr( $youtube ).'"><i class="fa fa-youtube"></i></a></li>';
            }
            if ( isset($instagram) && $instagram != '' ) {
                $content .= '<li><a href="'.esc_attr( $instagram ).'"><i class="fa fa-instagram"></i></a></li>';
            }
            if ( isset($linkedin) && $linkedin != '' ) {
                $content .= '<li><a href="'.esc_attr( $linkedin ).'"><i class="fa fa-linkedin"></i></a></li>';
            }
            if ( isset($skype) && $skype != '' ) {
                $content .= '<li><a href="skype:'.esc_attr( $skype ).'?call"><i class="fa fa-skype"></i></a></li>';
            }
            if ( isset($googleplus) && $googleplus != '' ) {
                $content .= '<li><a href="'.esc_attr( $googleplus ).'"><i class="fa fa-google-plus"></i></a></li>';
            }
            if ( isset($dribbble) && $dribbble != '' ) {
                $content .= '<li><a href="'.esc_attr( $dribbble ).'"><i class="fa fa-dribbble"></i></a></li>';
            }
            if ( isset($deviantart) && $deviantart != '' ) {
                $content .= '<li><a href="'.esc_attr( $deviantart ).'"><i class="fa fa-deviantart"></i></a></li>';
            }
            if ( isset($digg) && $digg != '' ) {
                $content .= '<li><a href="'.esc_attr( $digg ).'"><i class="fa fa-digg"></i></a></li>';
            }
            if ( isset($flickr) && $flickr != '' ) {
                $content .= '<li><a href="'.esc_attr( $flickr ).'"><i class="fa fa-flickr"></i></a></li>';
            }
            if ( isset($stumbleupon) && $stumbleupon != '' ) {
                $content .= '<li><a href="'.esc_attr( $stumbleupon ).'"><i class="fa fa-stumbleupon"></i></a></li>';
            }
            if ( isset($tumblr) && $tumblr != '' ) {
                $content .= '<li><a href="'.esc_attr( $tumblr ).'"><i class="fa fa-tumblr"></i></a></li>';
            }
            if ( isset($vimeo) && $vimeo != '' ) {
                $content .= '<li><a href="'.esc_attr( $vimeo ).'"><i class="fa fa-vimeo-square"></i></a></li>';
            }
            $content .= '</ul>';
        $content .= '</div>';
        return $content;
}
add_shortcode('social_icons', 'faimos_social_icons_shortcode');


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// check for plugin using plugin name
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
  require_once('vc-shortcodes.inc.php');
} 

/**

||-> Shortcode: Members Slider

*/

function mt_shortcode_members01($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation' => '',
            'number' => '',
            'navigation' => 'false',
            'order' => 'desc',
            'pagination' => 'false',
            'autoPlay' => 'false',
            'button_text' => '',
            'button_link' => '',
            'button_background' => '',
            'paginationSpeed' => '700',
            'slideSpeed' => '700',
            'number_desktop' => '4',
            'number_tablets' => '2',
            'number_mobile' => '1'
        ), $params ) );


    $html = '';



    // CLASSES
    $class_slider = 'mt_slider_members_'.uniqid();



    $html .= '<script>
                jQuery(document).ready( function() {
                    jQuery(".'.$class_slider.'").owlCarousel({
                        navigation      : '.$navigation.', // Show next and prev buttons
                        pagination      : '.$pagination.',
                        autoPlay        : '.$autoPlay.',
                        slideSpeed      : '.$paginationSpeed.',
                        paginationSpeed : '.$slideSpeed.',
                        autoWidth: true,
                        itemsCustom : [
                            [0,     '.$number_mobile.'],
                            [450,   '.$number_mobile.'],
                            [600,   '.$number_desktop.'],
                            [700,   '.$number_tablets.'],
                            [1000,  '.$number_tablets.'],
                            [1200,  '.$number_desktop.'],
                            [1400,  '.$number_desktop.'],
                            [1600,  '.$number_desktop.']
                        ]
                    });
                    
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item:nth-child(2)").addClass("hover_class");
                jQuery(".'.$class_slider.' .owl-wrapper .owl-item").hover(
                  function () {
                    jQuery(".'.$class_slider.' .owl-wrapper .owl-item").removeClass("hover_class");
                    if(jQuery(this).hasClass("open")) {
                        jQuery(this).removeClass("open");
                    } else {
                    jQuery(this).addClass("open");
                    }
                  }
                );


                });
              </script>';


        $html .= '<div class="mt_members1 '.$class_slider.' row animateIn wow '.$animation.'">';
        $args_members = array(
                'posts_per_page'   => $number,
                'orderby'          => 'post_date',
                'order'            => $order,
                'post_type'        => 'member',
                'post_status'      => 'publish' 
                ); 
        $members = get_posts($args_members);
            foreach ($members as $member) {
                #metaboxes
                $metabox_member_position = get_post_meta( $member->ID, 'av-job-position', true );

                $metabox_facebook_profile = get_post_meta( $member->ID, 'av-facebook-link', true );
                $metabox_twitter_profile  = get_post_meta( $member->ID, 'av-twitter-link', true );
                $metabox_linkedin_profile = get_post_meta( $member->ID, 'av-gplus-link', true );
                $metabox_vimeo_url = get_post_meta( $member->ID, 'av-instagram-link', true );

                $member_title = get_the_title( $member->ID );

                $testimonial_id = $member->ID;
                $content_post   = get_post($member);
                $content        = $content_post->post_content;
                $content        = apply_filters('the_content', $content);
                $content        = str_replace(']]>', ']]&gt;', $content);
                #thumbnail
                $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $member->ID ),'full' );

                if($metabox_facebook_profile) {
                    $profil_fb = '<a target="_new" href="'. $metabox_facebook_profile .'" class="member01_profile-facebook"> <i class="fa fa-facebook" aria-hidden="true"></i></a> ';
                }

                if($metabox_twitter_profile) {
                    $profil_tw = '<a target="_new" href="https://twitter.com/'. $metabox_twitter_profile .'" class="member01_profile-twitter"> <i class="fa fa-twitter" aria-hidden="true"></i></a> ';
                }

                if($metabox_linkedin_profile) {
                    $profil_in = '<a target="_new" href="'. $metabox_linkedin_profile .'" class="member01_profile-linkedin"> <i class="fa fa-linkedin" aria-hidden="true"></i> </a> ';
                }

                if($metabox_vimeo_url) {
                    $profil_vi = '<a target="_new" href="'. $metabox_vimeo_url .'" class="member01_vimeo_url"> <i class="fa fa-vimeo" aria-hidden="true"></i> </a> ';
                }
                
                $html.='
                    <div class="col-md-12 relative">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div id="member_hover" class="members_img_holder">
                                    
                                    <div class="memeber01-img-holder">';
                                        if($thumbnail_src) { 
                                            $html .= '<div class="grid">
                                                        <div class="effect-duke">
                                                            <img src="'. $thumbnail_src[0] . '" alt="'. $member->post_title .'" />
                                                        </div>
                                                      </div>';
                                        }else{ 
                                            $html .= '<img src="http://placehold.it/450x1000" alt="'. $member->post_title .'" />'; 
                                        }
                                    $html.='</div>
                                    
                                   </div>
                                   <div class="member01-content">
                                        <div class="member01-content-inside">
                                            <h3 class="member01_name">'.$member_title.'</h3>
                                            <div class="content-div"><p class="member01_content-desc">'.  $metabox_member_position. '</p></div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>';

            }
    $html .= '</div>';
    wp_reset_postdata();
    return $html;
}
add_shortcode('mt_members_slider', 'mt_shortcode_members01');



function modeltheme_icon_listgroup_shortcode($params, $content) {
  extract( shortcode_atts( 
      array(
          'list_icon'               => '',
          'list_image'              => '',
          'list_image_max_width'    => '',
          'list_image_margin'       => '',
          'list_icon_size'          => '',
          'list_icon_margin'        => '',
          'list_icon_color'         => '',
          'list_icon__hover_color'  => '',
          'list_icon_title'         => '',
          'list_icon_url'           => '',
          'list_icon_title_size'    => '',
          'list_icon_title_color'   => '',
          'list_icon_subtitle'                => '',
          'list_icon_subtitle_size'      => '',
          'list_icon_subtitle_color'          => '',
          'animation'               => '',
      ), $params ) );
  $thumb      = wp_get_attachment_image_src($list_image, "full");
  $thumb_src  = $thumb[0];
  $html = '';
  if(!empty($list_icon__hover_color)) {
    $html .= '<style type="text/css">
                  .mt-icon-listgroup-holder:hover i {
                      color: '.$list_icon__hover_color.' !important;
                  }
              </style>';
  }
  $html .= '<div class="mt-icon-listgroup-item wow '.$animation.'">';
              if (!empty($list_icon_url)) {
                $html .= '<a href="'.$list_icon_url.'">';
              }
      $html .= '<div class="mt-icon-listgroup-holder">
                  <div class="mt-icon-listgroup-icon-holder-inner">';
                    if(empty($list_image)) {
                    $html .= '<i style="margin-right:'.esc_attr($list_icon_margin).'px; color:'.esc_attr($list_icon_color).';font-size:'.esc_attr($list_icon_size).'px" class="'.esc_attr($list_icon).'"></i>';
                    } else {
                      $html .='<img alt="list-image" style="margin-right:'.esc_attr($list_image_margin).'px;" class="mt-image-list" src="'.esc_attr($thumb_src).'">';
                    }
                  $html .= '</div>
                <div class="mt-icon-listgroup-content-holder-inner">
                  <p class="mt-icon-listgroup-title" style="font-size: '.esc_attr($list_icon_title_size).'px; color: '.esc_attr($list_icon_title_color).'">'.esc_attr($list_icon_title).'</p>
                  <p class="mt-icon-listgroup-text" style="font-size: '.esc_attr($list_icon_subtitle_size).'px; color: '.esc_attr($list_icon_subtitle_color).'">'.esc_attr($list_icon_subtitle).'</p>                  
                </div>
              </div>';
              if (!empty($list_icon_url)) {
                $html .= '</a>';
              }
            $html .= '</div>';
  return $html;
}
add_shortcode('mt_list_group', 'modeltheme_icon_listgroup_shortcode');
/**
||-> Map Shortcode in Visual Composer with: vc_map();
*/
if ( is_plugin_active( 'js_composer/js_composer.php' ) ) {
  vc_map( array(
     "name" => esc_attr__("faimos - Icon List Group Item", 'modeltheme'),
     "base" => "mt_list_group",
     "category" => esc_attr__('faimos', 'modeltheme'),
     "icon" => plugins_url( 'images/list-group.svg', __FILE__ ),
     "params" => array(
        array(
          "group" => "Image Setup",
          "type" => "attach_images",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__( "Choose image", 'modeltheme' ),
          "param_name" => "list_image",
          "value" => "",
          "description" => esc_attr__( "If you set this, will overwrite the icon setup.", 'modeltheme' )
        ),
        array(
          "group" => "Image Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image max width", 'modeltheme'),
          "param_name" => "list_image_max_width",
          "value" => "50",
          "description" => "Default: 50(px)"
        ),
        array(
          "group" => "Image Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Image Margin right (px)", 'modeltheme'),
          "param_name" => "list_image_margin",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Size (px)", 'modeltheme'),
          "param_name" => "list_icon_size",
          "value" => "",
          "description" => "Default: 18(px)"
        ),
        array(
          "group" => "Icon Setup",
          "type" => "textfield",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Margin right (px)", 'modeltheme'),
          "param_name" => "list_icon_margin",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Color", 'modeltheme'),
          "param_name" => "list_icon_color",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Icon Setup",
          "type" => "colorpicker",
          "holder" => "div",
          "class" => "",
          "heading" => esc_attr__("Icon Hover Color", 'modeltheme'),
          "param_name" => "list_icon__hover_color",
          "value" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/Title", 'modeltheme'),
          "param_name" => "list_icon_title",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: This is a label"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/SubTitle", 'modeltheme'),
          "param_name" => "list_icon_subtitle",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: This is a label"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Label/Icon URL", 'modeltheme'),
          "param_name" => "list_icon_url",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => "Eg: http://modeltheme.com"
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("Title Font Size", 'modeltheme'),
          "param_name" => "list_icon_title_size",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "colorpicker",
          "heading" => esc_attr__("Title Color", 'modeltheme'),
          "param_name" => "list_icon_title_color",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "textfield",
          "heading" => esc_attr__("SubTitle Font Size", 'modeltheme'),
          "param_name" => "list_icon_subtitle_size",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ),
        array(
          "group" => "Label Setup",
          "type" => "colorpicker",
          "heading" => esc_attr__("SubTitle Color", 'modeltheme'),
          "param_name" => "list_icon_subtitle_color",
          "std" => '',
          "holder" => "div",
          "class" => "",
          "description" => ""
        ), 
     )
  ));
}

/*--------------------------------------------- */
/*--- 30. Countdown ---*/
/*---------------------------------------------*/
function faimos_countdown_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'date'                       => '',
            'digits_font_size'           => '',
            'digits_line_height'           => '',
            'texts_font_size'            => '',
            'texts_line_height'            => '',
            'digit_color'                => '',
            'text_color'                 => '',
            'dots_color'                 => '',
            'dots_font_size'                 => '',
            'dots_line_height'                 => ''
        ), $params ) );
    // DIGITS STYLE
    $digit_style = '';
    if (isset($digit_color)) {
      $digit_style .= 'color:'.esc_attr($digit_color).';';
    }
    if (isset($digits_font_size)) {
      $digit_style .= 'font-size: '.esc_attr($digits_font_size).' !important;';
    }
    if (isset($digits_line_height)) {
      $digit_style .= 'line-height: '.esc_attr($digits_line_height).' !important;';
    }
    // LABELS STYLE
    $text_style = '';
    if (isset($text_color)) {
      $text_style .= 'color:'.esc_attr($text_color).';';
    }
    if (isset($texts_font_size)) {
      $text_style .= 'font-size: '.esc_attr($texts_font_size).' !important;';
    }
    if (isset($digits_line_height)) {
      $text_style .= 'line-height: '.esc_attr($digits_line_height).' !important;';
    }
    // DOTS STYLE
    $dots_style = '';
    if (isset($dots_color)) {
      $dots_style = 'color:'.esc_attr($dots_color).';';
    }
    if (isset($dots_font_size)) {
      $dots_style .= 'font-size: '.esc_attr($dots_font_size).' !important;';
    }
    if (isset($dots_line_height)) {
      $dots_style .= 'line-height: '.esc_attr($dots_line_height).' !important;';
    }
    // YYYY/MM/DD hh:mm:ss
    // 
    $uniqueID = 'countdown_'.uniqid();
    $content = '';
    $content .= '<div class="text-center row"><div id="'.esc_attr($uniqueID).'" class="modeltheme-countdown"></div></div>';
    $content .= '<script type="text/javascript">
                  jQuery( document ).ready(function() {
                    //get each width
                    var width_days'.esc_attr($uniqueID).' = jQuery(\'.rev_slider #'.esc_attr($uniqueID).' .days-digit\').width();
                    var width_hours'.esc_attr($uniqueID).' = jQuery(\'.rev_slider #'.esc_attr($uniqueID).' .hours-digit\').width();
                    var width_minutes'.esc_attr($uniqueID).' = jQuery(\'.rev_slider #'.esc_attr($uniqueID).' .minutes-digit\').width();
                    var width_seconds'.esc_attr($uniqueID).' = jQuery(\'.rev_slider #'.esc_attr($uniqueID).' .seconds-digit\').width();
                    var width_dots'.esc_attr($uniqueID).' = jQuery(\'.rev_slider #'.esc_attr($uniqueID).' .c_dot\').width();
                    var width_dots_x3'.esc_attr($uniqueID).' = width_dots'.esc_attr($uniqueID).'*7;
                    //total width
                    var width_sum'.esc_attr($uniqueID).' = width_days'.esc_attr($uniqueID).'+width_hours'.esc_attr($uniqueID).'+width_minutes'.esc_attr($uniqueID).'+width_seconds'.esc_attr($uniqueID).'+width_dots_x3'.esc_attr($uniqueID).';
                    //test
                    //console.log(width_sum'.esc_attr($uniqueID).');
                    //apply width
                    jQuery(".rev_slider #'.esc_attr($uniqueID).'").width(width_sum'.esc_attr($uniqueID).');
                    jQuery("#'.esc_attr($uniqueID).'").countdown("'.esc_attr($date).'", function(event) {
                      jQuery(this).html(
                        event.strftime("<div class=\'days\'>"
                                          +"<div class=\'days-digit\' style=\''.esc_attr($digit_style).'\'>%D</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'days-name\' style=\''.esc_attr($text_style).'\'>Days</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.esc_attr($dots_style).'\'>&middot;</span>"
                                        +"<div class=\'hours\'>"
                                          +"<div class=\'hours-digit\'  style=\''.esc_attr($digit_style).'\'>%H</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'hours-name\' style=\''.esc_attr($text_style).'\'>Hours</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.esc_attr($dots_style).'\'>&middot;</span>"
                                        +"<div class=\'minutes\'>"
                                          +"<div class=\'minutes-digit\' style=\''.esc_attr($digit_style).'\'>%M</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'minutes-name\' style=\''.esc_attr($text_style).'\'>Minutes</div>"
                                        +"</div>"
                                        +"<span class=\'c_dot\' style=\''.esc_attr($dots_style).'\'>&middot;</span>"
                                        +"<div class=\'seconds\'>"
                                          +"<div class=\'seconds-digit\' style=\''.esc_attr($digit_style).'\'>%S</div>"
                                          +"<div class=\'clearfix\'></div>"
                                          +"<div class=\'seconds-name\' style=\''.esc_attr($text_style).'\'>Seconds</div>"
                                        +"</div>")
                      );
                    });
                  });
                </script>';
    return $content;
}
add_shortcode('mt-countdown', 'faimos_countdown_shortcode');

/*--------------------------------------------- */
/*--- 30. Countdown version 2 ---*/
/*---------------------------------------------*/
function modeltheme_shortcode_countdown_version_2($params, $content) {

    extract( shortcode_atts( 
        array(
            'animation'                 => '',
            'insert_date'               => '',
            'el_class'              => ''
        ), $params ) );

    $html = '';
    
    $uniqueID = 'countdown_'.uniqid();

    // custom javascript
    $html .= '<script type="text/javascript">
      var clock;

      jQuery(document).ready(function() {

        // Grab the current date
        var currentDate = new Date();

        // Grab the date inserted by user
        var inserted_date = new Date("'.$insert_date.'");

        // Calculate the difference in seconds between the future and current date
        var diff = inserted_date.getTime() / 1000 - currentDate.getTime() / 1000;

        // Instantiate a coutdown FlipClock
        clock = jQuery("#'.$uniqueID.'").FlipClock(diff, {
          clockFace: "DailyCounter",
          countdown: true
        });
      });
    </script>';

              
    $html .= '<div class="countdownv2_holder '.$el_class.'">';
        $html .= '<div class="countdownv2 clock " id="'.$uniqueID.'"></div>';
    $html .= '</div>';
    

      

    return $html;
}

add_shortcode('shortcode_countdown_v2', 'modeltheme_shortcode_countdown_version_2');


/**

||-> Shortcode: Featured Product

*/
function modeltheme_shortcode_featured_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text'                     =>'',
            'subtitle_product'                =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';

    


    $html .= '<div class="featured_product_shortcode col-md-12 wow '.$animation.' " style=" background-color: '.$background_color.';">';
      $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
              ); 

              
      $blogposts = get_posts($args_blogposts);
      

      foreach ($blogposts as $blogpost) {
      global $woocommerce, $product, $post;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;
      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);

        $html .= '<div class="featured_product_image_holder col-md-6">';
          if ( has_post_thumbnail( $select_product ) ) {
              $attachment_ids[0] = get_post_thumbnail_id( $select_product );
              $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
              $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
             }
        $html .= '</div>';

        $html .= '<div class="featured_product_details_holder  col-md-6">';
          $html.='<h2 class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</h2>';
          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>

                  </h1>';
          
          $html.='<h3 class="featured_product_price" style="color: '.$price_text_color.';">' .esc_html__("Current bid :","modeltheme").' '.$product->get_price_html().'</h2>';
          $html.='<div class="featured_product_description">'.$content.'</div>';
          $html.='<div class="featured_product_countdown">
                    
                 '.do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d')).'"]').'</div>';
       
          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';

        $html .= '</div>';

      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_product', 'modeltheme_shortcode_featured_product');

/*--------------------------------------------- */
/*--- Search Form ---*/
/*---------------------------------------------*/
function modeltheme_shortcode_ico_search($params, $content) {
    extract( shortcode_atts( 
        array(
            'width_type'                  =>'',
            'popular_searches'                =>'',
            'animation'                   =>'',
            'mtsearchform_style_variant'        =>'',
            'extra_class'                   =>'',
        ), $params ) );
    
    $html = '';
    if (isset($btn_background_color_hover)) {
        $html .= '<style>
                  .slider-state-submit button:hover,
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit button:before{
                    background: '.$btn_background_color_hover.' !important;
                  }
                  .mt-car-search .select2-container--default .select2-selection--single .select2-selection__rendered {
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control::-webkit-input-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control::-moz-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control:-ms-input-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .slider-state-search .search-field.form-control:-moz-placeholder{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .search-field.form-control {
                       color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mt-car-search .select2.select2-container .select2-selection .select2-selection__arrow::before{
                      color: '.$mt_ico_search_text_color.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit input {
                      border-color: '.$btn_background_color_normal.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .slider-state-submit button:hover {
                      border-color: '.$btn_background_color_hover.' !important;
                  }
                  .mtsearchform-style-v2.mt-car-search .submit .form-control:hover{
                      color: '.$btn_text_color.' !important;
                  }
                </style>';
    }

    $html .= '<div class="mt-product-search mt-product-search-shortcode wow '.esc_attr($animation).' '.$mtsearchform_style_variant.' '.$extra_class.'">
                <div class="faimos-header-searchform">
                    <form name="header-search-form" autocomplete="off" method="GET" class="woocommerce-product-search menu-search" action="' .home_url('/'). '">';
                        $html .= '<input type="hidden" value="product" name="prodyct_cat">
                        <div class="slider-state-select select-categories col-md-3 '.esc_attr($width_type).'">          
                            <select name="product_cat" class="select-car-type form-control">';
                            if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
                              $optsetlect=$_REQUEST['product_cat'];
                            } else {
                              $optsetlect=0;  
                            }
                              $terms_c = get_terms( 'product_cat' );
                              $html .= "<option value=''>".esc_html__('Platforms','modeltheme')."</option>";
                              foreach ($terms_c as $term) {
                                $html .= "<option value='{$term->slug}'>{$term->name}</option>";
                              }
                            $html .= '</select>
                          </div>

                        <div class="slider-state-search col-md-8 '.esc_attr($width_type).'">
                            <input type="search" class="search-field form-control search-keyword" placeholder="'.esc_html__( 'Search...','modeltheme' ).'" value="'.get_search_query().'" name="s" onkeyup="faimos_fetch_products()" />
                        </div>

                        <div class="slider-state-submit col-md-1 '.esc_attr($width_type).' submit">
                            <button type="submit" class="form-control btn btn-warning"><i class="fas fa-search" aria-hidden="true"></i></button>
                        </div>
                        <input type="hidden" name="post_type" value="product" />
                        <div class="clearfix"></div>
                    </form>
                  <div class="data_fetch"></div>
                </div>
              </div>';
    return $html;
}
add_shortcode('mt_ico_search', 'modeltheme_shortcode_ico_search');


/**
||-> Shortcode: Featured Product
*/
function modeltheme_shortcode_featured_simple_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'price_text_color'                =>'',
            'subtitle_product'                =>'',
            'bar_value'                       =>'',
            'progress_bg'                     =>'',
            'countdown_opt'                   =>'',
            'subtitle_countdown'              =>'',
            'countdown_bg'                    =>'',
            'countdown_color'                 =>'',
            'featured_img'                    =>'',
            'product_img'                     =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';
    $html .='<style type="text/css">
                .featured_product_shortcode .featured_product_name a {
                    color: '.$product_name_text_color.' !important;
                }
                .featured_product_shortcode.simple span.amount{
                    color: '.$price_text_color.' !important;
                }
                .featured_product_shortcode.simple .featured_product_description p{
                    color: '.$category_text_color.' !important;
                }
                .featured_product_shortcode.simple .progress-bar-success{
                    background: '.$progress_bg.' !important;
                }
                .featured_product_shortcode.simple .featured_countdown .row div{
                    color: '.$countdown_color.' !important;
                }
                .featured_product_shortcode.simple .featured_countdown .row .days-digit, 
                .featured_product_shortcode.simple .featured_countdown .row .hours-digit, 
                .featured_product_shortcode.simple .featured_countdown .row .minutes-digit, 
                .featured_product_shortcode.simple .featured_countdown .row .seconds-digit {
                    background: '.$countdown_bg.' !important;
                }
            </style>';
    $html .= '<div class="featured_product_shortcode simple col-md-12 wow '.$animation.' ">';
        $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
        ); 
         
    $blogposts = get_posts($args_blogposts);
      
    foreach ($blogposts as $blogpost) {
        global $woocommerce, $product, $post;
        $product = new WC_Product($select_product);
        $content_post = get_post($select_product);
        $content = $content_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);

        $product_img      = wp_get_attachment_image_src($product_img, "linify_skill_counter_65x65");
        $product_imgsrc  = $product_img[0];
        if($featured_img == 'choosed_nothing' or $featured_img == ''){
            $html .= '<div class="featured_product_image_holder col-md-6">';
                if ( has_post_thumbnail( $select_product ) ) {
                    $attachment_ids[0] = get_post_thumbnail_id( $select_product );
                    $attachment = wp_get_attachment_image_src($attachment_ids[0], 'full' );   
                    $html.='<img class="featured_product_image" src="'.$attachment[0].'" alt="'.get_the_title($select_product).'" />';
                }
            $html .= '</div>';
        } elseif($featured_img == 'custom_image') {
            $html .= '<div class="featured_product_image_holder col-md-6">';
                $html .= '<img src="'.esc_attr($product_imgsrc).'" data-src="'.esc_attr($product_imgsrc).'" alt="">';
            $html .= '</div>';
        }
        $html .= '<div class="featured_product_details_holder  col-md-6">';  
            $html.='<h2 class="featured_product_name">
                        <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>
                    </h2>';
           
            $html.='<h3 class="featured_product_price">'.$product->get_price_html().'</h3>';

            $html.='<div class="featured_product_description">'.faimos_excerpt_limit($content,15).'</div>';

            if($subtitle_product) {
                $html.='<p class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</p>';
            }
            $html.='<div class="progress">';
                $html.='<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$bar_value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$bar_value.'%"></div>';   
            $html.='</div>';
            
            if($countdown_opt) {
                $html.='<p class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_countdown.'</p>';
                $html.='<div class="featured_countdown">'.do_shortcode('[mt-countdown date="'.$countdown_opt.'"]').'</div>';
            }
        $html.='</div>';
      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_simple_product', 'modeltheme_shortcode_featured_simple_product');

/**

||-> Shortcode: Featured Product no image

*/
function modeltheme_shortcode_featured_no_image($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'background_color'                =>'',
            'price_text_color'                =>'',
            'button_background_color1'        =>'',
            'button_background_color2'        =>'',
            'button_text_color'               =>'',
            'button_text'                     =>'',
            'subtitle_product'                =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';

    


    $html .= '<div class="featured_product_shortcode v2 col-md-12 wow '.$animation.' " style=" background-color: '.$background_color.';">';
      $args_blogposts = array(
              'posts_per_page'   => 1,
              'order'            => 'DESC',
              'post_type'        => 'product',
              'post_status'      => 'publish' 
              ); 

              
      $blogposts = get_posts($args_blogposts);


      foreach ($blogposts as $blogpost) {
      global $woocommerce, $product, $post;
      $product = new WC_Product($select_product);
      $content_post = get_post($select_product);
      $content = $content_post->post_content;

      $content = apply_filters('the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);


        $html .= '<div class="featured_product_details_holder col-md-12">';
          $html.='<h2 class="featured_product_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</h2>';
          $html.='<h1 class="featured_product_name" style="color: '.$product_name_text_color.';">
                    <a href="'.get_permalink($select_product).'">'.get_the_title($select_product).'</a>

                  </h1>';
          
          
          $html.='<div class="featured_product_description">'.$content.'</div>';
          $html.='<div class="featured_product_countdown">
                    
                 '.do_shortcode('[shortcode_countdown_v2 insert_date="'.esc_attr(date_format($date, 'Y-m-d')).'"]').'</div>';

          $html.='<a class="featured_product_button" href="'.get_permalink($select_product).'?add-to-cart='.$select_product.'" target="_blank" style="color: '.$button_text_color.';background: '.esc_attr($button_background_color1).';">'.$button_text.'</a>';
          $html.='<p class="featured_product_price" style="color: '.$price_text_color.';">' .esc_html__("Current bid :","modeltheme").' '.$product->get_price_html().'</p>';

        $html .= '</div>';


      }
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_product_no_image', 'modeltheme_shortcode_featured_no_image');

/**

||-> Shortcode: Crypto Featured

*/
function modeltheme_shortcode_crypto_featured_product($params, $content) {
    extract( shortcode_atts( 
        array(
            'animation'                       =>'',
            'category_text_color'             =>'',
            'product_name_text_color'         =>'',
            'price_text_color'                =>'',
            'title_crypto'                    =>'',
            'subtitle_product'                =>'',
            'bar_value'                       =>'',
            'progress_bg'                     =>'',
            'countdown_opt'                   =>'',
            'subtitle_countdown'              =>'',
            'countdown_bg'                    =>'',
            'countdown_color'                 =>'',
            'featured_img'                    =>'',
            'product_img'                     =>'',
            'block_bg'                        =>'',
            'select_product'                  =>''
        ), $params ) );
    

    $html = '';
    $html .='<style type="text/css">
                .featured_crypto_shortcode .featured_crypto_name {
                    color: '.$product_name_text_color.' !important;
                }
                .featured_crypto_shortcode span.amount{
                    color: '.$price_text_color.' !important;
                }
                .featured_crypto_shortcode .featured_crypto_description p{
                    color: '.$category_text_color.' !important;
                }
                .featured_crypto_details_holder{
                    background: '.$block_bg.' !important;
                }
                .featured_crypto_shortcode .progress-bar-success{
                    background: '.$progress_bg.' !important;
                }
                .featured_crypto_shortcode .featured_countdown .row div{
                    color: '.$countdown_color.' !important;
                }
                .featured_crypto_shortcode .featured_countdown .row .days-digit, 
                .featured_crypto_shortcode .featured_countdown .row .hours-digit, 
                .featured_crypto_shortcode .featured_countdown .row .minutes-digit, 
                .featured_crypto_shortcode .featured_countdown .row .seconds-digit {
                    background: '.$countdown_bg.' !important;
                }
            </style>';
    $html .= '<div class="featured_crypto_shortcode col-md-12 wow '.$animation.' ">';
  
        $html .= '<div class="featured_crypto_details_holder">';  
            $html.='<h2 class="featured_crypto_name text-center">'.$title_crypto.'</h2>';

            if($countdown_opt) {
                $html.='<p class="featured_crypto_categories text-center" style="color: '.$category_text_color.';">'.$subtitle_countdown.'</p>';
                $html.='<div class="featured_countdown">'.do_shortcode('[mt-countdown date="'.$countdown_opt.'"]').'</div>';
            }
            $html.='<div class="featured_crypto_btn"><a class="button btn" href="#">Get Token</a></div>';
            if($subtitle_product) {
                $html.='<p class="featured_crypto_categories" style="color: '.$category_text_color.';">'.$subtitle_product.'</p>';
            }
            $html.='<div class="progress">';
                $html.='<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$bar_value.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$bar_value.'%"></div>';   
            $html.='</div>';
            
            
        $html.='</div>';
    $html .= '</div>';
    return $html;
}
add_shortcode('featured_crypto', 'modeltheme_shortcode_crypto_featured_product');

/*---------------------------------------------*/
/*--- Custom Images with Links ---*/
/*---------------------------------------------*/
function faimos_custom_images_links_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'banner_img'            => '',
            'banner_button_text'    => '',
            'banner_button_count'   => '',
            'banner_button_url'     => ''
        ), $params ) );

    $banner = wp_get_attachment_image_src($banner_img, "faimos_cat_pic500x500");

    $shortcode_content = '';
    #SALE BANNER
    $shortcode_content .= '<div class="custom_pages_links relative">';
            $shortcode_content .= '<img src="'.$banner[0].'" alt="'.$banner_button_text.'" />';
            $shortcode_content .= '<a href="'.$banner_button_url.'">
                                    <div class="custom_pages_links_holder">';
                $shortcode_content .= '<div class="masonry_holder">';
                    $shortcode_content .= '<h3 class="category_name">'.$banner_button_text.'</h3>';
                    $shortcode_content .= '<p class="category_count">'.$banner_button_count.'</p>';
                $shortcode_content .= '</div>';
            $shortcode_content .= '</div></a>';
    $shortcode_content .= '</div>';
       
    return $shortcode_content;
}
add_shortcode('custom-images-links', 'faimos_custom_images_links_shortcode');

/*---------------------------------------------*/
/*--- BLOG POSTS version 2 ---*/
/*---------------------------------------------*/
function faimos_blog_post_2_shortcode( $params, $content ) {
    extract( shortcode_atts( 
        array(
            'number'            => '',
            'category'          => '',
            'overlay_color'     => '',
            'text_color'        => '',
            'columns'           => '',
            'layout'            => ''
           ), $params ) );
    $args_posts = array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'tax_query' => array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            ),
            'post_status'           => 'publish' 
        );
    $posts = get_posts($args_posts);
    $shortcode_content = '';
    $shortcode_content .= '<div class="faimos_shortcode_blog_v2 vc_row sticky-posts">';
    foreach ($posts as $post) { 
        $excerpt = get_post_field('post_content', $post->ID);
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'faimos_post_pic700x450' );
        $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'faimos_blog_500x800' );
        $author_id = $post->post_author;
        $url = get_permalink($post->ID); 
        $shortcode_content .= '<div class="'.$columns.' post '.$layout.'">';

        if($layout == "horizontal" || $layout == "") {
            $shortcode_content .= '<div class="col-md-12 blog-thumbnail">';
                $shortcode_content .= '<a href="'.$url.'" class="relative">';
                    if($thumbnail_src) { 
                        $shortcode_content .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                    }else{ 
                        $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                    }
                    $shortcode_content .= '<div class="thumbnail-overlay absolute" style="background: '.$overlay_color.'!important;">';
                        $shortcode_content .= '<i class="fa fa-plus absolute"></i>';
                    $shortcode_content .= '</div>';
                $shortcode_content .= '</a>';
                $shortcode_content .= '<p class="author">';
                            $shortcode_content .= '<span class="post-tags">
                              '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                            </span>';
                        $shortcode_content .= '</p>';
                
                $shortcode_content .= '<div class="col-md-12 blog-content">';
                 
                $shortcode_content .= '<div class="head-content">';
                    $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '<div class="post-dates">
                              <a href="'.get_the_permalink().'">
                                  <span class="blog_date blog_day">'.get_the_date( 'j', $post->ID).'</span>
                                  <span class="blog_date blog_month">'.get_the_date( 'M Y', $post->ID).'</span>
                              </a>
                          </div>';
              $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        $shortcode_content .= '</div>';
        }else{
            $shortcode_content .= '<div class="col-md-12 blog-thumbnail ">';
                $shortcode_content .= '<a href="'.$url.'" class="relative">';
                    if($thumbnail_src) { 
                        $shortcode_content .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                    }else{ 
                        $shortcode_content .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />'; 
                    }
              
                $shortcode_content .= '</a>';
                $shortcode_content .= '<p class="author">';
                            $shortcode_content .= '<span class="post-tags">
                              '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                            </span>';
                        $shortcode_content .= '</p>';
            $shortcode_content .= '</div>';

            $shortcode_content .= '<div class="col-md-12 blog-content">';

            $shortcode_content .= '<div class="head-content">';
                    $shortcode_content .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $shortcode_content .= '</div>';
                $shortcode_content .= '<div class="post-dates">
                              <a href="'.get_the_permalink().'">
                                  <span class="blog_date blog_day">'.get_the_date( 'j', $post->ID).'</span>
                                  <span class="blog_date blog_month">'.get_the_date( 'M Y', $post->ID).'</span>
                              </a>
                          </div>';
            $shortcode_content .= '</div>';
            $shortcode_content .= '</div>';
        }
    } 
    $shortcode_content .= '</div>';
    return $shortcode_content;
}
add_shortcode('faimos-blog-posts-2', 'faimos_blog_post_2_shortcode');

?>
