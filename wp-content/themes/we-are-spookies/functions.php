<?php
require_once('filters.php');

add_filter('widgets_init', function() {
    unregister_sidebar('footer1');
    unregister_sidebar('footer2');
    unregister_sidebar('footer3');

    register_sidebar(array(
        'id' => 'footie_above',
        'name' => 'フッター (1/6)',
        'description' => 'すべてのページで表示されます。狭め。',
        'before_widget' => '<div id="%1$s" class="widget span2 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'id' => 'footie',
        'name' => 'フッター',
        'description' => 'すべてのページで表示されます。画面いっぱい！',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'id' => 'portfolio',
        'name' => 'Portfolio Sidebar',
        'description' => 'Used on only works page',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'id' => 'archives_sidebar',
        'name' => 'Archives sidebar',
        'description' => 'アーカイブス ページで表示されます。',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'id' => 'article_footer',
        'name' => 'Article footer',
        'description' => '単一投稿ページで表示されます。',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}, 15);
add_filter('wp_enqueue_scripts', function() {
    if (is_admin()) return;

    wp_deregister_script('bootstrap');
    wp_dequeue_script('bootstrap');
    wp_enqueue_script('bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '2.3.2', true);

    wp_dequeue_script('wpbs-scripts');
    wp_deregister_script('jquery-form');

    wp_deregister_style('bootstrap');
    wp_deregister_style('bootstrap-responsive');

    wp_enqueue_style('bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), '2.3.2');
    wp_enqueue_style('bootstrap-responsive', get_stylesheet_directory_uri() . '/css/bootstrap-responsive.min.css', array('bootstrap'), '2.3.2');
}, 20);
add_filter('wp', function() {
    remove_filter('wp_title', 'bones_filter_title');

    if (is_admin()) return;

    // WordPress が抱える jQuery を無効化
    wp_deregister_script('jquery');

    if (WP_DEBUG)
        wp_register_script('jquery', get_stylesheet_directory_uri() . '/js/jquery.js', array(), '2.0.2', true);
    else
        wp_register_script('jquery', 'http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.2.min.js', array(), '2.0.2', true);

    wp_register_script('modernizr', get_stylesheet_directory_uri() . '/js/modernizr.min.js', array(), false, true);

    wp_enqueue_script('pinterest-grid', get_stylesheet_directory_uri() . '/js/jquery.pinterestFlavored.js', array('jquery'), false, true);
    wp_enqueue_script('karousel', get_stylesheet_directory_uri() . '/js/jquery.karousel.js', array('jquery'));

    wp_enqueue_script('ignition', get_stylesheet_directory_uri() . '/js/ignite.js', array('modernizr', 'karousel', 'pinterest-grid'), false, true);
}, 15);
add_filter('wp_head', function() {
    wp_enqueue_style('we-are-spookies-generic', get_stylesheet_directory_uri() . '/css/common.css');

    if (get_post_type() === 'page') {
        wp_enqueue_style('we-are-spookies-pages', get_stylesheet_directory_uri() . '/css/pages.css', array('we-are-spookies-generic'));

        remove_filter('the_content', 'wpautop');
    } else if (is_404()) {
        wp_enqueue_style('we-are-spookies-page-not-found', get_stylesheet_directory_uri() . '/css/404.css', array('we-are-spookies-generic'));
    } else {
        wp_enqueue_style('we-are-spookies-pages', get_stylesheet_directory_uri() . '/css/archives.css', array('we-are-spookies-generic'));
    }
}, 20);
add_filter('wp_title', 're_bones_filter_title', 15, 2);
add_filter('nav_menu_css_class', 'activate_tabs', 10, 2);

register_nav_menus(array(
    'side_nav' => 'Sidebar',
));

function catch_that_image($post) {
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches[1];

    return empty($first_img[0])
        ? false
        : $first_img[0];
}

function activate_tabs($classes, $item) {
    if (is_page($item->object_id)) {
        $classes[] = 'active';
    }

    return $classes;
}
