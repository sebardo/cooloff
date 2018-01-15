<?php foreach ($inscriptions as $insc): ?>

	<?php if ($insc['inscription_num'] == $inscription['inscription_num']): ?>
	
		<tr id="row-<?php echo $insc['inscription_num'] ?>P-<?php echo $insc['id'] ?>" class="child-row" style="display:none;">
			<?php include_partial('list_td_tabular', array('inscription' => $insc, 'child' => true)) ?>
			<?php include_partial('list_td_actions', array('inscription' => $insc, 'child' => true)) ?>
		</tr>
	
	<?php endif ?>

<?php endforeach ?>