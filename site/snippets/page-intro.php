<?php if (!$page->intro_text()->empty() && $pagination->page() <= 1): ?>
<div class="page-intro text-large">
<?php echo $page->intro_text()->kirbytext() ?>
</div>
<?php endif ?>