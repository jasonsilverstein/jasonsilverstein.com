<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('primary-header');

  // Logic for posts, pagination and filters in /site/controllers/blog.php

  // Display filter message if filter, otherwise default page intro
  if ($filter):
    snippet('page-header-filtered-posts');
  else:
    snippet('page-intro');
  endif;

  // Display the short posts
  if ($posts->count() > 0):
    foreach ($posts as $post):
      snippet('post-short', array('post' => $post));
    endforeach;
  else:
    echo l('blog_no_posts_found');
  endif;

  // Display pagination
  if ($pagination->hasPages()):
    snippet('pagination', array('type' => 'blog', 'pagination' => $pagination));
  endif;

  snippet('close-app-body');
  snippet('footer');
  snippet('close-app-wrap');
  snippet('close-body');
  snippet('close-html');
  ?>