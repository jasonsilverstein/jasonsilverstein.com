<?php if(!defined('KIRBY')) exit ?>

title: Page - Blog Archives
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