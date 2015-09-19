<?php

return function($site, $pages, $page) {

  // Set default filter status
  $filter = false;

  // Get setting for number of pieces per page
  $perPage = intval($site->portfolio_pieces_per_page()->value());

  // Get sort order
  switch ($site->portfolio_sort_order()->value()) {
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


  // Get all pieces
  $pieces = $page
            ->children()
            ->visible()
            ->filter(function($child) {
              // Don't show pieces with publish dates in the future
              return (time() - strtotime($child->date_published())) >= 0;
              });

  // Apply sorting if required
  if ($site->portfolio_sort_order()->value() != 'manual') {
    $pieces = $pieces->sortBy($sortField, $sortDir);
  }

  // Apply pagination
  $pieces = $pieces->paginate($perPage);


  // Client filter
  if ($client = param('client')):
    $pieces = $pieces->filterBy('client', urldecode($client));
    $filter = true;
  endif;


  // Category filter
  if ($category = param('category')):
    $pieces = $pieces->filterBy('category', urldecode($category));
    $filter = true;
  endif;


  // Role filter
  if ($role = param('role')):
    $pieces = $pieces->filterBy('role', urldecode($role));
    $filter = true;
  endif;


  // Year filter
  if ($year = param('year')):
    $pieces = $pieces->filterBy('year', urldecode($year));
    $filter = true;
  endif;


  // Tag filter
  if ($tag = param('tag')):
    $pieces = $pieces->filterBy('tags', urldecode($tag), ',');
    $filter = true;
  endif;


  // Create a shortcut for pagination
  $pagination = $pieces->pagination();

  // Pass objects to the template
  return compact('pieces', 'pagination', 'filter');

};