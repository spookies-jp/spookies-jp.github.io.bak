<?php
function re_bones_filter_title( $title, $sep ) {
    if (is_feed()) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo('name');

    return $title;
}

function re_bones_main_nav() {
    $locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object($locations['main_nav']);
    $menus = wp_get_nav_menu_items($menu->term_id, array('update_post_term_cache' => false));
    $classes = array_pad(array(), count($menus), array());

    foreach ($menus as $key => $menu) {
        $classes[$key] = array('menu-item');
        $children = get_children(array('post_parent' => $menu->object_id));

        if (is_page($menu->object_id)) {
            $classes[$key][] = 'active';

            break;
        } else if (!empty($children)) foreach ($children as $child) {
            if (is_page($child->ID)) {
                $classes[$key][] = 'active';

                break;
            }
        }
    }

    if (!in_array('active', array_flatten($classes))) {
        $keys = array_keys($menus);

        $classes[$keys[0]][] = 'active';
    }

    foreach ($menus as $key => $menu) {
        echo '<li class="' . implode(' ', $classes[$key]) . '">' .
            '<a href="' . $menu->url . '">' . $menu->title . '</a>' .
            '</li>';
    }
}

// http://qiita.com/srea@github/items/31d68239c42f14bbc15c#comment-3f555e2661ac2b53d1b1
function array_flatten($array) {
    $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($array), RecursiveIteratorIterator::LEAVES_ONLY);

    return iterator_to_array($iterator, false);
}
