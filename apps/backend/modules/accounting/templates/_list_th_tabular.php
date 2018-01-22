<?php 

	$columns['father_dni'] = __('DNI');
	$columns['father_name'] = __('Nom Tutor');
	$columns['phones'] = __('Telèfons');
	$columns['student_name'] = __('Nom Alumne');
	$columns['inscription_code'] = __('Cód. inscripció');
	$columns['week'] = __('Setmana');
	$columns['method_payment'] = __('Mod. pagament');
	$columns['IMPORTE_DESCUENTO'] = __('Import descompte');
        $columns['IMPORTE_DESCUENTO_PORCENTAJE'] = __('Descompte (%)');
	$columns['IMPORTE_PRIMER_PAGO'] = __('Import 1er pag.');
	$columns['IMPORTE_SEGUNDO_PAGO'] = __('Import 2on pag.');
	$columns['IMPORTE_TOTAL_A_PAGAR'] = __('Import total');
	$columns['IMPORTE_TOTAL_PENDIENTE'] = __('Import pendent');
	$columns['payment_date'] = __('payment_date');
        $columns['payment_date_second'] = __('payment_date_second');

?>
<th></th>
<?php foreach ($columns as $key => $value): ?>

<th>
    <?php if ($sf_user->getAttribute('sort', null, 'sf_admin/accounting/sort') == $key): ?>
      <?php echo link_to($value, 'accounting/list?sort=' . $key . '&type='.($sf_user->getAttribute('type', 'asc', 'sf_admin/accounting/sort') == 'asc' ? 'desc' : 'asc')) ?>
      (<?php echo __($sf_user->getAttribute('type', 'asc', 'sf_admin/accounting/sort')) ?>)
    <?php else: ?>
      <?php echo link_to($value, 'accounting/list?sort=' . $key . '&type=asc') ?>
    <?php endif; ?>
</th>

<?php endforeach ?>

<th><?php echo __('Actions') ?></th>