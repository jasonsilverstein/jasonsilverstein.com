<?php
  switch ($type):
    case 'blog':
      $prevText = l('pagination_blog_prev');
      $nextText = l('pagination_blog_next');
      $prevTitle = l('pagination_blog_prev_title');
      $nextTitle = l('pagination_blog_next_title');
      break;
    default:
      $prevText = l('pagination_prev');
      $nextText = l('pagination_next');
      $prevTitle = l('pagination_prev_title');
      $nextTitle = l('pagination_next_title');
      break;
  endswitch;
  ?>

<div class="pagination">
  <div class="prev">
    <?php if($pagination->hasPrevPage()): ?>
    <a href="<?php echo $pagination->prevPageURL() ?>" title="<?php echo $prevTitle ?>">
      <?php echo $prevText ?>
    </a>
    <?php endif ?>
  </div>

  <div class="pages">
    <?php echo $pagination->page().'/'.$pagination->countPages() ?>
  </div>

  <div class="next">
    <?php if($pagination->hasNextPage()): ?>
    <a href="<?php echo $pagination->nextPageURL() ?>" title="<?php echo $nextTitle ?>">
      <?php echo $nextText ?>
    </a>
    <?php endif ?>
  </div>
</div>