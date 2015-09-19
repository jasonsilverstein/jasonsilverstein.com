<?php if (!$page->page_heading_visible()->empty()): ?>
<header class="primary-header">
  <h1>
    <a href="<?php echo $page->url() ?>"><?php echo $page->title() ?></a>
  </h1>
</header>
<?php endif ?>

