<?php
  $pieceLD = array(
    '@context'        => 'http://schema.org',
    '@type'           => 'CreativeWork',
    'text'            => (string) $piece->text()->escape(),
    'datePublished'   => (string) $piece->date_published()->escape(),
    'headline'        => (string) $piece->title()->escape(),
    'keywords'        => (string) $piece->tags()->escape(),
    'url'             => (string) $piece->url()
    );

    $pieceImages = $piece->piece_images()->split();

    if (count($pieceImages) > 0):
      $firstImage = $pieceImages[0];
      $image = $piece->file($firstImage)->url();
      $pieceLD['image'] = (string) $image;
      $pieceLD['thumbnailUrl'] = (string) $image;
    endif;
    ?>

  <script type="application/ld+json">
    <?php echo json_encode($pieceLD) ?>
  </script>