<div class="dialog-options">
    <?php echo __('Seleccionar:') ?>
    <a id="select-all" href="#"><?php echo __('Todas') ?></a>&nbsp;|
    <a id="select-none" href="#"><?php echo __('Ninguna') ?></a>
</div>
<form id="form-send-confirmation" action="<?php echo url_for('Inscription/sendConfirmation') ?>" method="post">
    <table class="sf_admin_list">
        <thead>
            <tr>
                <th></th>
                <th><?php echo __('Codi inscripció') ?></th>
                <th><?php echo __('Alumne') ?></th>
                <th><?php echo __('Setmana') ?></th>
                <th><?php echo __('Provincia') ?></th>
                <th><?php echo __('Centro') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inscriptions as $inscription): ?>
                <tr>
                    <td style="width:20px"><input type="checkbox" name="ids[<?php echo $inscription->getId() ?>]" value="<?php echo $inscription->getId() ?>"></td>
                    <td><?php echo $inscription->getInscriptionCode() ?></td>
                    <td><?php echo $inscription->getFullStudentName() ?></td>
                    <td><?php echo $inscription->getCourse() ?></td>
                    <td><?php echo $inscription->getProvincia()->getNombre() ?></td>
                    <td><?php echo $inscription->getKidsAndUsCenter() ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</form>