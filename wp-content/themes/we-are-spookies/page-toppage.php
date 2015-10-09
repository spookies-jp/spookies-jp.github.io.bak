<?php
/*
Template Name: Toppage
*/
?>
<?php get_header(); ?>
    <div id="toppage" class="row">
        <?php if (of_get_option('showhidden_slideroptions')) { ?>
            <div class="span12" id="our-banners">
                <div class="our-banner-container">
                    <div class="our-banner-inner">
                        <?php
                        $show_posts = of_get_option('slider_options');
                        $args = array( 'numberposts' => $show_posts, 'category_name' => 'recommendations' ); // set this to how many posts you want in the carousel
                        $myposts = get_posts( $args );
                        $post_num = 0;
                        foreach( $myposts as $post ) :  setup_postdata($post);
                            $post_num++;
                            $post_thumbnail_id = get_post_thumbnail_id();
                            $featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpbs-featured-carousel' );
                        ?>
                        <div class="<?php if($post_num == 1){ echo 'active'; } ?> item" data-item-number="<?php echo $post_num; ?>">
                            <?php the_post_thumbnail( 'wpbs-featured-carousel' ); ?>
                            <div class="carousel-caption">
                                <h4><?php the_title(); ?></h4>
                                <p>
                                    <?php
                                        echo get_the_content();
                                    ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>
                    <!-- Carousel nav -->
                </div>
                <a class="simple-carousel-control left" href="#our_banners" data-direction="left">&lsaquo;</a>
                <a class="simple-carousel-control right" href="#our_banners" data-direction="right">&rsaquo;</a>
            </div>
        <?php } // ends the if use carousel statement ?>
        <section class="span8">
            <header class="page-header">
                <h1>What's new</h1>
            </header>
            <div id="posts" role="main">
                <?php
                    $articles = get_posts(array('category_name' => 'blog', 'posts_per_page' => get_option('posts_per_page'), 'paged' => get_query_var('paged')));

                    if ($articles !== null) foreach($articles as $post) {
                        setup_postdata($post);
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                    <header>
                        <p class="post-header">
                            <time>
                                <?php the_time(get_option('date_format')); ?>
                            </time>
                        </p>
                        <?php if (($attachment = catch_that_image($post)) !== false) { ?>
                        <div class="thumbnail"
                            style="height: <?php echo get_option('thumbnail_size_h'); ?>px;"
                            >
                            <a class="alternate"
                                href="<?php the_permalink(); ?>"
                                style="display: inline-block; background-image: url(<?php echo $attachment; ?>); width: <?php echo get_option('thumbnail_size_w'); ?>px; height: <?php echo get_option('thumbnail_size_h'); ?>px; background-position: center;"
                                >
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <?php } ?>
                        <h1 class="page-title" itemprop="headline"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                    </header>
                    <section class="contents" itemprop="articleBody">
                        <?php the_excerpt(); ?>
                    </section>
                </article>
                <?php } else { ?>
                <article id="post-not-found">
                    <header>
                        <h1><?php _e("Not Found", "bonestheme"); ?></h1>
                    </header>
                    <section class="post_content">
                        <p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
                    </section>
                </article>
                <?php } ?>
            </div>
            <footer>
                <?php wp_reset_postdata(); ?>
            </footer>
        </section>
        <?php get_sidebar('sidebar2'); // sidebar 1 ?>
    </div> <!-- end #content -->
<?php get_footer(); ?>
