<?php if(!defined('KIRBY')) exit ?>

title: Link List - Item
pages: true
files: false
fields:

  title:
    label: Title
    type: text

  link_url:
    label: URL
    type: page

  link_target:
    label: Window
    type: checkbox
    text: Open in new window

  section_save:
    type: line