<?php

namespace Modeltheme_Addons_For_Wpbakery\includes;
use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) {
  die( '-1' );
}

trait ContentControlElementorIcons {
    /**
     * Icon Settings
     *
     * @return void
     */
    private function section_icons_settings() {

        $this->start_controls_section(
          'section_icons_settings',
          [
              'label' => esc_html__( 'Icons Settings', 'modeltheme-addons-for-wpbakery' ),
          ]
        );
        $this->add_control(
          'icon_type',
          [
            'label' => __( 'Type', 'modeltheme-addons-for-wpbakery' ),
            'label_block' => true,
            'type' => Controls_Manager::SELECT,
            'default' => '',
            'options' => [
              ''            => __( 'Select Option', 'modeltheme-addons-for-wpbakery' ),
              'font_icon'   => __( 'Font Icon', 'modeltheme-addons-for-wpbakery' ),
              'image'       => __( 'Image', 'modeltheme-addons-for-wpbakery' ),
            ],
          ]
        );
        $this->add_control( 
          'icon_fontawesome',
          [
            'label' => esc_html__( 'Icon', 'modeltheme-addons-for-wpbakery' ),
            'type'  => \Elementor\Controls_Manager::ICONS,
            'default' => [
              'value' => 'fas fa-star',
              'library' => 'solid',
            ],
            'condition' => [
              'icon_type' => 'font_icon',
            ],
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
            'condition' => [
              'icon_type' => 'image',
            ],
          ]
        );
        $this->add_control(
            'image_max_width',
            [
              'label' => esc_html__( 'Image Max Width', 'modeltheme-addons-for-wpbakery' ),
              'type' => \Elementor\Controls_Manager::NUMBER,
              'default' => 50,
              'condition' => [
              'icon_type' => 'image',
          ],
            ]
          );
          $this->add_control(
            'image_margin',
            [
              'label' => esc_html__( 'Image Margin right', 'modeltheme-addons-for-wpbakery' ),
              'type' => \Elementor\Controls_Manager::NUMBER,
              'condition' => [
              'icon_type' => 'image',
          ],
            ]
          );
        $this->add_control(
            'icon_size',
            [
              'label' => esc_html__( 'Icon Size', 'modeltheme-addons-for-wpbakery' ),
              'type' => \Elementor\Controls_Manager::NUMBER,
              'condition' => [
              'icon_type' => 'font_icon',
          ],
            ]
          );
          $this->add_control(
            'icon_color',
            [
              'type' => \Elementor\Controls_Manager::COLOR,
              'label' => __( 'Icon Color', 'modeltheme-addons-for-wpbakery' ),
              'label_block' => true,
              'condition' => [
            'icon_type' => 'font_icon',
          ],
            ]
          );
          $this->add_control(
          'use_svg',
          [
            'label' => esc_html__( 'SVG Code', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'rows' => 10,
             'condition' => [
            'icon_type' => 'svg',
          ],
          ]
        );
          $this->add_control(
          'icon_url',
          [
            'label' => esc_html__( 'Link', 'modeltheme-addons-for-wpbakery' ),
            'type' => \Elementor\Controls_Manager::URL,
            'placeholder' => esc_html__( 'https://your-link.com', 'modeltheme-addons-for-wpbakery' ),
            'default' => [
              'url' => '',
              'is_external' => true,
              'nofollow' => true,
              'custom_attributes' => '',
            ],
            'label_block' => true,
          ]
        );

        $this->end_controls_section();
    }

}