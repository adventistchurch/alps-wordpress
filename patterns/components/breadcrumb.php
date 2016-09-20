<nav class="breadcrumbs" role="navigation">
  <ul class="breadcrumbs__list">
    <?php foreach ($breadcrumbs as $breadcrumb): ?>
      <li class="breadcrumbs__list-item font--secondary--xs upper dib"><a href="<?php echo $breadcrumb['link']; ?>" class="breadcrumbs__link"><?php echo $breadcrumb['name']; ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav> <!-- /.breadcrumbs -->
