<?php
/*
Template Name: Full Width Page
*/
?>
<?php get_header(); ?>
    <section class="row">
        <header class="span12">
            <div class="page-header"><h1><?php echo $post->post_name; ?></h1></div>
        </header>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article id="<?php echo $post->post_name; ?>" <?php post_class('span12'); ?> role="article">
            <main role="main">
            <?php the_content(); ?>
            </main>
        </article>
        <?php comments_template(); ?>
        <?php endwhile; ?>
        <?php else : ?>
        <article id="post-not-found">
            <header>
                <h1><?php _e("Not Found", "bonestheme"); ?></h1>
            </header>
            <main class="post_content" role="main">
                <p><?php _e("Sorry, but the requested resource was not found on this site.", "bonestheme"); ?></p>
            </main>
            <footer>
            </footer>
        </article>
        <?php endif; ?>
    </section>
<?php get_footer(); ?>
