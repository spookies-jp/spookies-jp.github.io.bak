<?php
/*
Template Name: for our products
*/
?>
<?php get_header(); ?>
    <section id="works" class="row">
        <header class="span12">
            <div class="page-header"><h1>Works</h1></div>
        </header>
        <?php get_sidebar('portfolio'); ?>
        <main class="span12" role="main">
            <?php
                $articles = get_posts(array('post_parent' => $post->ID, 'post_type' => 'page', 'meta_key' => 'outside_uri'));

                if (!empty($articles)) foreach ($articles as $article) {
                    $outside_uri = get_post_meta($article->ID, 'outside_uri', true);
            ?>
                <article>
                    <?php $thumbnailgun = get_post_meta($article->ID, 'outside_image_uri', true); ?>
                    <header>
                        <?php if (!empty($thumbnailgun)) { ?>
                            <h1 class="attached" style="background-image: url(<?php echo $thumbnailgun; ?>);">
                        <?php } else { ?>
                            <h1>
                        <?php } ?>
                            <?php echo $article->post_title; ?>
                            <?php if (!empty($outside_uri)) { ?>
                                <small><a href="<?php echo $outside_uri; ?>"><?php echo $outside_uri; ?></a></small>
                            <?php } ?>
                        </h1>
                    </header>
                    <div class="contents collapse clearfix" id="item-<?php echo $article->ID; ?>">
                        <?php if (!empty($thumbnailgun)) { ?>
                            <div class="thumbnail pull-left">
                                <a href="<?php echo $outside_uri; ?>"><img src="<?php echo $thumbnailgun; ?>" /></a>
                            </div>
                            <div class="description pull-right">
                        <?php } else { ?>
                            <div class="description">
                        <?php } ?>
                            <?php echo $article->post_content; ?>
                        </div>
                    </div>
                    <footer>
                        <a href="#" data-toggle="collapse" data-target="#item-<?php echo $article->ID; ?>" data-parent="article">開く/閉じる</a>
                    </footer>
                </article>
            <?php } else { ?>
                <article id="post-not-found">
                    <header>
                        <h1><?php _e("Not Found", "bonestheme"); ?></h1>
                    </header>
                    <section class="post_content">
                        <p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
                    </section>
                    <footer>
                    </footer>
                </article>
            <?php } ?>
        </main>
        <footer>
            <?php wp_reset_postdata(); ?>
        </footer>
        <script>
            $(function() {
                $('main > article')
                    .first()
                    .addClass('active')
                    .children('.contents.collapse')
                    .addClass('in');

                $('main footer > a').on('click', function(event) { event.preventDefault(); });
            });
        </script>
    </section>
<?php get_footer(); ?>
