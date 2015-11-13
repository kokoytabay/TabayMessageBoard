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
		$(document).on('click', '.delete', function(event){
			event.preventDefault();

			var that = $(this);
			var url = that.attr('href');
			var parentTable = that.closest('table');
			if (confirm('Are you sure you want to delete?')) {
				$.ajax({
					url: url,
					beforeSend: function(){
						parentTable.html('<tr><td class="align-center">Loading...</td></tr>');
					}
				}).done(function(response){
					parentTable.fadeOut('slow', function(){
						parentTable.remove();

						if (response == 'redirect') {
							window.location = '../../messages';
						}
					});
				});
			}
		});
	}

	if ($('#MessageContentViewForm').length) {
		$('#MessageContentViewForm').submit(function(event){
			event.preventDefault();

			var that = $(this);
			var url = that.attr('action');
			var data = that.serialize();
			var loadingReply = $('#loading-reply');
			if ($('#MessageContentContent').val() != '') {
				$.ajax({
					url: url,
					method: 'POST',
					data: data,
					beforeSend: function(){
						loadingReply.html('Loading...');
					}
				}).done(function(html){
					$(html).prependTo('.messages-list:first').hide().fadeIn('slow', function(){
						loadingReply.html('');
					});
				});
			}
		});
	}

	if ($('#search-form').length) {
		$('#search-form').submit(function(event){
			event.preventDefault();

			var that = $(this);
			var url = that.attr('action');
			var data = that.serialize();
			var firstMessagesList = $('.messages-list:first');
			if ($('#search').val() != '') {
				$.ajax({
					url: url,
					method: 'GET',
					data: data,
					beforeSend: function(){
						firstMessagesList.html('<div class="align-center">Loading...</div>');
					}
				}).done(function(html){
					firstMessagesList.html(html).hide().fadeIn('slow');
				});
			}
		});
	}
});