<?php if(!defined('KIRBY')) exit ?>

title: Portfolio - Piece
pages: false
files: true
fields:

  section_piece:
    label: Piece
    type: headline

  piece_images:
    label: Piece images
    type: checkboxes
    options: images

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

  overview:
    label: Overview
    type: text
    icon: font

  date_published:
    label: Publish date
    type: date
    icon: calendar
    required: true

  client:
    label: Client
    type: text
    icon: font
    width: 1/2

  category:
    label: Category
    type: text
    icon: font
    width: 1/2

  role:
    label: Role
    type: text
    icon: font
    width: 1/2

  year:
    label: Year
    type: text
    icon: font
    width: 1/2

  tags:
    label: Tags
    type: tags
    icon: tag
    lowercase: true
    required: false


  section_short_settings:
    label: Piece preview
    type: headline

  short_images:
    label: Piece preview images
    type: checkboxes
    options: images

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


  section_settings:
    label: General settings
    type: headline

  page_heading_visible:
    label: Piece heading
    type: checkbox
    icon: toggle-on
    text: Show piece heading
    default: true

  comments_enabled:
    label: Comments
    type: checkbox
    icon: toggle-on
    text: Enable comments
    default: false


  section_save:
    type: line