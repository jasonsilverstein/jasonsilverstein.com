<?php
  $images = [];
  $imagesLimit = intval($post->short_images_limit()->value());
  $imagesPerRowMedium = intval($post->short_images_per_row_medium()->value());
  $imagesPerRowLarge = intval($post->short_images_per_row_large()->value());
  $thumbSize = 1140 / $imagesPerRowMedium;

  // Build visible images array
  if ($post->hasImages()):
    foreach($post->images() as $image):
      if (in_array($image->filename(), $post->gallery_images()->split())):
        array_push($images, $image);
      endif;
    endforeach;
  endif;

  // If visible images
  if (count($images) > 0):
  ?>

<div class="images">

  <div class="small-item-grid-1 medium-item-grid-<?php echo $imagesPerRowMedium ?> large-item-grid-<?php echo $imagesPerRowLarge ?>">
  <?php
    for ($i=0; $i<$imagesLimit; $i++):
      if ($i < count($images)):
        $image = $images[$i];
    ?>

  <figure class="item">
    <a href="<?php echo $post->url() ?>" <?php if ($image->caption()): ?>title="<?php echo $image->caption() ?>"<?php endif ?>>
      <img src="<?php echo thumb($image, array('width' => $thumbSize))->url() ?>" <?php if ($image->caption()): ?>alt="<?php echo $image->caption() ?>"<?php endif ?>>
      <!-- <span class="overlay-content"></span> -->
      <span class="overlay"></span>
    </a>
  </figure>

  <?php
    endif;
    endfor;
    ?>
  </div>
</div>

<?php
  endif;
  snippet('post-header', array('post' => $post));
  // getPostExcerpt function in site/plugins/empyre-theme.php
  echo getPostExcerpt($site, $post);
  ?>