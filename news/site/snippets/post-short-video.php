<div class="video">
  <?php echo $post->video_embed_code() ?>
</div>

<?php
  snippet('post-header', array('post' => $post));
  // getPostExcerpt function in site/plugins/empyre-theme.php
  echo getPostExcerpt($site, $post);