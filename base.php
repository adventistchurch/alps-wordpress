<?php
use Roots\Sage\Setup;
use Roots\Sage\Wrapper;
?>

<!doctype html>
<html <?php language_attributes(); ?> class="theme--emperor">
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class("body theme--cool"); ?>>
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
      <main class="main can-be--dark-dark" role="main">
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
