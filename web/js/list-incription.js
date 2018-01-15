var generating = false;
jQuery(function($) {
	$('#export').click(function(e) {
		e.preventDefault();
		jQuery( "#dialog" ).dialog({
		     height: 500,
		     width: 500,
		     modal: true,
		     buttons: {
		         "Exportar": function() {
		        	 var numColumns = jQuery('#form-export input:checkbox:checked').length;
		        	 if (numColumns == 0) {
		        		 alert(minNumColumns);
		        		 return;
		        	 }
		        	 var filename = jQuery('input[name=filename]').val();
		        	 if (!jQuery.trim(filename)) {
		        		 alert(selectFileName);
		        		 return;
		        	 }
		        	 jQuery(this).dialog("close");
		        	 jQuery('#form-export').submit();
		         }
		      }
		});
	});
	$('#export-all').click(function(e) {
		e.preventDefault();
		jQuery('#form-export input[type=checkbox]').prop('checked', true);
	});
	$('#export-none').click(function(e) {
		e.preventDefault();
		jQuery('#form-export input[type=checkbox]').prop('checked', false);
	});

    $('#filters_centers').change(function(e) {
        var centroId = $(this).val();
        updateFilters(centroId);
    });

    updateFilters($('#filters_centers').val());

    $('#send-confirmation-email').click(function(e) {
        e.preventDefault();
        $('#dialog-mailing').html('<p class="loading">' + loadingWait + '</p>');
        var dialog = jQuery( "#dialog-mailing" ).dialog({
            height: 600,
            width: '95%',
            modal: true,
            buttons: {
                "Enviar": function() {

                    if (!generating) {

                        var numColumns = jQuery('#form-send-confirmation input:checkbox:checked').length;
                        if (numColumns == 0) {
                            alert(minNumColumns);
                            return;
                        }

                        jQuery('#form-send-confirmation').ajaxSubmit({
                            beforeSend: function () {
                                generating = true;
                                if (jQuery('.ui-dialog-buttonset').find('p').length == 0) {
                                    jQuery('.ui-dialog-buttonset').append('<p style="float: left; margin: 13px 10px">' + sendingWait + '</p>');
                                }
                                else {
                                    jQuery('.ui-dialog-buttonset').find('p').text(sendingWait);
                                }
                            },
                            success: function (data) {
                                generating = false;
                                jQuery(dialog).dialog("close");
                                data = JSON.parse(data);
                                if (data.status == "OK") {
                                    alert(data.emails_sent + ' ' + sentOk);
                                }
                                else {
                                    alert('Error: ' + data.message);
                                }
                            },
                            error: function (data) {
                                generating = false;
                                jQuery(dialog).dialog("close");
                                alert('An error happened');
                            }
                        });

                    }
                }
            }
        });

        jQuery.ajax({
            url: $(this).attr('href'),
            success: function(data) {
                $('#dialog-mailing').html(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    jQuery(document).on('click', '#select-all', function(e) {
        e.preventDefault();
        jQuery('#form-send-confirmation input[type=checkbox]').prop('checked', true);
    });

    jQuery(document).on('click', '#select-none', function(e) {
        e.preventDefault();
        jQuery('#form-send-confirmation input[type=checkbox]').prop('checked', false);
    });

});

function updateFilters(centroId)
{
    if (centroId) {
        $("#filters_grupo_id > option").each(function () {
            if ($(this).attr('value') != '') {
                if (centroId == $(this).attr('data-centro')) {
                    $(this).toggle(true);
                }
                else {
                    $(this).toggle(false);
                }
            }
        });

        $("#filters_profesor_id > option").each(function () {
            if ($(this).attr('value') != '') {
                if (centroId == $(this).attr('data-centro')) {
                    $(this).toggle(true);
                }
                else {
                    $(this).toggle(false);
                }
            }
        });

        $("#filters_week > option").each(function () {
            if ($(this).attr('value') != '') {
                if (centroId == $(this).attr('data-centro')) {
                    $(this).toggle(true);
                }
                else {
                    $(this).toggle(false);
                }
            }
        });
    }
    else {
        $("#filters_grupo_id > option").toggle(true);
        $("#filters_profesor_id > option").toggle(true);
    }
}
