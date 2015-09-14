<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('json-ld-piece', array('piece' => $page));

  // Logic for images in /site/controllers/piece.php

  // If visible images
  if (count($images) > 0):
  ?>

  <div class="images">
  <?php foreach ($images as $image): ?>
    <figure>
      <a class="fancybox" data-fancybox-group="gallery" href="<?php echo $image->url() ?>" <?php if ($image->caption()): ?>title="<?php echo $image->caption() ?>"<?php endif ?>>
        <img src="<?php echo thumb($image, array('width' => 1140))->url() ?>" <?php if ($image->caption()): ?>alt="<?php echo $image->caption() ?>"<?php endif ?>>
      </a>
      <?php
        if ($image->caption()):
         echo '<figcaption>'.$image->caption()->html().'</figcaption>';
        endif;
        ?>
    </figure>
  <?php endforeach; ?>
  </div>

  <?php
    endif;
    snippet('primary-header', array('piece' => $page));
    ?>

<div class="row">
  <div class="large-8 columns">
    <?php echo $page->text()->kirbytext() ?>
  </div>
  <div class="large-3 large-push-1 columns">
    <?php snippet('piece-meta') ?>
  </div>
</div>


<?php
  snippet('comments');
  snippet('piece-navigation');
  snippet('close-app-body');
  snippet('footer');
  snippet('close-app-wrap');
  snippet('close-body');
  snippet('close-html');
  ?>