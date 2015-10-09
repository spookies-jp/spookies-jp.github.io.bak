<?php get_header(); ?>
<?php
if (in_category('blog'))
{
    // ブログ カテゴリーは専用テンプレートを使う
    get_template_part('single', 'blog');
} else {
    // 専用テンプレートしかないのでそれにフォールバック
    get_template_part('single', 'blog');
}
?>
<?php get_footer(); ?>
