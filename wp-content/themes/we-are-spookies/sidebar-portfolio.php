<div id="sidebar" class="sidebar portfolio sidebar span12" role="complementary">
    <?php
    if (is_active_sidebar('portfolio') ) {
        dynamic_sidebar('portfolio');
    }

    wp_nav_menu(array(
        'container' => false,
        'menu_class' => 'inline',
        'theme_location' => 'side_nav'
    ));
    ?>
</div>
