<?php

return function($site, $pages, $page) {

  // Set default filter status
  $filter = false;

  // Get setting for number of posts per page
  $perPage = intval($site->blog_posts_per_page()->value());

  // Get sort order
  switch ($site->blog_sort_order()->value()) {
    case "chronological":
      $sortField = 'date_published';
      $sortDir = 'asc';
      break;
    case "reverse_chronological":
      $sortField = 'date_published';
      $sortDir = 'desc';
      break;
    case "alphabetical":
      $sortField = 'title';
      $sortDir = 'asc';
      break;
    case "reverse_alphabetical":
      $sortField = 'title';
      $sortDir = 'desc';
      break;
    default:
      $sortField = 'date_published';
      $sortDir = 'desc';
  }


  // Get all posts
  $posts = $page
            ->children()
            ->visible()
            ->filter(function($child) {
              // Don't show posts with publish dates in the future
              return (time() - strtotime($child->date_published())) >= 0;
              });

  // Apply sorting if required
  if ($site->blog_sort_order()->value() != 'manual') {
    $posts = $posts->sortBy($sortField, $sortDir);
  }

  // Apply pagination
  $posts = $posts->paginate($perPage);


  // Author filter
  if ($by = param('by')):
    switch ($site->blog_author_name_display_style()):
      case 'full_name':
        $user = $site->users()->filter(function($user) {
          return $user->firstname().' '.$user->lastname() == urldecode(param('by'));
        })->first();
        $username = isset($user) ? $user->username() : '';
        break;

      case 'first_name':
        $user = $site->users()->filter(function($user) {
          return $user->firstname() == urldecode(param('by'));
        })->first();
        $username = isset($user) ? $user->username() : '';
        break;

      default:
        $username = $by;
        break;
    endswitch;

    $posts = $posts->filterBy('author_username', urldecode($username));
    $filter = true;
  endif;


  // Date filter
  if ($date = param('from')):
    $posts = $posts->filterBy('date_published', urldecode($date));
    $filter = true;
  endif;


  // Tag filter
  if ($tag = param('tag')):
    $posts = $posts->filterBy('tags', urldecode($tag), ',');
    $filter = true;
  endif;

  // Type filter
  if ($type = param('type')):
    $posts = $posts->filter(function($child) {
      return $child->template() == urldecode('post-'.param('type'));
    });
    $filter = true;
  endif;


  // Create a shortcut for pagination
  $pagination = $posts->pagination();

  // Pass objects to the template
  return compact('posts', 'pagination', 'filter');

};