<?php
  snippet('local-audio', array('page' => $post));
  snippet('post-header', array('post' => $post));
  // getPostExcerpt function in site/plugins/empyre-theme.php
  echo getPostExcerpt($site, $post);