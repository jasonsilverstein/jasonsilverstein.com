<?php if ($site->portfolio_piece_display_nav()->bool()): ?>

<div class="pagination">
  <div class="prev">
    <?php if($page->hasPrevVisible()): ?>
    <a href="<?php echo $page->prevVisible()->url() ?>" title="<?php echo str_replace('{{ title }}', $page->prev()->title() , l('pagination_piece_prev_title')) ?>">
      <?php echo str_replace('{{ title }}', $page->prev()->title() , l('pagination_piece_prev')) ?>
    </a>
    <?php endif ?>
  </div>

  <div class="pages">
    &nbsp;
  </div>

  <div class="next">
    <?php if($page->hasNextVisible()): ?>
    <a href="<?php echo $page->nextVisible()->url() ?>" title="<?php echo str_replace('{{ title }}', $page->next()->title() , l('pagination_piece_next_title')) ?>">
      <?php echo str_replace('{{ title }}', $page->next()->title() , l('pagination_piece_next')) ?>
    </a>
    <?php endif ?>
  </div>
</div>

<?php endif ?>