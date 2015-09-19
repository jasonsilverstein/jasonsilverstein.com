<?php
  $images = [];
  $imagesLimit = intval($piece->short_images_limit()->value());
  $imagesPerRowMedium = intval($piece->short_images_per_row_medium()->value());
  $imagesPerRowLarge = intval($piece->short_images_per_row_large()->value());

  // Build visible images array
  if ($piece->hasImages()):
    foreach($piece->images() as $image):
      if (in_array($image->filename(), $piece->short_images()->split())):
        array_push($images, $image);
      endif;
    endforeach;
  endif;
  ?>


<article class="piece-short <?php echo $piece->category() ?>">
  <div class="row">

    <div class="medium-3 columns">
      <header>
        <h1>
          <a href="<?php echo $piece->url() ?>"><?php echo $piece->title() ?></a>
        </h1>
      </header>
      <div class="client">
        <p><a href="<?php echo u('portfolio/client:'.urlencode($piece->client())) ?>"><?php echo $piece->client(); ?></a>
        </p>
      </div>
      <div class="overview">
        <?php echo $piece->overview()->kirbytext() ?>
      </div>

    </div>
    <div class="medium-8 medium-push-1 columns">
      <div class="images">
        <div class="small-item-grid-1 medium-item-grid-<?php echo $imagesPerRowMedium ?> large-item-grid-<?php echo $imagesPerRowLarge ?>">

          <?php
            for ($i=0; $i<$imagesLimit; $i++):
              if ($i < count($images)):
                $image = $images[$i];
            ?>

            <figure class="item">
              <a href="<?php echo $piece->url() ?>">
                <img src="<?php echo thumb($image, array('width' => 710, 'height' => 450, 'crop' => true))->url() ?>" <?php if ($image->caption()): ?>alt="<?php echo $image->caption() ?>"<?php endif ?>>
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
    </div>

  </div>

  <?php snippet('json-ld-piece', array('piece' => $piece)) ?>
</article>