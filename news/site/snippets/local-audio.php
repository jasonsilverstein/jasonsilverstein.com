<?php
  $audioPath = pathinfo($page->file($page->audio_file()->value())->url());
  $audioPath = $audioPath['dirname'] . DS . $audioPath['filename'];
  ?>

<audio preload="auto" controls>
  <source src="<?php echo $audioPath ?>.mp3" type="audio/mp3">
  <source src="<?php echo $audioPath ?>.ogg" type="audio/ogg">
  <source src="<?php echo $audioPath ?>.wav" type="audio/wav">
  <?php echo l('audio_not_supported') ?>
</audio>