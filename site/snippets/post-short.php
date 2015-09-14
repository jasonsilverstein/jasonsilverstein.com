<?php
  $postType = getPostType($post);
  $postVars = array(
    'post' => $post,
    'postType' => $postType
    );
  ?>

<article class="post-short <?php echo $post->template() ?>">
  <div class="row">
    <div class="large-10 large-push-2 columns">
      <div class="post-body">
        <?php snippet('post-short-'.$postType, $postVars) ?>
      </div>
    </div>
    <div class="large-2 large-pull-12 columns">
      <?php snippet('post-short-meta', $postVars) ?>
    </div>
  </div>

  <?php snippet('json-ld-post', array('post' => $post)) ?>
</article>