<?php if(!defined('KIRBY')) exit ?>

title: Default Page
pages: true
files: true
fields:

  section_seo:
    label: SEO
    type: headline

  title:
    label: Title
    type: text

  description:
    label: Description
    type: textarea
    icon: font
    buttons: false

  keywords:
    label: Keywords
    type: tags
    icon: tag

  section_settings:
    label: General
    type: headline

  site_name:
    label: Site name
    type: text
    icon: font

  copyright:
    label: Copyright
    type: text
    icon: font


  section_design:
    label: Design
    type: headline

  logo_type:
    label: Logo type
    type: select
    options:
      text: Text
      image: Image
    default: text

  logo_image:
    label: Logo image
    type: select
    options: images

  logo_text:
    label: Logo text
    type: text
    icon: font

  design_primary_color:
    label: Primary color
    type: color
    icon: tint


  section_accounts:
    label: Accounts
    type: headline

  disqus_shortname:
    label: Disqus shortname
    type: text
    icon: key
    placeholder: e.g. empyre

  google_analytics_id:
    label: Google analytics ID
    type: text
    icon: key
    placeholder: e.g. UA-52956228-1


  section_blog:
    label: Blog
    type: headline

  blog_sort_order:
    label: Post sort order
    type: select
    icon: sort-amount-desc
    options:
      chronological: Publish date (ascending)
      reverse_chronological: Publish date (descending)
      alphabetical: Alphabetical (ascending)
      reverse_alphabetical: Alphabetical (descending)
      manual: Manual
    default: reverse_chronological

  blog_posts_per_page:
    label: Posts per page
    type: number
    icon: ellipsis-h

  blog_auto_excerpt_length:
    label: Auto excerpt length
    type: number
    default: 400
    icon: ellipsis-h

  blog_author_name_display_style:
    label: Author name display style
    type: select
    options:
      full_name: Full name
      first_name: First name only
      username: Username
    default: full_name

  blog_author_avatar_display_style:
    label: Author avatar display style
    type: select
    options:
      profile: User profile image
      gravatar: Gravatar
    default: profile

  blog_post_short_meta:
    label: Post meta display
    type: checkboxes
    options:
      author_avatar: Author avatar
      author_name: Author name
      date_published: Publish date
      comment_count: Comment count
      tags: Tags
      icons: Icons


  section_post:
    label: Blog Post
    type: headline

  blog_post_display_nav:
    label: Post navigation
    type: checkbox
    icon: toggle-on
    text: Display previous/next post links
    default: true

  blog_post_meta:
    label: Post meta display
    type: checkboxes
    options:
      author_avatar: Author avatar
      author_name: Author name
      date_published: Publish date
      comment_count: Comment count
      tags: Tags
      icons: Icons


  section_portfolio:
    label: Portfolio
    type: headline

  portfolio_pieces_per_page:
    label: Pieces per page
    type: number
    icon: ellipsis-h

  portfolio_sort_order:
    label: Piece sort order
    type: select
    icon: sort-amount-desc
    options:
      chronological: Publish date (ascending)
      reverse_chronological: Publish date (descending)
      alphabetical: Alphabetical (ascending)
      reverse_alphabetical: Alphabetical (descending)
      manual: Manual
    default: reverse_chronological


  section_piece:
    label: Portfolio piece
    type: headline

  portfolio_piece_display_nav:
    label: Piece navigation
    type: checkbox
    icon: toggle-on
    text: Display previous/next post links
    default: true


  section_custom_html:
    label: Custom HTML
    type: headline

  custom_html_header:
    label: Inside head tag
    type: textarea
    icon: code
    buttons: false

  custom_html_footer:
    label: Before closing body tag
    type: textarea
    icon: code
    buttons: false

  line_empyre:
    type: line

  info:
    type: info
    text: >

      ![Empyre logo](http://c.empy.re/image/260225063h1X/empyre-email-signature.png)


      Manila 1.1.0 was meticulously handcrafted by <a href="http://empy.re" target="_blank">Empyre</a>

      For theme information and support, please visit <a href="http://empy.re/support" target="_blank">empy.re/support</a>


  line_hidden:
    type: line

  theme:
    type: hidden

  version:
    type: hidden

  author:
    type: hidden

  author_url:
    type: hidden