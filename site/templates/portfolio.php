<!DOCTYPE html>
<?php
  snippet('open-html');
  snippet('head');
  snippet('open-body');
  snippet('open-app-wrap');
  snippet('header');
  snippet('open-app-body');
  snippet('primary-header');

  // Logic for pieces, pagination and filters in /site/controllers/portfolio.php

  // Display filter message if filter, otherwise default page intro
  if ($filter):
    snippet('page-header-filtered-pieces');
  else:
    snippet('page-intro');
  endif;

  // Display the short pieces
  if ($pieces->count() > 0):
    foreach ($pieces as $piece):
      snippet('piece-short', array('piece' => $piece));
    endforeach;
  else:
    echo l('portfolio_no_pieces_found');
  endif;

  // Display pagination
  if ($pagination->hasPages()):
    snippet('pagination', array('type' => 'portfolio', 'pagination' => $pagination));
  endif;

  snippet('close-app-body');
  snippet('footer');
  snippet('close-app-wrap');
  snippet('close-body');
  snippet('close-html');
  ?>