$(document).ready(function() {
	$("#saveImg").click(function(event) {
		var fd  = new FormData();

		$.each($("input[type='file']")[0].files, function(i, file) {
			fd.append('img[]', file);
		});
		

		$.ajax({
			type: "POST",
			url: "post.php",
			data: fd,
			contentType: false, 
    		processData: false,
			success: function (response) {
				alert(response);
			}
		});
		return false;

	});
});
