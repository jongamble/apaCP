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
	    console.log(isFormValid);

	    // Insert Ajax call to insert data into database
	    var form_data = [];
		form_data["site_name"] = $('#site-name').val();
		form_data["domain_name"] = $('#domain-name').val();
		form_data["user_name"] = $('#user-name').val();
		form_data["user_pass"] = $('#user-pass').val();
		form_data["folder_name"] = $('#folder-name').val();
		form_data["client_type"] = $('#client-type').val();
		console.log(form_data);
		if(isFormValid == true){
			$.ajax({
				type: 'POST',
				data: {
					'site_name' : form_data["site_name"],
					'domain_name' : form_data["domain_name"],
					'user_name' : form_data["user_name"],
					'user_pass' : form_data["user_pass"],
					'folder_name' : form_data["folder_name"],
					'client_type' : form_data["client_type"]
				},
				url: 'library/ajax-functions/db.insertForm.php',
				dataType: 'json',
				success: function(data){
					//$('.error_message').animate({opacity:0});
					//$('.thank_you_message').fadeIn();
					$('.active-hosts').load('library/includes/inc.activeHosts.php');
				},
				error: function(data){
					console.log('Error');
					console.log(data);
				}
			});
		} else {
			//$('.error_message').animate({opacity:1});
			console.log('Error with input to ajax');
		}	
	    return false;
	});
});