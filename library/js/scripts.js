jQuery(document).ready(function($) {
	$(".create-host").on('submit', function(){
		var isFormValid = true;
		$(".create-host .input-text").each(function(){
	        if ($.trim($(this).val()).length == 0){
	            $(this).addClass("form-error");
	            isFormValid = false;
	        }
	        else{
	            $(this).removeClass("form-error");
	        }
	    });

	    if (!isFormValid){
	    	$('.test-output .module-content').html("<p>Please fill in all fields</p>");
	    }

	    return isFormValid;
	});
});