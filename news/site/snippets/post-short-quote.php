<?php snippet('post-header', array('post' => $post)) ?>

<blockquote>
  <?php echo $post->quote()->kirbytext() ?>
  <cite><?php echo $post->cite()->html() ?></cite>
</blockquote>

<?php
  // getPostExcerpt function in site/plugins/empyre-theme.php
  echo getPostExcerpt($site, $post)
  ?>