<?php if ($inscription['NUM_REG'] > 1): ?>
<td><a id="folder-<?php echo $inscription['inscription_num'] ?>P" href="#"><img src="/images/plus.png"/></a></td>
<?php else: ?>
<td></td>	
<?php endif ?>
  
<td><?php echo $inscription['father_dni'] ?></td>  
<td><?php echo $inscription['father_name'] ?></td>
<td><?php echo $inscription['phones'] ?></td>
<td>
	<?php if ($inscription['NUM_REG'] == 1): ?>
		<?php echo $inscription['student_name'] ?>
	<?php endif ?>
</td>
<td>
    <?php if ($inscription['NUM_REG'] == 1 || $child): ?>
		<?php echo $inscription['inscription_code'] ?>
	<?php endif ?>
</td>
<td <?php if ($inscription['NUM_REG'] == 1 || $child): ?>title="<?php echo $inscription['week_title'] ?>"<?php endif ?>>
    <?php if ($inscription['NUM_REG'] == 1 || $child): ?>
		<?php echo $inscription['week_title_short'] ?>
	<?php endif ?>
</td>  
<td>
<?php if ($inscription['NUM_REG'] == 1): ?>
<?php 
	$options = array(InscriptionPeer::METHOD_PAYMENT_TRANSFER => __('Transferència'), InscriptionPeer::METHOD_PAYMENT_CASH => __('Efectiu'), InscriptionPeer::METHOD_PAYMENT_RECIBO => __('Rebut'), InscriptionPeer::METHOD_PAYMENT_TPV => __('Targeta bancària'));
	echo select_tag($inscription['id'] . '-payment', options_for_select($options, $inscription['method_payment'], array('include_blank' => false)), array('disabled' => 'disabled'));
?>
<?php endif ?>
</td>  
<td>
	<?php if ($inscription['NUM_REG'] == 1): ?>
	<span id="discount-<?php echo $inscription['id'] ?>"><?php echo $inscription['IMPORTE_DESCUENTO'] ?></span>
	<?php else: ?>
	<span id="discount-<?php echo $inscription['inscription_num'] ?>P"><?php echo $inscription['IMPORTE_DESCUENTO'] ?></span>
	<?php endif ?>
</td>
<td>
    <?php if ($inscription['NUM_REG'] == 1): ?>
        <input type="text" name="<?php echo $inscription['id'] ?>-discount-percent" value="<?php echo $inscription['IMPORTE_DESCUENTO_PORCENTAJE'] ?>" disabled/>
    <?php else: ?>
        <span id="discount-percent-<?php echo $inscription['inscription_num'] ?>P"></span>
    <?php endif ?>
</td>
<td>
	<?php if ($inscription['NUM_REG'] == 1): ?>
	<input type="text" name="<?php echo $inscription['id'] ?>-firstp" value="<?php echo $inscription['IMPORTE_PRIMER_PAGO'] ?>" disabled/>
	<?php else: ?>
	<span id="firstp-<?php echo $inscription['inscription_num'] ?>P"><?php echo $inscription['IMPORTE_PRIMER_PAGO'] ?></span>
	<?php endif ?>
</td> 
<td>
	<?php if ($inscription['NUM_REG'] == 1): ?>
	<input type="text" name="<?php echo $inscription['id'] ?>-secondp" value="<?php echo $inscription['IMPORTE_SEGUNDO_PAGO'] ?>" disabled/>
	<?php else: ?>
	<span id="secondp-<?php echo $inscription['inscription_num'] ?>P"><?php echo $inscription['IMPORTE_SEGUNDO_PAGO'] ?></span>
	<?php endif ?>
</td> 
<?php if ($child): ?>
<td id="<?php echo $inscription['id'] ?>-amount"><?php echo $inscription['IMPORTE_TOTAL_A_PAGAR'] ?></td>
<td id="<?php echo $inscription['id'] ?>-pamount" style="<?php echo $inscription['IMPORTE_TOTAL_PENDIENTE'] > 0 ? 'color:red' : ($inscription['IMPORTE_TOTAL_PENDIENTE'] == 0 ? 'color:green' : 'color:orange')?>"><?php echo $inscription['IMPORTE_TOTAL_PENDIENTE'] ?></td>
<?php else: ?>
<td id="amount-<?php echo $inscription['inscription_num'] ?>P" style="font-weight:bold"><?php echo $inscription['IMPORTE_TOTAL_A_PAGAR'] ?></td>
<td id="pamount-<?php echo $inscription['inscription_num'] ?>P" style="font-weight:bold;<?php echo $inscription['IMPORTE_TOTAL_PENDIENTE'] > 0 ? 'color:red' : 'color:green'?>"><?php echo $inscription['IMPORTE_TOTAL_PENDIENTE'] ?></td>
<?php endif ?>

<td>
    <?php if ($inscription['NUM_REG'] == 1): ?>
        <?php echo input_date_tag($inscription['id'] . '-paymentdate', $inscription['payment_date'], array('rich' => true, 'calendar_button_img' => '/sf/sf_admin/images/date.png', 'culture' => $sf_user->getCulture(), 'format' => 'd/MM/yyyy', 'disabled' => 'disabled')) ?>
    <?php endif ?>
</td>