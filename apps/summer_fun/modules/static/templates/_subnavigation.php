<?php
$classParty = $classGames = $classTheater = "";
$action = $sf_params->get('action');

switch ($action)
{
    case 'partyTime':
        $classParty = "active";
        break;
    
    case 'games':
        $classGames = "active";
        break;
    
    case 'theater':
        $classTheater = "active";
        break;
}
?>
<ul class="subnavigation">
    <li class="subnav1"><?php echo link_to_i18n(__("Contes i cançons:[1]Party Time!", array('[1]' => '<br />')), '@party_time', array('title' => __("Contes i cançons: Party Time!"), 'class' => "$classParty")); ?></li>
    <li class="subnav2"><?php echo link_to_i18n(__("Jocs i manualitats"), '@games', array('title' => __("Jocs i manualitats"), 'class' => "$classGames")); ?></li>
    <li class="subnav3"><?php echo link_to_i18n(__("Dinar i excursions"), '@theater', array('title' => __("Dinar i excursions"), 'class' => "$classTheater")); ?></li>
</ul>