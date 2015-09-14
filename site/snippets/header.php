<header id="app-header">
  <div class="inner">
    <div class="brand">
      <a href="<?php echo u() ?>">
      <?php
        if ($site->logo_type() == 'image'):
          if($image = $site->image($site->logo_image())):
            echo '<img src="'.$image->url().'" alt="'.$site->title()->html().'" />';
          endif;
        else:
          echo $site->logo_text();
        endif;
        ?>
      </a>
    </div>

    <div class="nav-wrap">
      <nav class="nav-primary nav-center nav-right-large">
        <h2 class="outline-title"><?php echo l('nav_primary_title') ?></h2>
        <p class="np-toggle"></p>
        <?php
          // linkList function in site/plugins/empyre-theme.php
          linkList($pages->find('nav-primary'), $pages, 1, 3)
          ?>
      </nav>
    </div>
  </div>
</header>