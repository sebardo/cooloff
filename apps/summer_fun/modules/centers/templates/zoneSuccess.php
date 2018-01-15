<div id="container-centers">
    <div class="content-centers">
        
        <div class="center-wrapper">
            <div class="info">
                <h2><?php echo $center->getTitle(); ?></h2>
        
                <div class="description">
                    <?php echo $center->getDescription(); ?>
                </div>
                <?php $news = SummerFunCenterNewsItemPeer::doSelectWithI18nByZoneId($center->getId());?>
                <?php if($news):?>
                    <h3>Blog</h3>
                    
                    <?php foreach ($news as $newsItem): ?>
                        <div class="new">
                            <h4><?php echo link_to_i18n($newsItem->getTitle(),  '@centers_zone_news_item?id=' . $newsItem->getId()); ?></h4>
                                <?php
                                $images = $newsItem->getFiles('images');
                                $image = array_shift($images);
                                if ($image) {
                                    echo image_link( $image->getThumbWebPath(215, 160, true), '@centers_zone_news_item?id=' . $newsItem->getId(),
                                            array('alt' => $image->getTitle(), 'width' => 215));
                                }
                                ?>
                                <?php /*
                                <ul>
                                    <?php foreach ($images as $image): ?>
                                        <li><?php echo image_link($image->getThumbWebPath(50,50, true), '@centers_zone_news_item?id=' . $newsItem->getId(),
                                                array('alt' => $image->getTitle())); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                */?>
                                <?php
                                $p = new myParagraphsChopper($newsItem->getDescription());
                                echo $p->getParagraphsAsHtml(1);
                                if ($p->getParagraphsCount() > 1) {
                                    echo link_to_i18n(__('Llegir més'), '@centers_zone_news_item?id=' . $newsItem->getId(), array('class' => 'more'));
                                }
                                ?>
                            <br class="clear" />
                        </div>
                    <?php endforeach; ?>
                
                <?php endif; ?>
                
                <div class="content-back">
                    <?php echo link_to_i18n(__('Tornar'), '@centers', array('title' => __("Tornar"))); ?>
                </div>
            </div>
            
            <div class="docs">
                <?php if($center->getFiles('docs_' . $sf_user->getCulture())): ?>
                    <h3><?php echo __("Documents"); ?></h3>
                    <?php $docs = $center->getFiles('docs_' . $sf_user->getCulture()); ?>
                    <ul>
                        <?php $cont = 1; ?>
                        <?php foreach ($docs as $doc): ?>
                            <li>
                            	<?php if ($doc->getIsProtected() == true): ?>
                            		<?php echo link_to_i18n($doc->getTitle(), '@center_password?stripped_center=' . ThairaProjectTools::createStrippedName($center->getTitle()) . '&id=' . $doc->getId(), array('title' => $doc->getTitle(), 'class' => 'doc-button'.$cont, 'target' => '_blank')); ?>
                            	<?php else: ?>
                            		<a href="<?php echo $doc->getWebPath(); ?>" target="_blank" class="doc-button<?php echo $cont;?>"><?php echo $doc->getTitle(); ?></a>
                            	<?php endif; ?>
                            </li>
                            <?php $cont++; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
            <br class="clear" />
        </div>
    </div>
</div>