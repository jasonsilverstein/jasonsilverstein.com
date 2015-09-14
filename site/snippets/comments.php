<?php if ($page->comments_enabled()->bool() && !$site->disqus_shortname()->empty()): ?>
<section class="comments">
  <h2 class="outline-title"><?php echo l('comments') ?></h2>
  <?php snippet('disqus') ?>
</section>
<?php endif ?>