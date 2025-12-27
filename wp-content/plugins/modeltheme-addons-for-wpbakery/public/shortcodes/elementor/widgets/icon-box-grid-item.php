<?php
namespace Elementor;
use Modeltheme_Addons_For_Wpbakery\includes\ContentControlElementorIcons;

class addons_icon_box_grid_item extends Widget_Base {
	public function get_style_depends() {
        wp_enqueue_style( 'icon-box-grid-item', plugins_url( '../../../css/icon-box-grid-item.css' , __FILE__ ));

	        return [
	            'icon-box-grid-item',
	        ];
    }
	
	public function get_name() { 
		return 'icon-box-grid-item';
	}
	
	public function get_title() {
		return 'MT - Icon Box Grid Item';
	}
	
	public function get_icon() {
		return 'eicon-nerd';
	}
	
	public function get_categories() {
		return [ 'addons-widgets' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'title_tab',
			[
				'label' => __( 'Title', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'title',
			[
				'label' => __( 'Title Label', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
        $this->add_control(
			'title_tag',
			[
				'label' => __( 'Element tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p', 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h1',
			]
		); 
		$this->end_controls_section();
		$this->start_controls_section(
			'subtitle_tab',
			[
				'label' => __( 'Subtitle', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
			'subtitle',
			[
				'label' => __( 'Label/SubTitle', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'subtitle_tag',
			[
				'label' => __( 'Element tag', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'type' => Controls_Manager::SELECT,
				'options' => [
					'' 			=> __( 'Select', 'modeltheme-addons-for-wpbakery' ),
					'h1' 		=> __( 'h1', 'modeltheme-addons-for-wpbakery' ),
					'h2'		=> __( 'h2', 'modeltheme-addons-for-wpbakery' ),
					'h3' 		=> __( 'h3', 'modeltheme-addons-for-wpbakery' ),
					'h4' 		=> __( 'h4', 'modeltheme-addons-for-wpbakery' ),
					'h5' 		=> __( 'h5', 'modeltheme-addons-for-wpbakery' ),
					'h6' 		=> __( 'h6', 'modeltheme-addons-for-wpbakery' ),
					'p' 		=> __( 'p' , 'modeltheme-addons-for-wpbakery' ),

				],
				'default' => 'h3',
			]
		); 
		$this->end_controls_section();
		$this->start_controls_section(
			'image_tab',
			[
				'label' => __( 'Image', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
          'image',
          [
            'label' => esc_html__( 'Image', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
              'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
          ]
        );
		$this->end_controls_section();
		$this->start_controls_section(
			'btn_tab',
			[
				'label' => __( 'Button', 'modeltheme-addons-for-wpbakery' ),
			]
		);
        $this->add_control(
			'read_more_text',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => __( 'Button text', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
			]
		);
        $this->add_control(
			'read_more_link',
			[
				'label' => esc_html__( 'Button Link', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();
        $this->start_controls_section(
            'style_title',
            [
                'label' => esc_html__( 'Content', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_control(
			'title_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single .mt-addons-grid-class-title' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->add_control(
			'title_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Title Hover Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single:hover .mt-addons-grid-class-title' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'SubTitle Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single .mt-addons-grid-class-subtitle' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->add_control(
			'subtitle_color_hover',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'SubTitle Hover Color ', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single:hover .mt-addons-grid-class-subtitle' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->add_control(
			'btn_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Read More Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single .mt-addons-grid-btn-more' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->add_control(
			'btn_hover_color',
			[
				'type' => \Elementor\Controls_Manager::COLOR,
				'label' => __( 'Read More Hover Color', 'modeltheme-addons-for-wpbakery' ),
				'label_block' => true,
				'selectors' => [
                    '{{WRAPPER}} .mt-addons-grid-class-single:hover .mt-addons-grid-btn-more' => 'color: {{VALUE}}',
                ],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'gradient_tab',
			[
				'label' => __( 'Gradient', 'modeltheme-addons-for-wpbakery' ),
                'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .mt-addons-grid-class-single .mt-addons-class-expandable-overlay',
			]
		);

        $this->end_controls_section();
	}
	   protected function render() {
        $settings = $this->get_settings_for_display();
        $title 					= $settings['title'];
        $title_tag 				= $settings['title_tag'];
        $subtitle 				= $settings['subtitle'];
        $subtitle_tag 			= $settings['subtitle_tag'];
        // $title_color 			= $settings['title_color'];
        // $subtitle_color 		= $settings['subtitle_color'];
        $image 					= $settings['image']['id'];
        $read_more_text 		= $settings['read_more_text'];
        $read_more_link 		= $settings['read_more_link']['url'];

		if($image) {
		    $thumb      = wp_get_attachment_image_src($image, "full");
		    if ($thumb) {
		      $thumb_src  = $thumb[0];
		    }
		  }
        ?>
	        <div class="mt-addons-grid-item">
		        <div class="mt-addons-grid-class-single">
		            <div class="mt-addons-class-post-details relative">
		            	<div class="mt-addons-class-expandable-overlay">
		            	</div>
		        		<div class="mt-addons-class-metas">
	          			<?php if(!empty($thumb_src)){ ?>
		        			<img src="<?php echo esc_url($thumb_src); ?>"  />
	    				<?php } ?>
		            		<<?php echo $title_tag; ?> class="mt-addons-grid-class-title"><?php echo esc_html($title); ?></<?php echo $title_tag;?>>
		            		<<?php echo $subtitle_tag; ?> class="mt-addons-grid-class-subtitle"><?php echo esc_html($subtitle); ?></<?php echo $subtitle_tag;?>>
	          				<?php if(!empty($read_more_link)){ ?>
		            			<a class="mt-addons-grid-btn-more" href="<?php echo esc_url($read_more_link); ?>"><?php echo esc_html($read_more_text); ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
	    					<?php } ?>
		        		</div>
		            </div>
		        </div>
	        </div>
    <?php } 
    protected function content_template() {}

}