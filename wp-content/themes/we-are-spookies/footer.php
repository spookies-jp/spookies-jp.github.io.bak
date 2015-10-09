        </div>
        <footer role="contentinfo">
            <nav>
                <aside id="spoo" data-trigger-for-us="spoo">
                    <div class="container clearfix">
                        <a href="#page-area" class="pull-right">ページトップへ</a>
                    </div>
                </aside>

                <div id="footie_below">
                    <div class="navigation">
                        <ul class="inline">
                            <?php re_bones_main_nav(); ?>
                        </ul>
                    </div>

                    <div class="container" style="margin-top: 20px;">
                        <?php dynamic_sidebar('footie'); ?>
                    </div>

                    <aside id="blogroll" class="row">
                        <div class="container">
                            <?php dynamic_sidebar('footie_above'); ?>
                        </div>
                    </aside>

                    <p class="attribution container">
                        Copyright &copy; 2006 - <?php echo date('Y'); ?> <?php the_author_meta('nickname', 1); ?> All Rights Reserved.
                    </p>
                </div>
            </nav>
        </footer>
        <!--[if lt IE 7 ]>
            <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
            <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
        <![endif]-->
        <?php wp_footer(); // js scripts are inserted using this function ?>
    </body>
</html>
