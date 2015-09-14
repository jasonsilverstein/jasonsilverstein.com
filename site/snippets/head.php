<?php
  // getMeta function in site/plugins/empyre-theme.php
  $meta = getMeta($site, $page);
  ?>

<head>
  <!-- Meta -->
  <title><?php echo $meta['title'] ?></title>
  <meta charset="utf-8" />
  <meta name="description" content="<?php echo $meta['description'] ?>" />
  <meta name="keywords" content="<?php echo $meta['keywords'] ?>" />
  <meta name="robots" content="index, follow" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Open Graph -->
  <meta property="og:site_name" content="<?php echo $meta['og']['site_name'] ?>" />
  <meta property="og:type" content="<?php echo $meta['og']['type'] ?>" />
  <meta property="og:title" content="<?php echo $meta['og']['title'] ?>" />
  <meta property="og:description" content="<?php echo $meta['og']['description'] ?>" />

  <?php
    // Images
    if (isset($meta['og']['images'])):
      foreach ($meta['og']['images'] as $image):
        echo '<meta property="og:image" content="'.$image.'" />';
      endforeach;
    endif;

    // Audio
    if (isset($meta['og']['audio'])):
      echo '<meta property="og:audio" content="'.$meta['og']['audio'].'" />';
    endif;

    // Video
    if (isset($meta['og']['video'])):
      echo '<meta property="og:video" content="'.$meta['og']['video'].'" />';
    endif;
    ?>

  <meta property="fb:admins" content="" />

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo u('favicon.ico') ?>" type="image/x-icon" />

  <!-- Blog RSS feed -->
  <link rel="alternate" type="application/rss+xml" href="<?php echo url('blog/feed') ?>" title="<?php echo html($pages->find('blog/feed')->title()) ?>" />

  <!-- Assets -->
  <?php
    $cdnjs = '//cdnjs.cloudflare.com/ajax/libs/';

    // Styles
    echo css(array(
      'assets/css/theme-vendor.min.css',
      'assets/css/theme.css',
      'assets/css/theme-custom-styles.css',
      $cdnjs.'font-awesome/4.3.0/css/font-awesome.min.css'
      ));
    snippet('css-settings');

    // Scripts
    echo js(array(
      'assets/js/theme-modernizr.min.js'
      ));
    snippet('js-empyre');

    // Custom head HTML
    echo $site->custom_html_header()->html();
    ?>
</head>