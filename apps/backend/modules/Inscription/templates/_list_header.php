<?php
// auto-generated by sfPropelAdmin
// date: 2014/04/29 12:55:10
?>
<div class="sf_admin_filters">
	<ul class="sf_admin_actions">
    	<li><?php echo button_to(__('Descarregar Fotos'), 'Inscription/exportPicture', 'class=sf_admin_action_zip') ?></li>
    	<li><input type="button" value="<?php echo __('Exportar') ?>" class="sf_admin_action_export" id="export"></li>
    	<li>
    		<a href="<?php echo url_for('Inscription/pdfFicha') ?>" target="_blank" class="abtn">
    		<img src="/sfAdminDashPlugin/images/icon_pdf.gif" title="Generar Pdf" alt="Generar Pdf">
    		<?php echo __('Generar fichas') ?>
    		</a>
    	</li>
		<li style="margin-left: 5px">
			<a id="send-confirmation-email" href="<?php echo url_for('Inscription/listConfirmationSending') ?>" class="abtn send-confirmation">
				<img src="/sfAdminDashPlugin/images/icon_pdf.gif" title="Generar Pdf" alt="Generar Pdf">
				<?php echo __('Envío resguardos') ?>
			</a>
		</li>
  	</ul>
</div>