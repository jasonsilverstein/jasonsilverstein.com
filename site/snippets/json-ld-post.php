<?php
  $postType = getPostType($post);

  $postLD = array(
    '@context'        => 'http://schema.org',
    '@type'           => 'BlogPosting',
    'articleBody'     => (string) $post->text()->escape(),
    'datePublished'   => (string) $post->date_published()->escape(),
    'headline'        => (string) $post->title()->escape(),
    'keywords'        => (string) $post->tags()->escape(),
    'url'             => (string) $post->url(),
    'wordCount'       => (string) $post->text()->words(),
    'author'          => array(
      '@context'        => 'http://schema.org',
      '@type'           => 'Person',
      'name'            => (string) getPostAuthorName($site, $post)
      )
    );

    switch ($postType):
      case 'audio':
        $contentUrl = $post->file($post->audio_file()->value())->url();
        $postLD['audio'] = array(
          'contentUrl' => (string) $contentUrl
          );
        break;

      case 'gallery':
        $galleryImages = $post->gallery_images()->split();
        if (count($galleryImages) > 0):
          $firstImage = $galleryImages[0];
          $image = $post->file($firstImage)->url();
          $postLD['image'] = (string) $image;
          $postLD['thumbnailUrl'] = (string) $image;
        endif;
        break;

      case 'video':
        $postLD['video'] = array(
          'embedUrl' => (string) $post->video_url()
          );
        break;

      default:
        if ($post->hasImages()):
          $image = $post->images()->first()->url();
          $postLD['image'] = (string) $image;
          $postLD['thumbnailUrl'] = (string) $image;
        endif;

        break;
    endswitch;
  ?>

  <script type="application/ld+json">
    <?php echo json_encode($postLD) ?>
  </script>