<?php get_header(); ?>
    <div id="posts" class="row">
        <section>
            <header>
                <nav class="clearfix">
                    <p class="pull-right"><?php next_posts_link(); ?></p>
                    <p class="pull-left"><?php previous_posts_link(); ?></p>
                </nav>
            </header>
            <div class="span8">
                <div class="page-header">
                    <?php
                        $author_name = get_query_var('author_name');
                        $author = empty($author_name)
                            ? get_user_by('slug', $author_name)
                            : get_userdata(get_query_var('author'));
                    ?>
                    <h1>Posts by: <?php the_author_meta('user_nicename', $author->ID); ?></h1>
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
            </div>
            <div class="span12">
                <footer>
                    <nav class="clearfix">
                        <p class="pull-right"><?php next_posts_link(); ?></p>
                        <p class="pull-left"><?php previous_posts_link(); ?></p>
                    </nav>
                </footer>
            </div>
        </div>
    </div>
<?php get_footer(); ?>
