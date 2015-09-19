<div class="primary-header filtered-posts">
  <div class="page-intro">
    <div class="row">
      <div class="medium-6 columns">
        <?php
          if (param('client')):
            $param = 'client';
            $text = l('portfolio_filtered_client');
          elseif (param('category')):
            $param = 'category';
            $text = l('portfolio_filtered_category');
          elseif (param('role')):
            $param = 'role';
            $text = l('portfolio_filtered_role');
          elseif (param('year')):
            $param = 'year';
            $text = l('portfolio_filtered_year');
          elseif (param('tag')):
            $param = 'tag';
            $text = l('portfolio_filtered_tag');
          else:
            $param = '';
            $text = '';
          endif;

          $param = urldecode(param($param));
          $param = '<strong>'.$param.'</strong>';
          $text = str_replace('{{ param }}', $param, $text);
          $text = '<p>'.$text.'</p>';

          echo $text;
          ?>
      </div>
      <div class="reset medium-6 columns">
        <p class="return"><a href="<?php echo u().'/portfolio' ?>"><?php echo l('portfolio_remove_filter') ?></a></p>
      </div>
    </div>
  </div>
</div>