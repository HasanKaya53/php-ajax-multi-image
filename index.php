<html>
	<head>
		<title>PHP AJAX multi img upload</title>
		<meta charset="utf-8">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
		<script type="text/javascript" src="ajax.js"></script>
	</head>

	<body>
		
		<form id="imgUploadForm" method="POST" action="#">
			<input type="file" name="img" id="img" multiple>
			<button id="saveImg" name="saveImg">Save Img</button>
		</form>

	</body>
</html>
