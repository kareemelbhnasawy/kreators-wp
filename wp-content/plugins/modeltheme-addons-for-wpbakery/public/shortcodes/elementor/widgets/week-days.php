<?php
namespace Elementor;

	class addons_week_days extends Widget_Base {

		public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-week-days', plugins_url( '../../../css/week-days.css' , __FILE__ ));
        
        return [
            'mt-addons-week-days',
        ];
    }

    public function get_name()
    {
        return 'week-days';
    }

    public function get_title()
    {
        return esc_html__('MT - Week days', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-post';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'week', 'days', 'time'];
    }

	public function register_controls() {
		$this->start_controls_section(
			'header',
			[
				'label' => __( 'Header', 'modeltheme-addons-for-wpbakery' ),
			]
		);
		$this->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Main Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
	     $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mt-addons-week-days-m-title',
            ]
        );
	    $this->add_control(
	    	'subtitle',
	        [
	            'label' => esc_html__('Main Subtitle', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
         $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Subtitle Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .mt-addons-week-days-m-subtitle',
            ]
        );
	    $this->end_controls_section();

	    $this->start_controls_section(
            'styling',
            [
                'label' => esc_html__('Styling', 'modeltheme-addons-for-wpbakery'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .mt-addons-week-days-shortcode',
			]
		);
	    $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Day Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'day_typography',
                'selector' => '{{WRAPPER}} .mt-addons-week-days-day',
            ]
        );
		 $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
            	'label' => esc_html__( 'Hours Typography', 'modeltheme-addons-for-wpbakery' ),
                'name' => 'hours_typography',
                'selector' => '{{WRAPPER}} .mt-addons-week-days-hours',
            ]
        );
		$this->add_control(
            'padding_item',
            [
                'label' => esc_html__( 'Padding item', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-week-days-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-week-days-shortcode' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		 $this->end_controls_section();

		$this->start_controls_section(
			'section_items',
			[
				'label' => __( 'List Area', 'modeltheme-addons-for-wpbakery' ),
			]
		);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::COLOR,
				'default' => 'rgba(30, 30, 30, 0.2)',
			]
		);
		$repeater->add_control(
	    	'day',
	        [
	            'label' => esc_html__('Week day', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
	    $repeater->add_control(
			'day_color',
			[
				'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::COLOR,
			]
		);
	    $repeater->add_control(
            'hours',
            [
                'label' => esc_html__('Hours', 'modeltheme-addons-for-wpbakery'),
                'type' => Controls_Manager::TEXT,
            ]
        );
		$repeater->add_control(
			'hours_color',
			[
				'label' => esc_html__( 'Color', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::COLOR,
			]
		);
	    $this->add_control( 
	        'list',
	        [
	            'label' => esc_html__('Menu Items', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::REPEATER,
	            'fields' => $repeater->get_controls(),
	            'default' => [
					[
						'day' => esc_html__( 'Monday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '01:00-02:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Tuesday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '02:00-03:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Wednesday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '03:00-04:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Thursday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '04:00-05:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Friday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '05:00-06:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Saturday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '06:00-07:00', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'day' => esc_html__( 'Sunday', 'modeltheme-addons-for-wpbakery' ),
						'hours' => esc_html__( '07:00-08:00', 'modeltheme-addons-for-wpbakery' ),
					],
				],
	        ]
	    );
		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        $title = $settings['title'];
        $subtitle = $settings['subtitle'];
        $padding_item = $settings['padding_item'];
        ?>
       <div class="mt-addons-week-days-m  mt-addons-week-days-shortcode mt-addons-week-days-layout--standard mt-addons-week-days-line-type--between mt-addons-week-days-resposive--no mt-addons-week-days-text-underline">
       		<?php if (!empty($subtitle)){?>
	       		<h5 class="mt-addons-week-days-m-subtitle"><?php echo esc_html($subtitle); ?></h5>
	       	<?php }?>
	       	<?php if (!empty($title)){?>
				<h2 class="mt-addons-week-days-m-title"><?php echo esc_html($title); ?></h2>
			<?php }?>
			<?php if ($list) {
					foreach ( $list as $item ) {
	                $day = $item['day'];
	                $hours = $item['hours'];
	                $day_color = $item['day_color'];
	                $hours_color = $item['hours_color'];
	                $border_color = $item['border_color'];
	                ?>   
					<div class="mt-addons-week-days-m-items">
						<div class="mt-addons-week-days mt-addons-week-days-item" style="color:<?php echo esc_attr($padding_item)?>">
							<div class="mt-addons-week-days-title-holder">
								<h5 class="mt-addons-week-days-day" style="color:<?php echo esc_attr($day_color)?>"><?php echo esc_html($day); ?></h5>
							</div>
							<div class="mt-addons-week-days-line" style="color:<?php echo esc_attr($border_color)?>"></div>
							<p class="mt-addons-week-days-hours" style="color:<?php echo esc_attr($hours_color)?>"><?php echo esc_html($hours); ?></p>
						</div>
					</div>
				<?php } ?>
			<?php } ?>
		</div><?php
	}

    protected function content_template() {}
}

