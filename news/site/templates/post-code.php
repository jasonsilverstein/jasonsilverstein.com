<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('json-ld-post', array('post' => $page));

  if (!$page->gist_url()->empty()):
    echo gist($page->gist_url());
  elseif (!$page->inline_code()->empty()):
    echo '<pre><code class="language-'.$page->inline_code_language().'">'.$page->inline_code()->escape().'</code></pre>';
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