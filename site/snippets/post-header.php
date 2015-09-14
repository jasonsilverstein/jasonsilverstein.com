<?php if (!$post->page_heading_visible()->empty()): ?>
<header class="primary-header">
  <h1>
  <?php if (!$post->link()->empty()): ?>
    <a href="<?php echo u($post->link()) ?>" data-target-new>
      <?php echo $post->title() ?> <i class="fa fa-external-link"></i>
    </a>
    <?php if ($page->template() != 'post-link'): ?>
    <a href="<?php echo u($post->url()) ?>" title="<?php echo l('post_meta_permalink_title') ?>">
      <i class="fa fa-long-arrow-right"></i>
    </a>
  <?php endif; ?>
  <?php else: ?>
    <a href="<?php echo $post->url() ?>"><?php echo $post->title() ?></a>
  <?php endif ?>
  </h1>
</header>
<?php endif ?>