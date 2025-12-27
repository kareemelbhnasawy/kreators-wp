<?php
namespace Elementor;

class addons_portfolio_images extends Widget_Base {
    
    public function get_style_depends() {
        wp_enqueue_style( 'portfolio-grid-images', plugins_url( '../../../css/portfolio-grid-images.css' , __FILE__ ));
        return [
            'portfolio-grid-images',
        ];
    }
    public function get_name() {
        return 'mt-portfolio-grid-images';
    }
    public function get_title() {
        return 'MT - Portfolio Grid Images';
    }
    public function get_icon() {
        return 'eicon-tabs';
    }
    public function get_categories() {
        return [ 'addons-widgets' ];
    } 
    public function get_script_depends() {
        wp_enqueue_script( 'portfolio-grid-images', plugins_url( '../../../js/portfolio-grid-images.js' , __FILE__));

        return [ 'jquery', 'elementor-frontend', 'portfolio-grid-images'];
    }
    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __( 'Content', 'modeltheme-addons-for-wpbakery' ),
            ]
        );
        // start repeater
        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label' => __( 'Tab Title', 'modeltheme-addons-for-wpbakery' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $repeater->add_control(
            'image_1', 
            [
                'label' => esc_html__( 'Image 1', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'image_2', 
            [
                'label' => esc_html__( 'Image 2', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'image_3', 
            [
                'label' => esc_html__( 'Image 3', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'image_4', 
            [
                'label' => esc_html__( 'Image 4', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        // end repeater;
        $this->add_control(
            'portfolio_category_tabs',
            [
                'label' => esc_html__('Tabs Items', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls()
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_btn', 
            [
                'label' => esc_html__( 'Tab Styling', 'invent-slider' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'tab_text',
            [
                'type' => \Elementor\Controls_Manager::COLOR,
                'label' => __( 'Tab Text Color', 'modeltheme-addons-for-wpbakery' ),
                'selectors' => [
                    '{{WRAPPER}} .mt-portfolio-grid-images-hover-target' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section();
    }
    protected function render() {
        $settings = $this->get_settings_for_display();
        $portfolio_category_tabs          = $settings['portfolio_category_tabs'];
        $tab_text                         = $settings['tab_text'];

    ?> 

        
    <div class='mt-portfolio-grid-image-cursor' id="mt-portfolio-grid-image-cursor"></div>
    <div class='mt-portfolio-grid-image-cursor2' id="mt-portfolio-grid-image-cursor2"></div>
    <div class='mt-portfolio-grid-image-cursor3' id="mt-portfolio-grid-image-cursor3"></div> 

    <div class="mt-portfolio-grid-images-section">
       <ul class="mt-portfolio-grid-images-case-study-wrapper"> 
            <?php if ($portfolio_category_tabs) { ?>
                <!-- Tab Title -->
                <?php foreach ($portfolio_category_tabs as $portfolio_tab) { 
                    $title = $portfolio_tab['title'];
                    ?>  
                  <li class="mt-portfolio-grid-images-name">
                    <a  class="mt-portfolio-grid-images-hover-target"style="color:<?php echo esc_attr($tab_text);?>"><?php echo esc_html($title);?></a>
                    </li> 
                <?php } ?>
            <?php }?>
        </ul>
        <ul class="mt-portfolio-grid-images">
            <?php if ($portfolio_category_tabs) { ?>
                <?php foreach ($portfolio_category_tabs as $portfolio_tab) { 
                    $image_1          = $portfolio_tab['image_1']['url'];
                    $image_2          = $portfolio_tab['image_2']['url'];
                    $image_3          = $portfolio_tab['image_3']['url'];
                    $image_4          = $portfolio_tab['image_4']['url'];
                ?>
                <li>
                    <div class="mt-portfolio-grid-images-hero">
                        <span>
                            <img src="<?php echo esc_url($image_1); ?>" alt='<?php echo esc_html__($title); ?>'>
                        </span> 
                        <span>
                            <img src="<?php echo esc_url($image_2); ?>" alt='<?php echo esc_html__($title); ?>'>

                        </span> 
                        <span>
                            <img src="<?php echo esc_url($image_3); ?>" alt='<?php echo esc_html__($title); ?>'>
                        </span> 
                        <span>
                            <img src="<?php echo esc_url($image_4); ?>" alt='<?php echo esc_html__($title); ?>'>
                        </span> 
                    </div> 
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>   
    </div>

    <?php }
    protected function content_template() {

    }
}