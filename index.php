<!DOCTYPE html>
<html lang="en">

<head>
	<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
	<title>Table Processing Plugin</title>
</head>

<body>
	<form action="visual.php" enctype="multipart/form-data" method="post">
		<label for="upload">Select files (accepts only Excel 2007+ files):</label>
		<input type="file" id="upload" name="upload[]" accept=".xlsx" multiple="multiple"><br><br>
		<input type="submit">
	</form>
</body>

</html>
