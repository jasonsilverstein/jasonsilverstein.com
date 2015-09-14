<?php

return function($site, $pages, $page) {

  // Get all posts and add pagination
  $posts = page('blog')
            ->children()
            ->visible()
            ->filter(function($child) {
              // Don't show posts with publish dates in the future
              return (time() - strtotime($child->date_published())) >= 0;
              })
            ->sortBy('date_published', 'desc');


  $groupedPosts = array();

  // Group posts by year and month
  foreach ($posts as $post):
    $postYear = date('Y', strtotime($post->date_published()));
    $postMonthName = date('F', strtotime($post->date_published()));
    $postMonth = date('m', strtotime($post->date_published()));

    // Create year and month groupings
    if (!isset($groupedPosts[$postYear][$postMonth])):
      $groupedPosts[$postYear][$postMonth]['name'] = $postMonthName;
      $groupedPosts[$postYear][$postMonth]['posts'] = [];
    endif;

    // Add post to group
    if (isset($groupedPosts[$postYear][$postMonth])):
      $groupedPosts[$postYear][$postMonth]['posts'][] = ['title' => $post->title()->html()->value(), 'url' => $post->url(), 'date' => $post->date_published()];
    endif;

    // Sort posts descending chronologically (newest first)
    uasort($groupedPosts[$postYear][$postMonth]['posts'], 'orderByDateDescending');

    // Sort months descending chronologically (newest first)
    asort($groupedPosts[$postYear]);

  endforeach;

  // Sort years descending chronologically (newest first)
  arsort($groupedPosts);

  // Pass objects to the template
  return compact('groupedPosts');

};