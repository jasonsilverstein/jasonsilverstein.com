<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('primary-header');

  echo '<div class="page-body">';
  echo $page->text()->kirbytext();
  echo '</div>';


  // Logic for posts in /site/controllers/page-blog-archives.php

  // Display years
  foreach ($groupedPosts as $year => $months):
    echo '<section class="archives-year">';
    echo '<h2>'.$year.'</h2>';
    echo '<div class="item-grid small-item-grid-1 large-item-grid-3">';

    // Display months
    foreach ($months as $month):
      echo '<div class="item">';
      echo '<p><strong>'.$month['name'].'</strong></p>';
      echo '<nav class="nav-side">';
      echo '<ul>';

      // Display posts
      foreach ($month['posts'] as $post):
        echo '<li>';
        echo '<a href="'.$post['url'].'">';
        echo $post['title'];
        echo '</a>';
        echo '</li>';
      endforeach;

      echo '</ul>';
      echo '</nav>';
      echo '</div>';
    endforeach;

    echo '</div>';
    echo '</section>';
  endforeach;

  snippet('close-app-body');
  snippet('footer');
  snippet('close-app-wrap');
  snippet('close-body');
  snippet('close-html');
  ?>