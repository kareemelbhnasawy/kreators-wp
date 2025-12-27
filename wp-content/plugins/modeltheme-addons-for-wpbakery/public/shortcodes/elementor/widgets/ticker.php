<?php
namespace Elementor;

	class addons_ticker extends Widget_Base {

		public function get_style_depends() {
        wp_enqueue_style( 'mt-addons-ticker', plugins_url( '../../../css/ticker.css' , __FILE__ ));
        
        return [
            'mt-addons-ticker',
        ];
    }

    public function get_name()
    {
        return 'ticker';
    }

    public function get_title()
    {
        return esc_html__('MT - Ticker', 'modeltheme-addons-for-wpbakery');
    }

    public function get_icon() {
        return 'eicon-grow';
    }

    public function get_categories() {
        return [ 'addons-widgets' ];
    }

    public function get_keywords() {
        return [ 'ticker', 'slider', 'back'];
    }

	public function register_controls() {
		$this->start_controls_section(
			'section_items',
			[
				'label' => __( 'List Area', 'modeltheme-addons-for-wpbakery' ),
			]
		);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-sun',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);
        $repeater->add_control(
	    	'title',
	        [
	            'label' => esc_html__('Main Title', 'modeltheme-addons-for-wpbakery'),
	            'type' => Controls_Manager::TEXT,
	        ]
	    );
	    $repeater->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Title Typography', 'modeltheme-addons-for-wpbakery' ),
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} .mt-addons-ticker-list-item',
			]
		);
	    $repeater->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Title Color', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
			]
		);
		$repeater->add_control(
            'padding_icon',
            [
                'label' => esc_html__( 'Icon Padding', 'modeltheme-addons-for-wpbakery' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .mt-addons-ticker-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'unit' => 'px',
                'size' => 150,
            ],
         ]
       );
		$repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
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
						'title' => esc_html__( 'ANALYZE YOUR AUDIENCE', 'modeltheme-addons-for-wpbakery' ),
						'icon' => esc_html__( 'fa fa-facebook', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'title' => esc_html__( 'KEEP YOUR FOLLOWER ENGAGED', 'modeltheme-addons-for-wpbakery' ),
						'icon' => esc_html__( 'fa fa-facebook', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'title' => esc_html__( 'MAKING MONEY ON SOCIAL', 'modeltheme-addons-for-wpbakery' ),
						'icon' => esc_html__( 'fa fa-facebook', 'modeltheme-addons-for-wpbakery' ),
					],
					[
						'title' => esc_html__( 'STANDOUT WITH AN UNIQUE DESIGN', 'modeltheme-addons-for-wpbakery' ),
						'icon' => esc_html__( 'fa fa-facebook', 'modeltheme-addons-for-wpbakery' ),
					],
				],
	        ]
	    );
		$this->end_controls_section();
	}

	protected function render() {
        $settings = $this->get_settings_for_display();
        $list = $settings['list'];
        ?>     		 
		<div class="mt-addons-ticker">
		  <ul class="mt-addons-ticker-list">
		  	<?php foreach ( $list as $item ) {
		  	$icon = $item['icon'];
        	$title = $item['title'];
        	$title_color = $item['title_color'];
        	$icon_color = $item['icon_color'];
         	?>    
			    <li  class="mt-addons-ticker-list-item">
			    	<div class="mt-addons-ticker-icon" style="color:<?php echo esc_attr($icon_color)?>">
			    		<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
			    	</div>
			    	<div class="mt-addons-ticker-title" style="color:<?php echo esc_attr($title_color)?>">
			    		<?php echo esc_html($title)?>
			    	</div>
			    </li>
		    <?php } ?>
		  </ul>
		</div>
    <?php
	}

    protected function content_template() {}
}

