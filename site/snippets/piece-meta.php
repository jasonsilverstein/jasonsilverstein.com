<div class="piece-meta">

  <?php if (!$page->client()->empty()): ?>
    <div class="item">
      <p class="client">
        <span class="label"><?php echo l('piece_meta_client') ?></span>
        <a href="<?php echo u('/portfolio/client:'.urlencode($page->client())) ?>"><?php echo $page->client(); ?></a>
      </p>
    </div>
  <?php endif ?>

  <?php if (!$page->category()->empty()): ?>
    <div class="item">
      <p class="category">
        <span class="label"><?php echo l('piece_meta_category') ?></span>
        <a href="<?php echo u('/portfolio/category:'.urlencode($page->category())) ?>"><?php echo $page->category(); ?></a>
      </p>
    </div>
  <?php endif ?>

  <?php if (!$page->role()->empty()): ?>
    <div class="item">
      <p class="role">
        <span class="label"><?php echo l('piece_meta_role') ?></span>
        <a href="<?php echo u('/portfolio/role:'.urlencode($page->role())) ?>"><?php echo $page->role(); ?></a>
      </p>
    </div>
  <?php endif ?>

  <?php if (!$page->year()->empty()): ?>
    <div class="item">
      <p class="year">
        <span class="label"><?php echo l('piece_meta_year') ?></span>
        <a href="<?php echo u('/portfolio/year:'.urlencode($page->year())) ?>"><?php echo $page->year(); ?></a>
      </p>
    </div>
  <?php endif ?>

  <?php if (!$page->tags()->empty()): ?>
    <div class="item">
      <p class="tags">
        <span class="label"><?php echo l('piece_meta_tags') ?></span>
        <?php $tags = explode(',', $page->tags()) ?>
        <?php foreach($tags as $tag): ?>
        <a href="<?php echo u('/portfolio/tag:'.urlencode($tag)) ?>"><span class="hashtag">#</span><?php echo $tag ?></a><span class="divider"></span>
        <?php endforeach ?>
      </p>
    </div>
  <?php endif ?>

  <div class="item icons">
    <a class="social-link twitter" title="<?php echo l('piece_meta_tweet_title') ?>" href="http://twitter.com/home?status=<?php echo urlencode($page->title().' '.$page->url()); ?>" rel="nofollow" data-target-new>
      <i class="fa fa-twitter"></i>
    </a>
  </div>

</div>