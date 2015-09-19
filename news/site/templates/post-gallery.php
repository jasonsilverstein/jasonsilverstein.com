<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('json-ld-post', array('post' => $page));

  // Logic for images in /site/controllers/post-gallery.php

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
  snippet('post-header', array('post' => $page));

  echo $page->text()->kirbytext();

  snippet('post-meta');
  snippet('comments');
  snippet('post-navigation');
  snippet('close-app-body');
  snippet('footer');
  snippet('close-app-wrap');
  snippet('close-body');
  snippet('close-html');
  ?>