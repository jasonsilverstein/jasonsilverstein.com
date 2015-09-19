<?php
  if (!$post->gist_url()->empty()):
    echo gist($post->gist_url());
  elseif (!$post->inline_code()->empty()):
    echo '<pre><code class="language-'.$post->inline_code_language().'">'.$post->inline_code()->escape().'</code></pre>';
  endif;

  snippet('post-header', array('post' => $post));

  // getPostExcerpt function in site/plugins/empyre-theme.php
  echo getPostExcerpt($site, $post);