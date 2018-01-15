<div id="container-centers">
    <div class="content-centers">
                
        <h2><?php echo $newsItem->getTitle(); ?></h2>
        
        <div class="center-news-wrapper">
            <div class="info">
                <?php echo $newsItem->getDescription(); ?>
            </div>
            <div class="images">
                <?php
                $images = $newsItem->getFiles('images');
                $image = array_shift($images);
                $main_image = $image->getThumbWebPath(300, 3000);
                if ($image) {?>
                   <a href="<?php echo $image->getWebPath() ?>"
                               rel="prettyPhoto[pp_gal]">
                    <?php echo image_tag($main_image, array('alt' => '', 'width' => 300)); ?>
                    </a>
                <?php 
                }
                ?>
                <ul>
                    <?php foreach ($images as $image): ?>
                        <li>
                            <a href="<?php echo  $image->getWebPath() ?>"
                               rel="prettyPhoto[pp_gal]">
                                    <?php echo image_tag( $image->getThumbWebPath(70, 70, true), array('alt' => '', 'width' => 70)); ?>
                            
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <br class="clear" />
        </div>
        <?php
        $center = SummerFunCenterPeer::retrieveByPKWithI18n($newsItem->getSummerFunCenterId());
        ?>
        <div class="content-back">        	
            <?php echo link_to_i18n('Tornar', '@center?stripped_center=' . ThairaProjectTools::createStrippedName($center->getTitle()) . '&id=' . $newsItem->getSummerFunCenterId(), array('title' => __("Tornar"))); ?>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto();
});
</script>