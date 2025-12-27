<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

use MT_Addons\includes\ContentControlHelp;

class mt_addons_timeline extends Widget_Base {
	
	public function get_style_depends() {
    	wp_enqueue_style( 'mt-addons-timeline', MT_ADDONS_PUBLIC_ASSETS.'css/timeline.css');
        return [
            'mt-addons-timeline',
        ];
    }

	public function get_name() {
		return 'mtfe-timeline';
	}
	
	use ContentControlHelp;

	public function get_title() {
		return esc_html__('MT - Timeline','mt-addons');
	}
	
	public function get_icon() {
		return 'eicon-time-line';
	} 

	public function get_categories() {
		return [ 'mt-addons-widgets' ];
	}

	protected function register_controls() {
        $this->section_timeline();
        $this->section_help_settings();
    }

    private function section_timeline() {
        $this->start_controls_section(
            'section_title',
            [
                'label'                     => esc_html__( 'Content', 'mt-addons' ),
            ]
        );

        // Timeline Layout Controls
        $this->add_control(
            'layout_options',
            [
                'label'                     => esc_html__( 'Layout Options', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::HEADING,
                'separator'                 => 'before',
            ]
        );

        $this->add_control(
            'line_status',
            [
                'label'                     => esc_html__( 'Disable Vertical Line', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'                  => esc_html__( 'Hide', 'mt-addons' ),
                'label_off'                 => esc_html__( 'Show', 'mt-addons' ),
                'return_value'              => 'yes',
                'default'                   => 'no',
            ]
        );

        $this->add_control(
            'line_bg_color',
            [
                'type'                      => \Elementor\Controls_Manager::COLOR,
                'label'                     => esc_html__( 'Line Background', 'mt-addons' ),
                'label_block'               => true,
                'selectors'                 => [
                    '{{WRAPPER}} .mt-addons-timeline::before' => 'background: {{VALUE}};',
                ],
                'condition'                 => [
                    'line_status'           => '',
                ],
                'default'                   => '#eee',
            ]
        );

        $this->add_control(
            'image_status',
            [
                'label'                     => esc_html__( 'Show Timeline Image', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::SWITCHER,
                'label_on'                  => esc_html__( 'Show', 'mt-addons' ),
                'label_off'                 => esc_html__( 'Hide', 'mt-addons' ),
                'return_value'              => 'yes',
                'default'                   => 'yes',
            ]
        );

        // Typography Controls
        $this->add_control(
            'typography_options',
            [
                'label'                     => esc_html__( 'Typography', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::HEADING,
                'separator'                 => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'                      => 'title_typography',
                'label'                     => esc_html__( 'Title Typography', 'mt-addons' ),
                'selector'                  => '{{WRAPPER}} .mt-addons-timeline-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'type'                      => \Elementor\Controls_Manager::COLOR,
                'label'                     => esc_html__( 'Title Color', 'mt-addons' ),
                'selectors'                 => [
                    '{{WRAPPER}} .mt-addons-timeline-title' => 'color: {{VALUE}};',
                ],
                'default'                   => '#000000',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'                      => 'desc_typography',
                'label'                     => esc_html__( 'Description Typography', 'mt-addons' ),
                'selector'                  => '{{WRAPPER}} .mt-addons-timeline-desc',
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'type'                      => \Elementor\Controls_Manager::COLOR,
                'label'                     => esc_html__( 'Description Color', 'mt-addons' ),
                'selectors'                 => [
                    '{{WRAPPER}} .mt-addons-timeline-desc' => 'color: {{VALUE}};',
                ],
                'default'                   => '#666666',
            ]
        );

        // Block Style Controls
        $this->add_control(
            'block_style',
            [
                'label'                     => esc_html__( 'Block Style', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::HEADING,
                'separator'                 => 'before',
            ]
        );

        $this->add_control(
            'block_bg',
            [
                'type'                      => \Elementor\Controls_Manager::COLOR,
                'label'                     => esc_html__( 'Block Background', 'mt-addons' ),
                'selectors'                 => [
                    '{{WRAPPER}} .mt-addons-timeline-content' => 'background: {{VALUE}};',
                ],
                'default'                   => '#FFFFFF',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                      => 'block_border',
                'label'                     => esc_html__( 'Block Border', 'mt-addons' ),
                'selector'                  => '{{WRAPPER}} .mt-addons-timeline-content',
            ]
        );

        $this->add_control(
            'block_margin',
            [
                'label'                     => esc_html__( 'Block Margin', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units'                => [ 'px', '%', 'em' ],
                'selectors'                 => [
                    '{{WRAPPER}} .mt-addons-timeline-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default'                   => [
                    'top'                   => '0',
                    'right'                 => '0',
                    'bottom'                => '30',
                    'left'                  => '0',
                    'unit'                  => 'px',
                    'isLinked'              => false,
                ],
            ]
        );

        // Timeline Items
        $repeater = new Repeater();

        $repeater->add_control(
            'item_date_image',
            [
                'label'                     => esc_html__( 'Image', 'mt-addons' ),
                'description'               => esc_html__('Choose image for timeline marker.', 'mt-addons'),
                'type'                      => \Elementor\Controls_Manager::MEDIA,
                'default'                   => [
                    'url'                   => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'                     => esc_html__( 'Title', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::TEXT,
                'label_block'               => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'                     => esc_html__( 'Description', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::TEXTAREA,
                'rows'                      => 5,
            ]
        );

        $repeater->add_control(
            'item_date',
            [
                'label'                     => esc_html__( 'Date', 'mt-addons' ),
                'type'                      => \Elementor\Controls_Manager::TEXT,
                'description'               => esc_html__('Enter the date for this timeline item. Format example: 2017 November 15th', 'mt-addons'),
            ]
        );

        $this->add_control(
            'timeline_items',
            [
                'label'                     => esc_html__('Timeline Items', 'mt-addons'),
                'type'                      => Controls_Manager::REPEATER,
                'fields'                    => $repeater->get_controls(),
                'default'                   => [
                    [
                        'title'             => esc_html__( 'Junior Developer', 'mt-addons' ),
                        'description'       => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'mt-addons' ),
                        'item_date'         => esc_html__( 'September 2017 - June 2018', 'mt-addons' ),
                    ],
                    [
                        'title'             => esc_html__( 'Senior Developer', 'mt-addons' ),
                        'description'       => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'mt-addons' ),
                        'item_date'         => esc_html__( 'June 2018 - May 2020', 'mt-addons' ),
                    ],
                    [
                        'title'             => esc_html__( 'CEO', 'mt-addons' ),
                        'description'       => esc_html__( 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'mt-addons' ),
                        'item_date'         => esc_html__( 'May 2020 - Current', 'mt-addons' ),
                    ],
                ],
                'title_field'              => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }
           
	protected function render() {
        $settings = $this->get_settings_for_display();
        $line_status = $settings['line_status'];
        $timeline_items = $settings['timeline_items'];
        $image_status = $settings['image_status'];

        $line_class = $line_status === 'yes' ? 'mt-addons-no-line' : '';
        ?>
        <div class="mt-addons-timeline <?php echo esc_attr($line_class); ?>">
            <?php if ($timeline_items) : ?>
                <?php foreach ($timeline_items as $item) : ?>
                    <div class="mt-addons-timeline-item">
                        <?php if ($image_status === 'yes' && !empty($item['item_date_image']['url'])) : ?>
                            <div class="mt-addons-timeline-img">
                                <img src="<?php echo esc_url($item['item_date_image']['url']); ?>" 
                                     alt="<?php echo esc_attr($item['title']); ?>">
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-addons-timeline-content">
                            <?php if (!empty($item['title'])) : ?>
                                <h3 class="mt-addons-timeline-title"><?php echo esc_html($item['title']); ?></h3>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['description'])) : ?>
                                <p class="mt-addons-timeline-desc"><?php echo esc_html($item['description']); ?></p>
                            <?php endif; ?>
                            
                            <?php if (!empty($item['item_date'])) : ?>
                                <p class="mt-addons-timeline-date"><?php echo esc_html($item['item_date']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
	}
	protected function content_template() {
        ?>
        <div class="mt-addons-timeline {{ settings.line_status === 'yes' ? 'mt-addons-no-line' : '' }}">
            <# if ( settings.timeline_items ) { #>
                <# _.each( settings.timeline_items, function( item ) { #>
                    <div class="mt-addons-timeline-item">
                        <# if ( settings.image_status === 'yes' && item.item_date_image.url ) { #>
                            <div class="mt-addons-timeline-img">
                                <img src="{{ item.item_date_image.url }}" alt="{{ item.title }}">
                            </div>
                        <# } #>
                        
                        <div class="mt-addons-timeline-content">
                            <# if ( item.title ) { #>
                                <h3 class="mt-addons-timeline-title">{{{ item.title }}}</h3>
                            <# } #>
                            
                            <# if ( item.description ) { #>
                                <p class="mt-addons-timeline-desc">{{{ item.description }}}</p>
                            <# } #>
                            
                            <# if ( item.item_date ) { #>
                                <p class="mt-addons-timeline-date">{{{ item.item_date }}}</p>
                            <# } #>
                        </div>
                    </div>
                <# }); #>
            <# } #>
        </div>
        <?php
    }
}