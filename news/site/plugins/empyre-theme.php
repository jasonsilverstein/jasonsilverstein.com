<?php

  /*
   * linkList
   *
   * Builds a nested navigation structure from a parent page
   *
   * @page (object) Kirby page object to build navigation from
   * @pages (object) Kirby pages object
   * @level (int) Current level of nesting
   * @maxLevels (int) Maximum number of nesting levels
   * @return (array)
   */
  function linkList($page, $pages, $level, $maxLevels) {
    $renderLevel = $level != $maxLevels + 1 || $maxLevels == 0;

    if ($page && $renderLevel):
      $children = $page->children()->visible();

      if ($children):
        echo '<ul>';
        foreach ($children as $item):
          $itemChildren = $item->children()->visible();
          $hasChildren = $itemChildren && $itemChildren->count();
          $itemClass = ($hasChildren && $level != $maxLevels) ? 'np-node' : '';
          $itemData = '';
          $itemTitle = $item->title();
          $itemURL = $item->link_url();
          $itemTarget = $item->link_target();
          $linkedPage = $pages->findByURI($item->link_url());

          if ($linkedPage):
            $itemURL = $linkedPage->url();

            if ($linkedPage->isOpen()):
              $itemClass .= ' np-active';
            endif;
          endif;

          if ($itemTarget->bool()):
           $itemData .= 'data-target-new';
          endif;

          echo '<li class="'.$itemClass.'">';
          echo '<a href="'.$itemURL.'" '.$itemData.'>'.$itemTitle.'</a>';

          if ($hasChildren):
            linkList($item, $pages, $level + 1, $maxLevels);
          endif;

          echo '</li>';
        endforeach;
        echo '</ul>';
      endif;
    endif;
  };


  /*
   * getMeta
   *
   * Sets the meta data for the current page
   *
   * @site (object) Kirby site object
   * @page (object) Kirby page object
   * @return (array)
   */
  function getMeta($site, $page){
    $meta = array();

    // Base
    if ($page->isHomePage()):
      $meta['title'] = $site->title();
    else:
      $meta['title'] = ($page->meta_title()->empty() ? $page->title()->html() : $page->meta_title()->html()).' | '.$site->site_name()->html();
    endif;

    $meta['description'] = $site->description()->html()->value();
    $meta['keywords'] = $site->keywords()->html()->value();

    // OG
    $meta['og']['site_name'] = $site->site_name()->html()->value();
    $meta['og']['title'] = $meta['title'];
    $meta['og']['description'] = $meta['description'];
    $meta['og']['type'] = 'website';

    // Set OG type to article for posts
    if (strpos($page->template(), 'post') === 0):
      $meta['og']['type'] = 'article';
    endif;

    // Set template specific OG data
    switch ($page->template()):

      // Post - Audio
      case 'post-audio':
        $meta['og']['audio'] = $page->file($page->audio_file()->value())->url();
        break;

      // Post - Gallery
      case 'post-gallery':
        if (!$page->gallery_images()->empty()):
          $images = $page->gallery_images()->split();
          foreach ($images as $image):
            $meta['og']['images'][] = $page->file($image)->url();
          endforeach;
        endif;
        break;

      // Post - Video
      case 'post-video':
        $meta['og']['video'] = $page->video_url()->value();
        break;

      // Portfolio piece
      case 'piece':
        $meta['og']['type'] = 'article';
        if (!$page->piece_images()->empty()):
          $images = $page->piece_images()->split();
          foreach ($images as $image):
            $meta['og']['images'][] = $page->file($image)->url();
          endforeach;
        endif;
        break;

      default:
        break;
    endswitch;


    return $meta;
  }


  /*
   * getPostAuthorName
   *
   * Sets the display name of an author based on settings
   *
   * @site (object) Kirby site object
   * @post (object) Kirby page object
   * @return (string)
   */
  function getPostAuthorName($site, $post){
    $author = $post->author_username();
    $author = $site->user($author);

    switch ($site->blog_author_name_display_style()):
      case 'full_name':
        $name = $author->firstname().' '.$author->lastname();
        break;
      case 'first_name':
        $name = $author->firstname();
        break;
      default:
        $name = $author->username();
        break;
    endswitch;

    return $name;
  }


  /*
   * getPostExcerpt
   *
   * Creates the excerpt for the main text section of a post
   *
   * @site (object) Kirby site object
   * @post (object) Kirby page object
   * @return (string)
   */
  function getPostExcerpt($site, $post) {
    switch($post->excerpt_type()):
      case 'full':
        $excerpt = $post->text()->kirbytext();
        break;
      case 'custom':
        $excerpt = $post->custom_excerpt()->kirbytext();
        break;
      default:
        $text = $post->text()->kirbytext();
        $len = intval($site->blog_auto_excerpt_length()->value());
        $words = explode(' ', $text);
        $excerpt = implode(' ', array_slice($words, 0, $len));
        if ($len < count($words)):
          $excerpt .= ' [&hellip;]';
        endif;
    endswitch;

    $excerpt = '<div class="excerpt">'.$excerpt.'</div>';

    return $excerpt;
  }


  /*
   * getPostType
   *
   * Gets a post type from its template
   *
   * @post (object) Kirby page object
   * @return (string)
   */
  function getPostType($post){
    if (strpos($post->template(), '-') !== false):
      $postType = explode('-', $post->template())[1];
    else:
      $postType = 'text';
    endif;

    return $postType;
  }


  /*
   * orderByDateAscending
   *
   * Orders items ascending chronologically (for uasort functions)
   *
   * @a (string) first date for comparison
   * @b (string) second date for comparison
   * @return (string)
   */
  function orderByDateAscending ($a, $b){
    return strtotime($a['date']) - strtotime($b['date']);
  }


  /*
   * orderByDateDescending
   *
   * Orders items descending chronologically (for uasort functions)
   *
   * @a (string) first date for comparison
   * @b (string) second date for comparison
   * @return (string)
   */
  function orderByDateDescending ($a, $b){
    return strtotime($b['date']) - strtotime($a['date']);
  }


  /*
   * setIcon
   *
   * Sets FontAwesome icon classes
   *
   * @i (string) the string to be converted to an icon class
   * @return (string)
   */
  function setIcon($i){
    switch ($i):
      case 'text':
        echo 'font';
        break;
      case 'quote':
        echo 'quote-left';
        break;
      case 'link':
        echo 'external-link';
        break;
      case 'code':
        echo 'code';
        break;
      case 'gallery':
        echo 'picture-o';
        break;
      case 'audio':
        echo 'volume-up';
        break;
      case 'video':
        echo 'youtube-play';
        break;
      default:
        echo $i;
    endswitch;
  }


  /*
   * toPrettyURL
   *
   * Converts strings to pretty URL formats
   *
   * @string (string) the string to be formatted
   * @return (string)
   */
  function toPrettyURL($string){
    return preg_replace(array('/[^a-zA-Z0-9 \t-]/', '/[ \t]/', '/-+/', '/^-/', '/-$/'), array('', '-', '-', '', ''), strtolower($string));
  }