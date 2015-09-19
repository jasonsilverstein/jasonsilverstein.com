<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('json-ld-post', array('post' => $page));
  snippet('local-audio');
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