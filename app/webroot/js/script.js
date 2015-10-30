$(document).ready(function(){
	$('#UserBirthdate').datepicker({
		dateFormat: 'yy-mm-dd'
	});

	$('#UserAvatar').change(function(){
	    var fileReader = new FileReader();
	    fileReader.readAsDataURL(this.files[0]);
	    fileReader.onload = function (event) {
	        $('#image-preview').html('<img src="' + event.target.result + '">');
	    };
	});
});