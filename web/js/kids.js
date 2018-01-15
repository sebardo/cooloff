var elementInit = new Array();

function initBanner(culture) {
	elementInit.push( function() {
		var banner = new SWFObject(sfRelativeUrlRoot
				+ "/swf/banner.swf?idioma=" + culture, "mymovie", "585", "338", "8");
		banner.addParam("wmode", "transparent");
		banner.write("flash-home");
	});
}

function initCorners() {
	elementInit.push(function() {
		$('div.rcorner').rcorner({
		bgImageLocation: '/images/transparent.gif',
		bgImageWidth: '41px',
		bgImageHeight: '41px'
		});
	});
}

function initScrolls(scrollVar, box) {
	elementInit.push(function() {

		$("#scrollDown").click(function(){
		  		  	  	
		  	divHeight = $(box).height();
			divMargin = $(box).css('marginTop');				
			margeTop = parseInt(divMargin) - parseInt(scrollVar);
		  	
			limit = divHeight * parseInt(-1);
		  
		  	if((parseInt(divMargin.replace(/px/, "")) > limit) && (divHeight > scrollVar)){
	      		$(box).animate({  
	        		marginTop: margeTop + "px"
	      		}, 500);
	      	}
	    });
	    
	    $("#scrollUp").click(function(){
	    
	    	divHeight = $(box).height();
			divMargin = $(box).css('marginTop');	  
		  
		  	if(divMargin != '0px'){	  	
		  		margeDown = parseInt(divMargin) + parseInt(scrollVar);	  	
		  	}else margeDown = 0;
		  
	      	$(box).animate({  
	        	marginTop: margeDown + "px"
	      	}, 500);
	      
	    });

	});
}

window.onload = function() {
	for (i = 0; i < elementInit.length; i++)
		elementInit[i]();
}

$("select:has(option[value=]:first-child)").on('change', function() {
    $(this).toggleClass("empty", $.inArray($(this).val(), ['', null]) >= 0);
}).trigger('change');