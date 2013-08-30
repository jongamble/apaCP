jQuery(document).ready(function($) {
	
// Start the Create Host submit button functionality
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

		function writeRow(data){
			var output = '<tr class="active-hosts-row">\n';
			output += '<td class="active-hosts-data-item">' + data['site_name'] + '</td>';
			output += '<td class="active-hosts-data-item">' + data['domain_name'] + '</td>';
			output += '<td class="active-hosts-data-item">' + data['user_name'] + '</td>';
			output += '<td class="active-hosts-data-item">' + data['folder_name'] + '</td>';
			output += '<td class="active-hosts-data-item">' + data['client_type'] + '</td>';
			output += '<td class="active-hosts-data-item">' + data['active'] + '</td>';
			output += '<td class="active-hosts-data-item active-hosts-icons"><a href="#' + data["id"] + '" data-item-id="' + data["id"] + '" class="edit-host"><i class="icon-cog"></i></a><a href="#' + data["id"] + '" data-item-id="' + data["id"] + '" class="trash-host"><i class="icon-trash"></i></a></td>';
			output += '</tr>';
			return output;
		}

	    if (!isFormValid){
	    	$('.test-output .module-content').html("<p>Please fill in all fields</p>");
	    }
	    
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
					//$('tbody').prepend()
					console.log(data);
					$(writeRow(data)).hide().prependTo('.active-hosts-list').fadeIn(800);
					$('.create-error').hide();
					$('.create-success').fadeIn(800);

				},
				error: function(data){
					console.log('Error');
					console.log(data);
					$('.create-success').hide();
					$('.create-error').fadeIn(800);
				}
			});
		} else {
			//$('.error_message').animate({opacity:1});
			console.log('Error with input to ajax');
			$('.create-success').hide();
			$('.create-error').fadeIn(800);
		}	
	    return false;
	});
// End the Create Host Submit Button Functionality

// Start the Delete Host Trash Button Functionality
	$('.trash-host').on('click', function(){
		var itemID = $(this).data("item-id");
		
		$.ajax({
		  url: 'library/ajax-functions/db.deleteHost.php',
		  type: 'POST',
		  dataType: 'json',
		  data: {
		  	'item_id': itemID
		  },
		  context: this,
		  success: function(data, textStatus, xhr) {
		    $(this).parents('.active-hosts-row').fadeOut(500, function() {$(this).remove()});
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log('error');
		    console.log($(this));
		    console.log('errorThrown');
		    console.log('textStatus');
		    console.log('xhr');

		  }
		});
		return false;
	});
});