<div id="post" class="row">
    <section class="span12" role="main">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <nav class="clearfix">
            <p class="pull-right"><?php next_post_link(); ?></p>
            <p class="pull-left"><?php previous_post_link(); ?></p>
        </nav>
        <main role="main">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
                <header>
                    <h1 class="page-title" itemprop="headline">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <small>
                            <?php the_author_posts_link(); ?>
                            <time datetime="<?php the_time('Y-m-j'); ?>" pubdate><?php the_date(); ?></time>
                        </small>
                    </h1>
                </header>
                <section itemprop="articleBody">
                    <?php the_content(); ?>
                    <?php wp_link_pages(); ?>
                </section>
                <footer>
                    <p class="metadata">
                        <?php _e('Category', 'bonestheme'); ?>
                        <?php the_category(', '); ?>
                    </p>
                    <?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags','bonestheme') . ':</span> ', ' ', '</p>'); ?>
                </footer> <!-- end article footer -->
            </article>
            <?php endwhile; ?>
            <?php else : ?>
            <article id="post-not-found">
                <header>
                    <h1><?php _e('Not Found', 'bonestheme'); ?></h1>
                </header>
                <section class="post_content">
                    <p><?php _e('Sorry, but the requested resource was not found on this site.', 'bonestheme'); ?></p>
                </section>
                <footer>
                </footer>
            </article>
            <?php endif; ?>
        </main>
        <div class="widget recent posts">
            <h2 class="widgettitle"><?php _e('Recent Posts'); ?></h2>
            <div class="widgetcontent">
                <ul class="recent posts unstyled clearfix" id="carousel_ul">
                    <?php
                        $articles = get_posts(array('category_name' => 'blog', 'posts_per_page' => get_option('posts_per_page')));

                        if (!empty($articles)) foreach ($articles as $article) {
                    ?>
                    <li class="<?php if (is_single($article->ID)) echo 'active'; ?>">
                        <time>
                            <?php echo get_the_time(get_option('date_format'), $article->ID); ?>
                        </time>
                        <a href="<?php echo get_permalink($article->ID); ?>">
                            <?php echo $article->post_title; ?>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="control widget">
                <p data-trigger-for-us="karousel" data-direction="left"><a href="#">&lsaquo;</a></p>
                <p data-trigger-for-us="karousel" data-direction="right"><a href="#">&rsaquo;</a></p>
            </div>
        </div>
        <?php wp_reset_postdata(); ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('article_footer') ) : ?>
        <?php endif; ?>
    </div>
</section>
