<?php
  $video_url = get_post_meta($post->ID, 'video_url', true);
  $video_caption = get_post_meta($post->ID, 'video_caption', true);
?>
<figure class="figure w--100p">
  <div class="img-wrap fitvid">
    <div class="fluid-width-video-wrapper" style="padding-top: 56.3333%;">
      <iframe src="<?php echo $video_url; ?>" frameborder="0" webkitallowfullscreen="true" mozallowfullscreen="true" allowfullscreen="true"></iframe>
    </div>
  </div> <!-- /.img-wrap -->
  <?php if ($video_caption): ?>
    <figcaption class="figcaption" style="width:100%;">
      <p class="font--secondary--xs"><?php echo $video_caption; ?></p>
    </figcaption>
  <?php endif; ?>
</figure> <!-- /.figure -->
