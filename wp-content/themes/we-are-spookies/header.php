<!doctype html>
<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- media-queries.js (fallback) -->
        <!--[if lt IE 9]>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->
        <!-- html5.js -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <!-- wordpress head functions -->
        <?php wp_head(); ?>
        <!-- end of wordpress head -->
    </head>
    <body <?php body_class(); ?> id="page-area">
        <header class="navbar navbar-fixed-top" role="banner">
            <div class="navbar-inner">
                <nav class="container" role="navigation">
                    <a class="brand" id="logo" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>">
                        <?php if (of_get_option('branding_logo','')!='') { ?>
                            <img src="<?php echo of_get_option('branding_logo'); ?>" alt="<?php echo get_bloginfo('name'); ?>" title="<?php echo get_bloginfo('description'); ?>">
                        <?php }
                        if (of_get_option('site_name','1')) bloginfo('name'); ?>
                    </a>
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div id="main-navigation" class="nav-collapse">
                        <ul id="menu-top-menu" class="nav pull-right">
                            <?php re_bones_main_nav(); ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
