<div class="shift-right--fluid bg--beige can-be--dark-dark">
  <?php if (is_active_sidebar('sidebar_breakout_block')): ?>
    <div class="media-block block spacing bg--tan can-be--dark-dark block--breakout pad--secondary--for-breakouts">
      <?php dynamic_sidebar('sidebar_breakout_block'); ?>
    </div>
  <?php endif; ?>

  <div class="column__secondary can-be--dark-dark">
    <aside class="aside spacing--double">
      <div class="pad--secondary spacing--double">
        <?php if (is_active_sidebar('sidebar')): ?>
          <?php dynamic_sidebar('sidebar'); ?>
        <?php endif; ?>
      </div>
    </aside>
  </div>
</div> <!-- /.shift-right--fluid -->
