<?php
  use Roots\Sage\Setup;
  use Roots\Sage\Wrapper;

  $primary_theme_color = get_field('primary_theme_color', 'option');
?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class("body"); ?>>
    <!--[if lt IE 11]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <div class="content cf has-aside" role="document">
      <?php
        do_action('get_header');
        get_template_part('templates/header');
      ?>
      <main class="main can-be--dark-dark <?php if (is_page_template('template-longform.php')): echo 'bg--white article__longform'; endif; ?>" role="main">
        <?php include Wrapper\template_path(); ?>
      </main> <!-- /.main -->
      <?php
        do_action('get_footer');
        get_template_part('templates/footer');
        wp_footer();
      ?>
    </div> <!-- /.content -->
  </body>
</html>
