<?php if(!defined('KIRBY')) exit ?>

title: Post - Gallery
pages: false
files: true
fields:

  section_post_type:
    label: Gallery
    type: headline

  gallery_images:
    label: Show images
    type: checkboxes
    options: images

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


  section_short_settings:
    label: Post preview
    type: headline

  short_images_limit:
    label: Number of images to show
    type: number
    icon: ellipsis-h
    default: 1

  short_images_per_row_medium:
    label: Images per row on medium screens
    type: number
    icon: ellipsis-h
    default: 1
    width: 1/2

  short_images_per_row_large:
    label: Images per row on large screens
    type: number
    icon: ellipsis-h
    default: 1
    width: 1/2


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