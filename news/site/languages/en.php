<?php

  // General
  // ------------------------------
  l::set('submit', 'Submit');
  l::set('cancel', 'Cancel');
  l::set('comments', 'Comments');


  // Audio
  // ------------------------------
  l::set('audio_not_supported', 'Your browser does not support the audio element.');


  // Pagination
  // ------------------------------

  // Default
  l::set('pagination_next', 'Next &rarr;');
  l::set('pagination_next_title', 'View next');
  l::set('pagination_prev', '&larr; Previous');
  l::set('pagination_prev_title', 'View previous');

  // Blog
  l::set('pagination_blog_next', 'Next &rarr;');
  l::set('pagination_blog_next_title', 'View older posts');
  l::set('pagination_blog_prev', '&larr; Previous');
  l::set('pagination_blog_prev_title', 'View newer posts');

  // Blog post
  l::set('pagination_post_next', 'Next &rarr;');
  l::set('pagination_post_next_title', 'View next post: {{ title }}');
  l::set('pagination_post_prev', '&larr; Previous');
  l::set('pagination_post_prev_title', 'View previous post: {{ title }}');

  // Portfolio piece
  l::set('pagination_piece_next', '{{ title }} &rarr;');
  l::set('pagination_piece_next_title', 'View {{ title }}');
  l::set('pagination_piece_prev', '&larr; {{ title }}');
  l::set('pagination_piece_prev_title', 'View {{ title }}');


  // Blog
  // ------------------------------
  l::set('blog_filtered_author', 'Viewing all posts by {{ param }}.');
  l::set('blog_filtered_date', 'Viewing all posts from {{ param }}.');
  l::set('blog_filtered_type', 'Viewing all {{ param }} posts.');
  l::set('blog_filtered_tag', 'Viewing posts tagged {{ param }}.');
  l::set('blog_no_posts_found', 'No posts found.');
  l::set('blog_remove_filter', '&times;');


  // Navigation
  // ------------------------------
  l::set('nav_primary_title', 'Primary Navigation');


  // Portfolio
  // ------------------------------
  l::set('portfolio_filtered_client', 'Viewing all pieces for {{ param }}.');
  l::set('portfolio_filtered_category', 'Viewing all {{ param }} pieces.');
  l::set('portfolio_filtered_role', 'Viewing all {{ param }} pieces.');
  l::set('portfolio_filtered_year', 'Viewing all pieces from {{ param }}.');
  l::set('portfolio_filtered_tag', 'Viewing pieces tagged {{ param }}.');
  l::set('portfolio_no_pieces_found', 'No portfolio pieces found.');
  l::set('portfolio_remove_filter', '&times;');


  // Portfolio piece
  // ------------------------------
  l::set('piece_meta_client', 'Client');
  l::set('piece_meta_category', 'Category');
  l::set('piece_meta_role', 'Role');
  l::set('piece_meta_year', 'Year');
  l::set('piece_meta_tags', 'Tags');
  l::set('piece_meta_tweet_title', 'Tweet');


  // Post
  // ------------------------------
  l::set('post_meta_avatar_alt', 'Avatar for {{ author_name }}');
  l::set('post_meta_author_title', 'View all posts by {{ author_name }}');
  l::set('post_meta_comments_title', 'View comments');
  l::set('post_meta_date_published_title', 'View all posts from {{ date }}');
  l::set('post_meta_permalink_title', 'Permalink');
  l::set('post_meta_tag_title', 'View all posts tagged {{ tag }}');
  l::set('post_meta_type_title', 'View all {{ type }} posts');
  l::set('post_meta_tweet_title', 'Tweet');


  // Post short
  // ------------------------------
  l::set('post_short_meta_avatar_alt', 'Avatar for {{ author_name }}');
  l::set('post_short_meta_author_title', 'View all posts by {{ author_name }}');
  l::set('post_short_meta_date_published_title', 'View all posts from {{ date }}');
  l::set('post_short_meta_permalink_title', 'View post');
  l::set('post_short_meta_tag_title', 'View all posts tagged {{ tag }}');
  l::set('post_short_meta_type_title', 'View all {{ type }} posts');