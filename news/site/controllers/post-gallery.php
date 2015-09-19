<?php

return function($site, $pages, $page) {

  $images = [];

  // Build visible images array
  if ($page->hasImages()):
    foreach($page->images() as $image):
      if (in_array($image->filename(), $page->gallery_images()->split())):
        array_push($images, $image);
      endif;
    endforeach;
  endif;

  // Pass objects to the template
  return compact('images');

};