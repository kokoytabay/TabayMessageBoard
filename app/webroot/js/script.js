$(document).ready(function(){
	if ($('#UserBirthdate').length) {
		$('#UserBirthdate').datepicker({
			dateFormat: 'yy-mm-dd'
		});
	}
	
	if ($('#UserAvatar').length) {
		$('#UserAvatar').change(function(){
		    var fileReader = new FileReader();
		    fileReader.readAsDataURL(this.files[0]);
		    fileReader.onload = function (event) {
		        $('#image-preview').html('<img src="' + event.target.result + '">');
		    };
		});
	}
	
	if ($('#MessageToId').length) {
		$('#MessageToId').select2({
			placeholder: 'Search for a recipient',
			allowClear: true
		});
	}

	if ($('.messages-list').length) {
		$('.messages-list').jscroll({
			autoTrigger: false,
			nextSelector: 'a[rel="next"]',
			contentSelector: '.messages-list'
		});
	}

	if ($('.delete').length) {
		$('.delete').click(function(event){
			event.preventDefault();

			var that = $(this);
			var url = that.attr('href');
			var parent_table = 	that.closest('table');
			if (confirm('Are you sure you want to delete?')) {
				$.ajax({
					url: url,
					beforeSend: function() {
						parent_table.html('<tr><td class="align-center">Loading...</td></tr>');
					}
				}).done(function(){
					parent_table.fadeOut('slow', function(){
						parent_table.remove();
					});
				});
			}
		});
	}
});