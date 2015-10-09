<?php get_header(); ?>
    <div id="posts" class="row">
        <section>
            <?php // TODO: have_posts() が false のときに対応する ?>
            <header class="span12">
                <nav class="clearfix">
                    <p class="pull-right"><?php next_posts_link(); ?></p>
                    <p class="pull-left"><?php previous_posts_link(); ?></p>
                </nav>
            </header>
            <div class="span8">
                <div class="page-header">
                    <h1>Category: <?php single_cat_title(); ?></h1>
                </div>
                <main role="main">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
                            <?php the_excerpt(); ?>
                        </section>
                        <footer>
                            <p class="metadata">
                                <?php _e('Category', 'bonestheme'); ?>
                                <?php the_category(', '); ?>
                            </p>
                            <?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags','bonestheme') . ':</span> ', ' ', '</p>'); ?>
                        </footer>
                    </article>
                <?php endwhile; ?>
                <?php else : ?>
                    <article id="post-not-found">
                        <header>
                            <h1><?php _e('No Posts Yet', 'bonestheme'); ?></h1>
                        </header>
                        <section class="post_content">
                            <p><?php _e('Sorry, What you were looking for is not here.', 'bonestheme'); ?></p>
                        </section>
                        <footer>
                        </footer>
                    </article>
                <?php endif; ?>
                </main>
            </div>
            <div class="span4">
                <?php dynamic_sidebar('archives_sidebar'); ?>
                <div class="widget widget_archive">
                    <h2 class="widgettitle"><?php _e('Categories'); ?></h2>
                    <div class="widgetcontent">
                        <?php wp_list_categories(array('show_count' => true, 'title_li' => null)); ?>
                    </div>
                </div>
                <div class="widget widget_categories">
                    <h2 class="widgettitle"><?php _e('Archives'); ?></h2>
                    <div class="widgetcontent">
                        <?php wp_get_archives(array('show_post_count' => true)); ?>
                    </div>
                </div>
            </div>
            <div class="span12">
                <footer>
                    <nav class="clearfix">
                        <p class="pull-right"><?php next_posts_link(); ?></p>
                        <p class="pull-left"><?php previous_posts_link(); ?></p>
                    </nav>
                </footer>
            </div>
        </section>
    </div>
<?php get_footer(); ?>
