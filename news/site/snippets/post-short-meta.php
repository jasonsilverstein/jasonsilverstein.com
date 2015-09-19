<?php
  $datePublished = date_create($post->date_published());
  $datePublished = date_format($datePublished, 'F d, Y');
  $meta = $site->blog_post_short_meta()->split();
  $authorName = getPostAuthorName($site, $post);
  ?>

<div class="post-meta">

  <!-- Author avatar -->
  <?php if (in_array('author_avatar', $meta)): ?>
  <div class="item avatar">
    <a href="<?php echo u('/by:'.urlencode($authorName)) ?>" title="<?php echo str_replace('{{ author_name }}', $authorName, l('post_meta_author_title')) ?>">
    <?php if ($site->blog_author_avatar_display_style() == 'profile'): ?>
      <img src="<?php echo $site->user($post->author_username())->avatar()->url() ?>" alt="<?php echo str_replace('{{ author_name }}', $authorName, l('post_meta_avatar_alt')) ?>">
    <?php else: ?>
      <img src="<?php echo $site->user($post->author_username())->gravatar(150) ?>" alt="<?php echo str_replace('{{ author_name }}', $authorName, l('post_meta_avatar_alt')) ?>">
    <?php endif ?>
    </a>
  </div>
  <?php endif ?>

  <!-- Author name -->
  <?php if (in_array('author_name', $meta)): ?>
  <div class="item author">
    <a href="<?php echo u('/by:'.urlencode($authorName)) ?>" title="<?php echo str_replace('{{ author_name }}', $authorName, l('post_meta_author_title')) ?>"><?php echo $authorName ?></a>
  </div>
  <?php endif ?>

  <!-- Publish date -->
  <?php if (in_array('date_published', $meta)): ?>
  <div class="item published">
    <a href="<?php echo u('/from:'.urlencode($post->date_published())) ?>" title="<?php echo str_replace('{{ date }}', $datePublished, l('post_meta_date_published_title')) ?>"><?php echo $datePublished ?></a>
  </div>
  <?php endif ?>

  <!-- Comment count -->
  <?php if (in_array('comment_count', $meta) && $post->comments_enabled()->bool() && !$site->disqus_shortname()->empty()): ?>
  <div class="item comment-count">
    <a href="<?php echo $post->url(); ?>#disqus_thread" data-disqus-identifier="<?php echo $post->hash() ?>"></a>
  </div>
  <?php endif ?>

  <!-- Tags -->
  <?php if (in_array('tags', $meta)): ?>
  <div class="item tags">
    <?php $tags = explode(',', $post->tags()) ?>
    <?php
      foreach($tags as $tag):
        if ($tag != ''):
    ?>
    <a href="<?php echo u('/tag:'.urlencode($tag)) ?>" title="<?php echo str_replace('{{ tag }}', $tag, l('post_meta_tag_title')) ?>">#<?php echo $tag ?></a>
    <?php
        endif;
      endforeach;
    ?>
  </div>
  <?php endif ?>

  <!-- Icons -->
  <?php if (in_array('icons', $meta)): ?>
  <div class="item icons">
    <a class="social-link twitter" title="<?php echo l('post_meta_tweet_title') ?>" href="http://twitter.com/home?status=<?php echo urlencode($page->title().' '.$page->url()); ?>" rel="nofollow" data-target-new>
      <i class="fa fa-twitter"></i>
    </a>
  </div>
  <?php endif ?>

</div>