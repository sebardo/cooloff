<div id="container-centers">
    <div class="content-centers">
        <h2><?php echo __('On som'); ?></h2>
        <?php if($_SERVER['REQUEST_URI']=="/centres-fr"):?>
			<ul class="centers-list">     
            	<?php if ($zoneFR->getTitle() != ""): ?>         
	                <li>
	                    <span><?php echo $zoneFR->getTitle(); ?></span>
	                    <?php $centers = $zoneFR->getCentersWithI18n(); ?>
	                    <?php if ($centers): ?>
	                        <?php $num_centers =  count($centers); ?>
	                        <?php $cont2 = 1; ?>
	                        <ul>
	                            <?php foreach ($centers as $center): ?>                                
	                            	<?php if($center->getTitle() != ""): ?>
		                                <li<?php echo $num_centers == $cont2 ? ' class="last"':""; ?>>
		                                	<?php echo image_tag('summer_fun/icons/pointer.png'); ?> <?php echo link_to_i18n($center->getTitle(), '@center?stripped_center=' . ThairaProjectTools::createStrippedName($center->getTitle()) . '&id=' . $center->getId(), array('title' => $center->getTitle())); ?>
		                                </li>
		                            <?php endif; ?>
	                                <?php $cont2++; ?>
	                            <?php endforeach; ?>
	                        </ul>
	                    <?php endif; ?>
	                </li>
            	<?php endif; ?>
			</ul>
		<?php else: ?>
        <ul class="centers-list">            
            <?php foreach ($zones as $zone): ?>      
            	<?php if (($zone->getTitle() != "") && ($zone->getId() != 30)): ?>         
	                <li>
	                    <span><?php echo $zone->getTitle(); ?></span>
	                    <?php $centers = $zone->getCentersWithI18n(); ?>
	                    <?php if ($centers): ?>
	                        <?php $num_centers =  count($centers); ?>
	                        <?php $cont2 = 1; ?>
	                        <ul>
	                            <?php foreach ($centers as $center): ?>                                
	                            	<?php if($center->getTitle() != ""): ?>
		                                <li<?php echo $num_centers == $cont2 ? ' class="last"':""; ?>>
		                                	<?php echo image_tag('summer_fun/icons/pointer.png'); ?> <?php echo link_to_i18n($center->getTitle(), '@center?stripped_center=' . ThairaProjectTools::createStrippedName($center->getTitle()) . '&id=' . $center->getId(), array('title' => $center->getTitle())); ?>
		                                </li>
		                            <?php endif; ?>
	                                <?php $cont2++; ?>
	                            <?php endforeach; ?>
	                        </ul>
	                    <?php endif; ?>
	                </li>
            	<?php endif; ?>
            <?php endforeach; ?>
        </ul>
		<?php endif;?>
        <br class="clear" />
    </div>
</div>    
<script type="text/javascript">
<!--
jQuery(function($) {
	$('#container-centers .centers-list > li:not(:has(li))').remove();	
	$('#container-centers .centers-list > li:odd').addClass('even');
});
// -->
</script>