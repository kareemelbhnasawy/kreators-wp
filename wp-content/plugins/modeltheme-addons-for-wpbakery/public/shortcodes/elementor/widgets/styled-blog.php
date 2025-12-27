<?php
namespace Elementor;
class addons_styled_blog extends Widget_Base {
    public function get_style_depends() {

        wp_enqueue_style( 'styled-blog', plugins_url( '../../../css/styled-blog.css' , __FILE__ ));

        return [
            'styled-blog',
        ];

    }

    public function get_name()
    {
        return 'styled-blog';
    }

    public function get_title()
    {
        return esc_html__('MT - Styled Blog', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-price-table';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'styled', 'blog', 'blogging', 'custom' ];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Content', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label' => esc_html__( 'Select Layout', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'modeltheme-addons-for-wpbakery' ),
                    'vertical' => esc_html__( 'Vertical', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__( 'No. Of Columns', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__( '3 Columns', 'modeltheme-addons-for-wpbakery' ),
                    '2' => esc_html__( '2 Columns', 'modeltheme-addons-for-wpbakery' ),
                ],
            ]
        );

        $this->add_control(
            'articles',
            [
                'label' => esc_html__( 'No, Of Articles', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $post_category_tax = get_terms('category');
        $post_category = array();
        if ($post_category_tax) {
            foreach ( $post_category_tax as $term ) {
                $post_category[$term->name] = $term->slug;
            }
        }

        $this->add_control(
            'category',
            [
                'label' => __( 'Category', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::SELECT,
                'options' => $post_category,
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
            ]
        );
        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-head-content .author' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout = $settings['layout_style'];
        $number = $settings['number'];
        $category = $settings['category'];
        $text_color = $settings['text_color'];

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
        $html = '';
        $html .= '<div class="mt-addons_shortcode_blog_v2 vc_row sticky-posts">';
        foreach ($posts as $post) {
            $excerpt = get_post_field('post_content', $post->ID);
            $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'angro_post_pic700x450' );
            $thumbnail_src2 = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ),'angro_blog_500x800' );
            $author_id = $post->post_author;
            $url = get_permalink($post->ID);
            $html .= '<div class="col-md-4 post '.$layout.'">';

            if($layout == "horizontal" || $layout == "") {
                $html .= '<div class="col-md-12 blog-thumbnail">';
                $html .= '<a href="'.$url.'" class="relative">';
                if($thumbnail_src) {
                    $html .= '<img src="'. $thumbnail_src[0] . '" alt="'. $post->post_title .'" />';
                }else{
                    $html .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />';
                }
                $html .= '<div class="thumbnail-overlay absolute">';
                $html .= '<i class="fas fa-plus absolute"></i>';
                $html .= '</div>';
                $html .= '</a>';


                $html .= '<div class="col-md-12 blog-content">';

                $html .= '<div class="mt-addons-head-content">';
                $html .= '<p class="author">';
                $html .= '<span class="post-tags">
                              '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                            </span>';
                $html .= '</p>';
                $html .= '<h3 class="post-name"><a href="'.$url.'">'.$post->post_title.'</a></h3>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
                $html .= '</div>';
            }else{
                $html .= '<div class="col-md-12 blog-thumbnail ">';
                $html .= '<a href="'.$url.'" class="relative">';
                if($thumbnail_src) {
                    $html .= '<img src="'. $thumbnail_src2[0] . '" alt="'. $post->post_title .'" />';
                }else{
                    $html .= '<img src="http://placehold.it/700x450" alt="'. $post->post_title .'" />';
                }

                $html .= '</a>';
                $html .= '</div>';

                $html .= '<div class="col-md-12 blog-content">';

                $html .= '<div class="mt-addons-head-content">';
                $html .= '<p class="author">';
                $html .= '<span class="post-tags">
                              '.get_the_term_list( $post->ID, 'category', '', ', ' ).'
                            </span>';
                $html .= '</p>';
                $html .= '<h3 class="post-name"><a href="'.$url.'" style="color: '.$text_color.'">'.$post->post_title.'</a></h3>';
                $html .= '</div>';
                $html .= '<div class="post-dates">
                              <a href="'.get_the_permalink().'">
                                  <span class="blog_date blog_day">'.get_the_date( 'j', $post->ID).'</span>
                                  <span class="blog_date blog_month">'.get_the_date( 'M Y', $post->ID).'</span>
                              </a>
                          </div>';
                $html .= '</div>';
                $html .= '</div>';
            }
        }
        $html .= '</div>';
        echo $html;
    }

    protected function content_template() {}
}

