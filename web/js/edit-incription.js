jQuery(function($) {
	$('#rotate-image').click(function(e) {
		e.preventDefault();
		var id = $('input[name=id]').val();
		var data = "id=" + id + "&degrees=90";
		
		$.ajax({
	        url: rotateUrl,
	        data: data,
	        success: function(data) {
	        	data = JSON.parse(data);
	            if (data.status == "OK") {
	            	$('#image-student').attr('src', data.image);
	            }
			},
			error: function(data) {
				if (data.getStatus() == 401) {
					window.location = document.URL;
				}
	  		    console.log(data);
		  	}
	    });
	});
	
	$('#upload-image').click(function(e) {
        e.preventDefault();
		$('#studentPhoto').trigger('click');
    });
	
	$('#studentPhoto').change(function(e) {
    	$('#form-photo').ajaxSubmit({
            beforeSend: function() {
            	//$('#profile-image-error' + $('#studentId').val()).text('<?php echo __('Espere, si us plau') ?>...');
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status == "OK") {
                	$('#image-student').attr('src', data.message);
                }
                else {
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
});