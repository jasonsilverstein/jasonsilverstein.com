<?php if(!defined('KIRBY')) exit ?>

title: Blog Index
pages: true
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

  intro_text:
    label: Introduction text
    type: textarea
    icon: font

  page_heading_visible:
    label: Blog heading
    type: checkbox
    icon: toggle-on
    text: Show blog heading
    default: true