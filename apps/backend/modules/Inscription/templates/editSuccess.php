<?php
// auto-generated by sfPropelAdmin
// date: 2015/03/30 08:24:55
?>
<?php use_helper('Object', 'Validation', 'ObjectAdmin', 'I18N', 'Date') ?>

<?php use_stylesheet('/sf/sf_admin/css/main') ?>

<div id="sf_admin_container">

<h1><?php echo __('Editar inscripció', 
array()) ?></h1>

<div id="sf_admin_header">
<?php include_partial('Inscription/edit_header', array('inscription' => $inscription)) ?>
</div>

<div id="sf_admin_content">
<?php include_partial('Inscription/edit_messages', array('inscription' => $inscription, 'labels' => $labels)) ?>
<?php include_partial('Inscription/edit_form', array('inscription' => $inscription, 'labels' => $labels)) ?>
</div>

<div id="sf_admin_footer">
<?php include_partial('Inscription/edit_footer', array('inscription' => $inscription)) ?>
</div>

</div>

<?php use_javascript('jquery-1.11.2.min.js') ?>

<script type="text/javascript">

    $.noConflict();
    jQuery(document).ready(function($) {
        $('#inscription_student_course_inscription').on('change', function(e) {
            updateServices($('#inscription_student_course_inscription').val(), 2);
        });

        function updateServices(idCentre, type)
        {
            if (idCentre) {
                $.ajax({
                    url: '<?php echo url_for('Inscription/serviceSchedulesCourse'); ?>',
                    data: 'id=' + idCentre + '&type=' + type,
                    success: function(data) {
                        if (type == 1) {
                            if (data.length) {
                                var values = data.split('|');
                                $("#unassociated_inscription_service_schedule > option").toggle(true);
                                $("#unassociated_inscription_service_schedule > option").each(function () {
                                    if (values.indexOf($(this).attr('value')) == -1) {
                                        $(this).toggle(false);
                                    }
                                });

                                $("#associated_inscription_service_schedule > option").toggle(true);
                                $("#associated_inscription_service_schedule > option").each(function () {
                                    if (values.indexOf($(this).attr('value')) == -1) {
                                        $(this).toggle(false);
                                    }
                                });
                            }
                            else {
                                $("#unassociated_inscription_service_schedule > option").toggle(false);
                                $("#associated_inscription_service_schedule > option").toggle(false);
                            }
                        }
                        else {
                            if (data.length)
                            {
                                $("#associated_inscription_service_schedule > option").remove();
                                $("#unassociated_inscription_service_schedule").html(data);
                            }
                            else {
                                $("#unassociated_inscription_service_schedule > option").remove();
                                $("#associated_inscription_service_schedule > option").remove();
                            }
                        }
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }
        }

        updateServices($('#inscription_student_course_inscription').val(), 1);
    });


</script>
