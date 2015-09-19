<?php if(!defined('KIRBY')) exit ?>

title: Portfolio
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
    label: Portfolio heading
    type: checkbox
    icon: toggle-on
    text: Show portfolio heading
    default: true