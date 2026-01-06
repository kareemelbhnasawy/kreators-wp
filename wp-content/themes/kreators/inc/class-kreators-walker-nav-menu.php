<?php
/**
 * Custom Nav Walker for Kreators Theme
 *
 * Extends the default WordPress navigation walker to add
 * custom classes and enhanced accessibility.
 *
 * @package kreators
 */

if (!class_exists('Kreators_Walker_Nav_Menu')) :

class Kreators_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * @param string   $output Used to append additional content.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);

        $classes = array('sub-menu', 'kr-submenu');

        if ($depth === 0) {
            $classes[] = 'kr-submenu-level-1';
        } else {
            $classes[] = 'kr-submenu-level-' . ($depth + 1);
        }

        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $output .= "{$n}{$indent}<ul{$class_names}>{$n}";
    }

    /**
     * Starts the element output.
     *
     * @param string   $output Used to append additional content.
     * @param WP_Post  $item   Menu item data object.
     * @param int      $depth  Depth of menu item.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     * @param int      $id     Current item ID.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $classes[] = 'kr-menu-item';

        // Add depth class
        $classes[] = 'kr-menu-item-depth-' . $depth;

        // Add active/current classes
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'kr-menu-item-active';
        }

        if (in_array('current-menu-parent', $classes) || in_array('current-menu-ancestor', $classes)) {
            $classes[] = 'kr-menu-item-parent-active';
        }

        // Add has-children class
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'kr-has-submenu';
        }

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener noreferrer';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href'] = !empty($item->url) ? $item->url : '';

        // Add aria-current for current menu item
        if (in_array('current-menu-item', $classes)) {
            $atts['aria-current'] = 'page';
        }

        // Add aria-haspopup for items with children
        if (in_array('menu-item-has-children', $classes)) {
            $atts['aria-haspopup'] = 'true';
            $atts['aria-expanded'] = 'false';
        }

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

        $item_output = $args->before ?? '';
        $item_output .= '<a' . $attributes . ' class="kr-menu-link">';
        $item_output .= ($args->link_before ?? '') . $title . ($args->link_after ?? '');

        // Add dropdown indicator for parent items
        if (in_array('menu-item-has-children', $classes) && $depth === 0) {
            $item_output .= '<svg class="kr-menu-arrow" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
        }

        $item_output .= '</a>';
        $item_output .= $args->after ?? '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    /**
     * Ends the element output.
     *
     * @param string   $output Used to append additional content.
     * @param WP_Post  $item   Page data object.
     * @param int      $depth  Depth of page.
     * @param stdClass $args   An object of wp_nav_menu() arguments.
     */
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $n = '';
        } else {
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }

    /**
     * Display fallback menu when no menu is assigned.
     *
     * @param array $args Menu arguments.
     * @return string Fallback menu HTML.
     */
    public static function fallback($args) {
        $output = '';

        if (current_user_can('edit_theme_options')) {
            $output .= '<ul class="' . esc_attr($args['menu_class']) . '">';
            $output .= '<li class="menu-item kr-menu-item">';
            $output .= '<a href="' . esc_url(admin_url('nav-menus.php')) . '" class="kr-menu-link">';
            $output .= esc_html__('Add a menu', 'kreators');
            $output .= '</a>';
            $output .= '</li>';
            $output .= '</ul>';
        } else {
            $output .= '<ul class="' . esc_attr($args['menu_class']) . '">';
            $output .= '<li class="menu-item kr-menu-item">';
            $output .= '<a href="' . esc_url(home_url('/')) . '" class="kr-menu-link">';
            $output .= esc_html__('Home', 'kreators');
            $output .= '</a>';
            $output .= '</li>';
            $output .= '</ul>';
        }

        if ($args['echo']) {
            echo $output;
        }

        return $output;
    }
}

endif;
