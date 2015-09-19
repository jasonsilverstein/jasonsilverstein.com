<div class="primary-header filtered-posts">
  <div class="page-intro">
    <div class="row">
      <div class="medium-6 columns">
        <?php
          if (param('by')):
            $param = 'by';
            $text = l('blog_filtered_author');
          elseif (param('from')):
            $param = 'from';
            $text = l('blog_filtered_date');
          elseif (param('type')):
            $param = 'type';
            $text = l('blog_filtered_type');
          elseif (param('tag')):
            $param = 'tag';
            $text = l('blog_filtered_tag');
          else:
            $param = '';
            $text = '';
          endif;

          if ($param == 'from'):
            $param = date("F jS, Y", strtotime(urldecode(param($param))));
          else:
            $param = urldecode(param($param));
          endif;

          $param = '<strong>'.$param.'</strong>';
          $text = str_replace('{{ param }}', $param, $text);
          $text = '<p>'.$text.'</p>';

          echo $text;
          ?>
      </div>
      <div class="reset medium-6 columns">
        <p class="return"><a href="<?php echo u() ?>"><?php echo l('blog_remove_filter') ?></a></p>
      </div>
    </div>
  </div>
</div>