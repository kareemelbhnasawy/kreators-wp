<?php
/**
 * Helper class
 *
 * @package AddonSlider
 */
namespace DynamicLayers\AddonSlider\Classes;

defined( 'ABSPATH' ) || die();

class Helper {
    
    /**
     * Get elementor instance
     *
     * @return \Elementor\Plugin
     */
    static function elementor_instance() {
        return \Elementor\Plugin::instance();
    }

    /**
     * Check elementor version
     *
     * @param string $version
     * @param string $operator
     * @return bool
     */
    static function is_elementor_version( $operator = '<', $version = '2.6.0' ) {
        return defined( 'ELEMENTOR_VERSION' ) && version_compare( ELEMENTOR_VERSION, $version, $operator );
    }

    /**
     * Render icon html with backward compatibility
     *
     * @param array $settings
     * @param string $old_icon_id
     * @param string $new_icon_id
     * @param array $attributes
     */
    static function render_icon( $settings = [], $old_icon_id = 'icon', $new_icon_id = 'selected_icon', $attributes = [] ) {
        // Check if its already migrated
        $migrated = isset( $settings['__fa4_migrated'][$new_icon_id] );
        // Check if its a new widget without previously selected icon using the old Icon control
        $is_new = empty( $settings[$old_icon_id] );

        $attributes['aria-hidden'] = 'true';

        if ( self::is_elementor_version( '>=', '2.6.0' ) && ( $is_new || $migrated ) ) {
            \Elementor\Icons_Manager::render_icon( $settings[$new_icon_id], $attributes );
        } else {
            if ( empty( $attributes['class'] ) ) {
                $attributes['class'] = $settings[$old_icon_id];
            } else {
                if ( is_array( $attributes['class'] ) ) {
                    $attributes['class'][] = $settings[$old_icon_id];
                } else {
                    $attributes['class'] .= ' ' . $settings[$old_icon_id];
                }
            }
            printf( '<i %s></i>', \Elementor\Utils::render_html_attributes( $attributes ) );
        }
    }

    /**
     * Get a list of all the allowed html tags.
     *
     * @param string $level Allowed levels are basic and intermediate
     * @return array
     */
    static function get_allowed_html_tags( $level = 'basic' ) {
        $allowed_html = [
            'b'      => [],
            'i'      => [],
            'u'      => [],
            's'      => [],
            'br'     => [],
            'em'     => [],
            'del'    => [],
            'ins'    => [],
            'sub'    => [],
            'sup'    => [],
            'code'   => [],
            'mark'   => [],
            'small'  => [],
            'strike' => [],
            'abbr'   => [
                'title' => [],
            ],
            'span'   => [
                'class' => [],
            ],
            'strong' => [],
        ];

        if ( $level === 'intermediate' ) {
            $tags = [
                'a'       => [
                    'href'  => [],
                    'title' => [],
                    'class' => [],
                    'id'    => [],
                ],
                'q'       => [
                    'cite' => [],
                ],
                'img'     => [
                    'src'    => [],
                    'alt'    => [],
                    'height' => [],
                    'width'  => [],
                ],
                'svg'     => [
                    'class'           => true,
                    'aria-hidden'     => true,
                    'aria-labelledby' => true,
                    'role'            => true,
                    'xmlns'           => true,
                    'width'           => true,
                    'height'          => true,
                    'viewbox'         => true,
                ],
                'g'       => ['fill' => true],
                'title'   => ['title' => true],
                'path'    => [
                    'd'    => true,
                    'fill' => true,
                ],
                'dfn'     => [
                    'title' => [],
                ],
                'time'    => [
                    'datetime' => [],
                ],
                'cite'    => [
                    'title' => [],
                ],
                'acronym' => [
                    'title' => [],
                ],
                'hr'      => [],
            ];

            $allowed_html = array_merge( $allowed_html, $tags );
        }

        return $allowed_html;
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    static function kses_basic( $string = '' ) {
        return wp_kses( $string, self::get_allowed_html_tags( 'basic' ) );
    }

    /**
     * Strip all the tags except allowed html tags
     *
     * The name is based on inline editing toolbar name
     *
     * @param string $string
     * @return string
     */
    static function kses_advance( $string = '' ) {
        return wp_kses( $string, self::get_allowed_html_tags( 'intermediate' ) );
    }
}