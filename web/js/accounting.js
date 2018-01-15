jQuery(function($) {
	$('a[id^=folder-]').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('id').split("-").pop();
		var image = $(this).find(">:first-child");
		if (image.attr('src') == '/images/plus.png') {
			$('tr[id^=row-' + id + '-]').toggle(true);
			image.attr('src', '/images/minus.png');
		}
		else {
			$('tr[id^=row-' + id + '-]').toggle(false);
			image.attr('src', '/images/plus.png');
		}
	});
	$('a[id^=edit-]').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('id').split("-").pop();
		$('input[name^=' + id + '-]').removeAttr('disabled');
		$('select[name^=' + id + '-]').removeAttr('disabled');
		$('img[id^=trigger_' + id +']').toggle(true);
	});
	
	$('a[id^=save-]').click(function(e) 
	{
		e.preventDefault();
		var id = $(this).attr('id').split("-").pop();
		if ($('input[name=' + id + '-discount]').is(':disabled')) {
			return;
		}
		updateRecord(id);
	});

    $('a[id^=mark-paid-]').click(function(e)
    {
        e.preventDefault();

        if (confirm(markAsPaidQuestion)) {
            var id = $(this).attr('id').split("-").pop();
            updateRecord(id, true);
        }
    });

    $('td input[type=text]').not('.date').keydown(function(e)
	{
		// Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	});

    //$('img[id^=trigger]').toggle(false);
});


function updateRecord(id, markPaid)
{
    if (typeof myVariable === 'markPaid') { markPaid = false; }

	var data = 'id=' + id;
	data += '&discount-percent=' + jQuery('input[name=' + id + '-discount-percent]').val();
	data += '&beca=' + jQuery('input[name=' + id + '-beca]').val();
	data += '&firstp=' + jQuery('input[name=' + id + '-firstp]').val();
	data += '&secondp=' + jQuery('input[name=' + id + '-secondp]').val();
	data += '&payment=' + jQuery('select[name=' + id + '-payment]').val();
	data += '&paymentdate=' + jQuery('input[name=' + id + '-paymentdate]').val();

    if (markPaid) {
        data += '&markPaid=1';
    }

	jQuery.ajax({
        url: routeUpdate,
        data: data,
        success: function(data) {
        	console.log(data);
            data = JSON.parse(data);
            if (data.status == "OK") {
            	jQuery('input[name^=' + id + '-]').attr('disabled', 'disabled');
            	jQuery('select[name^=' + id + '-]').attr('disabled', 'disabled');
                jQuery('img[id^=trigger_' + id +']').toggle(false);
            	if (data.message.rows)
            	{
                    for (var i = 0; i < data.message.rows.length; i++)
                    {
                        var rowData = data.message.rows[i];
                        // Child
                        jQuery('#discount-' + rowData.id).text(rowData.discount);
                        jQuery('input[name=' + rowData.id + '-discount-percent]').val(rowData.discountPercent);
                        jQuery('input[name=' + rowData.id + '-beca]').val(rowData.beca);
                        jQuery('input[name=' + rowData.id + '-firstp]').val(rowData.firstp);
                        jQuery('input[name=' + rowData.id + '-secondp]').val(rowData.secondp);
                        jQuery('select[name=' + rowData.id + '-payment]').val(rowData.payment);
                        jQuery('#' + rowData.id + '-amount').text(rowData.amount);
                        jQuery('#' + rowData.id + '-pamount').text(rowData.pamount);
                        jQuery('input[name=' + rowData.id + '-paymentdate]').val(rowData.paymentdate);

                        if (rowData.pamount > 0) {
                            jQuery('#' + rowData.id + '-pamount').css('color', 'red');
                        }
                        else {
                            jQuery('#' + rowData.id + '-pamount').css('color', 'green');
                        }
                    }
            		
            		// Parent
            		jQuery('#discount-' + data.message.group.num + 'P').text(data.message.group.discount);
            		jQuery('#beca-' + data.message.group.num + 'P').text(data.message.group.beca);
            		jQuery('#firstp-' + data.message.group.num + 'P').text(data.message.group.firstp);
            		jQuery('#secondp-' + data.message.group.num + 'P').text(data.message.group.secondp);
            		jQuery('#amount-' + data.message.group.num + 'P').text(data.message.group.amount);
            		jQuery('#pamount-' + data.message.group.num + 'P').text(data.message.group.pamount);
            		
            		if (data.message.group.pamount > 0) {
            			jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'red');
            		}
            		else {
            			if (data.message.group.pamount == 0) {
            				jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'green');
            			}
            			else {
            				jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'orange');
            			}
            		}
            	}
            	else {
            		// Only child
            		jQuery('input[name=' + id + '-discount-percent]').val(data.message.group.discountPercent);
            		jQuery('#discount-' + id).text(data.message.group.discount);
            		jQuery('input[name=' + id + '-beca]').val(data.message.group.beca);
            		jQuery('input[name=' + id + '-firstp]').val(data.message.group.firstp);
            		jQuery('input[name=' + id + '-secondp]').val(data.message.group.secondp);
            		jQuery('input[name=' + id + '-paymentdate]').val(data.message.group.paymentdate);
            		jQuery('select[name=' + id + '-payment]').val(data.message.group.payment);
            		jQuery('#amount-' + data.message.group.num + 'P').text(data.message.group.amount);
            		jQuery('#pamount-' + data.message.group.num + 'P').text(data.message.group.pamount);
            		
            		if (data.message.group.pamount > 0) {
            			jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'red');
            		}
            		else {
            			if (data.message.group.pamount == 0) {
            				jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'green');
            			}
            			else {
            				jQuery('#pamount-' + data.message.group.num + 'P').css('color', 'orange');
            			}
            		}
            	}
            }
            else {
           	 
            }
		},
		error: function(data) {
			if (data.getStatus() == 401) {
				window.location = document.URL;
			}
  		    console.log(data);
	  	}
    });
}