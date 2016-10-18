<?php use Roots\Sage\Titles; ?>
<?php
  if (!empty(get_field('header_background_image'))):
    $bg_image = get_field('header_background_image');
?>
  <style type="text/css">
    .header-swath--with-image {
      background-image: url(<?php echo $bg_image['sizes']['featured__hero--m']; ?>);
    }
    @media (min-width: 800px) {
      .header-swath--with-image {
        background-image: url(<?php echo $bg_image['sizes']['featured__hero--l']; ?>);
      }
    }
    @media (min-width: 1100px) {
      .header-swath--with-image {
        background-image: url(<?php echo $bg_image['sizes']['featured__hero--xl']; ?>);
      }
    }
  </style>
<?php endif; ?>
<header class="header__swath theme--primary-background-color blend-mode--multiply <?php if (isset($bg_image)): echo "header-swath--with-image"; endif; ?>">
  <div class="layout-container cf">
    <?php /*
    <div class="header__text">
      <div class="unify show-at--small">
        <h2 class="font--secondary--l upper white">Section</h2>
        <h3 class="font--secondary--m white--trans">Section subtitle</h3>
      </div>
      <div class="header__logo"><img src="http://placehold.it/80x80"></div>
    </div> <!-- /.header__text -->
    */ ?>
    <div class="flex-container cf">
      <div class="shift-left--fluid">
        <!-- <span class="kicker white">Kicker</span> -->
        <h1 class="font--tertiary--xl white"><?php echo Titles\title(); ?></h1>
        <?php print_r($post); ?>
      </div>
      <div class="shift-right--fluid"></div> <!-- /.shift-right--fluid -->
    </div>
  </div>
</header> <!-- /.header__swath -->
