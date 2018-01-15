<div class="icon">
  <a href="<?php echo url_for($item['url']) ?>">    
    <?php echo image_tag($item['image'], array('alt' => __($item['name']))) ?>
    <span><?php echo __($item['name']) ?></span>
  </a>
</div>