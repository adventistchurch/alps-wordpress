<?php get_template_part('templates/page', 'header'); ?>
<?php if (is_page_template('template-news.php')): ?>
  <?php include(locate_template('patterns/components/news-navigation.php')); ?>
<?php endif; ?>
<?php get_template_part('templates/content'); ?>
