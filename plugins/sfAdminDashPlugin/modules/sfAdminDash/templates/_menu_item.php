<a href="<?php echo url_for($item['url']) ?>">
  <?php if (sfAdminDash::getProperty('resize_mode') == 'html'): ?>
    <?php echo image_tag($item['image'], array('alt' => __($item['name']), 'width' => '16', 'height' => '16')) ?>
  <?php else: ?>
    <?php echo image_tag($item['image'], array('alt' => __($item['name']))) ?>
  <?php endif; ?>
  <span><?php echo __($item['name']) ?></span>
</a>