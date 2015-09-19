<?php if(!defined('KIRBY')) exit ?>

title: Post - Quote
pages: false
files: true
fields:

  section_post_type:
    label: Quote
    type: headline

  quote:
    label: Text
    type: textarea
    icon: quote-left

  cite:
    label: Author
    type: text
    icon: user


  section_post:
    label: Post
    type: headline

  title:
    label: Title
    type: text

  meta_title:
    label: Meta title
    type: text
    icon: font
    placeholder: Defaults to title

  text:
    label: Text
    type: textarea
    icon: font

  tags:
    label: Tags
    type: tags
    icon: tag
    lowercase: true
    required: false

  date_published:
    label: Publish date
    type: date
    icon: calendar
    required: true
    width: 1/2

  author_username:
    label: Author
    type: user
    required: true
    width: 1/2


  section_blog_index_settings:
    label: Post preview settings
    type: headline

  excerpt_type:
    label: Excerpt type
    type: select
    options:
      auto: Auto
      full: Full
      custom: Custom
    default: auto

  custom_excerpt:
    label: Custom excerpt
    type: textarea
    icon: font


  section_settings:
    label: General settings
    type: headline

  page_heading_visible:
    label: Post heading
    type: checkbox
    icon: toggle-on
    text: Show post heading
    default: true

  comments_enabled:
    label: Comments
    type: checkbox
    icon: toggle-on
    text: Enable comments
    default: false


  section_save:
    type: line