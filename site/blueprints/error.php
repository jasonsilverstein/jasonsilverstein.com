<?php if(!defined('KIRBY')) exit ?>

title: Page - Error
pages: false
files: false
fields:

  title:
    label: Title
    type: text

  meta_title:
    label: Meta title
    type: text
    icon: font
    placeholder: Defaults to title

  text_heading:
    label: Text heading
    type: text
    icon: font

  text:
    label: Text
    type: textarea
    icon: font

  page_heading_visible:
    label: Page heading
    type: checkbox
    icon: toggle-on
    text: Show page heading
    default: true